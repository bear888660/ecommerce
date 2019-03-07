@extends('front.layouts.front')

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
                        <th colspan="2">會員資料修改</th>
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
                        <td>
                            {{\App\Order::$shippingMethodMap[$order->shipping_method]}}
                        </td>
                        <td width="16%">
                            {{\App\Order::$shippingProgressMap[$order->shipping_progress]}}
                        </td>
                        <td width="16%">{{$order->order_price}}</td>
                        <td width="16%">
                            <a class="button" onclick="alert('目前無法退貨!!')">退貨</a>
                        </td>
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
