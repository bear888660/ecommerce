<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //訂單狀態
    const PAY_STATUS_UNPAID = '1';
    const PAY_STATUS_PAID = '2';
    const PAY_STATUS_FAILED = '3';

    public static $payStatusMap = [
        self::PAY_STATUS_UNPAID => '未付款',
        self::PAY_STATUS_PAID => '已付款',
        self::PAY_STATUS_FAILED => '付款失敗'
    ];

    //出貨狀態
    const SHIPPING_PROGRESS_PENDING = '1';
    const SHIPPING_PROGRESS_DELIVERED = '2';
    const SHIPPING_PROGRESS_RECEIVED = '3';

    public static $shippingProgressMap = [
        self::SHIPPING_PROGRESS_PENDING => '未出貨',
        self::SHIPPING_PROGRESS_DELIVERED => '已出貨',
        //self::SHIPPING_PROGRESS_RECEIVED => '以收貨'
    ];

    //付款方式&運送方式
    const SHIPPING_METHOD_CREDIT_CARD = 'CreditCard';
    public static $shippingMethodMap = [
        self::SHIPPING_METHOD_CREDIT_CARD => '信用卡'
    ];

    protected $fillable = [
        'user_id',
        'recipient',
        'recipient_mobile',
        'recipient_county',
        'recipient_district',
        'recipient_zipcode',
        'recipient_address',
        'shipping_method',
        'pay_status',
        'shipping_fee',
        'order_price',
        'shipping_progress',
        'order_no'
     ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->order_no) {
                $model->order_no = static::generateOrderNo();
                if (!$model->order_no) {
                    return false;
                }
            }
        });
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderCashFlow()
    {
        return $this->hasMany(OrderCashFlow::class);
    }

    public function getOrdersByUser($userId)
    {
        return $this->where('user_id', '=', $userId);
    }



    public static function generateOrderNo()
    {
        $prefix = date('ymd');
        for ($i = 0; $i < 10; $i++) {
            $orderNo = $prefix.str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            if (!static::query()->where('order_no', $orderNo)->exists()) {
                return $orderNo;
            }
        }
    }

}
