<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Pool;
use Illuminate\Http\Client\Response; // ✅ Added for type checking
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\DotDataExport;
use App\Exports\EmailSubjectExport;
use App\Models\UserDailyFetch;
use Carbon\Carbon;

class FmcsaController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function fetch(Request $request)
    {
        ini_set('max_execution_time', 1800);
        ini_set('memory_limit', '512M');

        $request->validate([
            'start_dot' => 'required|numeric',
            'end_dot'   => 'required|numeric'
        ]);

        $start = (int) $request->start_dot;
        $end   = (int) $request->end_dot;
        $mcRange = range(min($start, $end), max($start, $end));
        //code for validaton
        
       


        $headers = [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/122.0.0.0',
            'Referer'    => 'https://safer.fmcsa.dot.gov/'
        ];

        // --- PHASE 1: Fetch MC pages concurrently ---
        $saferResponses = Http::pool(fn (Pool $pool) =>
            collect($mcRange)->map(fn ($mc) =>
                $pool->as("mc_$mc")->withHeaders($headers)->timeout(10)->asForm()->post('https://safer.fmcsa.dot.gov/query.asp', [
                    'searchtype'   => 'ANY',
                    'query_type'   => 'queryCarrierSnapshot',
                    'query_param'  => 'MC_MX',
                    'query_string' => $mc
                ])
            )
        );

        $allData = [];
        $dotNumbersToFetch = [];

        foreach ($mcRange as $mc) {
            $response = $saferResponses["mc_$mc"] ?? null;
            $dotNum = "NOT_FOUND";

            // ✅ FIX: Verify $response is a Response object and not an Exception
            if ($response instanceof Response && $response->successful()) {
                $html = str_replace('&nbsp;', ' ', $response->body());

                if (preg_match('/USDOT Number.*?<td[^>]*>\s*([0-9]{4,10})\s*<\/td>/si', $html, $matches)) {
                    $dotNum = trim($matches[1]);
                }

                if ($dotNum === "NOT_FOUND" && !str_contains($html, 'Legal Name')) continue;

                if ($dotNum !== "NOT_FOUND") {
                    $dotNumbersToFetch[$mc] = $dotNum;
                }

                preg_match('/Physical\s*Address.*?<td[^>]*>(.*?)<\/td>/si', $html, $addrMatch);
                $fullAddr = isset($addrMatch[1]) ? trim(strip_tags($addrMatch[1])) : '';
                $location = 'N/A';
                if (!empty($fullAddr)) {
                    if (preg_match('/([^,]+),\s*([A-Z]{2})\s*(\d{5})?/i', $fullAddr, $loc)) {
                        $location = trim($loc[1]) . ', ' . trim($loc[2]);
                    } else {
                        $location = $fullAddr;
                    }
                }

                preg_match('/Entity Type.*?<td.*?>(.*?)<\/td>/si', $html, $entityTypeMatch);
                $entityType = isset($entityTypeMatch[1]) ? trim(strip_tags($entityTypeMatch[1])) : 'N/A';
                
                $pattern = '/Operating Authority Status:.*?<TD[^>]*>\s*(.*?)\s*<br>/si';
                preg_match($pattern, $html, $matches);
                $operatingStatus = isset($matches[1]) ? trim(strip_tags($matches[1])) : 'N/A';

                $mcsDate = $this->quickMatch('/MCS-150 Form Date.*?<td.*?>(.*?)<\/td>/si', $html);

                $allData["MC$mc"] = [
                    'MC'          => "MC$mc",
                    'DOT'         => $dotNum,
                    'Location'    => $location,
                    'EntityType'  => $entityType,
                    'OperatingStatus' => $operatingStatus,
                    'MCS150Date'    => $mcsDate,
                    'CompanyName' => $this->quickMatch('/Legal Name.*?<td.*?>(.*?)<\/td>/si', $html),
                    'Status'      => $this->quickMatch('/USDOT Status.*?<b>(.*?)<\/b>/si', $html),
                    'Phone'       => $this->quickMatch('/Phone.*?<td.*?>(.*?)<\/td>/si', $html),
                    'PowerUnits'  => $this->quickMatch('/Power Units.*?<td.*?>(.*?)<\/td>/si', $html),
                    'Drivers'     => $this->quickMatch('/Drivers.*?<td.*?>(.*?)<\/td>/si', $html),
                    'Email'       => 'Searching...' 
                ];
            } else {
                // Handle cases where the initial MC search failed
                $allData["MC$mc"] = [
                    'MC' => "MC$mc",
                    'DOT' => 'Request Failed',
                    'Email' => 'N/A'
                    // Fill other fields with N/A as needed
                ];
            }
        }

        // --- PHASE 2: Fetch emails concurrently ---
        if (!empty($dotNumbersToFetch)) {
            $emailResponses = Http::pool(fn (Pool $pool) =>
                collect($dotNumbersToFetch)->map(fn ($dotNum, $mc) =>
                    $pool->as("email_$mc")->withHeaders($headers)->timeout(10)
                        ->get("https://ai.fmcsa.dot.gov/SMS/Carrier/{$dotNum}/CarrierRegistration.aspx")
                )
            );

            foreach ($dotNumbersToFetch as $mc => $dot) {
                $res = $emailResponses["email_$mc"] ?? null;
                $email = 'Not Found';

                // ✅ FIX: Also applied check here to prevent crashes on Phase 2
                if ($res instanceof Response && $res->successful()) {
                    $body = $res->body();

                    if (preg_match('/lblEmail_0[^>]*>([^<]+)/i', $body, $m)) {
                        $email = trim($m[1]);
                    } elseif (preg_match('/mailto:([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6})/i', $body, $m)) {
                        $email = trim($m[1]);
                    } elseif (preg_match('/([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6})/i', $body, $m)) {
                        $email = trim($m[1]);
                    }
                } else {
                    $email = 'Timeout/Error';
                }

                if (isset($allData["MC$mc"])) {
                    $allData["MC$mc"]['Email'] = $email;
                }
            }
        }
       // -----------------------------
// Update daily fetch totals in DB
// -----------------------------
$user = auth()->user();
$role = $user->getRoleNames()->first(); // Spatie roles
$today = Carbon::today();

// Get or create today's record
$dailyFetch = UserDailyFetch::firstOrCreate(
    ['user_id' => $user->id, 'fetch_date' => $today],
    ['mc_count' => 0, 'email_count' => 0]
);

// Role-based daily limits
$limits = [
    'guest'  => 20,
    'user'   => 500,
    'editor' => 1000,
];

$dailyLimit = $limits[$role ?? 'guest'] ?? 20;

// Calculate remaining emails today
$remainingMc = max(0, $dailyLimit - $dailyFetch->mc_count);

if ($remainingMc <= 0) {
    return back()->with('error', 'You have reached your daily fetching limit. Come back tomorrow or get a role to fetch more.');
}

// Limit API data to what’s allowed today
$allowedData = array_slice($allData, 0, $remainingMc);

// Count valid emails
$totalMcFetched = count($allowedData);
$totalEmailsFetched = 0;

foreach ($allowedData as $mc => $data) {
    if (isset($data['Email']) && !in_array($data['Email'], ['Not Found','Timeout/Error'])) {
        $totalEmailsFetched++;
    }
}

// Save today's totals
$dailyFetch->mc_count    += $totalMcFetched;
$dailyFetch->email_count += $totalEmailsFetched;
$dailyFetch->save();

// Store in session and send to view
$request->session()->put('allData', $allowedData);

return view('welcome', [
    'allData' => $allowedData
]);
    }

    private function quickMatch($pattern, $html)
    {
        if (preg_match($pattern, $html, $m)) {
            return trim(strip_tags($m[1]));
        }
        return 'N/A';
    }

    public function export(Request $request)
    {
        $allData = $request->session()->get('allData');
        if (empty($allData)) {
            return redirect()->back()->with('error', 'No data found to export');
        }
        return Excel::download(new DotDataExport($allData), 'fmcsa_carriers.xlsx');
    }

    public function exportEmailsExcel(Request $request)
    {
        $allData = $request->session()->get('allData');
        if (empty($allData)) {
            return redirect()->back()->with('error', 'No data found to export');
        }
        return Excel::download(new EmailSubjectExport($allData), 'emails_subjects.xlsx');
    }
}