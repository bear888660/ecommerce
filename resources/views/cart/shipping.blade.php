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
                <th colspan="4">運送方式</th>
            </thread>
            <tbody>
                <tr>
                    <td width="2%"><input type="radio" name="shippingMethod" class="shippingMethod" value="CreditCard"></td>
                    <td width="48%">信用卡付款</td>
                    <td width="25%"></td>
                    <td width="25%"></td>
                </tr>
            </tbody>
        </table>

        <table class="table">
            <thread>
                <th width="25%"></th>
                <th width="48%"></th>
                <th width="12%"></th>
                <th width="15%"></th>
            </thread>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td align="left">共{{Cart::count()}}件</td>
                    <td>商品金額：{{Cart::subtotal(0)}}</td>

                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>運費金額：{{config('ecommerce.shipping_fee.cradit_card')}}</td>

                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>應付金額：{{ number_format(Cart::subtotal(0, '', '') + config('ecommerce.shipping_fee.cradit_card'), '0', '', ',') }}</td>

                </tr>
                <tr>
                    <td align="left">
                        <a class="btn button btn-sm btn-default" href="{{route('cart')}}">返回購物車</a>
                    </td>
                    <td></td>
                    <td></td>
                    <td align="right">
                        <div class="btn button btn-sm btn-default select-shipping-method">下一步</div>
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
<script>
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('.select-shipping-method').on('click', function(){
            const shippinngMethod = $('.shippingMethod:checked').val();
            if (shippinngMethod) {
                location.href = '/cart/' + shippinngMethod;
            } else {
                showMessage('請選擇運送方式');
            }
        });
    });

</script>
@endsection
