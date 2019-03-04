@extends('front.layouts.front')

@section('title', 'Home')
@section('content')
<section class="hero text-center">
            <br/>
            <br/>
            <br/>
            <br/>
            <h2 >
            </h2>
            <br>

        </section>
        <br/>
        <div class="subheader text-center">
             <h2>
            MyKey&rsquo;s Latest Shirts
        </h2>
        </div>
        <div class="row">
            @foreach($products as $product)
                <div class="small-3 columns">
                    <div class="item-wrapper">
                        <div class="img-wrapper">
                            <a class="button expanded add-to-cart">
                                Add to Cart
                            </a>
                            <a href="#">
                                <img src="{{asset('images/products/' . $product->image)}}"/>
                            </a>
                        </div>
                        <a href="#">
                            <h3>
                                {{$product->name}}
                            </h3>
                        </a>
                        <h5>
                            ${{$product->price}}
                        </h5>
                        <p>
                            {{$product->description}}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <br>
@endsection
