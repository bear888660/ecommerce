<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'recipient',
        'recipient_mobile',
        'recipient_county',
        'recipient_district',
        'recipient_zipcode',
        'recipient_address',
        'shipping_method',
        'status',
        'shipping_fee'
     ];
    function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
