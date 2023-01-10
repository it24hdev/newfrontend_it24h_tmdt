@extends('frontend.layouts.base')
@section('title')
    <title>@lang('lang.IT24Hcheckout')</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('asset/css/checkout.css')}}">
@endsection
@section('header-home')
    @include('frontend.layouts.header-page', [$Sidebars, $active_menu])
@endsection
@section('content')
    <div class="wp-breadcrumb-page">
        <div class="container-page">
            <div class="breadcrumb-page">
                <a href="{{route('user')}}">@lang('lang.Home') <i class="fas fa-angle-right mx-1"></i></a>
                <a>Thanh toán</a>
            </div>
        </div>
    </div>
    <div id="content" class="container-page">
        <div class="col-12 cpn_box">
            @if($active==1)
                <h3 class="d-block mb-4 mx-3">Thông tin đặt hàng</h3>
                <div class="col-12 d-flex">
                    <div class="col-6">
                        <div class="wp-form mx-3">
                            <div class="form-group mb-1">
                                <div class="form-group">
                                    <div class="input-wrapper">
                                        <span class="icon-wrapper-payment">
                                            <i class="fal fa-user"></i>
                                        </span>
                                        <span class="position-relative">
                                            <input class="form-control input-info" type="text" name="customer_name" maxlength="50" autocomplete="off" placeholder="Họ và tên (bắt buộc)">
                                            <span class="requite_name text-danger mx-2 d-none"><i></i></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-1">
                                <div class="form-group">
                                    <div class="input-wrapper">
                                        <span class="icon-wrapper-payment">
                                            <i class="fal fa-phone-alt"></i>
                                        </span>
                                        <span class="position-relative">
                                            <input class="form-control input-info" type="number" autocomplete="off" name="phone_number" placeholder="Số điện thoại (bắt buộc)">
                                            <span class="requite_numberphone text-danger mx-2 d-none"><i></i></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-1">
                                <div class="form-group">
                                    <div class="input-wrapper">
                                        <span class="icon-wrapper-payment">
                                            <i class="fal fa-envelope"></i>
                                        </span>
                                        <span class="position-relative">
                                            <input class="form-control input-info"  type="email" placeholder="Email" name="customer_email" maxlength="100" autocomplete="off" placeholder="Email">
                                            <span class="requite_email text-danger mx-2 d-none"><i></i></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-1 address-box">
                                <div class="d-flex">
                                    <select name="city" class="ct_info form-select col-sm-1 w-50">
                                        @foreach($city as $key => $item)
                                            <option value="{{$item->matp}}" @if($item->matp == 31) selected @endif>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    <select name="district" class="dt_info form-select form-select-sm w-50">
                                        @foreach($district as $key => $item)
                                            @if($item->matp == 31)
                                                <option value="{{$item->name}}">{{$item->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <input id="address" name="street" type="text" placeholder="Số nhà, tên đường" class="mt-2" autocomplete="off">
                            </div>
                            <div class="mt-3 d-flex flex-column">
                                <div class="receipt">
                                    <label for="VAT">
                                        <input type="checkbox" name="VAT" id="VAT">
                                        <span>Yêu cầu xuất hóa đơn công ty (Vui lòng điền email để nhận hoá đơn VAT)</span>
                                    </label><br>
                                    <a href="#" target="_blank">
                                        <i class="text-danger">(Với đơn hàng trên 20 triệu vui lòng thanh toán chuyển khoản từ tài
                                            khoản công ty khi cần xuất VAT cho công ty)</i>
                                    </a>
                                </div>
                                <div class="mb-3 receipt_ip d-none">
                                    <input name="name_company" type="text" placeholder="Tên công ty (*)" autocomplete="off" class="my-2">
                                    <span class="requite_name_company text-danger mx-2"><i></i></span>
                                    <input name="address_company" type="text" placeholder="Địa chỉ công ty (*)" autocomplete="off" class="my-2">
                                    <span class="requite_address_company text-danger mx-2"><i></i></span>
                                    <input name="tax_code" type="text" placeholder="Mã số thuế (*)" autocomplete="off" class="my-2">
                                    <span class="requite_tax_code text-danger mx-2"><i></i></span>
                                    <input name="email_company" type="text" placeholder="Email công ty (*)" autocomplete="off" class="my-2">
                                    <span class="requite_email_company text-danger mx-2"><i></i></span>
                                </div>
                            </div>
                            <div>
                                <i>
                                    <input type="checkbox" class="check_rules" checked="checked" name="check_rules">
                                    <a href="" target="_blank" class="text-danger font-rules">Bằng cách đặt hàng, bạn đồng ý với Điều khoản sử dụng của IT24H.</a>
                                </i>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="order-review mb-5 mx-3">
                            <h3>@lang('lang.Yourorder')</h3>
                            <div class="checkout-review-order">
                                <table class="checkout-review-order-table">
                                    <tfoot>
                                        <tr class="order-total">
                                            <th>@lang('lang.Total') </th>
                                            <td>
                                                <strong>
                                                    <span class="amount mx-1">{{ number_format($total_money, 0, '', '.') }}<span> @lang('lang.Currencyunit')</span></span>
                                                </strong>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="payment mt-2">
                                    <div class="form-group pt-3">
                                        <input type="radio" id="transfer" name="payment_method" value="Chuyển khoản"  class="form-check-input me-2 payment-check" checked>
                                        <label for="transfer" class="payment-check"><strong>@lang('lang.Directbanktransfer')</strong></label>
                                    </div>
                                    <div class="form-group pt-3">
                                        <input  type="radio" id="cash_on_shop" name="payment_method" value="Thanh toán tại cửa hàng" class="form-check-input me-2 payment-check">
                                        <label for="cash_on_shop" class="payment-check"><strong>@lang('lang.Cashondelivery')</strong></label>
                                    </div>
                                </div>
                                <div class="place-order mt-4">
                                    <p>@lang('lang.Yourpersonaldata').</p>
                                    <button type="button" class="btn-order btn-complte-payment">@lang('lang.PlaceOrder')</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="entry-content w-100">
                    <p class="cart-empty">
                        <img src="{{asset('upload/images/common_img/shopping_cart.png')}}">
                    </p>
                    <p>Không có sản phẩm nào trong giỏ hàng của bạn</p>
                    <a href="/">Tiếp tục mua sắm</a>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('footer')
    @include('frontend.layouts.footer')
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            var _token = $('meta[name="csrf-token"]').attr('content');
            $('.payment-check').click(function(){
                $('.payment-box').not($(this).parent('.form-group').children('.payment-box')).slideUp( 300 );
                $(this).parent('.form-group').children('.payment-box').slideDown( 300 );
            });
            $(document).on('click', '#VAT', function(){
                if($(this).is(':checked')){
                    if($('.receipt_ip').hasClass('d-none')){
                        $('.receipt_ip').removeClass('d-none');
                    }
                }
                else{
                    $('.receipt_ip').addClass('d-none');
                }
            });
            $(document).on('change', 'select[name="city"]', function(){
                var ma_tp = $(this).val();
                data = {
                    ma_tp : ma_tp,
                    _token: _token
                }
                $.ajax({
                    url: '{{route('get_district')}}',
                    method: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function (data) {
                        if(data.success){
                            $('select[name="district"]').html('');
                            $.each(data.district, function(k,v) {
                                $('select[name="district"]').append($('<option>',
                                    {
                                        value: v.name,
                                        text : v.name
                                    }));
                            });
                        }
                    }
                });
            });
            $(document).on('click', '.btn-complte-payment', function(){
                var customer_name = $('input[name="customer_name"]').val();
                var phone_number = $('input[name="phone_number"]').val();
                var mailformat = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                var nameformat = /[^a-zA-Z0-9]{1,3}/gm;
                var email = $('input[name="customer_email"]').val();
                var address = $('select[name="district"]').val() +" - "+ $('select[name="city"] option:selected').text();
                if($('input[name="street"]').val()){
                    address = $('input[name="street"]').val() + " - " + address;
                }
                var note = $('input[name="note"]').val();
                var payment_method = $('input[name="payment_method"]:checked').val();
                var vat = $('input[name="VAT"]');
                var name_company = address_company = tax_code = email_company ="";
                if($('input[name="name_company"]').val() != ""){
                    name_company = $('input[name="name_company"]').val();
                }
                var address_company = $('input[name="address_company"]').val();
                var tax_code = $('input[name="tax_code"]').val();
                var email_company = $('input[name="email_company"]').val();
                var data = {
                    customer_name: customer_name,
                    email: email,
                    phone_number: phone_number,
                    address: address,
                    note: note,
                    address_company: address_company,
                    tax_code: tax_code,
                    email_company: email_company,
                    name_company: name_company,
                    payment_method: payment_method,
                    _token: _token
                };
                if(!$('.requite_name').hasClass('d-none')){
                    $('.requite_name').addClass('d-none');
                }
                if(!$('.requite_numberphone').hasClass('d-none')){
                    $('.requite_numberphone').addClass('d-none');
                }
                if(!$('.requite_email').hasClass('d-none')){
                    $('.requite_email').addClass('d-none');
                }
                $('.requite_name i').html('');
                $('.requite_numberphone i').html('');
                $('.requite_email i').html('');
                switch (true){
                    case ($('input[name="check_rules"]').is(":checked") == false) : {
                        break;
                    }
                    case (customer_name.split(" ").join("").length==0) : {
                        if($('.requite_name').hasClass('d-none')){
                            $('.requite_name').removeClass('d-none');
                        }
                        $('.requite_name i').html('Vui lòng nhập Họ và tên của bạn.');
                        $('input[name="customer_name"]').focus();
                        break;
                    }
                    case (customer_name.split(" ").join("").length<2 || !nameformat.test(customer_name)) : {
                        if($('.requite_name').hasClass('d-none')){
                            $('.requite_name').removeClass('d-none');
                        }
                        $('.requite_name i').html('Họ và tên không hợp lệ, vui lòng nhập lại.');
                        $('input[name="customer_name"]').focus();
                        break;
                    }
                    case ((phone_number.split(" ").join("").length<10) || (phone_number.split(" ").join("").length>12)) :{
                        if($('.requite_numberphone').hasClass('d-none')){
                            $('.requite_numberphone').removeClass('d-none');
                        }
                        $('.requite_numberphone i').html('Số điện thoại không hợp lệ, vui lòng nhập lại.');
                        $('input[name="phone_number"]').focus();
                        break;
                    }
                    case(email.split(" ").join("").length>0 && !mailformat.test(email)):{
                        if($('.requite_email').hasClass('d-none')){
                            $('.requite_email').removeClass('d-none');
                        }
                        $('.requite_email i').html('Địa chỉ email không hợp lệ, vui lòng nhập lại.');
                        $('input[name="customer_email"]').focus();
                        break;
                    }
                    case(vat.is(":checked")):{
                        $('.requite_name_company i').html('');
                        $('.requite_address_company i').html('');
                        $('.requite_tax_code i').html('');
                        $('.requite_email_company i').html('');
                        switch (true){
                            case (name_company.split(" ").join("").length==0) : {
                                $('.requite_name_company i').html('Tên công ty không được phép bỏ trống.');
                                break;
                            }
                            case (name_company.split(" ").join("").length<2 || !nameformat.test(name_company)) : {
                                $('.requite_name_company i').html('Tên công ty không hợp lệ, vui lòng nhập lại.');
                                break;
                            }
                            case (address_company.split(" ").join("").length==0) : {
                                $('.requite_address_company i').html('Địa chỉ công ty không được phép bỏ trống.');
                                break;
                            }
                            case (address_company.split(" ").join("").length<2 || !nameformat.test(address_company)) : {
                                $('.requite_address_company i').html('Địa chỉ công ty không hợp lệ, vui lòng nhập lại.');
                                break;
                            }
                            case (tax_code.split(" ").join("").length==0) : {
                                $('.requite_tax_code i').html('Mã số thuế không được phép bỏ trống.');
                                break;
                            }
                            case (tax_code.split(" ").join("").length<10 || tax_code.split(" ").join("").length>15) : {
                                $('.requite_tax_code i').html('Mã số thuế không hợp lệ, vui lòng nhập lại.');
                                break;
                            }
                            case (email_company.split(" ").join("").length==0) : {
                                $('.requite_email_company i').html('Email công ty không được phép bỏ trống, vui lòng nhập lại');
                                break;
                            }
                            case (!mailformat.test(email_company)) : {
                                $('.requite_email_company i').html('Email công ty không hợp lệ, vui lòng nhập lại.');
                                break;
                            }
                            default:{
                                $.ajax({
                                    url: '{{route('complete_payment')}}',
                                    method: 'POST',
                                    data: data,
                                    dataType: 'json',
                                    success: function (data) {
                                        if(data.success){
                                            // $('.btn-complte-payment').attr('disabled',true);
                                            window.location = '{{route('successorder')}}';
                                        }
                                        else{
                                            window.location = '{{route('checkout')}}';
                                        }
                                    }
                                });
                            }
                        }
                        break;
                    }
                    default:{
                        $.ajax({
                            url: '{{route('complete_payment')}}',
                            method: 'POST',
                            data: data,
                            dataType: 'json',
                            success: function (data) {
                                if(data.success==true){
                                    // $('.btn-complte-payment').attr('disabled',true);
                                    window.location = '{{route('successorder')}}';
                                }
                                else{
                                    window.location = '{{route('checkout')}}';
                                }
                            }
                        });
                    }
                }
            });
        });
    </script>
@endsection
