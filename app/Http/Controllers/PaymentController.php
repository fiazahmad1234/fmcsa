<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

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

            return back()->with('success', 'Payment successful! Payment ID: ' . $paymentIntent->id);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
