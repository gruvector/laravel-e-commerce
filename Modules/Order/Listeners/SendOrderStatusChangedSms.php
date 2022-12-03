<?php

namespace Modules\Order\Listeners;

use Modules\Sms\Sms;
use Modules\Order\Entities\Order;
use Modules\Order\Events\OrderStatusChanged;

class SendOrderStatusChangedSms
{
    /**
     * Handle the event.
     *
     * @param \Modules\Order\Events\OrderStatusChanged $event
     * @return void
     */
    public function handle(OrderStatusChanged $event)
    {
        if (! in_array($event->order->status, setting('sms_order_statuses', []))) {
            return;
        }

        Sms::send(
            $event->order->customer_phone,
            $this->message($event->order)
        );
    }

    private function message(Order $order)
    {
        return trans('sms::messages.order_status_changed', [
            'first_name' => $order->customer_first_name,
            'order_id' => $order->id,
            'status' => mb_strtolower($order->status()),
        ]);
    }
}
