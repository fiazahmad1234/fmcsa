<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailConfiguration;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmailConfigurationController extends Controller
{
    /**
     * Display all email configurations for logged-in user
     */
    public function index()
    {
        // Get all configs for the logged-in user
        $configs = EmailConfiguration::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        return view('dashboard.all_configuration', compact('configs')); // Blade: resources/views/email/all.blade.php
    }

    /**
     * Update the email configuration
     */
    public function update(Request $request, $id)
    {
        $config = EmailConfiguration::findOrFail($id);

        // Optional: only allow owner to update
        if ($config->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:email_configurations,email,{$id}",
            'password' => 'nullable|string|min:6',
            'smtp_host' => 'nullable|string',
            'smtp_port' => 'nullable|integer',
            'smtp_encryption' => 'nullable|boolean',
        ]);

        $config->name = $request->name;
        $config->email = $request->email;
        if ($request->password) {
            $config->password = Hash::make($request->password); // update only if new password entered
        }
        $config->smtp_host = $request->smtp_host;
        $config->smtp_port = $request->smtp_port;
        $config->smtp_encryption = $request->smtp_encryption ?? 1;

        $config->save();

        return redirect()->back()->with('success', 'Email configuration updated successfully!');
    }

    /**
     * Delete the email configuration
     */
    public function destroy($id)
    {
        $config = EmailConfiguration::findOrFail($id);

        // Optional: only allow owner to delete
        if ($config->user_id !== Auth::id()) {
            abort(403);
        }

        $config->delete();

        return redirect()->back()->with('success', 'Email configuration deleted successfully!');
    }
  public function contact(Request $request)
{
    // ✅ Validation
    $request->validate([
        'name'    => 'required|string|max:255',
        'number'   => 'required|string|max:11',
        'email'   => 'required|email|max:255',
        'message' => 'required|string',
    ]);

    // ✅ Store data
    Contact::create([
        'name'    => $request->name,
        'phone'   => $request->number,
        'email'   => $request->email,
        'message' => $request->message,
    ]);

    // ✅ Redirect with success
    return redirect()->back()->with('success', 'Your message has been sent successfully!');
}
public function showContacts()
{
    // Get all contacts from DB, newest first
    $contacts = Contact::orderBy('created_at', 'desc')->get();

    return view('dashboard.message', compact('contacts'));
}

}
