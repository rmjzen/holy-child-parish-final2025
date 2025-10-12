<?php

namespace App\Http\Controllers;

use App\Models\SacramentalService;
use Illuminate\Http\Request;

class  StripeController extends Controller
{
    public function index(){
        return view('payment.index');

    }

    public function checkout(){
        
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));


        $session = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'php',
                        'product_data' => [
                            'name' => 'Sacramental Service Fee',
                        ],
                        'unit_amount' => 10000,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('stripe.success'),
            'cancel_url' => route('stripe.cancel'),
        ]);

        return redirect()->away($session->url);
    }

    public function success(){
        return view('payment.success');
    }

    public function cancel()
    {
        return view('payment.success');
    }
}
