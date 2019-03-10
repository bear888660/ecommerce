@extends('layouts.front')
@section('title', 'shop')
@section('content')
    <div class="row">
        <div class="small-5 small-offset-1 columns">
            <div class="item-wrapper">
                <div class="img-wrapper">
                    <a href="#">
                         <img src="{{asset('images/products/' . $product->image)}}"/>
                    </a>
                </div>
            </div>
        </div>
        <div class="small-6 columns">
            <div class="item-wrapper">
                <h3 class="subheader">
                   <span class="price-tag">${{$product->price}}</span> {{$product->name}}
                </h3>
                <h3 class="subheader">
                    數量：
                    @if ($product->stock > 0 )
                        <select style="width:12%" name="qty" id="qty">
                                <option value="1" selected>1</option>
                                @foreach(range(2, 20) as $num)
                                    <option value="{{$num}}">{{$num}}</option>
                                @endforeach
                        </select>
                        <div class="row">
                            <div class="large-12 columns">
                                <a href="#" productId="{{$product->id}}" class="button  expanded add-to-cart">Add to Cart</a>
                            </div>
                        </div>
                    @else
                    已售完
                    @endif
                </h3>
            </div>
        </div>
    </div>
@endsection

@section('scriptAfterJs')
    <script>

        
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.add-to-cart').on('click', function(){
            let productId = $(this).attr('productId');
            let qty = Number($('#qty').val());

            $.ajax({
                method: "POST",
                url: "/cart",
                data: {productId, qty},
            }).done(function(data) {
                const msg = JSON.parse(data);
                if (msg.status === true) {
                    return showMessage('商品已加入購物車');
                } 
                showMessage(msg.errMsg);
            }).fail((message) => {
                showMessage('加入購物車失敗');
            });
        });
    });
    </script>
@endsection
