<?php

namespace Modules\Payment\Gateways;

use Illuminate\Http\Request;
use Modules\Order\Entities\Order;
use Modules\Payment\GatewayInterface;
use Modules\Payment\Responses\NullResponse;

class COD implements GatewayInterface
{
    public $label;
    public $description;

    public function __construct()
    {
        $this->label = setting('cod_label');
        $this->description = setting('cod_description');
    }

    public function purchase(Order $order, Request $request)
    {
        return new NullResponse($order);
    }

    public function complete(Order $order)
    {
        return new NullResponse($order);
    }
}
