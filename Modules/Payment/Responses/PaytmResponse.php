<?php

namespace Modules\Payment\Responses;

use Modules\Order\Entities\Order;
use Modules\Payment\GatewayResponse;
use Modules\Payment\HasTransactionReference;

class PaytmResponse extends GatewayResponse implements HasTransactionReference
{
    private $order;
    private $clientResponse;

    public function __construct(Order $order, $clientResponse)
    {
        $this->order = $order;
        $this->clientResponse = $clientResponse;
    }

    public function getOrderId()
    {
        return $this->order->id;
    }

    public function getTransactionReference()
    {
        return $this->clientResponse['TXNID'];
    }

    public function toArray()
    {
        return parent::toArray() + [
            'amount' => $this->order->total->convertToCurrentCurrency()->round()->amount(),
            'txnToken' => $this->clientResponse->txnToken,
        ];
    }
}
