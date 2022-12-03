<?php

namespace Modules\Payment\Responses;

use Modules\Order\Entities\Order;
use Modules\Payment\ShouldRedirect;
use Modules\Payment\GatewayResponse;
use Modules\Payment\HasTransactionReference;

class InstamojoResponse extends GatewayResponse implements ShouldRedirect, HasTransactionReference
{
    private $order;
    private $clientResponse;

    public function __construct(Order $order, array $clientResponse)
    {
        $this->order = $order;
        $this->clientResponse = $clientResponse;
    }

    public function getOrderId()
    {
        return $this->order->id;
    }

    public function getRedirectUrl()
    {
        return $this->clientResponse['longurl'];
    }

    public function getTransactionReference()
    {
        return $this->clientResponse['payment_id'];
    }
}
