<?php

namespace Modules\Payment\Responses;

use Modules\Payment\GatewayResponse;
use Razorpay\Api\Order as RazorpayOrder;
use Modules\Payment\HasTransactionReference;

class RazorpayResponse extends GatewayResponse implements HasTransactionReference
{
    private $razorpayOrder;

    public function __construct(RazorpayOrder $razorpayOrder)
    {
        $this->razorpayOrder = $razorpayOrder;
    }

    public function getOrderId()
    {
        return $this->razorpayOrder->receipt;
    }

    public function getTransactionReference()
    {
        return $this->razorpayOrder->razorpay_payment_id;
    }

    public function toArray()
    {
        return $this->razorpayOrder->toArray();
    }
}
