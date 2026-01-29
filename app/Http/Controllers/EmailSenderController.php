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

    // 1. SET TIMEOUT: This allows the script to run as long as needed 
    // without the server cutting it off after 30-60 seconds.
    set_time_limit(0);

    $file = $request->file('excel');
    $import = new EmailSubjectImport();
    Excel::import($import, $file);

    // 2. DEFINE ACCOUNTS: Match each mailer with its correct 'from' email
    $accounts = [
        [
            'mailer' => 'smtp', 
            'from'   => env('MAIL_FROM_ADDRESS')
        ],
        [
            'mailer' => 'account_two', 
            'from'   => 'fiazahmad13072@gmail.com'
        ],
    ];
    $accountCount = count($accounts);

    foreach ($import->emails as $index => $item) {
        // 3. ROTATE: Pick account based on index (0, 1, 0, 1...)
        $currentAccount = $accounts[$index % $accountCount];

        // 4. SEND: Specify the mailer AND force the 'from' address
        Mail::mailer($currentAccount['mailer'])
            ->to($item['email'])
            ->send((new TruckerMail($item['subject']))->from($currentAccount['from']));

        // 5. PAUSE: Random delay to prevent being flagged as a bot
        sleep(rand(5, 10));
    }

    return back()->with('success', 'Emails sent to ' . count($import->emails) . ' recipients!');
}
}
