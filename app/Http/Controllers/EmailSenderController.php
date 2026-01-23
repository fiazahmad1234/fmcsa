<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmailSubjectImport;
use App\Mail\TruckerMail;

class EmailSenderController extends Controller
{
    // Show upload form
    public function index()
    {
        return view('emails.upload'); // form view
    }

    // Handle Excel upload and send emails
    public function sendEmails(Request $request)
    {
        $request->validate([
            'excel' => 'required|mimes:xlsx,xls,csv',
        ]);

        $file = $request->file('excel');

        $import = new EmailSubjectImport();
        Excel::import($import, $file);

        foreach ($import->emails as $item) {
            Mail::to($item['email'])->send(new TruckerMail($item['subject']));
        }

        return back()->with('success', 'Emails sent to ' . count($import->emails) . ' recipients!');
    }
}
