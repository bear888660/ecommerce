@extends('front.layouts.front')
@section('title', 'shop')
@section('content')
        <div class="row">
            @foreach($products as $product)
                <div class="small-3 columns">
                    <div class="item-wrapper">
                        <div class="img-wrapper">
                            <a href="/products/{{$product->id}}">
                                <img src="{{asset('images/products/' . $product->image)}}"/>
                            </a>
                        </div>
                        <a href="/products/{{$product->id}}">
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
@endsection
