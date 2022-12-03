<?php

namespace Modules\Order;

use Modules\Support\Money;
use Modules\Order\Entities\Order;
use Illuminate\Support\Collection;

class OrderCollection extends Collection
{
    public function sumTotal()
    {
        $total = $this->sum(function (Order $order) {
            return $order->total->amount();
        });

        return Money::inDefaultCurrency($total);
    }
}
