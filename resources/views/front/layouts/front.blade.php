<!doctype html>
<html class="no-js" lang="en" dir="ltr">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="x-ua-compatible" content="ie=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>
            @yield('title')
        </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <link rel="stylesheet" href="{{asset('dist/css/foundation.css')}}"/>
        <link rel="stylesheet" href="{{asset('dist/css/app.css')}}"/>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css" rel="stylesheet">
        <script src="{{asset('dist/js/vendor/jquery.js')}}"></script>
        <script src="{{asset('dist/js/TWzipcode/jquery.twzipcode.js')}}"></script>

        <style type="text/css">
            #twzipcode select, #twzipcode input{
                width:10%;
                display:inline-block;
                border:10px;
            }

            .row input {
                display:inline-block;
            }

            .is-invalid {
                border: 1px solid red !important;
            }

        </style>
    </head>
    <body>
        <div  class="top-bar">
            <div style="color:white" class="top-bar-left">
                <h4 class="brand-title">
                    <a href="{{url('/')}}">
                        <i class="fa fa-home fa-lg" aria-hidden="true">
                        </i>
                        Home
                    </a>
                </h4>
            </div>
            <div class="top-bar-right">
                <ol class="menu">
                    @foreach($nav_product_categories as $nav_product_category)
                        <li>
                            <a href="/{{$nav_product_category->en_name}}">
                                {{$nav_product_category->name}}
                            </a>
                        </li>
                    @endforeach
                    <li>
                        <a href="{{route('cart.index')}}">
                            <i class="fa fa-shopping-cart fa-2x" aria-hidden="true">
                            </i>
                            CART
                            <span class="alert badge">
                                {{Cart::count()}}
                            </span>
                        </a>
                    </li>

                    @guest
                        <li>
                            <a href="{{ route('login') }}">
                               <font>登入</font>
                            </a>
                        </li>
                    @else
                        <li>
                               <font><b>{{Auth::user()->name}}</b> 您好</font>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('user.logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                登出
                            </a>

                            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ol>
            </div>
        </div>

        @yield('content')

        <footer class="footer">
        <div class="row full-width">
            <div class="small-12 medium-4 large-4 columns">
            <i class="fi-laptop"></i>
            <p>Coded with love by Webdevmatics for educational purpose only</p>
            </div>
            <div class="small-12 medium-4 large-4 columns">
            <i class="fi-html5"></i>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit impedit consequuntur at! Amet sed itaque nostrum, distinctio eveniet odio, id ipsam fuga quam minima cumque nobis veniam voluptates deserunt!</p>
            </div>

            <div class="small-6 medium-4 large-4 columns">
            <h4>Follow Us</h4>
            <ul class="footer-links">
                <li><a href="https://github.com/webdevmatics">GitHub</a></li>
                <li><a href="#">Facebook</a></li>
                <li><a href="https://twitter.com/webdevmatics">Twitter</a></li>
            <ul>
            </div>
        </div>
        </footer>


    <script src="{{asset('dist/js/app.js')}}"></script>

    <script type="text/javascript">
        $(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.add-to-cart').on('click', function(){
                let id = $(this).attr('productId');
                let qty = Number($('#qty').val());
                let currentNum = Number($('#currentNum').val());
                //let stock = Number($('#stock').val());

                itemNum = currentNum + qty;
                if ( itemNum > 20 ) {
                    showMessage('超過最大可購買數量!');
                    let targetNum = 20 - currentNum;
                    if (targetNum > 0 ) {
                        $('#qty').find('option[value="' + targetNum + '"]').prop('selected', true);
                    }
                    return;
                }

                $.ajax({
                    method: "POST",
                    url: "/cart",
                    data: {id, qty},
                }).done(function(data) {
                    const msg = JSON.parse(data);
                    if (msg.status === true) {
                        showMessage('商品已加入購物車');
                    } else {
                        showMessage(msg.errorMsg);
                    }

                    $('#currentNum').val($itemNum);
                }).fail((message) => {
                    showMessage('加入購物車失敗');
                });
            });


            $('.cartListNum').on('change', function(){
                const rowId = $(this).attr('rowId');
                const qty = $(this).val();
                $.ajax({
                    method: "POST",
                    url: `/cart/${rowId}`,
                    data: {qty, _method: 'PATCH'},
                }).done((data) => {

                    const msg = JSON.parse(data);
                    if (msg.status === true) {
                        $(this).attr('preValue', $(this).val());
                        $('#' + rowId).text(msg.itemPrice);
                    } else {
                        const preValue = $(this).attr('preValue');

                        $(this).find('option:selected').prop('selected', false);
                        $(this).find('option[value="' + preValue + '"]').prop('selected', true)
                        showMessage(msg.errorMsg);
                    }
                });
            });


            $('.delete-item').on('click', function(){
                let rowId = $(this).attr('rowId');
                $.ajax({
                    method: "POST",
                    data: {_method: 'DELETE'},
                    url: `/cart/${rowId}`,
                    }).done(() => {
                        $('#'+rowId).remove();
                        if ($('.items').length === 0) {
                            $('.table').remove();
                            $('form').append(
                            '<section class="text-center"><br/> <br/><br/><br/><br/><br/><br/>您的購物車中沒有商品  <a href="/home">繼續購物</a><br/><br/><br/><br/><br/></section>'
                            );
                        }
                    })
                    .fail((message) => {
                        showMessage('刪除失敗');
                    });
                });
            });
            $('.select-shipping-method').on('click', function(){
                const shippinngMethod = $('.shippingMethod:checked').val();
                if (shippinngMethod) {
                    location.href = '/cart/' + shippinngMethod;
                } else {
                    showMessage('請選擇運送方式');
                }
            });

            $('.cart-send').on('click', function(){
                const recipient = $('#recipient').val();
                const recipient_mobile = $('#recipient_mobile').val();
                const recipient_county = $('#recipient_county').val();
                const recipient_district = $('#recipient_district').val();
                const recipient_zipcode = $('#recipient_zipcode').val();
                const recipient_address = $('#recipient_address').val();
                const shippingMethod = $('#shippingMethod').val();

                $('.is-invalid').removeClass('is-invalid');
                $.ajax({
                    method: "POST",
                    data: {recipient, recipient_mobile, recipient_county, recipient_district, recipient_zipcode, recipient_address},
                    url: `/cart/${shippingMethod}`,
                    }).done((data) => {
                        const msg = JSON.parse(data);

                        if (msg.status === true) {
                            location.href="/cart/cashflow/CraditCard";
                        } else {
                            showMessage(msg.errorMsg);
                        }

                    })
                    .fail((data) => {
                        const errors = data.responseJSON.errors;
                        let msgs = [];
                        for (field in errors) {
                            const error = errors[field];
                            $('#' + field).addClass('is-invalid');
                            error.forEach((msg) => {
                                msgs.push(msg);
                            });
                        }
                        if (msgs.length > 0) {
                            showMessage(msgs.join("\n"));
                        }
                    });
            });

    </script>

    </body>
</html>
