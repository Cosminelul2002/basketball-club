<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Stripe\Stripe as StripeGateway;
use Inertia\Inertia;
use Stripe\PaymentIntent;
use Stripe\StripeClient;

class StripeController extends Controller
{
    public function checkout(Request $request)
    {
        $stripePriceId = 'price_deluxe_album';

        $quantity = 1;

        return $request->user()->checkout([$stripePriceId => $quantity], [
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),
        ]);
    }
}
