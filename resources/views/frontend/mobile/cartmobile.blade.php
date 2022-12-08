@extends('frontend.mobile.basemobile')

@section('title')
    <title>IT24H - Giỏ hàng</title>
@endsection

@section('header_mobile')
    @include('frontend.mobile.headermobile')
@endsection

@section('content')
    <div class="component-cart-container">
        <div id="breadcrumbs">
            <div class="block-breadcrumbs affix" id="affix_h">
                <div class="cps-container">
                    <ul>
                        <li>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10.633"
                                     viewBox="0 0 12 10.633">
                                    <path
                                        d="M13.2,9.061H12.1v3.965a.6.6,0,0,1-.661.661H8.793V9.721H6.15v3.965H3.507a.6.6,0,0,1-.661-.661V9.061h-1.1c-.4,0-.311-.214-.04-.494L7,3.259a.634.634,0,0,1,.936,0l5.3,5.307c.272.281.356.495-.039.495Z"
                                        transform="translate(-1.471 -3.053)" fill="#3991ff"></path>
                                </svg>
                            </div>
                            <a href="/">Trang chủ</a></li>
                        <li>
                            <div>
                                <svg height="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                    <path
                                        d="M96 480c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L242.8 256L73.38 86.63c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l192 192c12.5 12.5 12.5 32.75 0 45.25l-192 192C112.4 476.9 104.2 480 96 480z"></path>
                                </svg>
                            </div>
                            <p>
                                Giỏ hàng
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <section class="block-cart-product d-none" data-target="{{$product_cart->count()}}">
            @if (!empty($product_cart))
            <div class="container-cart">
                    @foreach ($product_cart as $item_cart)
                    <div class="product-item-cart" id="cart_{{$item_cart->id}}">
                        <div class="d-flex">
                            <div class="check_p"><input id="check_cart_{{$item_cart->id}}" class="check_cart" type="checkbox" name="check_cart" data-target="{{$item_cart->id}}"></div>
                            <div class="product-item-cart__image">
                                <img src="{{asset('upload/images/products/thumb/'.$item_cart->thumb)}}"></div>
                            <div class="product-item-cart-info-detail">
                                <p class="product-cart-name">{{$item_cart->name}}</p>
                                <div class="product-item-cart__price">
                                    @if($item_cart->price_onsale)
                                    <p class="sale-price" data-target="{{$item_cart->price_onsale}}">{{ number_format($item_cart->price_onsale, 0, '', '.') }} đ</p>
                                    <p class="regular-price" data-target="{{$item_cart->price}}">{{ number_format($item_cart->price, 0, '', '.') }} đ</p>
                                    <span class="onsale-cart">Giảm {{ $item_cart->onsale}}%</span></div>
                                    @else
                                    <p class="sale-price">{{ number_format($item_cart->price, 0, '', '.') }} đ</p>
                                    @endif
                                <div class="item-action-cart">
                                    <div class="change-quantity">
                                        <p>Chọn số lượng:</p>
                                        <div class="number-q">
                                            <span class="minus_cart">-</span>
                                            <input name="qty_cart" type="number" readonly="readonly" min="1" max="999" value="1">
                                            <span class="plus_cart">+</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="delete-item cart_delete" data-target="{{$item_cart->id}}">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                 data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"
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
            <div class="container-total-box">
                <div class="bottom-bar">
                    <div class="total-box">
                        <p class="title-temp">Tổng tiền tạm tính:</p>
                        <div class="price-tt">
                            <span class="total">0 đ</span>
                        </div>
                    </div>
                    <div class="sm_cart">
                        <a href="{{route('checkout')}}" class="btn-sm-cart">
                            Tiến hành đặt hàng
                        </a>
                        <a href="/" class="btn-add-another-p">
                            Chọn thêm sản phẩm khác
                        </a></div>
                </div>
            </div>
            @endif
        </section>
        <div class="cnt_empty_cart d-none">
            <div class="empty_cart">
                <i class="far fa-frown"></i>
                <p>Không có sản phẩm nào trong giỏ hàng, Vui lòng quay lại</p>
                <a href="/"  class="back-home"> Quay lại trang chủ</a>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            function runOnScroll() {
                if (jQuery(window).scrollTop() > 30) {
                    document.getElementById("affix_h").style.top = "60px";
                } else {
                    document.getElementById("affix_h").style.top = "115px";
                }
            }
            $(window).scroll(runOnScroll);
        })
    </script>
@endsection

{{--@section('footer')--}}
{{--    @include('frontend.mobile.footermobile')--}}
{{--@endsection--}}
