<?php

namespace Modules\Order\Http\Controllers\Admin;

use Modules\Order\Entities\Order;
use Modules\Order\Entities\OrderProduct;
use Modules\Order\Events\OrderStatusChanged;

class OrderStatusController
{
    /**
     * Update the specified resource in storage.
     *
     * @param \Modules\Order\Entities\Order $request
     * @return \Illuminate\Http\Response
     */
    public function update(Order $order)
    {
        $order->update(['status' => request('status')]);

        $this->adjustStock($order);

        $message = trans('order::messages.status_updated');

        event(new OrderStatusChanged($order));

        return $message;
    }

    private function adjustStock(Order $order)
    {
        if (in_array(request('status'), [Order::CANCELED, Order::REFUNDED])) {
            $this->restoreStock($order);
        } else {
            $this->reduceStock($order);
        }
    }

    private function restoreStock(Order $order)
    {
        $order->products->each(function (OrderProduct $orderProduct) {
            $orderProduct->product->increment('qty', $orderProduct->qty);
        });
    }

    private function reduceStock(Order $order)
    {
        $order->products->each(function (OrderProduct $orderProduct) {
            $orderProduct->product->decrement('qty', $orderProduct->qty);
        });
    }
}
