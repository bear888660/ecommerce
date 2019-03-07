@extends('front.layouts.front')

@section('title', 'Home')
@section('content')

<section class="text-center">
            <br/>
            <br/>
</section>
<div class="row text-left">
        <table class="table">
            <thread>
                <th colspan="4">收件人資訊</th>
            </thread>
            <tbody>
                <tr>
                    <td width="8%">姓名:</td>
                    <td width="20%"><input type="text" name="recipient" id="recipient"></td>
                    <td width="47%"></td>
                    <td width="25%"></td>
                </tr>
                <tr>
                    <td>手機:</td>
                    <td><input type="text" name="recipient_mobile" id="recipient_mobile"></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td valign="top">住址:</td>
                    <td colspan="3">
                        <div id="twzipcode"></div>
                        <script>
                            $("#twzipcode").twzipcode();
                        </script>
                        <input type="text" name="recipient_address" id="recipient_address">
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        <a class="btn button btn-sm btn-default" href="{{route('cart')}}">返回購物車</a>
                        <input type="hidden" value="CraditCard" name="shippingMethod" id="shippingMethod">
                    </td>
                    <td></td>
                    <td></td>
                    <td align="right">
                        <div class="btn button btn-sm btn-default cart-send">送出</div>
                    </td>
                </tr>
            </tbody>
        </table>
</div>
<section class="text-center">
            <br/>
            <br/>
            <br/>
            <br/>
</section>

@endsection

