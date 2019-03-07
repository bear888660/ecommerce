
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
                location.href=`/cashflow/MPG/pay/` + msg.orderId;
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
