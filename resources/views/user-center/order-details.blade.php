@extends('layouts.front')

@section('title', 'Home')
@section('content')

<section class="text-center">
            <br/>
            <br/>
</section>
<div class="row text-left">
            <table class="table">
                <thread >
                    <tr align="left">
                        <th width="25%">訂單編號：{{$order->order_no}}</th>
                        <th width="25%"></th>
                        <th width="25%"></th>
                        <th width="25%"></th>
                    </tr>
                </thread>
                <tbody>
                    <tr>
                        <td>商品名</td>
                        <td>數量</td>
                        <td>單價</td>
                        <td>小計</td>
                    </tr>
                    @foreach($order->orderDetails as $orderDetail)
                        <tr>
                            <td>
                                {{$orderDetail->product->name}}
                                    <img  width="40px" height="40px" src="{{asset('images/products/' . $orderDetail->product->image)}}">
                            </td>
                            <td>{{$orderDetail->qty}}</td>
                            <td>{{$orderDetail->price}}</td>
                            <td>
                                {{number_format($orderDetail->qty * $orderDetail->price, 0, '', ',')}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <table class="table">
                <tr>
                    <td width="30%"></td>
                    <td width="30%"></td>
                    <td  width="25%" align="right">商品總額</td>
                    <td width="25%">{{number_format($order->order_price - $order->shipping_fee, 0, '', ',')}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td align="right">運費</td>
                    <td>{{number_format($order->shipping_fee, 0, '', ',')}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td align="right">總計</td>
                    <td>{{number_format($order->order_price, 0, '', ',')}}</td>
                </tr>
            </table>
            <div align="center"><a href="{{URL::previous()}}" class="button">返回上一頁</a></div>
</div>
<section class="text-center">
            <br/>
            <br/>
            <br/>
            <br/>
</section>

@endsection
