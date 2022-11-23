@extends('frontend.mobile.basemobile')

@section('title')
    <title>IT24H - Sản phẩm</title>
@endsection

@section('header_mobile')
    @include('frontend.mobile.headermobile')
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('asset/css/mobile/filter_price.css')}}">
@endsection
@section('content')
    <div id="breadcrumbs">
        <div class="block-breadcrumbs affix" id="affix_h">
            <div class="cps-container">
                <ul>
                    <li>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10.633" viewBox="0 0 12 10.633">
                                <path
                                    d="M13.2,9.061H12.1v3.965a.6.6,0,0,1-.661.661H8.793V9.721H6.15v3.965H3.507a.6.6,0,0,1-.661-.661V9.061h-1.1c-.4,0-.311-.214-.04-.494L7,3.259a.634.634,0,0,1,.936,0l5.3,5.307c.272.281.356.495-.039.495Z"
                                    transform="translate(-1.471 -3.053)" fill="#3991ff">
                                </path>
                            </svg>
                        </div>
                        <a href="/">Trang chủ</a>
                    </li>
                    <li>
                        <div>
                            <svg height="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                <path
                                    d="M96 480c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L242.8 256L73.38 86.63c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l192 192c12.5 12.5 12.5 32.75 0 45.25l-192 192C112.4 476.9 104.2 480 96 480z"></path>
                            </svg>
                        </div>
                        <a href="{{route('product_cat',[ 'slug' => $cat->slug])}}">{{$cat->name}}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    {{--    Banner--}}
    <div class="banner_product">
        <div class="home_top">
            <div class="banner_top">
                <div class="border_slider">
                    <div class="owl-carousel owl-theme owl-loaded owl-drag" id="slider-show">
                        @foreach ($sliders as $item)
                            <a href="{{$item->link_target}}">
                                <img class="owl-lazy"
                                     data-src="{{asset('upload/images/slider/thumb/'.$item->image)}}"
                                     alt="">
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    thương hiệu--}}
    <div class="brand_product">
        <div class="block-filter-brands"><!---->
            <div class="brands__content">
                <div class="list-brand">
                    <a href="https://cellphones.com.vn/mobile/apple.html" target="_self" class="list-brand__item">
                        <img src="https://cdn2.cellphones.com.vn/x/media/tmp/catalog/product/t/_/t_i_xu_ng_71_.png"
                             alt="Apple" loading="lazy" class="filter-brand__img">
                    </a>
                    <a href="https://cellphones.com.vn/mobile/samsung.html" target="_self"
                       class="list-brand__item"><img
                            src="https://cdn2.cellphones.com.vn/x/media/tmp/catalog/product/t/_/t_i_xu_ng_72_.png"
                            alt="Samsung" loading="lazy" class="filter-brand__img"> <!----></a><a
                        href="https://cellphones.com.vn/mobile/xiaomi.html" target="_self" class="list-brand__item"><img
                            src="https://cdn2.cellphones.com.vn/x/media/tmp/catalog/product/t/_/t_i_xu_ng_73_.png"
                            alt="Xiaomi" loading="lazy" class="filter-brand__img"> <!----></a><a
                        href="https://cellphones.com.vn/mobile/oppo.html" target="_self" class="list-brand__item"><img
                            src="https://cdn2.cellphones.com.vn/x/media/tmp/catalog/product/t/_/t_i_xu_ng_74_.png"
                            alt="OPPO" loading="lazy" class="filter-brand__img"> <!----></a><a
                        href="https://cellphones.com.vn/mobile/vivo.html" target="_self" class="list-brand__item"><img
                            src="https://cdn2.cellphones.com.vn/x/media/tmp/catalog/product/t/_/t_i_xu_ng_67_.png"
                            alt="vivo" loading="lazy" class="filter-brand__img"> <!----></a><a
                        href="https://cellphones.com.vn/mobile/nokia.html" target="_self" class="list-brand__item"><img
                            src="https://cdn2.cellphones.com.vn/x/media/tmp/catalog/product/t/_/t_i_xu_ng_75_.png"
                            alt="Nokia" loading="lazy" class="filter-brand__img"> <!----></a><a
                        href="https://cellphones.com.vn/mobile/realme.html" target="_self" class="list-brand__item"><img
                            src="https://cdn2.cellphones.com.vn/x/media/tmp/catalog/product/t/_/t_i_xu_ng_76_.png"
                            alt="realme" loading="lazy" class="filter-brand__img"> <!----></a><a
                        href="https://cellphones.com.vn/mobile/asus.html" target="_self" class="list-brand__item"><img
                            src="https://cdn2.cellphones.com.vn/x/media/tmp/catalog/product/t/_/t_i_xu_ng_77_.png"
                            alt="ASUS" loading="lazy" class="filter-brand__img"> <!----></a><a
                        href="https://cellphones.com.vn/mobile/oneplus.html" target="_self"
                        class="list-brand__item"><img
                            src="https://cdn2.cellphones.com.vn/x/media/tmp/catalog/product/t/_/t_i_xu_ng_79_.png"
                            alt="OnePlus" loading="lazy" class="filter-brand__img"> <!----></a><a
                        href="https://cellphones.com.vn/mobile/nubia.html" target="_self" class="list-brand__item"><img
                            src="https://cdn2.cellphones.com.vn/x/media/tmp/catalog/product/t/_/t_i_xu_ng_80_.png"
                            alt="Nubia" loading="lazy" class="filter-brand__img"> <!----></a><a
                        href="https://cellphones.com.vn/mobile/tecno.html" target="_self" class="list-brand__item"><img
                            src="https://cdn2.cellphones.com.vn/x/media/catalog/product/0/1/015413gpfxf4f5f3uwu6wf.png"
                            alt="Tecno" loading="lazy" class="filter-brand__img"> <!----></a><a
                        href="https://cellphones.com.vn/mobile/dien-thoai-pho-thong.html" target="_self"
                        class="list-brand__item"><!----> <span>Điện thoại phổ thông</span></a>
                    <a href="https://cellphones.com.vn/mobile/hang-sap-ve.html" target="_self"
                       class="list-brand__item"><!----> <span>Tin đồn - Mới ra</span></a>
                    <a href="https://cellphones.com.vn/mobile/hang-khac.html" target="_self"
                       class="list-brand__item"> <span>Hãng khác</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{--    Bộ lọc--}}
    <div class="filter_product">
        <div class="filter-sort__title">Chọn theo tiêu chí</div>
        <div id="filterModule">
            <div class="filter-sort__list-filter">
                <div class="filter-wrapper">
                    <button class="btn-filter btn-f">
                        <div class="icon mr-1 ml-0">
                            <svg height="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path
                                    d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"></path>
                            </svg>
                        </div>
                        Bộ lọc
                    </button>
                    <form action="{{route('product_cat',['slug'=> $cat->slug])}}" method="get" enctype="multipart/form-data">
                    <div class="filterall">
                        <div>
                        <div class="header-filter-all">
                            <div class="title">
                                <div class="icon">
                                    <svg height="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path
                                            d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"></path>
                                    </svg>
                                </div>
                                Bộ lọc
                            </div>
                            <button class="btnclose">x</button>
                        </div>
                        </div>
                        <div class="listFilter">
                            <div>
                            @if(!empty($attributes))
                                @foreach($attributes as $key => $value)
                                    @if($value->count_attr>0)
                                    <div class="filter-wrapper">
                                        <div class="is-flex title-filter">
                                            <p>{{$value->name}}</p>
                                        </div>
                                        <ul>
                                            @foreach($value->detailproperty as $property)
                                                @if($property->count_product>0)
                                                <li>
                                                    <a>
                                                    <input type="text" name="{{$property->this_attr}}[]" value="{{$property->this_attr_detail}}" class="btn-filter btn-filter-item"  @if($property->attr_checked == 1) style="background: #3991ff;color: #f9fafb;" @endif>
                                                        {{$property->name}}
                                                    </input>
                                                    </a>
                                                </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                @endforeach
                            @endif
                            </div>
                        </div>
                            <input style="position: relative; top: -55px;" type="submit" class="btn btn-primary" value="Lọc">
                    </div>
                    </form>
                </div>
                <div class="filter-wrapper">
                    <button class="btn-filter" id="filter_by_price">
                        <div class="icon mr-1 ml-0">
                            <svg height="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <path
                                    d="M512 64C547.3 64 576 92.65 576 128V384C576 419.3 547.3 448 512 448H64C28.65 448 0 419.3 0 384V128C0 92.65 28.65 64 64 64H512zM128 384C128 348.7 99.35 320 64 320V384H128zM64 192C99.35 192 128 163.3 128 128H64V192zM512 384V320C476.7 320 448 348.7 448 384H512zM512 128H448C448 163.3 476.7 192 512 192V128zM288 352C341 352 384 309 384 256C384 202.1 341 160 288 160C234.1 160 192 202.1 192 256C192 309 234.1 352 288 352z"></path>
                            </svg>
                        </div>
                        Giá
                    </button>
                    {{--                    form lọc giá--}}
                    <div class="p_filter d-none">
                        <div id="slider-range"></div>
                        <div class=" slider-labels d-flex">
                            <div class="caption min_c">
                                <span id="slider-range-value1"></span>
                            </div>
                            <div class=" text-right caption">
                                <span id="slider-range-value2"></span>
                            </div>
                        </div>
                        <div class="col-sm-12 d-flex justify-content-center">
                            {{--                            <form>--}}
                            <input type="hidden" name="min-value" class="min-value">
                            <input type="hidden" name="max-value" class="max-value">
                            <button class="btn btn-primary mx-1 close_p">Đóng</button>
                            <button class="btn btn-primary mx-1">Lọc</button>
                            {{--                            </form>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="{{asset('asset/js/filter-price-2.js')}}"></script>
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
            // $(document).on('click','#submitfilter', function (){
            //
            // })
        })
    </script>
@endsection
@section('footer')
    @include('frontend.mobile.footermobile')
@endsection
