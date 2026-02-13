<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmailSubjectImport;
use App\Mail\TruckerMail;
use App\Models\EmailConfiguration;
use Illuminate\Support\Facades\Config;  // ✅ Correct facade


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

    set_time_limit(0);

    $file = $request->file('excel');
    $import = new EmailSubjectImport();
    Excel::import($import, $file);

    $user = auth()->user();

    // ✅ Get accounts using user_id manually
    $accounts = EmailConfiguration::where('user_id', $user->id)->get();

    if ($accounts->count() == 0) {
        return back()->with('error', 'Please add at least one email configuration.');
    }

    $subjectTemplates = [
        "New Dispatch Alert for {name}",
        "Urgent Delivery Update for {name}",
        "Shipment Tracking Update for {name}",
        "Driver Assignment Notification for {name}",
        "Route Change Notification for {name}",
    ];

    foreach ($import->emails as $index => $item) {

        $name = $item['name'] ?? 'Customer';

        // ✅ Role Check
        if ($user->hasAnyRole(['admin', 'editor'])) {

            // Rotate accounts
            $account = $accounts[$index % $accounts->count()];
            $subjectTemplate = $subjectTemplates[array_rand($subjectTemplates)];

        } else {

            // Normal user → first account only
            $account = $accounts->first();
            $subjectTemplate = "New Dispatch Alert for {name}";
        }

        $subject = str_replace("{name}", $name, $subjectTemplate);

        // 🔥 Dynamic Mail Config
       Config::set('mail.mailers.dynamic', [
    'transport'  => 'smtp',
    'host'       => 'smtp.gmail.com',
    'port'       => 587,      // correct Gmail port
    'encryption' => 'tls',    // TLS for Gmail
    'username'   => trim($account->email),
    'password'   => trim($account->password), // must be plain App Password
]);

Config::set('mail.from.address', trim($account->email));
Config::set('mail.from.name', $account->name);

        Mail::mailer('dynamic')
            ->to($item['email'])
            ->send(new TruckerMail($subject, $item));

        sleep(7);
    }

    return back()->with('success', 'Emails sent successfully!');
}


}
