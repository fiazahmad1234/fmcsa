<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Payment;

class ProPaymentController extends Controller
{
    public function check($plan) // <-- plan from URL
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Please login first.');
        }

        $payment = Payment::where('user_id', $user->id)
            ->where('status', 'success')
            ->latest()
            ->first();

        if (!$payment) {
            return redirect('/checkout')
                ->with('info', 'Please complete payment first.');
        }

        // 🔥 Match URL plan with DB plan
        if ($payment->plan === $plan) {
            return view('dashboard.index'); // <-- AUTO BREAK
        }

        return redirect('/checkout')
            ->with('info', 'Plan does not match your payment.');
    }
}
