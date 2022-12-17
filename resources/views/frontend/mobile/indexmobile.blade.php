@extends('frontend.mobile.basemobile')

@section('title')
    <title>IT24H - Trang chủ</title>
@endsection

@section('header_mobile')
    @include('frontend.mobile.headermobile')
@endsection

@section('content')
    <div class="body_mobile">
        {{--    slider banner--}}
        <div class="home_top">
            <div class="banner_top">
                <div class="border_slider">
                    <div class="owl-carousel owl-theme owl-loaded owl-drag" id="slider-show">
                        @foreach ($sliders as $item)
                            <a href="{{$item->link_target}}">
                                <img src="{{asset('upload/images/slider/thumb/'.$item->image)}}">
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        {{--    category--}}
        <div class="category_">
            <div class="b_cate">
                <div class="content_cat">
                    <div class="content_cat_w">
                        @foreach ($get_cat_parents as $item)
                            {{--                    item--}}
                            <div class="item-categories-outer">
                                <a href="{{route('product_cat', ['slug' =>  $item->slug])}}"
                                   class="item-categories square"
                                   style="background-color:transparent;background-image:url({{asset('upload/images/products/thumb/'.$item->thumb)}});">
                                </a>
                                <p class="title-under">{{$item->name}}</p>
                            </div>
                            {{--                    end item--}}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        {{--    hotsale --}}
        <div class="hot_sale">
            <div class="block_hot_sale">
                <div class="hot_sale_l1">
                    {{--                header-time sale--}}
                    <div class="header_sale">
                        <div class="top_header_sale">
                            <div class="h_inner title_s">
                                <div class="d-flex">
                                    <i class="fas fa-bolt"></i>
                                    <p>Flash Sale</p>
                                </div>
                                <div class="time_count">
                                    <a title="Xem tất cả Deal Hot" href="#">
                                        <div class="count-down" id="timesale" get-time-sale="{{$time_sale}}">
                                            <span id="d"></span> &nbsp;<span id="h"></span>&nbsp;:&nbsp;<span id="m"></span>&nbsp;:&nbsp;<span id="s"></span></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--                sale--}}
                    <div class="block_c_s">
                        <div class="content_h_sale">
                            <div class="hs_content_wrapper">
                                @foreach($get_hot_sale_mobile as $value)
                                    <div class="round_ps">
                                        <div class="item_p">
                                            <a class="ditem" href="{{ route('detailproduct', $value->slug)}}">
                                                <div class="p_brand">
                                                    @if (!empty($value->brands->image))
                                                        <span class="dbrand" style="background-image: url('{{asset("upload/images/products/thumb/".$value->brands->image)}}');"></span>
                                                    @endif
                                                    <div class="dtag">
                                                        @if (!empty($value->year))
                                                            <span class="years">NEW 2022</span>
                                                        @endif
                                                        @if (!empty($value->installment))
                                                            <span class="payment">Trả góp 0%</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="p_img">
                                                    <img src="{{asset('upload/images/products/thumb/'.$value->thumb)}}">
                                                </div>
                                                <div class="p_price">
                                                    @if (!empty($value->onsale))
                                                        <div class="promotion">
                                                            <div class="dprice dpromotion">{{number_format($value->price,0,',','.')}} đ</div>
                                                            <div class="dprice dpercent">- {{$value->onsale}}%</div>
                                                        </div>
                                                        <div class="p_price">{{number_format($value->price_onsale,0,',','.')}} đ</div>
                                                    @else
                                                        <div class="promotion">
                                                            <div class="dprice dpromotion">{{number_format($value->price,0,',','.')}} đ</div>
                                                            <div class="dprice dpercent">- 0%</div>
                                                        </div>
                                                        <div class="p_price">{{number_format($value->price,0,',','.')}} đ</div>
                                                    @endif
                                                </div>
                                                <div class="sold">
                                                    <div class="dealsqty">
                                                        <div class="dprogress" style="width:{{$value->pt_sl_daban()}}%"></div>
                                                        @if (!empty($value->sold))
                                                            <span>Đã bán {{$value->sold}}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{--khuyen mai hot--}}
        <div class="category-container">
            <div class="cat_box_sale mg-box-p">
                <div class="cat_box_s_h">
                    <div class="title_s">
                        <div class="b_title tt_center" id="new_p">
                            <i class="fas fa-sparkles"></i><h2>Sản phẩm mới</h2>
                        </div>
                        <div class="b_title tt_center" id="hot_p">
                            <i class="fas fa-fire"></i><h2>Sản phẩm hot</h2>
                        </div>
                        <div class="b_title tt_center" id="promotion_p">
                            <i class="far fa-diploma"></i><h2>Khuyến mại</h2>
                        </div>
                    </div>
                </div>
                <div class="featured-product-list" id="load_promotion" data-target=""></div>
                <div class="viewall_promotion">
                    <a id="viewall_promotion">Xem tất cả<i class="fal fa-angle-down"></i></a>
                </div>
            </div>
        </div>
        {{--categoryproduct--}}
        <div class="block-product" id="categories_p" list-cat="{{$list_cat}}" >
            @foreach($get_cat_parents as $item)
                <div class="block-featured-product" id="category_product_{{$item->id}}">
                    {{--            list title--}}
                    <div class="product-list-title is-flex is-flex-wrap-wrap">
                        <a href="{{route('product_cat', ['slug' =>  $item->slug])}}" class="title"><h2>{{$item->name}}</h2>
                        </a>
                        <a href="{{route('product_cat', ['slug' =>  $item->slug])}}" class="more-product">Xem tất cả</a>
                    </div>
                    <div class="item_tag">
                        <div class="list-related-tag" id="list_tag_{{$item->id}}"></div>
                    </div>
                    {{--                product--}}
                    <div class="featured-product-list" id="list_products_{{$item->id}}">
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
@section('footer')
    @include('frontend.mobile.footermobile')
@endsection
