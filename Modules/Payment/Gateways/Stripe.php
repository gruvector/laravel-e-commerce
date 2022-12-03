<?php

namespace Modules\Payment\Gateways;

use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use Modules\Order\Entities\Order;
use Modules\Payment\GatewayInterface;
use Modules\Payment\Responses\StripeResponse;

class Stripe implements GatewayInterface
{
    public $label;
    public $description;

    public function __construct()
    {
        $this->label = setting('stripe_label');
        $this->description = setting('stripe_description');

        \Stripe\Stripe::setApiKey(setting('stripe_secret_key'));
    }

    public function purchase(Order $order, Request $request)
    {
        $intent = PaymentIntent::create([
            'amount' => $order->total->subunit(),
            'currency' => setting('default_currency'),
        ]);

        return new StripeResponse($order, $intent);
    }

    public function complete(Order $order)
    {
        return new StripeResponse($order, new PaymentIntent(request('paymentIntent')));
    }
}
