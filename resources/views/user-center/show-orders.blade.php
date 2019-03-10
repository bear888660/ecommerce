@extends('layouts.front')

@section('title', 'Home')
@section('content')

<section class="text-center">
            <br/>
            <br/>
</section>
<div class="row text-left">
        @if (count($orders)> 0)
            <table class="table">
                <thread >
                    <tr align="center">
                        <th>訂購日期</th>
                        <th>編號</th>
                        <th>付款方式</th>
                        <th>付款狀態</th>
                        <th>進度</th>
                        <th>訂單金額</th>
                    </tr>
                </thread>
                <tbody>
                    @foreach($orders as $order)
                    <tr align="center">
                        <td>{{$order->created_at}}</td>
                        <td width="16%">
                            <a href="/user-center/order-details?orderNo={{$order->order_no}}">
                                {{$order->order_no}}
                            </a>
                        </td>
                        <td width="16%">
                            {{\App\Order::$shippingMethodMap[$order->shipping_method]}}
                        </td>
                        <td width="16%">
                            {{\App\Order::$payStatusMap[$order->pay_status]}}
                            @if($order->pay_status === \App\Order::PAY_STATUS_UNPAID)
                                 <a href="{{route('payment.MPGpay', ['orderId'=>$order->id])}}">重新付款</a>
                            @endif
                        </td>
                        <td width="16%">
                            {{\App\Order::$shippingProgressMap[$order->shipping_progress]}}
                        </td>
                        <td width="16%">{{$order->order_price}}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div align="center">{{ $orders->appends(Request::except('page'))->links() }}</div>
        @else
            <section class="text-center">
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                            無訂單資料
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
            </section>
        @endif

</div>
<section class="text-center">
            <br/>
            <br/>
            <br/>
            <br/>
</section>

@endsection
