<?php

namespace App\Classes\ThirdPartPay;

//class name should base on third part provider name + 'PaymentServiceProvider' and must extend PaymentServiceProviderAbs
class MPGPaymentServiceProvider extends PaymentServiceProviderAbs
{
    protected $sendParams = [
        'MerchantID' => '',
        'RespondType' => '',
        'CheckValue' => '',
        'TimeStamp' => '',
        'Version' => '',
        'MerchantOrderNo' => '',
        'Amt' => '',
        'ItemDesc' => '',
        'Email' => '',
        'LoginType' => '',
    ];

    protected $checkParams = [
        'HashKey' => '',
        'Amt' => '',
        'MerchantID' => '',
        'MerchantOrderNo' => '',
        'TimeStamp' => '',
        'Version' => '',
        'HashIV' => ''
    ];

    protected function setCheckValueToSendParams()
    {
        $data = [];
        foreach ($this->checkParams as $key => $value) {
            if (empty($value)) {
                throw new \Exception("check Value {$key} is required");
            }
            $data[] = "$key=$value";
        }
        $sdata = implode('&', $data);
        $this->sendParams['CheckValue'] = strtoupper(hash('sha256',$sdata));
    }
}