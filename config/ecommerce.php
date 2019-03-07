<?php

return [
    'shipping_fee' => [
        'cradit_card' => env('ECOMMERCE_CRADITCARD_SHIPPING_FEE')
    ],

    'cashflow' => [
        "MPG" => [
            "serviceUrl" => env('MPG_SERVICE_URL'),
            "MerchantID" => env('MPG_MERCHANT_ID'),
            "HashKey" => env('MPG_HASH_KEY'),
            "HashIV" => env('MPG_HASH_IV')
        ]
    ]
];


