<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderCashFlow extends Model
{
    protected $fillable = [
        'status',
        'message',
        'trade_no',
        'order_no',
        'order_id',
        'provider'
    ];
}
