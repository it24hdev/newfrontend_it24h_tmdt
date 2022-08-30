@extends('frontend.layouts.base')

@section('title')
    <title>@lang('lang.It24hcart')</title>
@endsection

@section('css')
    <link rel="stylesheet" href="asset/css/cart.css">
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
                <a>@lang('lang.Cart')</a>
            </div>
        </div>
    </div>
    <div id="content" class="container-page" style="color: #222">
        <div class="container-wp-remove" style="width:100%">
            @if (Cart::count()>0)
            <div class="row" id="cart-empty">
                <div class="col-12 col-lg-8">
                    <div class="wp-cart-table">
                        <form action="{{ route('cart.update') }}" method="POST">
                            @csrf
                        <table class="table-cart">
                            <thead>
                                <tr>
                                    <th class="product-remove"></th>
                                    <th class="product-thumbnail"></th>
                                    <th class="product-name">@lang('lang.Product')</th>
                                    <th class="product-price">@lang('lang.Price')</th>
                                    <th class="product-quantity">@lang('lang.Quantity')</th>
                                    <th class="product-subtotal">@lang('lang.Subtotal')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Cart::content() as $row)
                                <tr class="cart-item" id="item-{{$row->rowId}}">
                                    <td class="product-remove">
                                        <a href="javascript:;" class="remove-cart" data-rowid="{{$row->rowId}}" onclick="return confirm('@lang('lang.Areyousureremoveproduct')')"><i class="fal fa-times"></i></a>
                                    </td>
                                    <td class="product-thumbnail">
                                        <a href="@php
                                            foreach($product_carts as $item){
                                                if($item->id == $row->id){
                                                    echo route('detailproduct', $item->slug);
                                                }
                                            }
                                        @endphp">
                                            <img width="300" height="300" src="upload/images/products/thumb/{{$row->options->thumbnail}}" alt="">
                                        </a>
                                    </td>
                                    <td class="product-name">
                                        <a href="@php
                                        foreach($product_carts as $item){
                                            if($item->id == $row->id){
                                                echo route('detailproduct', $item->slug);
                                            }
                                        }
                                    @endphp">{{$row->name}}</a>
                                    </td>
                                    <td class="product-price">
                                    <span class="title">@lang('lang.Price')</span>
                                        <span>
                                            {{ number_format($row->price, 0, '', '.') }} đ
                                        </span>
                                    </td>
                                    <td class="product-quantity">
                                    <span class="title">@lang('lang.Quantity')</span>
                                    <div class="quantity">
                                        <button type="button" class="change-qty" data-value="-1" data-rowid="{{ $row->rowId }}" data-id="{{ $row->id }}"><i class="fas fa-minus"></i></button>
                                        <input type="number" class="qty number-order-{{$row->id}}" min="1" max="999" name="qty[{{ $row->rowId }}]"
                                        value="{{$row->qty}}">
                                        <button type="button" class="change-qty" data-value="1" data-rowid="{{ $row->rowId }}" data-id="{{ $row->id }}"><i class="fas fa-plus"></i></button>
                                    </div>
                                    </td>
                                    <td class="product-subtotal">
                                    <span class="title">@lang('lang.Subtotal')</span>
                                    <span class="subtotal"><span class="subtotal-{{$row->id}}">{{ number_format($row->subtotal, 0, '', '.') }}</span> <strong>đ</strong></span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="actions clearfix">
                            <form action="" class="coupon">
                                <input type="text" class="input-text" placeholder="@lang('lang.Couponcode')">
                                <button class="btn-submit">@lang('lang.ApplyCoupon')</button>
                            </form>
                            <button type="submit" class="btn-update">@lang('lang.UpdateCart')</button>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="cart-collaterals">
                        <div class="cart-total">
                            <h2>@lang('lang.Carttotals')</h2>
                            <div class="subtotal">
                                <span>@lang('lang.Subtotal')</span>
                                <span class="count-subtotal"><span>{{ Cart::subtotal(0, '', '.')}} </span> <strong>@lang('lang.Currencyunit')</strong></span>
                            </div>
                            <div class="total">
                                <span>@lang('lang.Subtotal')</span>
                                <span class="count-total"><span>{{ Cart::subtotal(0, '', '.')}}</span> <strong>@lang('lang.Currencyunit')</strong></span>
                            </div>
                            <a href="{{route('checkout')}}" class="checkout text-center">@lang('lang.Proceedtocheckout')</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-5">
                    @if (!empty($products))
                        <div class="cross-sells">
                            <h2>@lang('lang.Youmaybeinterestedin')</h2>
                            <div class="wp-list-product">
                                <div class="list-product owl-carousel owl-theme owl-loaded owl-drag list-product-recommend-slider" id="list-product-group">
                                    @foreach ($products as $item)
                                        <!-- product -->
                                        <div class="product-item mb-3">
                                            <div class="thumb">
                                                <a href="{{ route('detailproduct', $item->slug)}}">
                                                    <img class="owl-lazy" data-src="{{asset('upload/images/products/medium/'.$item->thumb)}}" alt="">
                                                    @if (!empty($item->brand))
                                                        <span class="brand" style="background-image: url('{{asset("upload/images/products/thumb/".$item->brands->image)}}');"></span>
                                                    @endif
                                                    <div class="wp-tag">
                                                        @if (!empty($item->year))
                                                            <span class="years">{{$item->year}}</span>
                                                        @endif
                                                        @if (!empty($item->installment))
                                                            <span class="payment">Trả góp 0%</span>
                                                        @endif
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="detail">
                                                <div class="wp-event">
                                                    @if (!empty($item->event))
                                                        <p class="event" style="background: linear-gradient(to right,{{$item->events->color_left}},{{$item->events->color_right}});">
                                                            <img src="{{asset('upload/images/products/thumb/'.$item->events->icon)}}" alt="">
                                                            <span>{{$item->events->name}}</span>
                                                        </p>
                                                    @else
                                                        <p class="event" style="min-height: 20px;"></p>
                                                    @endif
                                                    <p class="code">Mã: {{$item->id}}</p>
                                                </div>
                                                <div class="name">
                                                    <a href="{{ route('detailproduct', $item->slug)}}">{{$item->name}}</a>
                                                </div>
                                                @if (!empty($item->specifications))
                                                    <ul class="product-attributes">
                                                        @foreach ($item->get_specifications() as $k)
                                                            <li>{{$k}}</li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                                <div class="price-review clearfix">
                                                    <div class="price">
                                                        @if (!empty($item->onsale))
                                                            <span class="onsale">- {{$item->onsale}}%</span>
                                                            <div class="price-old">{{number_format($item->price,0,',','.')}} đ</div>
                                                            <div class="price-new">{{number_format($item->price_onsale,0,',','.')}} đ</div>
                                                        @else
                                                            <div class="price-new">{{number_format($item->price,0,',','.')}} đ</div>
                                                        @endif
                                                    </div>
                                                    <div class="review">
                                                        <div class="rating2">
                                                            <div class="rating-upper" style="width: {{$item->count_vote()}}%">
                                                                <span><i class="fas fa-star"></i></span>
                                                                <span><i class="fas fa-star"></i></span>
                                                                <span><i class="fas fa-star"></i></span>
                                                                <span><i class="fas fa-star"></i></span>
                                                                <span><i class="fas fa-star"></i></span>
                                                            </div>
                                                            <div class="rating-lower">
                                                                <span><i class="fal fa-star"></i></span>
                                                                <span><i class="fal fa-star"></i></span>
                                                                <span><i class="fal fa-star"></i></span>
                                                                <span><i class="fal fa-star"></i></span>
                                                                <span><i class="fal fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="count-review">({{$item->votes->count()}})</div>
                                                        @if (!empty($item->sold))
                                                            <div class="sold"><i class="fas fa-badge-check"></i>Đã bán {{$item->sold}}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="detail-bottom">
                                                    @if (!empty($item->still_stock))
                                                        <div class="qty" style="color: #01aa42;
                                                        background-color: #dbf8e1;">{{$item->still_stock}}</div>
                                                    @endif
                                                    <div class="action">
                                                        <a href="javascript:;" class="repeat" title="So sánh"><i class="far fa-repeat"></i></a>
                                                        <a href="javascript:;" class="heart add-wish" title="Lưu sản phẩm" onclick="add_wish({{$item->id}})"><i class="far fa-heart"></i></a>
                                                        <a href="javascript:;" title="Thêm vào giỏ hàng" class="add-cart" onclick="add_cart({{$item->id}})"><i class="far fa-shopping-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
            @else
                <div class="entry-content" style="width:100%">
                    <p class="cart-empty">
                        <i class="fad fa-shopping-cart"></i><br>
                        @lang('lang.Yourcartiscurrentlyempty').
                    </p>
                    <a href="{{route('user')}}"> @lang('lang.Returntoshop')</a>
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
            add_wish = function(id){
                    var _token = $('meta[name="csrf-token"]').attr('content');
                    var data = {id:id, _token:_token};
                    $.ajax({
                        url: "{{route('add_wish')}}",
                        method: 'POST',
                        data: data,
                        dataType: 'json',
                        success: function(data) {
                            alert('Thêm thành công sản phẩm vào danh sách yêu thích!');
                            $('#count-wish').text(data.count_wish);
                        },
                    });
                }
                add_cart = function(id){
                    var _token = $('meta[name="csrf-token"]').attr('content');
                    var data = {
                        id: id,
                        _token: _token
                    };

                    $.ajax({
                        url: "{{ route('add_cart_ajax') }}",
                        method: 'POST',
                        data: data,
                        dataType: "json",
                        success: function(data) {
                            alert('Thêm thành công sản phẩm vào giỏi hàng!');
                            $('#count-cart').text(data.count);
                        },
                    });
                }
            $('.remove-cart').click(function(){
                var row_id = $(this).data('rowid');
                var _token = $('meta[name="csrf-token"]').attr('content');
                var data = {
                        row_id: row_id,
                        _token: _token
                    };
                    $.ajax({
                        url: "{{ route('remove_cart') }}",
                        method: 'POST',
                        data: data,
                        dataType: "json",
                        success: function(data) {
                            alert('Xóa thành công!');
                            if(data.count_cart == 0){
                                $('#cart-empty').remove();
                                $('.container-wp-remove').html(data.html_empty);
                            }else{
                                $('#item-'+row_id).remove();
                                $('.count-subtotal span').html(data.total);
                                $('.count-total span').html(data.total);
                            }
                            $('#count-cart').text(data.count_cart);
                        },
                    });
            });

            $('.change-qty').click(function(){
                var change_number = $(this).data('value');
                var id = $(this).data('id');
                var qty_old = $('.number-order-'+id).val();
                var row_id = $(this).data('rowid');
                var _token = $('meta[name="csrf-token"]').attr('content');
                var data = {
                        change_number: change_number,
                        qty_old: qty_old,
                        row_id: row_id,
                        _token: _token
                    };
                    $.ajax({
                        url: "{{ route('update_ajax') }}",
                        method: 'POST',
                        data: data,
                        dataType: "json",
                        success: function(data) {
                            $('.number-order-'+id).val(data.qty);
                            $('.subtotal-'+id).html(data.subtotal);
                            $('.count-subtotal span').html(data.subtotal_cart);
                            $('.count-total span').html(data.subtotal_cart);
                        },
                    });
            });
        });
    </script>
@endsection
