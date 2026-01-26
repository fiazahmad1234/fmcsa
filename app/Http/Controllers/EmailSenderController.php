<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\TruckerMail;

class EmailSenderController extends Controller
{
    public function index()
    {
        return view('emails.upload');
    }

    public function sendEmails(Request $request)
    {
        $request->validate([
            'excel' => 'required|mimes:xlsx,xls,csv',
        ]);

        // Load data directly into an array (Fastest for medium-sized sheets)
        $data = Excel::toArray([], $request->file('excel'));
        $rows = $data[0] ?? [];

        // Remove the header row (assuming first row is "Email", "Subject")
        array_shift($rows);

        foreach ($rows as $row) {
            $email = $row[0] ?? null;
            $subject = $row[1] ?? 'No Subject';

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Use queue() instead of send() to avoid blocking and spam triggers
                Mail::to($email)->queue(new TruckerMail($subject));
            }
        }

        return back()->with('success', 'Email delivery started for ' . count($rows) . ' recipients!');
    }
}