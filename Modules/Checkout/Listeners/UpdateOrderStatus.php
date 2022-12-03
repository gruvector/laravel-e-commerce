<?php

namespace Modules\Checkout\Listeners;

use Modules\Order\Entities\Order;

class UpdateOrderStatus
{
    /**
     * Handle the event.
     *
     * @param \Modules\Checkout\Events\OrderPlaced $event
     * @return void
     */
    public function handle($event)
    {
        $event->order->update(['status' => Order::PENDING]);
    }
}
