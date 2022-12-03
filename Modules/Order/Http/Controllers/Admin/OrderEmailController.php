<?php

namespace Modules\Order\Http\Controllers\Admin;

use Modules\Order\Entities\Order;
use Modules\Checkout\Mail\Invoice;
use Illuminate\Support\Facades\Mail;

class OrderEmailController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Modules\Order\Entities\Order $order
     * @return \Illuminate\Http\Response
     */
    public function store(Order $order)
    {
        Mail::to($order->customer_email)
            ->send(new Invoice($order));

        return back()->with('success', trans('order::messages.invoice_sent'));
    }
}
