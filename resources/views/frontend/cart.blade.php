@extends('frontend.layouts.base')
@section('title')
    <title>@lang('lang.It24hcart')</title>
@endsection
@section('css')
    <link rel="stylesheet" href="asset/css/cart.css">
@endsection

@section('header-home')
    @include('frontend.layouts.header-home', [$Sidebars, $active_menu])
@endsection

@section('content')
    <div class="wp-breadcrumb-page">
        <div class="container-page">
            <div class="breadcrumb-page">
                <a href="{{route('user')}}">@lang('lang.Home') <i class="fas fa-angle-right mx-1"></i></a>
                <a>@lang('lang.Cart')</a>
            </div>
        </div>
    </div>
    <div id="content" class="container-page" style="color: #222">
        <div class="container-wp-remove w-100">
            <div class="row d-none" id="cart-empty" data-target="{{\Illuminate\Support\Facades\Session::get('count_cart')}}">
                <div class="col-12 col-lg-8">
                    <div class="wp-cart-table">
                        <table class="table-cart">
                            <thead>
                            <tr>
                                <th class="text-center"><input type="checkbox" name="check_all" checked></th>
                                <th class="product-thumbnail text-center">Ảnh</th>
                                <th class="product-name text-center">Tên sản phẩm</th>
                                <th class="product-price text-center">Giá bán</th>
                                <th class="product-quantity text-center">Số lượng</th>
                                <th class="product-subtotal text-center">Tổng</th>
                                <th class="product-remove text-center"><i class="fal fa-trash-alt"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($cart_data)
                                @foreach ($cart_data as $item_cart)
                                    <tr class="cart-item" id="cart_{{$item_cart['item_id']}}">
                                        <td class="check_p">
                                            <input checked id="check_cart_{{$item_cart['item_id']}}" class="check_cart" type="checkbox" name="check_cart" data-target="{{$item_cart['item_id']}}">
                                        </td>
                                        <td class="product-thumbnail">
                                            @if($item_cart["item_image"]!="no-images.jpg")
                                                <img width="300" height="300"
                                                     src="{{asset('upload/images/products/thumb/'.$item_cart["item_image"])}}"
                                                     alt="">
                                            @else
                                                <img width="300" height="300"
                                                     src="{{asset('upload/images/common_img/no-images.jpg')}}"
                                                     alt="">
                                            @endif
                                        </td>
                                        <td class="product-name">
                                            <a href="{{route('detailproduct',['slug' => $item_cart["item_slug"]])}}">{{$item_cart["item_name"]}}</a>
                                        </td>
                                        <td class="product-price">
                                            @if($item_cart['item_price_onsale'])
                                                <span class="w-100 text-nowrap item_price" data-target="{{$item_cart['item_price_onsale']}}">{{ number_format($item_cart['item_price_onsale'], 0, '', '.') }} đ </span>
                                            @else
                                                <span class="w-100 text-nowrap item_price" data-target="{{$item_cart['item_price']}}">{{ number_format($item_cart['item_price'], 0, '', '.') }} đ </span>
                                            @endif
                                        </td>
                                        <td class="product-quantity">
                                            <div class="quantity">
                                                <button type="button" class="change-qty minus_cart" product-id="{{$item_cart['item_id']}}" quantity="{{$item_cart['item_quantity']}}"><i class="fas fa-minus"></i></button>
                                                <input type="number" class="qty" min="1" max="999" name="qty_cart" value="{{$item_cart['item_quantity']}}" readonly="readonly">
                                                <button type="button" class="change-qty plus_cart" product-id="{{$item_cart['item_id']}}" quantity="{{$item_cart['item_quantity']}}"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </td>
                                        <td class="product-subtotal">
                                            <strong><span class="subtotal text-nowrap"></span></strong>
                                        </td>
                                        <td class="product-remove">
                                            <a href="javascript:" class="remove-cart cart_delete"
                                               data-target="{{$item_cart['item_id']}}"><i class="fal fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="cart-collaterals">
                        <div class="cart-total">
                            <div class="actions clearfix">
                                <div class="coupon">
                                    <input type="text" class="input-text" placeholder="@lang('lang.Couponcode')">
                                    <button class="btn-submit">@lang('lang.ApplyCoupon')</button>
                                </div>
                            </div>
                            <div class="total">
                                <span>@lang('lang.Subtotal')</span>
                                <span class="count-total"><span></span> <strong>@lang('lang.Currencyunit')</strong></span>
                            </div>
                            <a class="checkout text-center btn-sm-cart">@lang('lang.Proceedtocheckout')</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="entry-content w-100 d-none">
                <p class="cart-empty">
                    <img src="{{asset('upload/images/common_img/shopping_cart.png')}}">
                </p>
                <p>Không có sản phẩm nào trong giỏ hàng của bạn</p>
                <a href="/">Tiếp tục mua sắm</a>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @include('frontend.layouts.footer')
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            var _token = $('meta[name="csrf-token"]').attr('content');
            total_cart();
            count_cart();
            // xoa san pham khoi gio hang
            $(document).on('click', '.cart_delete', function(){
                var product_id  =  $(this).attr('data-target');
                var data = {
                    product_id: product_id,
                    _token: _token
                };
                $.ajax({
                    url: '{{route('remove_cart_data')}}',
                    method: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function (data) {
                        if(data.success){
                            $('#count-cart').text(data.count);
                            $('#cart_'+product_id).remove();
                        }
                        total_cart();
                        $('#cart-empty').attr('data-target',data.count);
                        count_cart();
                    }
                });
            });
            //Cong so luong san pham
            $('.plus_cart').on('click',function(){
                $(this).prev().val(+$(this).prev().val() + 1);
                var $t = $(this);
                var product_id  =  $(this).attr('product-id');
                var quantity  =  $(this).attr('quantity');
                var data = {
                    product_id: product_id,
                    quantity: quantity,
                    status: "plus",
                    _token: _token
                };
                $.ajax({
                    url: '{{route('update_shopping_cart')}}',
                    method: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function (data) {
                        if(data.success){
                            $('#count-cart').text(data.count);
                            $t.parent().find('.minus_cart').attr('quantity',data.quantity);
                            $t.parent().find('.plus_cart').attr('quantity',data.quantity);
                            $t.parent().find('input[name="qty_cart"]').val(data.quantity);
                            total_cart();
                        }
                    }
                });
            });
            //tru sl san pham
            $('.minus_cart').click('click',function(){
                if ($(this).next().val() > 1){
                    var $t = $(this);
                    var product_id  =  $(this).attr('product-id');
                    var quantity  =  $(this).attr('quantity');
                    var data = {
                        product_id: product_id,
                        quantity: quantity,
                        status: "minus",
                        _token: _token
                    };
                    $.ajax({
                        url: '{{route('update_shopping_cart')}}',
                        method: 'POST',
                        data: data,
                        dataType: 'json',
                        success: function (data) {
                            if(data.success){
                                $('#count-cart').text(data.count);
                                $t.parent().find('.minus_cart').attr('quantity',data.quantity);
                                $t.parent().find('.plus_cart').attr('quantity',data.quantity);
                                $t.parent().find('input[name="qty_cart"]').val(data.quantity);
                                total_cart();
                            }
                        }
                    });
                }
            });
            //dem so luong san pham trong gio hang
            function count_cart(){
                if($('#cart-empty').attr('data-target')>0){
                    if($('#cart-empty').hasClass('d-none')){
                        $('#cart-empty').removeClass('d-none');
                    }
                    if(!$('.entry-content').hasClass('d-none')){
                        $('.entry-content').addClass('d-none');
                    }
                }
                else{
                    if(!$('#cart-empty').hasClass('d-none')){
                        $('#cart-empty').addClass('d-none');
                    }
                    if($('.entry-content').hasClass('d-none')){
                        $('.entry-content').removeClass('d-none');
                    }
                }
            }
            //tinh tong tien tam thoi
            function total_cart(){
                let total = price = 0;
                $('tbody tr').each(function(index) {
                    var this_total = 0;
                    price = $(this).find('.item_price').attr('data-target');
                    qty_cart = $(this).find('input[name="qty_cart"]').val();
                    if($(this).find('input[name="check_cart"]').is(":checked")) {
                        total = total + (price * qty_cart);
                    }
                    this_total = new Intl.NumberFormat().format(price * qty_cart);
                    $(this).find('.subtotal').html(this_total);
                });
                var total_cart = new Intl.NumberFormat().format(total);
                $('.count-total').html(total_cart+" VNĐ");
            }
            //tich chon san pham
            $(document).on('change', '.check_cart', function() {
                total_cart();
            });
            //chon tat ca
            $(document).on('change','input[name="check_all"]',function (){
                if($(this).is(':checked')==true){
                    $('input[name="check_cart"]').prop('checked',true);
                }
                else{
                    $('input[name="check_cart"]').prop('checked',false);
                }
                total_cart();
            });
            // tien hanh dat hang
            $(document).on('click', '.btn-sm-cart', function(){
                list_cart_success =  [];
                $('input[name="check_cart"]').each(function(index) {
                    if($(this).is(":checked")){
                        var product_id = $(this).attr('data-target');
                        list_cart_success.push(product_id);
                    }
                });
                if(list_cart_success.length !=0){
                    var data = {
                        list_cart_success: list_cart_success,
                        _token: _token
                    };
                    $.ajax({
                        url: '{{route('order_processing')}}',
                        method: 'POST',
                        data: data,
                        dataType: 'json',
                        success: function (data) {
                            if(data.success){
                                var checkout_url = '{{route('checkout')}}';
                                window.location = checkout_url;
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
