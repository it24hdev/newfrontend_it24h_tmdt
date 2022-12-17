@extends('frontend.mobile.basemobile')

@section('title')
    <title>IT24H - Sản phẩm</title>
@endsection

@section('header_mobile')
    @include('frontend.mobile.headermobile')
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('asset/css/mobile/filterprice_mobile.css')}}">
    <link rel="stylesheet" href="{{asset('asset/css/mobile/pagination_mobile.css')}}">
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
                        @if(!empty($cat))
                            <a href="{{route('product_cat',[ 'slug' => $cat->slug])}}">{{$cat->name}}</a>
                        @else
                            <a href="{{route('list_product')}}">Sản phẩm</a>
                        @endif
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
                @if($bard)
                    <div class="list-brand">
                        @foreach($bard as $key => $item)
                            @if($item->image)
                            <a href="{{route('product_cat',['slug'=> $cat->slug,'brand' => $item->name])}}" target="_self" class="list-brand__item">
                                <img src="{{asset('upload/images/products/'.$item->image)}}"
                                     alt="{{$item->name}}" loading="lazy" class="filter-brand__img">
                            </a>
                            @else
                            <a href="{{route('product_cat',['slug'=> $cat->slug,'brand' => $item->name])}}" target="_self"
                                     class="list-brand__item"> <span>{{$item->name}}</span>
                            </a>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="list_cat_childs">
        @if($list_cat_childs)
        <div class="filter-sort__title">Chọn theo loại sản phẩm</div>
        {{--    category--}}
        <div class="category_">
            <div class="b_cate">
                <div class="content_cat">
                    <div class="content_cat_w w2">
                        @foreach ($list_cat_childs as $item)
                            {{--                    item--}}
                            <div class="item-categories-outer wcc">
                                <a href="{{route('product_cat', ['slug' =>  $item->slug])}}"
                                   class="item-categories square2"
                                   style="background-color:transparent; background-size: contain;
                                   background-image:@if($item->thumb!="no-images.jpg")url({{asset('upload/images/products/thumb/'.$item->thumb)}});@else url('');@endif">
                                    <span class="">{{$item->name}}</span>
                                </a>
                            </div>
                            {{--                    end item--}}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    {{--    Bộ lọc--}}
    <div class="filter_product">
        <div class="filter-sort__title">Chọn theo tiêu chí</div>
        <div id="filterModule">
            <div class="filter-sort__list-filter">
                <div class="filter-wrapper">
                    @if(!empty($cat))
                    <button class="btn-filter btn-f">
                        <div class="icon mr-1 ml-0">
                            <svg height="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path
                                    d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"></path>
                            </svg>
                        </div>
                        Bộ lọc
                    </button>
                    @endif
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
                                            <div class="filter-wrapper" get-name-attrs="{{$value->attr_name_code}}">
                                                <div class="is-flex title-filter">
                                                    <p>{{$value->name}}</p>
                                                </div>
                                                <ul>
                                                    @foreach($value->detailproperty as $property)
                                                        @if($property->count_product>0)
                                                            <li id="detail_id_{{$property->id}}"
                                                                data-target="#filter_id_{{$property->id}}"
                                                                get-name-attr="{{$property->this_attr_code}}"
                                                                get-attr="{{$property->this_attr_detail_code}}"
                                                                class="btn-filter btn-filter-item @if($property->attr_checked == 1) active @endif">
                                                                {{$property->name}}
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
                        <input id="submitfilter" type="button" class="btn btn-primary" value="Lọc">
                    </div>

                </div>
                {{--                Lọc theo giá--}}
                <div class="filter-wrapper @if(request()->has('p')) active @endif" id="active_price">
                    <button class="btn-filter @if(request()->has('p')) ac @endif" id="filter_by_price">
                        <div class="icon mr-1 ml-0">
                            <svg class="@if(request()->has('p')) acsgv @endif" height="15"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
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
                            <button id="filter_price" class="btn btn-primary mx-1">Lọc</button>
                            {{--                            </form>--}}
                        </div>
                    </div>

                </div>
                {{--                Lọc theo thuộc tính--}}
                @if(!empty($attributes))
                    @foreach($attributes as $key => $value)
                        @if($value->count_attr>0)
                            <div class="filter-wrapper">
                                <button class="btn-filter btn-filter-child @if($value->count_attr_active) ac @endif"
                                        data-target="#collapse_{{$value->id}}">
                                    {{$value->name}}
                                    <div class="icon2">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="10"
                                             height="10">
                                            <path
                                                d="M224 416c-8.188 0-16.38-3.125-22.62-9.375l-192-192c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L224 338.8l169.4-169.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-192 192C240.4 412.9 232.2 416 224 416z"></path>
                                        </svg>
                                    </div>
                                </button>
                                <div class="list-filter-child" id="collapse_{{$value->id}}">
                                    <ul>
                                        @foreach($value->detailproperty as $property)
                                            @if($property->count_product>0)
                                                <li>
                                                    <button id="filter_id_{{$property->id}}"
                                                            data-target="#detail_id_{{$property->id}}"
                                                            class="chose_f btn-filter btn-filter-item @if($property->attr_checked == 1) ac @endif">
                                                        {{$property->name}}
                                                    </button>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    <div class="btn-filter-group">
                                        <button class="button_close" data-target="#collapse_{{$value->id}}">Đóng
                                        </button>
                                        <button class="button_submit">Xem kết quả</button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    {{--    Dang loc theo--}}
    <div class="filter_product filtering_by d-none">
        <div class="filter-sort__title">Đang lọc theo</div>
        <div class="filter-sort__list-filter">
            @if(!empty($attributes))
                @foreach($attributes as $key => $value)
                    @if($value->count_attr>0)
                        @foreach($value->detailproperty as $property)
                            @if($property->count_product>0 && $property->attr_checked == 1)
                                <button class="btn-filter ac cancel_filter" get-url-cancel="{{$property->fullurl}}">
                                    <div class="icon">
                                        <svg width="40" height="40" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 512 512">
                                            <path
                                                d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM175 208.1L222.1 255.1L175 303C165.7 312.4 165.7 327.6 175 336.1C184.4 346.3 199.6 346.3 208.1 336.1L255.1 289.9L303 336.1C312.4 346.3 327.6 346.3 336.1 336.1C346.3 327.6 346.3 312.4 336.1 303L289.9 255.1L336.1 208.1C346.3 199.6 346.3 184.4 336.1 175C327.6 165.7 312.4 165.7 303 175L255.1 222.1L208.1 175C199.6 165.7 184.4 165.7 175 175C165.7 184.4 165.7 199.6 175 208.1V208.1z"></path>
                                        </svg>
                                    </div>
                                    {{$value->name}}:<span
                                        class="item-value-filter"> &nbsp;{{$property->name}}&nbsp; </span>
                                </button>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @endif
            @if(!empty($filter_price))
                <button class="btn-filter ac cancel_price">
                    <div class="icon">
                        <svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM175 208.1L222.1 255.1L175 303C165.7 312.4 165.7 327.6 175 336.1C184.4 346.3 199.6 346.3 208.1 336.1L255.1 289.9L303 336.1C312.4 346.3 327.6 346.3 336.1 336.1C346.3 327.6 346.3 312.4 336.1 303L289.9 255.1L336.1 208.1C346.3 199.6 346.3 184.4 336.1 175C327.6 165.7 312.4 165.7 303 175L255.1 222.1L208.1 175C199.6 165.7 184.4 165.7 175 175C165.7 184.4 165.7 199.6 175 208.1V208.1z"></path>
                        </svg>
                    </div>
                    Giá:<span class="item-value-filter"> &nbsp;{{$filter_price}}&nbsp; </span>
                </button>
            @endif
            <button class="btn-filter ac cancel_all">
                <div class="icon">
                    <svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                            d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM175 208.1L222.1 255.1L175 303C165.7 312.4 165.7 327.6 175 336.1C184.4 346.3 199.6 346.3 208.1 336.1L255.1 289.9L303 336.1C312.4 346.3 327.6 346.3 336.1 336.1C346.3 327.6 346.3 312.4 336.1 303L289.9 255.1L336.1 208.1C346.3 199.6 346.3 184.4 336.1 175C327.6 165.7 312.4 165.7 303 175L255.1 222.1L208.1 175C199.6 165.7 184.4 165.7 175 175C165.7 184.4 165.7 199.6 175 208.1V208.1z"></path>
                    </svg>
                </div>
                Bỏ chọn tất cả
            </button>
        </div>
    </div>
    {{--    Sap xep theo--}}
    <div class="filter_product filtering_by">
        <div class="filter-sort__title">Sắp xếp theo</div>
        <div>
            <div class="filter-sort__list-filter sort_by">
            <button
                class="btn-filter btn-sort @if(request()->has('order') && request('order') == "gia_cao_den_thap") ac @endif"
                data-target-attr="gia_cao_den_thap">
                <div class="icon">
                    <svg height="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                        <path
                            d="M416 288h-95.1c-17.67 0-32 14.33-32 32s14.33 32 32 32H416c17.67 0 32-14.33 32-32S433.7 288 416 288zM544 32h-223.1c-17.67 0-32 14.33-32 32s14.33 32 32 32H544c17.67 0 32-14.33 32-32S561.7 32 544 32zM352 416h-32c-17.67 0-32 14.33-32 32s14.33 32 32 32h32c17.67 0 31.1-14.33 31.1-32S369.7 416 352 416zM480 160h-159.1c-17.67 0-32 14.33-32 32s14.33 32 32 32H480c17.67 0 32-14.33 32-32S497.7 160 480 160zM192.4 330.7L160 366.1V64.03C160 46.33 145.7 32 128 32S96 46.33 96 64.03v302L63.6 330.7c-6.312-6.883-14.94-10.38-23.61-10.38c-7.719 0-15.47 2.781-21.61 8.414c-13.03 11.95-13.9 32.22-1.969 45.27l87.1 96.09c12.12 13.26 35.06 13.26 47.19 0l87.1-96.09c11.94-13.05 11.06-33.31-1.969-45.27C224.6 316.8 204.4 317.7 192.4 330.7z"></path>
                    </svg>
                </div>
                <span>Giá Cao - Thấp</span>
            </button>
            <button
                class="btn-filter btn-sort @if(request()->has('order') && request('order') == "gia_thap_den_cao") ac @endif"
                data-target-attr="gia_thap_den_cao">
                <div class="icon">
                    <svg height="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                        <path
                            d="M416 288h-95.1c-17.67 0-32 14.33-32 32s14.33 32 32 32H416c17.67 0 32-14.33 32-32S433.7 288 416 288zM544 32h-223.1c-17.67 0-32 14.33-32 32s14.33 32 32 32H544c17.67 0 32-14.33 32-32S561.7 32 544 32zM352 416h-32c-17.67 0-32 14.33-32 32s14.33 32 32 32h32c17.67 0 31.1-14.33 31.1-32S369.7 416 352 416zM480 160h-159.1c-17.67 0-32 14.33-32 32s14.33 32 32 32H480c17.67 0 32-14.33 32-32S497.7 160 480 160zM192.4 330.7L160 366.1V64.03C160 46.33 145.7 32 128 32S96 46.33 96 64.03v302L63.6 330.7c-6.312-6.883-14.94-10.38-23.61-10.38c-7.719 0-15.47 2.781-21.61 8.414c-13.03 11.95-13.9 32.22-1.969 45.27l87.1 96.09c12.12 13.26 35.06 13.26 47.19 0l87.1-96.09c11.94-13.05 11.06-33.31-1.969-45.27C224.6 316.8 204.4 317.7 192.4 330.7z"></path>
                    </svg>
                </div>
                <span>Giá Thấp - Cao</span>
            </button>
            <button
                class="btn-filter btn-sort @if(request()->has('order') && request('order') == "khuyen_mai_hot") ac @endif"
                data-target-attr="khuyen_mai_hot">
                <div class="icon">
                    <svg height="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                        <path
                            d="M112 224c61.9 0 112-50.1 112-112S173.9 0 112 0 0 50.1 0 112s50.1 112 112 112zm0-160c26.5 0 48 21.5 48 48s-21.5 48-48 48-48-21.5-48-48 21.5-48 48-48zm224 224c-61.9 0-112 50.1-112 112s50.1 112 112 112 112-50.1 112-112-50.1-112-112-112zm0 160c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zM392.3.2l31.6-.1c19.4-.1 30.9 21.8 19.7 37.8L77.4 501.6a23.95 23.95 0 0 1-19.6 10.2l-33.4.1c-19.5 0-30.9-21.9-19.7-37.8l368-463.7C377.2 4 384.5.2 392.3.2z"></path>
                    </svg>
                </div>
                <span>Khuyến Mãi Hot</span>
            </button>
            <button
                class="btn-filter btn-sort @if(request()->has('order') && request('order') == "xem_nhieu") ac @endif"
                data-target-attr="xem_nhieu">
                <div class="icon">
                    <svg height="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                        <path
                            d="M279.6 160.4C282.4 160.1 285.2 160 288 160C341 160 384 202.1 384 256C384 309 341 352 288 352C234.1 352 192 309 192 256C192 253.2 192.1 250.4 192.4 247.6C201.7 252.1 212.5 256 224 256C259.3 256 288 227.3 288 192C288 180.5 284.1 169.7 279.6 160.4zM480.6 112.6C527.4 156 558.7 207.1 573.5 243.7C576.8 251.6 576.8 260.4 573.5 268.3C558.7 304 527.4 355.1 480.6 399.4C433.5 443.2 368.8 480 288 480C207.2 480 142.5 443.2 95.42 399.4C48.62 355.1 17.34 304 2.461 268.3C-.8205 260.4-.8205 251.6 2.461 243.7C17.34 207.1 48.62 156 95.42 112.6C142.5 68.84 207.2 32 288 32C368.8 32 433.5 68.84 480.6 112.6V112.6zM288 112C208.5 112 144 176.5 144 256C144 335.5 208.5 400 288 400C367.5 400 432 335.5 432 256C432 176.5 367.5 112 288 112z"></path>
                    </svg>
                </div>
                <span>Xem Nhiều</span>
            </button>
        </div>
        </div>
    </div>
    {{--    san pham--}}
    <div class="col-12">
        <div class="featured-product-list flex-wrap">
            @foreach($products as $value)
                <div class="component-product filter_item">
                    <div class="tag_cpn">
                        <div class="tag_p">
                            @if (!empty($value->year))
                                <span class="years2">{{$value->year}}</span>
                            @endif
                            @if (!empty($value->installment))
                                <span class="payment2">Trả góp 0%</span>
                            @endif
                        </div>

                        @if (!empty($value->brands->image))
                            <span class="dbrand2"
                                  style="background-image: url('{{asset("upload/images/products/thumb/".$value->brands->image)}}');"></span>
                        @endif
                    </div>
                    <div class="p-img">
                        <a href="{{ route('detailproduct', $value->slug)}}">
                            <img class="filter_item_img" src="@if($value->thumb != 'no-images.jpg' || !empty($value->thumb)){{asset('upload/images/products/thumb/'.$value->thumb)}}@else{{asset('upload/images/common_img/no-images.jpg')}}@endif"
                            alt="{{$value->name}}">
                        </a>
                    </div>
                    <div class="info_cpn">
                        <div class="p-info">
                            <a href="{{ route('detailproduct', $value->slug)}}" class="p-name">{{$value->name}}</a>
                            @if ($value->price_onsale!=0)
                                <div class="promotion2">
                                    <span class="pprice2">{{number_format($value->price,0,',','.')}} đ</span>
                                    <span class="dpercent2">- {{$value->onsale}}%</span>
                                </div>
                                <span class="p-price">{{number_format($value->price_onsale,0,',','.')}} đ</span>
                            @else
                                <div class="promotion2">
                                    <span></span>
                                </div>
                                <span class="p-price">{{number_format($value->price,0,',','.')}} đ</span>

                            @endif
                        </div>
                    </div>
                    <div class="p_rev">
                        <div class="review">
                            <div class="rating2">
                                <div class="rating-upper" style="width: {{$value->count_vote()}}%">
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
                            @if(!empty($value->sold))
                                <div class="sold2"><i class="fas fa-badge-check"></i>Đã bán {{$value->sold}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="detail_cpn">
                        <div class="detail-bottom">
                            @if (($value->quantity - $value->sold > 0))
                                <div class="qty" style="color: #01aa42; background-color: #dbf8e1;">Còn hàng</div>
                            @else
                                <div class="qty" style="color: #337bff; background-color: #dbe9f8;">Liên hệ</div>
                            @endif
                            <div class="action">
                                <a href="javascript:;" get-id="{{$value->id}}" class="heart add-wish d-none"
                                   title="Lưu sản phẩm">
                                    @if(in_array($value->id,explode(' ', Cookie::get('list_wish'))))
                                        <i class="fas fa-heart heart_red"></i>
                                    @else
                                        <i class="far fa-heart"></i>
                                    @endif
                                </a>
                                <a href="javascript:;" get-id="{{$value->id}}" title="Thêm vào giỏ hàng"
                                   class="add-cart">
                                    <i class="far fa-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mx-2 my-1 d-flex justify-content-end"> {!! $products->links('frontend.pagination') !!} </div>
    </div>
    {{--    Mo ta danh muc--}}
    @if(!empty($cat->content))
        <div class="describe_cat">
            {!! $cat->content  !!}
        </div>
    @endif
    {{--comment--}}
    <div class="comment-container">
        <div class="comment-form">
            <p class="comment-form-title">Hỏi và đáp</p>
            <div class="comment-form-content">
                <div class="textarea-comment">
                    <textarea placeholder="Xin mời để lại câu hỏi, IT24H sẽ trả lời lại trong 1h, các câu hỏi sau 22h - 8h sẽ được trả lời vào sáng hôm sau" class="textarea"></textarea>
                    <button class="button">
                        <div class="icon-paper-plane">
                            <svg height="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path
                                    d="M511.6 36.86l-64 415.1c-1.5 9.734-7.375 18.22-15.97 23.05c-4.844 2.719-10.27 4.097-15.68 4.097c-4.188 0-8.319-.8154-12.29-2.472l-122.6-51.1l-50.86 76.29C226.3 508.5 219.8 512 212.8 512C201.3 512 192 502.7 192 491.2v-96.18c0-7.115 2.372-14.03 6.742-19.64L416 96l-293.7 264.3L19.69 317.5C8.438 312.8 .8125 302.2 .0625 289.1s5.469-23.72 16.06-29.77l448-255.1c10.69-6.109 23.88-5.547 34 1.406S513.5 24.72 511.6 36.86z"></path>
                            </svg>
                        </div>
                        Gửi
                    </button>
                </div>
            </div>
        </div>
        <div class="block-comment__box-list-comment">
            <div class="list-comment">
                <div class="item-comment">
                    <div class="item-comment__box-cmt">
                        <div class="box-cmt__box-info">
                            <div class="box-info">
                                <div class="box-info__avatar">
                                    <span>N</span>
                                </div>
                                <p class="box-info__name">
                                    Nguyễn Thị Thúy Quyên
                                </p> <!----></div>
                            <div class="box-time-cmt">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                        <path id="clock"
                                              d="M7.72,8.78,5.25,6.31V3h1.5v2.69L8.78,7.72ZM6,0a6,6,0,1,0,6,6A6,6,0,0,0,6,0ZM6,10.5A4.5,4.5,0,1,1,10.5,6,4.5,4.5,0,0,1,6,10.5Z"
                                              fill="#707070">
                                        </path>
                                    </svg>
                                </div>&nbsp;1 tuần trước
                            </div>
                        </div>
                        <div class="box-cmt__box-question">
                            <div class="content">
                                <div>Con này khi nào có thì liên hệ em qua ZAlo *****239 nha ạ, em cám ơn nhiều</div>
                            </div>
                            <button class="btn-rep-cmt">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="12"
                                         viewBox="0 0 12 10.8">
                                        <path d="M3.48,8.32V4.6H1.2A1.2,1.2,0,0,0,0,5.8V9.4a1.2,1.2,0,0,0,1.2,1.2h.6v1.8l1.8-1.8h3A1.2,1.2,0,0,0,7.8,9.4V8.308a.574.574,0,0,1-.12.013H3.48ZM10.8,1.6H5.4A1.2,1.2,0,0,0,4.2,2.8V7.6H8.4l1.8,1.8V7.6h.6A1.2,1.2,0,0,0,12,6.4V2.8a1.2,1.2,0,0,0-1.2-1.2Z"
                                              transform="translate(0 -1.6)" fill="#2490ff">
                                        </path>
                                    </svg>
                                </div>&nbsp;Trả lời
                            </button>
                        </div>
                        <div class="item-comment__box-rep-comment">
                            <div class="list-rep-comment">
                                <div class="item-rep-comment">
                                    <div class="box-cmt__box-info">
                                        <div class="box-info">
                                            <div class="box-info__avatar">
                                                <span class="icon-cps">
                                                    <div>
                                                        <svg viewBox="0 0 40 40" fill="#fff" xmlns="http://www.w3.org/2000/svg">
                                                        </svg>
                                                    </div>
                                                </span>
                                            </div>
                                            <p class="box-info__name">
                                                Quản trị viên
                                            </p> <span class="box-info__tag">QTV</span>
                                        </div>
                                        <div class="box-time-cmt">
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                     viewBox="0 0 12 12">
                                                    <path id="clock"
                                                          d="M7.72,8.78,5.25,6.31V3h1.5v2.69L8.78,7.72ZM6,0a6,6,0,1,0,6,6A6,6,0,0,0,6,0ZM6,10.5A4.5,4.5,0,1,1,10.5,6,4.5,4.5,0,0,1,6,10.5Z"
                                                          fill="#707070"></path>
                                                </svg>
                                            </div>&nbsp;1 tuần trước
                                        </div>
                                    </div>
                                    <div class="box-cmt__box-question">
                                        <div class="content">
                                            <div>CellphoneS xin chào Chị Quyên</div>
                                        </div>
                                        <div class="content">
                                            <div>dạ em rất tiếc, CellphoneS chưa hỗ trợ thông báo khi hàng về qua zalo,
                                                Chị đăng ký thông tin chờ hàng ở phía trên hoặc mình thường xuyên theo
                                                dõi sản phẩm giúp em ạ
                                            </div>
                                        </div>
                                        <div class="content">
                                            <div>Thân mến!</div>
                                        </div>
                                        <div class="content">
                                            <div></div>
                                        </div>
                                        <button class="btn-rep-cmt respondent">
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="12"
                                                     viewBox="0 0 12 10.8">
                                                    <path id="chat"
                                                          d="M3.48,8.32V4.6H1.2A1.2,1.2,0,0,0,0,5.8V9.4a1.2,1.2,0,0,0,1.2,1.2h.6v1.8l1.8-1.8h3A1.2,1.2,0,0,0,7.8,9.4V8.308a.574.574,0,0,1-.12.013H3.48ZM10.8,1.6H5.4A1.2,1.2,0,0,0,4.2,2.8V7.6H8.4l1.8,1.8V7.6h.6A1.2,1.2,0,0,0,12,6.4V2.8a1.2,1.2,0,0,0-1.2-1.2Z"
                                                          transform="translate(0 -1.6)" fill="#2490ff">

                                                    </path>
                                                </svg>
                                            </div>&nbsp;Trả lời
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div> <!----></div>
                </div>
            </div>
            <button class="btn-show-more">
                Xem thêm 66 bình luận
                <div class="inline-block-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="10" height="10">
                        <path
                            d="M224 416c-8.188 0-16.38-3.125-22.62-9.375l-192-192c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L224 338.8l169.4-169.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-192 192C240.4 412.9 232.2 416 224 416z"></path>
                    </svg>
                </div>
            </button>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('asset/js/filter-price-2.js')}}"></script>
@endsection
