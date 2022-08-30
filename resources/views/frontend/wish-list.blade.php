@extends('frontend.layouts.base')

@section('title')
    <title>@lang('lang.It24hwishlist')</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('asset/css/cart.css')}}">
@endsection

@section('header-home')
    @include('frontend.layouts.header-page', [$Sidebars, $Menus])
@endsection

@section('header-mobile')
    @include('frontend.layouts.menu-mobile', [$Sidebars, $Menus])
@endsection

@section('content')
    <div class="wp-breadcrumb-page">
        <div class="container-page">
            <div class="breadcrumb-page">
                <a href="{{route('user')}}">@lang('lang.Home') <i class="fas fa-angle-right mx-1"></i></a>
                <a>@lang('lang.Favoriteproduct')</a>
            </div>
        </div>
    </div>
        <div class="container-page container-wp-remove" style="min-height: 500px; color:#222;">
            <div id="cart-empty">
                    <div class="wp-cart-table" style="margin-right: 0; margin-bottom: 0;">
                        @if ($products->count() > 0)
                            <table class="table-cart">
                                <thead>
                                    <tr>
                                        <th class="product-remove"></th>
                                        <th class="product-thumbnail text-center">Ảnh</th>
                                        <th class="product-name">@lang('lang.Product')</th>
                                        <th class="product-price">@lang('lang.Price')</th>
                                        <th class="add-cart-product"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                    <tr class="cart-item" id="item-{{$product->id}}">
                                        <td class="product-remove">
                                            <a href="javascript:;" class="remove-product" data-id="{{$product->id}}" onclick="return confirm('@lang('lang.Areyousureremoveproduct')')"><i class="fal fa-times"></i></a>
                                        </td>
                                        <td class="product-thumbnail">
                                            <a href="{{route('detailproduct', $product->slug)}}">
                                                <img width="300" height="300" src="{{asset('upload/images/products/thumb/'.$product->thumb)}}" alt="">
                                            </a>
                                        </td>
                                        <td class="product-name">
                                            <a href="{{route('detailproduct', $product->slug)}}">{{$product->name}}</a>
                                        </td>
                                        <td class="product-price">
                                        <span class="title">@lang('lang.Price')</span>
                                            @if ($product->onsale)
                                                <span>
                                                    {{ number_format($product->price_onsale, 0, '', '.') }} đ
                                                </span>
                                            @else
                                                <span>
                                                    {{ number_format($product->price, 0, '', '.') }} đ
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="javascript:;" class="add_to_cart_button btn btn-primary" style="color: #fff !important;" data-id="{{$product->id}}"><i class="far fa-shopping-cart me-2"></i>@lang('lang.Addtocart')</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p style="text-align: center;">@lang('lang.emptylistwish')</p>
                        @endif
                    </div>
            </div>
        </div>
    <p id="message_add_cart" style="display:none;">@lang('lang.Productaddedtocartsuccessfully')</p>
@endsection

@section('footer')
    @include('frontend.layouts.footer')
@endsection

@section('js')
    <script>
        var mess = document.getElementById('message_add_cart').innerHTML;
        $('.add_to_cart_button').click(function(){
            var id = $(this).data('id');
            var _token = $('meta[name="csrf-token"]').attr('content');
            var data = {id: id,_token: _token};
            $.ajax({
                url: "{{ route('add_cart_ajax') }}",
                method: 'POST',
                data: data,
                dataType: "json",
                success: function(data) {
                    alert(mess);
                    $('#count-cart').text(data.count);
                },
            });
        });
        $('.remove-product').click(function(){
                var id = $(this).data('id');
                var _token = $('meta[name="csrf-token"]').attr('content');
                var data = {
                        id: id,
                        _token: _token
                    };
                    $.ajax({
                        url: "{{ route('remove_product_wish') }}",
                        method: 'POST',
                        data: data,
                        dataType: "json",
                        success: function(data) {
                            alert('Xóa thành công!');
                            if(data.count_wish == 0){
                                $('#cart-empty').remove();
                            }else{
                                $('#item-'+id).remove();
                            }
                            $('#count-wish').text(data.count_wish);
                        },
                    });
            });
    </script>
@endsection
