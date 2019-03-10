@extends('admin.layout.admin')

@section('subject', '訂單管理');

@section('content')

<form action="/admin/orders/{{$order->id}}" method="post">
    @csrf
    @method('PATCH')

    @if(!empty($errors->any()))
        <div class="row col-sm-6">
            <div class="alert alert-danger">
                <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">訂單編號</label>
        <div class="col-md-6">
            {{$order->order_no}}
        </div>
    </div>

    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">收件人</label>
        <div class="col-md-6">
            {{$order->recipient}}
        </div>
    </div>

    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">收件人電話</label>
        <div class="col-md-6">
            {{$order->recipient_mobile}}
        </div>
    </div>

    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">收件人住址</label>
        <div class="col-md-6">
            {{$order->recipient_county}}
            {{$order->recipient_district}}
            {{$order->recipient_zipcode}}
            {{$order->recipient_address}}
        </div>
    </div>

    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">付款狀態</label>
        <div class="col-sm-2">
            {{App\Order::$payStatusMap[$order->pay_status]}}
            @if (App\Order::PAY_STATUS_PAID === $order->pay_status || App\Order::PAY_STATUS_FAILED === $order->pay_status)
                <a href="{{route('order.trade-review', ['id' => $order->id])}}">交易明細</a>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">付款方式</label>
        <div class="col-sm-2">
            {{App\Order::$shippingMethodMap[$order->shipping_method]}}
        </div>
    </div>

    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">出貨進度</label>
        <div class="col-sm-2">
            {{App\Order::$shippingProgressMap[$order->shipping_progress]}}
            @if (App\Order::SHIPPING_PROGRESS_PENDING === $order->shipping_progress &&
                 App\Order::PAY_STATUS_PAID === $order->pay_status)
                <button>出貨</button>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">購買明細</label>
        <div class="col-md-6">
            <table width="100%">
                <tr>
                    <td>商品</td>
                    <td>單價</td>
                    <td>數量</td>
                    <td>總價</td>
                </tr>
                @foreach($order->orderDetails as $orderDetail)
                    <tr>
                        <td>{{$orderDetail->product->name}}</td>
                        <td>{{$orderDetail->price}}</td>
                        <td>{{$orderDetail->qty}}</td>
                        <td>{{$orderDetail->price * $orderDetail->qty}}</td>
                    </tr>
                @endforeach

                <tr>
                    <td></td>
                    <td></td>
                    <td>商品總額</td>
                    <td>{{$order->order_price - $order->shipping_fee}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>運費</td>
                    <td>{{$order->shipping_fee}}</td>
                </tr>
                <tr style="border-top:1px solid black">
                    <td></td>
                    <td></td>
                    <td>商品總額</td>
                    <td>{{$order->order_price}}</td>
                </tr>


            </table>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-10">
        <a class="btn btn-primary" href="{{route('orders.index')}}?{{Request::input('redirect_val')}}">返回</a>
        </div>
    </div>
    <input name="redirect_val" type="hidden" value="{{Request::input('redirect_val')}}">
</form>
@endsection
@if (session('msg'))
    <script>alert('{{ session('msg') }}')</script>
@endif
