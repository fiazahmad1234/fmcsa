<?php

namespace App\Http\Controllers\Auth;
use App\Models\Attendance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Carbon;
// ✅ Add this


class LoginController extends Controller
{
    // Show login page
    public function showLoginForm()
    {
        return view('login');
    }

    // Handle login
    public function loginsubmit(Request $request)
    {
        $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return redirect()->back()->with('error', 'Email not registered!');
    }

    if (!Hash::check($request->password, $user->password)) {
        return redirect()->back()->with('error', 'Incorrect password!');
    }

    auth()->login($user);

    return redirect('dashboard')->with('success', 'Login successful!');
}
    
    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

public function register(Request $request)
{
    try {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Check if user exists
        $existing = User::where('email', $request->email)->first();
        if ($existing) {
            return redirect()->back()->with('error', 'This email is already registered!');
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        auth()->login($user);

        return redirect('dashboard')->with('success', 'Registration successful!');
        
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Something went wrong: '.$e->getMessage());
    }

}
public function index1()
    {
        // This view should @extends('layouts.dashboard')
        return view('dashboard.index'); 
    }
}