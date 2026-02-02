<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;

class ProPaymentController extends Controller
{
    // Handle the "Choose Plan" check
    public function check()
    {
        $user = Auth::user();

        if (!$user) {
            // User not logged in → redirect to login
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        // Get the latest successful payment of the user
        $payment = Payment::where('user_id', $user->id)
                          ->where('status', 'success')
                          ->orderBy('created_at', 'desc')
                          ->first();

        if (!$payment) {
            // No payment → redirect to checkout
            return redirect('/checkout')->with('info', 'Please complete your payment to access a plan.');
        }

        // Redirect based on amount paid
        if ($payment->amount == 80) {
            // Pro plan
            return redirect('/dashboard')->with('success', 'Welcome to the Pro Plan!');
        } elseif ($payment->amount == 100) {
            // Business plan
            return redirect('/dashboard')->with('success', 'Welcome to the Business Plan!');
        } elseif ($payment->amount == 150) {
            // Gold plan
            return redirect('/dashboard')->with('success', 'Welcome to the Gold Plan!');
        } else {
            // Default fallback
            return redirect('/pro-check')->with('success', 'Welcome to your dashboard!');
        }
    }
}

