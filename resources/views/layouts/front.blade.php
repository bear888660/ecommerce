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
                            <a href="/categories/{{$nav_product_category->en_name}}">
                                {{$nav_product_category->name}}
                            </a>
                        </li>
                    @endforeach
                    <li>
                        <a href="{{route('cart')}}">
                            <i class="fa fa-shopping-cart fa-2x" aria-hidden="true">
                            </i>
                            CART
                            <span class="alert badge" id="shipping-badge">
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
                            <a class="dropdown-item" href="{{route('user.center')}}">
                                訂單查詢
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                登出
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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

            <p>賣東西....</p>
            </div>
            <div class="small-12 medium-4 large-4 columns">

            <p>賣東西....</p>
            </div>

            <div class="small-6 medium-4 large-4 columns">
            賣東西....
            </div>
        </div>
        </footer>
    <script src="{{asset('dist/js/app.js')}}"></script>
    <script src="{{asset('dist/js/cart.js')}}"></script>
    @yield('scriptAfterJs')
    </body>
</html>
