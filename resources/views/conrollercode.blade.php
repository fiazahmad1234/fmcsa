<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Pool;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DotDataExport;

class FmcsaController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function fetch(Request $request)
    {
        $request->validate([
        'start_dot' => 'required|numeric',
        'end_dot'   => 'required|numeric',
    ]);

    ini_set('max_execution_time', 1200);

    // 1. Generate the sequence between the two numbers
    $start = (int) $request->start_dot;
    $end   = (int) $request->end_dot;
    
    // range() handles the generation; min/max ensures order doesn't matter
    $inputs = range(min($start, $end), max($start, $end));

    // Safety check to prevent IP bans or server timeout
    if (count($inputs) > 200) {
        return redirect()->back()->with('error', 'Please limit your range to 200 DOT numbers at a time.');
    }
        $headers = ['User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/121.0.0.0'];

        $responses = Http::pool(function (Pool $pool) use ($inputs, $headers) {
            foreach ($inputs as $id) {
                $cleanId = strtoupper(trim($id));
                $isMc = str_starts_with($cleanId, 'MC');
                $param = $isMc ? 'MC_MX' : 'USDOT';
                $val = $isMc ? substr($cleanId, 2) : $cleanId;

                // SAFER Snapshot
                $pool->as("safer_{$id}")->withHeaders($headers)->timeout(10)
                    ->get("https://safer.fmcsa.dot.gov/query.asp?searchtype=ANY&query_type=queryCarrierSnapshot&query_param={$param}&query_string={$val}");
                
                // SMS Registration (Note: This works best with DOT numbers. 
                // If $id is an MC, this specific request might return 'Not Found')
                $pool->as("reg_{$id}")->withHeaders($headers)->timeout(10)
                    ->get("https://ai.fmcsa.dot.gov/SMS/Carrier/{$id}/CarrierRegistration.aspx");
            }
        });

        $allData = [];
        foreach ($inputs as $id) {
            $saferRes = $responses["safer_{$id}"] ?? null;
            $regRes   = $responses["reg_{$id}"] ?? null;

            $saferBody = ($saferRes instanceof \Illuminate\Http\Client\Response && $saferRes->successful()) 
                ? $saferRes->body() : null;

            $regBody = ($regRes instanceof \Illuminate\Http\Client\Response && $regRes->successful()) 
                ? html_entity_decode($regRes->body()) : '';

            if (!$saferBody) {
                $allData[] = [
                    'DOT' => $id,
                    'CompanyName' => 'Connection Failed',
                    'Status' => 'OFFLINE',
                    'Phone' => 'N/A',
                    'Email' => 'N/A'
                ];
                continue;
            }

            // --- EXTRACTION ---
            preg_match('/Legal Name.*?<td.*?>(.*?)<\/td>/si', $saferBody, $company);
            preg_match('/MC\/MX\/FF Number.*?<td.*?>(.*?)<\/td>/si', $saferBody, $mc);
            preg_match('/USDOT Status.*?<li><b>(.*?)<\/b>/si', $saferBody, $status);
            preg_match('/Power Units.*?<td.*?>(.*?)<\/td>/si', $saferBody, $powerUnits);
            preg_match('/Drivers.*?<td.*?>(.*?)<\/td>/si', $saferBody, $drivers);
            preg_match('/Phone.*?<td.*?>(.*?)<\/td>/si', $saferBody, $phone);
            preg_match('/Entity Type.*?<td.*?>(.*?)<\/td>/si', $saferBody, $entityType);
            preg_match('/MCS-150 Form Date.*?<td.*?>(.*?)<\/td>/si', $saferBody, $mcsDate);

            // 5. Physical Address (for City/State/County info)
            preg_match('/Physical\s*Address.*?<td[^>]*>(.*?)<\/td>/si', $saferBody, $addrMatch);
            $fullAddr = isset($addrMatch[1]) ? trim(strip_tags($addrMatch[1])) : '';
            
            // Clean up address to get City, State
            $location = 'N/A';
            if (!empty($fullAddr)) {
                // Matches "CITY, ST 12345"
                if (preg_match('/([^,]+),\s*([A-Z]{2})\s*(\d{5})?/i', $fullAddr, $loc)) {
                    $location = trim($loc[1]) . ', ' . trim($loc[2]);
                } else {
                    $location = $fullAddr; // Fallback to raw address if regex fails
                }
            }
            
            // --- IMPROVED EMAIL EXTRACTION ---
            $email = 'Not Found';
            // Look for the "Email Address:" label specifically
            if (preg_match('/Email\s*Address:.*?([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6})/si', $regBody, $emailMatches)) {
                $email = trim($emailMatches[1]);
            } else {
                // Fallback: search for any email pattern in the registration body
                if (preg_match('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}/', $regBody, $fallback)) {
                    $email = $fallback[0];
                }
            }

            $allData[] = [
                'DOT'         => $id,
                'CompanyName' => trim(strip_tags($company[1] ?? 'N/A')),
                'MC'          => trim(strip_tags($mc[1] ?? 'N/A')),
                'Location'    => $location,
                'Status'      => trim(strip_tags($status[1] ?? 'N/A')),
                'PowerUnits'  => trim(strip_tags($powerUnits[1] ?? '0')),
                'Drivers'     => trim(strip_tags($drivers[1] ?? '0')),
                'Phone'       => trim(strip_tags($phone[1] ?? 'N/A')),
                'EntityType'  => trim(strip_tags($entityType[1] ?? 'N/A')),
                'MCS150Date'  => trim(strip_tags($mcsDate[1] ?? 'N/A')),
                'Email'       => $email,
            ];
        }

        $request->session()->put('allData', $allData);
        return view('welcome', compact('allData'));
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