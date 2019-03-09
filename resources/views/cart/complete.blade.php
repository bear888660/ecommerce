@extends('layouts.front')

@section('title', 'Home')
@section('content')

<section class="text-center">
            <br/>
            <br/>
</section>
<div class="row text-left">
            <section class="text-center">
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                            @if($success)
                                您購買的商品已付款完成!!
                            @else
                                您購買的商品尚未付款完成，請重新購買!!
                            @endif
                             <br><br> <a class="button" href="{{route('home')}}">回首頁</a>

                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
            </section>
</div>
<section class="text-center">
            <br/>
            <br/>
            <br/>
            <br/>
</section>

@endsection
