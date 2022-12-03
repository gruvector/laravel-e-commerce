<?php

namespace Modules\Payment;

use JsonSerializable;

abstract class GatewayResponse implements JsonSerializable
{
    abstract public function getOrderId();

    public function toArray()
    {
        $data = ['orderId' => $this->getOrderId()];

        if ($this instanceof ShouldRedirect) {
            $data['redirectUrl'] = $this->getRedirectUrl();
        }

        return $data;
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function __toString()
    {
        return json_encode($this->jsonSerialize());
    }
}
