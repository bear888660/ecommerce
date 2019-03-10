@extends('admin.layout.admin')

@section('subject', '訂單管理');

@section('content')
<div class="table-responsive">
    @if($orders)
        <table class="table table-striped table-sm" >
            <thead>
                <tr>
                    <th>訂單編號</th>
                    <th>訂購會員</th>
                    <th>收件人</th>
                    <th>收件人電話</th>
                    <th>付款狀態</th>
                    <th>付款方式</th>
                    <th>出貨進度</th>
                    <th>總額</th>
                    <th>修改</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{$order->order_no}}</td>
                        <td>{{$order->user->name}}</td>
                        <td>{{$order->recipient}}</td>
                        <td>{{$order->recipient_mobile}}</td>
                        <td>
                            {{App\Order::$payStatusMap[$order->pay_status]}}
                        </td>
                        <td>
                            {{App\Order::$shippingMethodMap[$order->shipping_method]}}
                        </td>
                        <td>{{App\Order::$shippingProgressMap[$order->shipping_progress]}}</td>
                        <td>{{$order->order_price}}</td>
                        <td>
                            <form style="display:inline-block;margin:0" method="get" action="/admin/orders/{{$order->id}}/edit">
                                <input type="hidden" name="redirect_val" value="{{http_build_query(Request::input())}}">
                                <button class="btn btn-link btn-sm">修改</button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        <div align="center">{{ $orders->appends(Request::except('page'))->links() }}</div>
    @else
    No data
    @endif
</div>
@endsection
