<?php

namespace Modules\Payment\Gateways;

use Exception;
use Illuminate\Http\Request;
use Modules\Order\Entities\Order;
use Modules\Payment\GatewayInterface;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use Modules\Payment\Responses\PayPalResponse;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;

class PayPal implements GatewayInterface
{
    public $label;
    public $description;

    public function __construct()
    {
        $this->label = setting('paypal_label');
        $this->description = setting('paypal_description');
    }

    public function client()
    {
        return new PayPalHttpClient($this->environment());
    }

    private function environment()
    {
        if (setting('paypal_test_mode')) {
            return new SandboxEnvironment(setting('paypal_client_id'), setting('paypal_secret'));
        }

        return new ProductionEnvironment(setting('paypal_client_id'), setting('paypal_secret'));
    }

    public function purchase(Order $order, Request $r)
    {
        try {
            $request = new OrdersCreateRequest;
            $request->prefer('return=representation');
            $request->body = $this->buildRequestBody($order);
        } catch (Exception $e) {
            throw new Exception(json_decode($e->getMessage())->message ?? '');
        }

        return new PayPalResponse($order, $this->client()->execute($request));
    }

    public function complete(Order $order)
    {
        try {
            $request = new OrdersCaptureRequest(request('resourceId'));
        } catch (Exception $e) {
            throw new Exception(json_decode($e->getMessage())->message ?? '');
        }

        return new PayPalResponse($order, $this->client()->execute($request));
    }

    private function buildRequestBody($order)
    {
        return [
            'intent' => 'CAPTURE',
            'payer' => [
                'name' => [
                    'given_name' => $order->customer_first_name,
                    'surname' => $order->customer_last_name,
                ],
                'email_address' => $order->customer_email,
                'address' => [
                    'address_line_1' => $order->billing_address_1,
                    'address_line_2' => $order->billing_address_2,
                    'admin_area_2' => $order->billing_city,
                    'admin_area_1' => $order->billing_state,
                    'postal_code' => $order->billing_zip,
                    'country_code' => $order->billing_country,
                ],
            ],
            'purchase_units' => [
                [
                    'reference_id' => $order->id,
                    'amount' => [
                        'currency_code' => setting('default_currency'),
                        'value' => (string) $order->total->round()->amount(),
                    ],
                    'shipping' => [
                        'name' => [
                            'full_name' => $order->customer_full_name,
                        ],
                        'address' => [
                            'address_line_1' => $order->shipping_address_1,
                            'address_line_2' => $order->shipping_address_2,
                            'admin_area_2' => $order->shipping_city,
                            'admin_area_1' => $order->shipping_state,
                            'postal_code' => $order->shipping_zip,
                            'country_code' => $order->shipping_country,
                        ],
                    ],
                ],
            ],
            'application_context' => [
                'brand_name' => setting('store_name'),
                'shipping_preferences' => 'SET_PROVIDED_ADDRESS',
                'user_action' => 'PAY_NOW',
            ],
        ];
    }
}
