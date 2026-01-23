<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PayPalController extends Controller
{
    private $baseUrl = "https://api-m.sandbox.paypal.com";
    private function getAccessToken() {
        $res = Http::withBasicAuth(env('PAYPAL_CLIENT_ID'), env('PAYPAL_SECRET'))
            ->asForm()
            ->post($this->baseUrl.'/v1/oauth2/token', ['grant_type'=>'client_credentials']);
        return $res->json()['access_token'];
    }

    public function createOrder() {
        $token = $this->getAccessToken();
        $res = Http::withToken($token)->post($this->baseUrl.'/v2/checkout/orders', [
            'intent'=>'CAPTURE',
            'purchase_units'=>[['amount'=>['currency_code'=>'USD','value'=>'10.00']]]
        ]);
        return response()->json($res->json());
    }

    public function captureOrder($orderId) {
        $token = $this->getAccessToken();
        $res = Http::withToken($token)->post($this->baseUrl."/v2/checkout/orders/{$orderId}/capture");
        return response()->json($res->json());
    }
}
