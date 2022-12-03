<?php

namespace Modules\Payment\Responses;

use Stripe\PaymentIntent;
use Modules\Order\Entities\Order;
use Modules\Payment\GatewayResponse;
use Modules\Payment\HasTransactionReference;

class StripeResponse extends GatewayResponse implements HasTransactionReference
{
    private $order;
    private $intent;

    public function __construct(Order $order, PaymentIntent $intent)
    {
        $this->order = $order;
        $this->intent = $intent;
    }

    public function getOrderId()
    {
        return $this->order->id;
    }

    public function getTransactionReference()
    {
        return $this->intent->id;
    }

    public function toArray()
    {
        return parent::toArray() + ['clientSecret' => $this->intent->client_secret];
    }
}
