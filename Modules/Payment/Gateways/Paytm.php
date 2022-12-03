<?php

namespace Modules\Payment\Gateways;

use Exception;
use Illuminate\Http\Request;
use Modules\Order\Entities\Order;
use Modules\Payment\GatewayInterface;
use paytm\paytmchecksum\PaytmChecksum;
use Modules\Payment\Responses\PaytmResponse;

class Paytm implements GatewayInterface
{
    public $label;
    public $description;

    public function __construct()
    {
        $this->label = setting('paytm_label');
        $this->description = setting('paytm_description');
    }

    public function purchase(Order $order, Request $request)
    {
        if (currency() !== 'INR') {
            throw new Exception(trans('payment::messages.only_supports_inr'));
        }

        $params = ['body' => $this->getRequestBody($order)];

        $checksum = PaytmChecksum::generateSignature(
            json_encode($params['body'], JSON_UNESCAPED_SLASHES),
            setting('paytm_merchant_key')
        );

        $params['head'] = ['signature' => $checksum];

        $ch = curl_init($this->getEndpoint($order));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params, JSON_UNESCAPED_SLASHES));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

        $response = json_decode(curl_exec($ch))->body;

        if ($response->resultInfo->resultStatus === 'F') {
            throw new Exception('Paytm: ' . $response->resultInfo->resultMsg);
        }

        return new PaytmResponse($order, $response);
    }

    private function getRequestBody(Order $order)
    {
        return [
            'requestType' => 'Payment',
            'mid' => setting('paytm_merchant_id'),
            'websiteName' => 'WEBSTAGING',
            'orderId' => $order->id,
            'txnAmount' => [
                'value' => $order->total->convertToCurrentCurrency()->round()->amount(),
                'currency' => 'INR',
            ],
            'userInfo' => [
                'custId' => auth()->check() ? $order->customer_id : 'GUEST',
                'mobile' => $order->customer_phone,
                'email' => $order->customer_email,
                'firstName' => $order->customer_first_name,
                'lastName' => $order->customer_last_name,
            ],
        ];
    }

    private function getEndpoint(Order $order)
    {
        $endpoint = 'https://securegw.paytm.in/theia/api/v1/initiateTransaction?';

        if (setting('paytm_test_mode')) {
            $endpoint = 'https://securegw-stage.paytm.in/theia/api/v1/initiateTransaction?';
        }

        return $endpoint . http_build_query([
            'mid' => setting('paytm_merchant_id'),
            'orderId' => $order->id,
        ]);
    }

    public function complete(Order $order)
    {
        return new PaytmResponse($order, request()->all());
    }
}
