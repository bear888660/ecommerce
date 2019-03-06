<?php

namespace App\Classes\ThirdPartPay;

abstract class PaymentServiceProviderAbs
{
    protected $sendParams = [];
    protected $checkParams = [];
    protected $serviceUrl = '';

    public function setSendParams($key, $value) {
        if (array_key_exists($key, $this->sendParams)) {
            $this->sendParams[$key] = $value;
        }
    }

    public function setCheckParams($key, $value) {
        if (array_key_exists($key, $this->checkParams)) {
            $this->checkParams[$key] = $value;
        }
    }

    public function setServiceUrl($url)
    {
        $this->serviceUrl = $url;
    }

    public function checkout()
    {
        $this->setCheckValueToSendParams();

        $html =  '<!DOCTYPE html>';
        $html .= '<html>';
        $html .=     '<head>';
        $html .=         '<meta charset="utf-8">';
        $html .=     '</head>';
        $html .=     '<body>';
        $html .=         "<form id=\"__ecpayForm\" method=\"post\" target=\"_self\" action=\"{$this->serviceUrl}\">";
        foreach ($this->sendParams as $keys => $value) {
            $html .=         "<input type=\"hidden\" name=\"{$keys}\" value=\"". htmlentities($value) . "\" />";
        }
        $html .=         '<script type="text/javascript">document.getElementById("__ecpayForm").submit();</script>';
        $html .= '</body>';
        $html .= '</html>';
        echo $html;
    }

    public function checkoutFeeback()
    {
        //do  feeback
    }

    protected abstract function setCheckValueToSendParams();
}