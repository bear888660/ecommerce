@extends('front.layouts.front')

@section('title', 'Home')
@section('content')

<section class="hero text-center">
            <br/>
            <br/>
            <br/>
            <br/>
            <br>
</section>
        <br/>
        <div class="subheader text-center">
             <h2>
            Best sell
        </h2>
        </div>
        <div class="row">
            @foreach($products as $product)
                <div class="small-3 columns">
                    <div class="item-wrapper">
                        <div class="img-wrapper">
                            <a href="/detail/{{$product->id}}">
                                <img src="{{asset('images/products/' . $product->image)}}"/>
                            </a>
                        </div>
                        <a href="/detail/{{$product->id}}">
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
