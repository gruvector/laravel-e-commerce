<?php

namespace Modules\Payment\Gateways;

use Exception;
use Illuminate\Http\Request;
use Modules\Order\Entities\Order;
use Modules\Payment\GatewayInterface;
use Modules\Payment\Responses\InstamojoResponse;

class Instamojo implements GatewayInterface
{
    public $label;
    public $description;

    public function __construct()
    {
        $this->label = setting('instamojo_label');
        $this->description = setting('instamojo_description');
    }

    public function client()
    {
        $endpoint = setting('instamojo_test_mode') ? 'https://test.instamojo.com/api/1.1/' : null;

        return new \Instamojo\Instamojo(setting('instamojo_api_key'), setting('instamojo_auth_token'), $endpoint);
    }

    public function purchase(Order $order, Request $request)
    {
        if (currency() !== 'INR') {
            throw new Exception(trans('payment::messages.only_supports_inr'));
        }

        try {
            $response = $this->client()
                ->paymentRequestCreate([
                    'purpose' => setting('store_name') . " payment for order #{$order->id}",
                    'amount' => $order->total->convertToCurrentCurrency()->round()->amount(),
                    'buyer_name' => $order->customer_full_name,
                    'email' => $order->customer_email,
                    'phone' => $order->customer_phone,
                    'send_sms' => true,
                    'redirect_url' => $this->getRedirectUrl($order),
                    'allow_repeated_payments' => false,
                ]);
        } catch (Exception $e) {
            throw new Exception(trim(trim($e->getMessage()), '"'));
        }

        return new InstamojoResponse($order, $response);
    }

    private function getRedirectUrl($order)
    {
        return route('checkout.complete.store', ['orderId' => $order->id, 'paymentMethod' => 'instamojo']);
    }

    public function complete(Order $order)
    {
        return new InstamojoResponse($order, request()->all());
    }
}
