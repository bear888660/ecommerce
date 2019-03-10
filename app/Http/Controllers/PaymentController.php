<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderCashFlow;
use App\Classes\PaymentServiceProviderFactoryImp;


class PaymentController extends Controller
{
    public function payByMPG($orderId)
    {
        $order = Order::find($orderId);
        $this->authorize('view', $order);

        if ($order->pay_status === Order::PAY_STATUS_UNPAID) {

            $user = $order->user;
            $t=time();
            $config = config('ecommerce.cashflow.MPG');
            $paymetGetway = PaymentServiceProviderFactoryImp::make('MPG');

            $paymetGetway->setServiceUrl(config('ecommerce.cashflow.MPG.serviceUrl'));

            $paymetGetway->setSendParams('MerchantID', config('ecommerce.cashflow.MPG.MerchantID'));
            $paymetGetway->setSendParams('RespondType', 'JSON');
            $paymetGetway->setSendParams('TimeStamp', $t);
            $paymetGetway->setSendParams('Version', "1.2");
            $paymetGetway->setSendParams('MerchantOrderNo', $order->order_no);
            $paymetGetway->setSendParams('Amt', $order->order_price);
            $paymetGetway->setSendParams('ItemDesc', 'products');
            $paymetGetway->setSendParams('Email', $user->email);
            $paymetGetway->setSendParams('LoginType', '0');
            $paymetGetway->setSendParams('ReturnURL', config('app.url'));

            $paymetGetway->setCheckParams('HashKey', config('ecommerce.cashflow.MPG.HashKey'));
            $paymetGetway->setCheckParams('Amt', $order->order_price);
            $paymetGetway->setCheckParams('MerchantID', config('ecommerce.cashflow.MPG.MerchantID'));
            $paymetGetway->setCheckParams('MerchantOrderNo', $order->order_no);
            $paymetGetway->setCheckParams('TimeStamp', $t);
            $paymetGetway->setCheckParams('Version', '1.2');
            $paymetGetway->setCheckParams('HashIV', config('ecommerce.cashflow.MPG.HashIV'));

            $paymetGetway->checkout();
            return ;

        }
        throw new \Exception('找不到付款資訊');
    }

    public function MPGcomplete(Request $request)
    {
        $JSONData = $request->input('JSONData');
        $data = json_decode($JSONData, true);

        return view('cart.complete', [
            'success' => 'SUCCESS' === $data['Status']
        ]);
    }

    //付款提醒
    public function MPGNotify(Request $request)
    {
        $JSONData = $request->input('JSONData');
        $data = json_decode($JSONData, true);
        $orderData = json_decode($data['Result'], true);

        $order_no = $orderData['MerchantOrderNo'];

        $order = Order::where('order_no', '=', $order_no)->first();

        if ('SUCCESS' === $data['Status']) {
            $order->pay_status = Order::PAY_STATUS_PAID; 
        } else {
            $order->pay_status = Order::PAY_STATUS_FAILED;
        }
        
        $order->save();

        
        $order->orderCashFlow()->create([
            'provider' => 'MPG',
            'status' => $data['Status'],
            'message' => $data['Message'],
            'order_no' => $order_no,
            'trade_no' => $orderData['TradeNo']
        ]);
    }
}
