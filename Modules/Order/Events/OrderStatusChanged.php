<?php

namespace Modules\Order\Events;

use Modules\Order\Entities\Order;
use Illuminate\Queue\SerializesModels;

class OrderStatusChanged
{
    use SerializesModels;

    /**
     * The instance of order.
     *
     * @var \Modules\Order\Entities\Order
     */
    public $order;

    /**
     * Create a new event instance.
     *
     * @param \Modules\Order\Entities\Order $order
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
}
