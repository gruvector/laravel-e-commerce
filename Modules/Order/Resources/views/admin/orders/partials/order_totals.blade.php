<div class="order-totals-wrapper">
    <div class="row">
        <div class="order-totals pull-right">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>{{ trans('order::orders.subtotal') }}</td>
                            <td class="text-right">{{ $order->sub_total->format() }}</td>
                        </tr>

                        @if ($order->hasShippingMethod())
                            <tr>
                                <td>{{ $order->shipping_method }}</td>
                                <td class="text-right">{{ $order->shipping_cost->format() }}</td>
                            </tr>
                        @endif

                        @foreach ($order->taxes as $tax)
                            <tr>
                                <td>{{ $tax->name }}</td>
                                <td class="text-right">{{ $tax->order_tax->amount->format() }}</td>
                            </tr>
                        @endforeach

                        @if ($order->hasCoupon())
                            <tr>
                                <td>{{ trans('order::orders.coupon') }} (<span class="coupon-code">{{ $order->coupon->code }}</span>)</td>
                                <td class="text-right">&#8211;{{ $order->discount->format() }}</td>
                            </tr>
                        @endif

                        <tr>
                            <td>{{ trans('order::orders.total') }}</td>
                            <td class="text-right">{{ $order->total->format() }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
