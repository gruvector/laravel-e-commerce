<?php

namespace Modules\Checkout\Listeners;

use Modules\Sms\Sms;
use Modules\Order\Entities\Order;
use Modules\Checkout\Events\OrderPlaced;
use Modules\Sms\Exceptions\SmsException;

class SendNewOrderSms
{
    /**
     * Handle the event.
     *
     * @param \Modules\Checkout\Events\OrderPlaced $event
     * @return void
     */
    public function handle(OrderPlaced $event)
    {
        try {
            $this->sendAdminSms($event->order);
            $this->sendCustomerSms($event->order);
        } catch (SmsException $e) {
            //
        }
    }

    private function sendAdminSms(Order $order)
    {
        if (! setting('new_order_admin_sms')) {
            return;
        }

        Sms::send(
            setting('store_phone'),
            $this->adminMessage($order)
        );
    }

    private function adminMessage(Order $order)
    {
        return trans('sms::messages.new_order', ['order_id' => $order->id]);
    }

    private function sendCustomerSms(Order $order)
    {
        if (! setting('new_order_sms')) {
            return;
        }

        Sms::send(
            $order->customer_phone,
            $this->customerMessage($order)
        );
    }

    private function customerMessage(Order $order)
    {
        return trans('sms::messages.order_has_been_placed', [
            'first_name' => $order->customer_first_name,
            'order_id' => $order->id,
        ]);
    }
}
