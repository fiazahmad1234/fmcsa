<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email'=> 'required|email',
            'message' => 'required|string'
        ]);

        // Example: send email
        // Mail::to('info@example.com')->send(new \App\Mail\ContactMail($request->all()));

        return back()->with('success', 'Your message has been sent!');
    }
}
