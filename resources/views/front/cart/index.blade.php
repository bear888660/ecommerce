@extends('front.layouts.front')

@section('title', 'Home')
@section('content')

<section class="text-center">
            <br/>
            <br/>
</section>
<div class="row text-left">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        @if (Cart::count() > 0)
        <table class="table">
            <thread>
                <th width="25%">產品</th>
                <th width="25%">價格</th>
                <th width="25%">數量</th>
                <th width="25%">刪除</th>
            </thread>


            <tbody>
                @foreach(Cart::content() as $item)
                    <tr class="items" id="{{$item->rowId}}">
                        <td>{{$item->name}}</td>
                        <td id="{{$item->rowId}}_price">{{$item->price * $item->qty}}</td>
                        <td>
                            <select rowId="{{$item->rowId}}" preValue="{{$item->qty}}" class="cartListNum" style="width:20%" name="qty" id="qty">
                                @foreach(range(1, 20) as $num)
                                    @if($item->qty == $num)
                                        <option selected value="{{$num}}">{{$num}}</option>
                                    @else
                                        <option value="{{$num}}">{{$num}}</option>
                                    @endif
                                @endforeach
                            </select>

                        </td>
                        <td>
                            <a href="#" class="delete-item button" rowId="{{$item->rowId}}">刪除</a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td><a  class="button" href="{{route('home')}}">繼續購物</a></td>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="/cart/shipping" class="btn button btn-sm btn-default">下一步</a>
                    </td>
                </tr>
            </tbody>
        </table>
        @else
            <section class="text-center">
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                            您的購物車中沒有商品  <a class="button" href="{{route('home')}}">繼續購物</a>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
            </section>
        @endif


    </form>
</div>
<section class="text-center">
            <br/>
            <br/>
            <br/>
            <br/>
</section>

@endsection
