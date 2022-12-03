<?php

namespace Modules\Payment\Gateways;

use Razorpay\Api\Api;
use Illuminate\Http\Request;
use Modules\Order\Entities\Order;
use Modules\Payment\GatewayInterface;
use Razorpay\Api\Order as RazorpayOrder;
use Modules\Payment\Responses\RazorpayResponse;

class Razorpay implements GatewayInterface
{
    public $label;
    public $description;

    public function __construct()
    {
        $this->label = setting('razorpay_label');
        $this->description = setting('razorpay_description');
    }

    public function client()
    {
        return new Api(setting('razorpay_key_id'), setting('razorpay_key_secret'));
    }

    public function purchase(Order $order, Request $request)
    {
        $razorpayOrder = $this->client()->order->create([
            'receipt' => $order->id,
            'amount' => $order->total->convertToCurrentCurrency()->subunit(),
            'currency' => currency(),
            'payment_capture' => true,
        ]);

        return new RazorpayResponse($razorpayOrder);
    }

    public function complete(Order $order)
    {
        $attributes = [
            'razorpay_payment_id' => request('razorpay_payment_id'),
            'razorpay_order_id' => request('razorpay_order_id'),
            'razorpay_signature' => request('razorpay_signature'),
        ];

        $this->client()->utility->verifyPaymentSignature($attributes);

        $razorpayOrder = new RazorpayOrder;
        $razorpayOrder->fill($attributes);

        return new RazorpayResponse($razorpayOrder);
    }
}
