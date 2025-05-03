<?php

namespace App\Services;

use Razorpay\Api\Api;

class RazorpayService
{
    protected $api;

    public function __construct()
    {
        $this->api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
    }

    public function createOrder($amount)
    {
        return $this->api->order->create([
            'amount' => $amount * 100, // amount in paisa
            'currency' => 'INR',
            'payment_capture' => 1 // auto-capture payment
        ]);
    }
}
