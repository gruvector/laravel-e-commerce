<?php

namespace Modules\Payment;

use Illuminate\Http\Request;
use Modules\Order\Entities\Order;

interface GatewayInterface
{
    public function purchase(Order $order, Request $request);

    public function complete(Order $order);
}
