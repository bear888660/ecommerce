<?php

namespace App\Classes;

interface PaymentServiceProviderFactory
{
    public static function make($serviceProvider);
}