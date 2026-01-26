<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\EmailSubjectExport;
use Maatwebsite\Excel\Facades\Excel;

class EmailExportController extends Controller
{
    // Show the form
    public function index()
    {
        $allData = session()->get('allData', []); // fetch session data for example
        return view('email_export', compact('allData'));
    }

    // Export function (new name)
    public function exportEmailsExcel(Request $request)
    {
        $allData = $request->input('export_data'); // get from hidden input
        $allData = json_decode($allData, true);    // decode JSON

        if (empty($allData)) {
            return redirect()->back()->with('error', 'No data found to export');
        }

        return Excel::download(new EmailSubjectExport($allData), 'emails_subjects.xlsx');
    }
}
