<div class="address-information-wrapper">
    <h3 class="section-title">{{ trans('order::orders.address_information') }}</h3>

    <div class="row">
        <div class="col-md-6">
            <div class="billing-address">
                <h4 class="pull-left">{{ trans('order::orders.billing_address') }}</h4>

                <span>
                    {{ $order->billing_full_name }}
                    <br>
                    {{ $order->billing_address_1 }}
                    <br>

                    @if ($order->billing_address_2)
                        {{ $order->billing_address_2 }}
                        <br>
                    @endif

                    {{ $order->billing_city }}, {{ $order->billing_state_name }} {{ $order->billing_zip }}
                    <br>
                    {{ $order->billing_country_name }}
                </span>
            </div>
        </div>

        <div class="col-md-6">
            <div class="shipping-address">
                <h4 class="pull-left">{{ trans('order::orders.shipping_address') }}</h4>

                <span>
                    {{ $order->shipping_full_name }}
                    <br>
                    {{ $order->shipping_address_1 }}
                    <br>

                    @if ($order->shipping_address_2)
                        {{ $order->shipping_address_2 }}
                        <br>
                    @endif

                    {{ $order->shipping_city }}, {{ $order->shipping_state_name }} {{ $order->shipping_zip }}
                    <br>
                    {{ $order->shipping_country_name }}
                </span>
            </div>
        </div>
    </div>
</div>
