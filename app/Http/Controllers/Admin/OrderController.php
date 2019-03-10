<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function ship(Request $request, $id)
    {
        
        $order = Order::find($id);

        if ($order->pay_status !== Order::PAY_STATUS_PAID) {
            throw new \Exception('訂單未付款無法出貨!');
        }

        if ($order->shipping_progress !== Order::SHIPPING_PROGRESS_PENDING) {
            throw new \Exception('訂單已出貨!');
        }
        
        $order->shipped();
        flash('msg', '訂單：' . $order->order_no . '已更改為出貨!');
        return back();
    }

    public function tradeReview($id)
    {
        $order = Order::find($id);
        $orderCashFlow = $order->orderCashFlow()->first();

        if ($orderCashFlow === null) {
            flash('msg', '找不到此筆訂單交易紀錄!');
            return back();
        }
        return view('admin.orders.trade-review', compact('orderCashFlow'));
    }

}
