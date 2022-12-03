<?php

namespace Modules\Payment\Responses;

use PayPalHttp\HttpResponse;
use Modules\Order\Entities\Order;
use Modules\Payment\GatewayResponse;
use Modules\Payment\HasTransactionReference;

class PayPalResponse extends GatewayResponse implements HasTransactionReference
{
    private $order;
    private $httpResponse;

    public function __construct(Order $order, HttpResponse $httpResponse)
    {
        $this->order = $order;
        $this->httpResponse = $httpResponse;
    }

    public function getOrderId()
    {
        return $this->order->id;
    }

    public function getTransactionReference()
    {
        return $this->httpResponse->result->purchase_units[0]->payments->captures[0]->id;
    }

    public function toArray()
    {
        return parent::toArray() + ['resourceId' => $this->httpResponse->result->id];
    }
}
