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
                                   style="background-color:transparent;background-size: 100% 100%;background-image:
                                   @if($item->thumb!="no-images.jpg")url({{asset('upload/images/products/thumb/'.$item->thumb)}});
                                   @else url({{asset('upload/images/common_img/'.$item->thumb)}});@endif">
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
            <div class="block_hot_sale" style="@if($deal_background->image!='no-images.jpg')
            background: url({{asset('upload/images/slider/'.$deal_background->image)}}) 0% 0% / cover no-repeat;
            @else background: linear-gradient(to top,{{$background[1]}},{{$background[0]}});
            @endif">
                <div class="hot_sale_l1">
                    <div class="text-center mx-2">
                        <div>
                            @if($deal_background->title_img!='no-images.jpg')
                            <img src="{{asset('upload/images/slider/'.$deal_background->title_img)}}" alt="title" class="w-100 my-2">
                            @else
                            <span class="title_bg">{{$deal_background->name}}</span>
                            @endif
                        </div>
                    </div>
                    {{--                header-time sale--}}
                    <div class="header_sale">
                        <div class="top_header_sale">
                            <div class="h_inner title_s">
                                <div>
                                    <p>
                                        <text>  Kết thúc trong </text>
                                    </p>
                                </div>
                                <div class="time_count">
                                    <a title="Xem tất cả Deal Hot" href="#">
                                        <div class="count-down" id="timesale" get-time-sale="{{$time_sale->time_sale}}">
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
                                                            <span class="years">{{$value->year}}</span>
                                                        @endif
                                                        @if (!empty($value->installment))
                                                            <span class="payment">{{$value->installment}}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="p_img">
                                                    <img src="{{asset('upload/images/products/thumb/'.$value->thumb)}}">
                                                </div>
                                                <div class="p_price">
                                                    @if ($value->price_deal!=0)
                                                        <div class="promotion">
                                                            <div class="dprice dpromotion">{{number_format($value->price,0,',','.')}} đ</div>
                                                            <div class="dprice dpercent">- {{number_format(100-$value->price_deal/$value->price*100)}}%</div>
                                                        </div>
                                                        <div class="p_price">{{number_format($value->price_deal,0,',','.')}} đ</div>
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
                    {{--                    xem them--}}
                    <div class="viewall_deal">
                        <a href="{{route('list_product',['promotion'=>'deal'])}}">Xem tất cả<i class="fal fa-angle-down"></i></a>
                    </div>
                </div>
            </div>
        </div>
        {{--khuyen mai hot--}}

        <div class="category-container">
            <div class="cat_box_sale mg-box-p">
                <div class="box_sale_title">
                    <span>GỢI Ý CHO BẠN</span>
                </div>
                <div class="promotion_menu">
                    <div class="scroll_promotion">
                        <div class="flex_promotion">
                            @if($count_is_new>0)
                            <div class="box_promtion_menu" id="new_p">
                                <div class="icon_promtion_menu">
                                    <i class="fas fa-sparkles"></i>
                                </div>
                                <div class="title_promotion_menu">
                                    <span>Sản phẩm mới</span>
                                </div>
                            </div>
                            @endif
                            @if($count_is_hot>0)
                            <div class="box_promtion_menu" id="hot_p">
                                <div class="icon_promtion_menu">
                                    <i class="fas fa-fire"></i>
                                </div>
                                <div class="title_promotion_menu">
                                    <span>Sản phẩm hot</span>
                                </div>
                            </div>
                            @endif
                            @if($count_is_promotion>0)
                            <div class="box_promtion_menu" id="promotion_p">
                                <div class="icon_promtion_menu">
                                    <i class="far fa-diploma"></i>
                                </div>
                                <div class="title_promotion_menu">
                                    <span>Khuyến mại</span>
                                </div>
                            </div>
                            @endif
                            @if($category_promotion)
                                @foreach($category_promotion as $key => $value)
                                    <div class="box_promtion_menu category_promotion" id="category_promotion_{{$value->id}}" data-target="{{$value->id}}">
                                        <div class="icon_promtion_menu">
                                            @if($value->thumb!="no-images.jpg")
                                                <img src="{{asset('upload/images/products/thumb/'.$value->thumb)}}">
                                            @endif
                                        </div>
                                        <div class="title_promotion_menu">
                                            <span>{{$value->name}}</span>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="featured-product-list background_list_p" id="load_promotion" data-target=""></div>
            </div>
        </div>
        {{--categoryproduct--}}
        <div class="block-product" id="categories_p" list-cat="{{$list_cat}}">
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
