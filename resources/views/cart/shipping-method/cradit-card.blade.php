@extends('layouts.front')

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
                    <td width="10%">姓名:</td>
                    <td width="20%"><input type="text" name="recipient" id="recipient"></td>
                    <td width="45%"></td>
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
                    <td align="left" colspan="2">
                        <input type="hidden" value="CreditCard" name="shippingMethod" id="shippingMethod">
                        <a class="btn button btn-sm btn-default" href="{{route('cart')}}">返回購物車</a>
                    </td>
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


@section('scriptAfterJs')


$(function(){

    <script>
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.cart-send').on('click', function(){
        const recipient = $('#recipient').val();
        const recipient_mobile = $('#recipient_mobile').val();
        const recipient_county = $('#recipient_county').val();
        const recipient_district = $('#recipient_district').val();
        const recipient_zipcode = $('#recipient_zipcode').val();
        const recipient_address = $('#recipient_address').val();
        const shipping_method = $('#shippingMethod').val();

        $('.is-invalid').removeClass('is-invalid');
        $.ajax({
            method: "POST",
            data: { recipient,
                    recipient_mobile,
                    recipient_county,
                    recipient_district,
                    recipient_zipcode,
                    recipient_address,
                    shipping_method
                },
            url: `/order/store`,
            }).done((data) => {
                const msg = JSON.parse(data);
                if (msg.status === 'true') {
                    location.href=`/payment/${msg.orderId}/MPGpay`;
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
    });
    </script>
@endsection
