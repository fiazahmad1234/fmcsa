<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Pool;
use Maatwebsite\Excel\Facades\Excel; // ✅ Import this
use App\Exports\DotDataExport;  

class FmcsaController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function fetch(Request $request)
    {
        ini_set('max_execution_time', 1200); // allow long running requests

        // Validate input
        $request->validate([
            'start_dot' => 'required|numeric',
            'end_dot'   => 'required|numeric'
        ]);

        // Setup MC range
        $start = (int) $request->start_dot;
        $end   = (int) $request->end_dot;
        $mcRange = range(min($start, $end), max($start, $end));

        $headers = [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/122.0.0.0',
            'Referer'    => 'https://safer.fmcsa.dot.gov/'
        ];

        // --- PHASE 1: Fetch MC pages concurrently to get DOT numbers ---
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

            if ($response && $response->successful()) {
                $html = str_replace('&nbsp;', ' ', $response->body());

                // Extract DOT number
                if (preg_match('/USDOT Number.*?<td[^>]*>\s*([0-9]{4,10})\s*<\/td>/si', $html, $matches)) {
                    $dotNum = trim($matches[1]);
                }

                // Skip if no legal name or DOT
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

                // --- Extract Entity Type ---
                preg_match('/Entity Type.*?<td.*?>(.*?)<\/td>/si', $html, $entityTypeMatch);
                $entityType = isset($entityTypeMatch[1]) ? trim(strip_tags($entityTypeMatch[1])) : 'N/A';

                  $operatingStatus = $this->quickMatch('/Operating Authority Status.*?<td.*?>(.*?)<\/td>/si', $html);

                // --- Extract MCS-150 Form Date ---
                $mcsDate = $this->quickMatch('/MCS-150 Form Date.*?<td.*?>(.*?)<\/td>/si', $html);

                $allData["MC$mc"] = [
                    'MC'          => "MC$mc",
                    'DOT'         => $dotNum,
                    'Location'    => $location,
                    'EntityType'  => $entityType,
                     'OperatingStatus'   => $operatingStatus,
                    'MCS150Date'    => $mcsDate,
                    'CompanyName' => $this->quickMatch('/Legal Name.*?<td.*?>(.*?)<\/td>/si', $html),
                    'Status'      => $this->quickMatch('/USDOT Status.*?<b>(.*?)<\/b>/si', $html),
                    'Phone'       => $this->quickMatch('/Phone.*?<td.*?>(.*?)<\/td>/si', $html),
                    'PowerUnits'  => $this->quickMatch('/Power Units.*?<td.*?>(.*?)<\/td>/si', $html),
                    'Drivers'     => $this->quickMatch('/Drivers.*?<td.*?>(.*?)<\/td>/si', $html),
                    'Email'       => 'Searching...' 
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

                if ($res && $res->successful()) {
                    $body = $res->body();

                    // Try multiple methods to extract email
                    if (preg_match('/lblEmail_0[^>]*>([^<]+)/i', $body, $m)) {
                        $email = trim($m[1]);
                    } elseif (preg_match('/mailto:([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6})/i', $body, $m)) {
                        $email = trim($m[1]);
                    } elseif (preg_match('/([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6})/i', $body, $m)) {
                        $email = trim($m[1]);
                    } else {
                        $email = 'Not Found';
                    }
                } else {
                    $email = 'Timeout/Error';
                }

                $allData["MC$mc"]['Email'] = $email;
            }
        }

        // Store results in session for export
        $request->session()->put('allData', $allData);

        return view('welcome', compact('allData'));
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
}
