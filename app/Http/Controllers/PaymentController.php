<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Payment;
use Illuminate\Support\Facades\Hash; // ✅ Add this

use App\Models\User;
use Illuminate\Support\Facades\Auth;



class PaymentController extends Controller
{
    public function checkout()
    {
        return view('checkout');
    }

    public function processPayment(Request $request)
    {
        // Validate form input
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'amount' => 'required|numeric',
            'payment_method_id' => 'required|string',
        ]);
          // 1. Check if user already exists by email
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        // Create a new user
$password = $request->password ?? 'riaz@13072';

$user = User::create([
    'name' => $request->name,
    'email' => $request->email,
    'password' => Hash::make($password),
]);
    }
    

    // 2. Log in the user
    Auth::login($user);

        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            // Create payment intent
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->amount * 100, // amount in cents
                'currency' => 'usd',
                'payment_method' => $request->payment_method_id,
                'receipt_email' => $request->email,
                 'confirm' => true,
                 'metadata' => [
                'customer_name' => $request->name,   // this will show in Stripe dashboard
                'phone' => $request->phone ?? '',
                'address' => $request->address ?? '',
            ],
                'automatic_payment_methods' => [
                'enabled' => true,
                'allow_redirects' => 'never'
                ],
            
            ]);
               if ($paymentIntent->status === 'succeeded') {
         $amount = intval($request->amount);

                $plan = null;
                if ($amount === 80) {
                    $plan = 'pro';
                } elseif ($amount === 100) {
                    $plan = 'business';
                } elseif ($amount === 150) {
                    $plan = 'gold';
                } else {
                    $plan = 'free';
                }

            Payment::create([
                'user_id' => $user->id,
                'payment_id' => $paymentIntent->id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone ?? null,
                'address' => $request->address ?? null,
                'amount' => $request->amount,
                'currency' => 'USD',
                'status' => 'success',
                'plan' => $plan, // set automatically based on amount

            ]);
        }

            return back()->with('success', 'Payment successful! Payment ID: ' . $paymentIntent->id);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
