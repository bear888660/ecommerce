<?php

namespace App\Classes;

class PaymentServiceProviderFactoryImp implements PaymentServiceProviderFactory
{
    public static function make($serviceProvider)
    {

        $serviceProvider = "\App\\Classes\\ThirdPartPay\\{$serviceProvider}PaymentServiceProvider";
        if (!class_exists($serviceProvider)) {
            throw new \exception('class' . $serviceProvider . ' is undefined');
        }
        return new $serviceProvider;
    }
}