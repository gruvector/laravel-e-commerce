<!DOCTYPE html>
<html lang="{{ locale() }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ trans('order::print.invoice') }}</title>

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
        <link href="{{ v(Module::asset('order:admin/css/print.css')) }}" rel="stylesheet">
    </head>

    <body class="{{ is_rtl() ? 'rtl' : 'ltr' }}">
        <!--[if lt IE 8]>
            <p>You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="container">
            <div class="invoice-wrapper clearfix">
                <div class="row">
                    <div class="invoice-header clearfix">
                        <div class="col-md-3">
                            <div class="store-name">
                                <h1>{{ setting('store_name') }}</h1>
                            </div>
                        </div>

                        <div class="col-md-9 clearfix">
                            <div class="invoice-header-right pull-right">
                                <span class="title">{{ trans('order::print.invoice') }}</span>

                                <div class="invoice-info clearfix">
                                    <div class="invoice-id">
                                        <label for="invoice-id">{{ trans('order::print.invoice_id') }}:</label>
                                        <span>#{{ $order->id }}</span>
                                    </div>

                                    <div class="invoice-date">
                                        <label for="invoice-date">{{ trans('order::print.date') }}:</label>
                                        <span>{{ $order->created_at->format('Y / m / d') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="invoice-body clearfix">
                    <div class="invoice-details-wrapper">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="invoice-details">
                                    <h5>{{ trans('order::print.order_details') }}</h5>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>{{ trans('order::print.email') }}:</td>
                                                    <td>{{ $order->customer_email }}</td>
                                                </tr>

                                                <tr>
                                                    <td>{{ trans('order::print.phone') }}:</td>
                                                    <td>{{ $order->customer_phone }}</td>
                                                </tr>

                                                @if ($order->shipping_method)
                                                    <tr>
                                                        <td>{{ trans('order::print.shipping_method') }}:</td>
                                                        <td>{{ $order->shipping_method }}</td>
                                                    </tr>
                                                @endif

                                                <tr>
                                                    <td>{{ trans('order::print.payment_method') }}:</td>
                                                    <td>{{ $order->payment_method }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="invoice-address">
                                    <h5>{{ trans('order::print.shipping_address') }}</h5>

                                    <span>{{ $order->shipping_full_name }}</span>
                                    <span>{{ $order->shipping_address_1 }}</span>
                                    <span>{{ $order->shipping_address_2 }}</span>
                                    <span>{{ $order->shipping_city }}, {{ $order->shipping_state_name }} {{ $order->shipping_zip }}</span>
                                    <span>{{ $order->shipping_country_name }}</span>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6">
                                <div class="invoice-address">
                                    <h5>{{ trans('order::print.billing_address') }}</h5>

                                    <span>{{ $order->billing_full_name }}</span>
                                    <span>{{ $order->billing_address_1 }}</span>
                                    <span>{{ $order->billing_address_2 }}</span>
                                    <span>{{ $order->billing_city }}, {{ $order->billing_state_name }} {{ $order->billing_zip }}</span>
                                    <span>{{ $order->billing_country_name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="cart-list">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ trans('order::print.product') }}</th>
                                            <th>{{ trans('order::print.unit_price') }}</th>
                                            <th>{{ trans('order::print.quantity') }}</th>
                                            <th>{{ trans('order::print.line_total') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->products as $product)
                                            <tr>
                                                <td>
                                                    <span>{{ $product->name }}</span>

                                                    @if ($product->hasAnyOption())
                                                        <div class="option">
                                                            @foreach ($product->options as $option)
                                                                <span>
                                                                    {{ $option->name }}:

                                                                    <span>
                                                                        @if ($option->option->isFieldType())
                                                                            {{ $option->value }}
                                                                        @else
                                                                            {{ $option->values->implode('label', ', ') }}
                                                                        @endif
                                                                    </span>
                                                                </span>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </td>

                                                <td>
                                                    <label class="visible-xs">{{ trans('order::print.unit_price') }}:</label>
                                                    <span>{{ $product->unit_price->convert($order->currency, $order->currency_rate)->convert($order->currency, $order->currency_rate)->format($order->currency) }}</span>
                                                </td>

                                                <td>
                                                    <label class="visible-xs">{{ trans('order::print.quantity') }}:</label>
                                                    <span>{{ $product->qty }}</span>
                                                </td>
                                                <td>
                                                    <label class="visible-xs">{{ trans('order::print.line_total') }}:</label>
                                                    <span>{{ $product->line_total->convert($order->currency, $order->currency_rate)->format($order->currency) }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="total pull-right">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>{{ trans('order::print.subtotal') }}</td>
                                        <td>{{ $order->sub_total->convert($order->currency, $order->currency_rate)->format($order->currency) }}</td>
                                    </tr>

                                    @if ($order->hasShippingMethod())
                                        <tr>
                                            <td>{{ $order->shipping_method }}</td>
                                            <td>{{ $order->shipping_cost->convert($order->currency, $order->currency_rate)->format($order->currency) }}</td>
                                        </tr>
                                    @endif

                                    @if ($order->hasCoupon())
                                        <tr>
                                            <td>{{ trans('order::orders.coupon') }} (<span class="coupon-code">{{ $order->coupon->code }}</span>)</td>
                                            <td>&#8211;{{ $order->discount->convert($order->currency, $order->currency_rate)->format($order->currency) }}</td>
                                        </tr>
                                    @endif

                                    @foreach ($order->taxes as $tax)
                                        <tr>
                                            <td>{{ $tax->name }}</td>
                                            <td class="text-right">{{ $tax->order_tax->amount->convert($order->currency, $order->currency_rate)->format($order->currency) }}</td>
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <td>{{ trans('order::print.total') }}</td>
                                        <td>{{ $order->total->convert($order->currency, $order->currency_rate)->format($order->currency) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            window.print();
        </script>
    </body>
</html>
