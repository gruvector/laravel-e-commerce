<?php

namespace Modules\Payment\Gateways;

use Illuminate\Http\Request;
use Modules\Order\Entities\Order;
use Modules\Payment\GatewayInterface;
use Modules\Payment\Responses\NullResponse;

class CheckPayment implements GatewayInterface
{
    public $label;
    public $description;
    public $instructions;

    public function __construct()
    {
        $this->label = setting('check_payment_label');
        $this->description = setting('check_payment_description');
        $this->instructions = setting('check_payment_instructions');
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
