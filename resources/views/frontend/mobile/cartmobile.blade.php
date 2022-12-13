@extends('frontend.mobile.basemobile')

@section('title')
    <title>IT24H - Giỏ hàng</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('asset/css/mobile/cart_mobile.css')}}">
@endsection

@section('content')
    <div class="component-cart-container">
        <div class="header_cart d-flex align-items-center justify-content-center">
            <div class="back">
                <a href="/" class="d-flex align-items-center">
                    <i class="fal fa-angle-left"></i>
                    <p> Trở về</p>
                </a>
            </div>
            <p class="title_cart title m-auto">Giỏ hàng</p>
            <div class="plus_p">
                <a href="/" class="d-flex align-items-center">
                    <i class="fal fa-plus"></i>
                </a>
            </div>
        </div>
        <section class="block-cart-product d-none" data-target="{{Cookie::get('count_cart')}}">
            @if (!empty($cart_data))
                <div class="container-cart">
                    @foreach ($cart_data as $item_cart)
                        <div class="product-item-cart" id="cart_{{$item_cart['item_id']}}">
                            <div class="d-flex">
                                <div class="check_p">
                                    <input id="check_cart_{{$item_cart['item_id']}}" class="check_cart" type="checkbox" name="check_cart" data-target="{{$item_cart['item_id']}}">
                                </div>
                                <div class="product-item-cart__image">
                                    <img src="{{asset('upload/images/products/thumb/'.$item_cart["item_image"])}}"></div>
                                <div class="product-item-cart-info-detail">
                                    <p class="product-cart-name">{{$item_cart['item_name']}}</p>
                                    <div class="product-item-cart__price">
                                        @if($item_cart['item_price_onsale'])
                                            <div class="d-flex">
                                                <p class="regular-price"
                                                   data-target="{{$item_cart['item_price']}}}">{{ number_format($item_cart['item_price'], 0, '', '.') }}
                                                    đ</p>
                                                <span class="onsale-cart">- {{ $item_cart['item_onsale']}}%</span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-baseline">
                                                <p class="sale-price"
                                                   data-target="{{$item_cart['item_price_onsale']}}">{{ number_format($item_cart['item_price_onsale'], 0, '', '.') }}
                                                    đ</p>
                                                <div class="item-action-cart">
                                                    <div class="change-quantity">
                                                        <div class="number-q">
                                                            <span class="minus_cart mx-1" product-id="{{$item_cart['item_id']}}" quantity="{{$item_cart['item_quantity']}}">-</span>
                                                            <input name="qty_cart" type="number" readonly="readonly" min="1" max="999" value="{{$item_cart['item_quantity']}}">
                                                            <span class="plus_cart mx-1" product-id="{{$item_cart['item_id']}}" quantity="{{$item_cart['item_quantity']}}">+</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    @else
                                        <div class="d-flex justify-content-between align-items-baseline">
                                            <p class="sale-price">{{ number_format($item_cart['item_price'], 0, '', '.') }} đ</p>
                                            <div class="item-action-cart">
                                                <div class="change-quantity">
                                                    <div class="number-q">
                                                        <span class="minus_cart mx-1" product-id="{{$item_cart['item_id']}}" quantity="{{$item_cart['item_quantity']}}">-</span>
                                                        <input name="qty_cart" type="number" readonly="readonly" min="1" max="999" value="{{$item_cart['item_quantity']}}">
                                                        <span class="plus_cart mx-1" product-id="{{$item_cart['item_id']}}" quantity="{{$item_cart['item_quantity']}}">+</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            </div>
                            <div class="delete-item cart_delete" data-target="{{$item_cart['item_id']}}">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                     data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 352 512"
                                     class="svg-inline--fa fa-times">
                                    <path data-v-0c88cae4="" fill="currentColor"
                                          d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"
                                          class="">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
        <div class="box-bottom d-none">
            <div class="container-total-box">
                <div class="bottom-bar">
                    <div class="voucher">
                        <svg data-v-6d2e8bc0="" id="icon-voucher" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
                            <path d="M395.13,306.087c-9.206,0-16.696,7.49-16.696,16.696c0,9.206,7.49,16.696,16.696,16.696s16.696-7.49,16.696-16.696
      C411.826,313.577,404.336,306.087,395.13,306.087z"></path>
                            <path d="M261.565,172.522c-9.206,0-16.696,7.49-16.696,16.696s7.49,16.696,16.696,16.696c9.206,0,16.696-7.49,16.696-16.696
      S270.771,172.522,261.565,172.522z"></path>
                            <path d="M495.304,72.348H144.696v50.087c0,9.217-7.479,16.696-16.696,16.696s-16.696-7.479-16.696-16.696V72.348H16.696
      C7.479,72.348,0,79.826,0,89.044v333.913c0,9.217,7.479,16.696,16.696,16.696h94.609v-50.087c0-9.217,7.479-16.696,16.696-16.696
      s16.696,7.479,16.696,16.696v50.087h350.609c9.217,0,16.696-7.479,16.696-16.696V89.044C512,79.826,504.521,72.348,495.304,72.348
      z M144.696,322.783c0,9.217-7.479,16.696-16.696,16.696s-16.696-7.479-16.696-16.696v-33.391c0-9.217,7.479-16.696,16.696-16.696
      s16.696,7.479,16.696,16.696V322.783z M144.696,222.609c0,9.217-7.479,16.696-16.696,16.696s-16.696-7.479-16.696-16.696v-33.391
      c0-9.217,7.479-16.696,16.696-16.696s16.696,7.479,16.696,16.696V222.609z M211.478,189.217c0-27.619,22.468-50.087,50.087-50.087
      c27.619,0,50.087,22.468,50.087,50.087c0,27.619-22.468,50.087-50.087,50.087C233.946,239.304,211.478,216.836,211.478,189.217z
       M257.512,343.544c-4.271,0-8.544-1.631-11.804-4.892c-6.521-6.521-6.521-17.087,0-23.609L387.37,173.37
      c6.521-6.522,17.086-6.522,23.608,0c6.521,6.521,6.521,17.087,0,23.609L269.315,338.652
      C266.054,341.914,261.782,343.544,257.512,343.544z M395.13,372.87c-27.619,0-50.087-22.468-50.087-50.087
      c0-27.619,22.468-50.087,50.087-50.087s50.087,22.468,50.087,50.087C445.217,350.402,422.75,372.87,395.13,372.87z"></path>
                        </svg>
                        <input type="text" placeholder="Nhập mã IT24H voucher">
                        <button class="btn btn-danger">Áp dụng </button>
                    </div>
                    <div class="total-box">
                        <p class="title-temp">Tổng tiền tạm tính:</p>
                        <div class="price-tt">
                            <span class="total">0 đ</span>
                        </div>
                    </div>
                    <div class="sm_cart">
                        <a class="btn-sm-cart">
                            Tiến hành đặt hàng
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="cnt_empty_cart d-none">
            <div class="empty_cart">
                <i class="far fa-frown"></i>
                <p>Không có sản phẩm nào trong giỏ hàng, Vui lòng quay lại</p>
                <a href="/" class="back-home"> Quay lại trang chủ</a>
            </div>
        </div>
    </div>
@endsection
