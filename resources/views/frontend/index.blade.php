@extends('frontend.layouts.base')

@section('title')
    <title>IT24H - Trang chủ</title>
@endsection


@section('header-home')
    @include('frontend.layouts.header-home', [$Sidebars, $Menus])
@endsection


@section('menu-mobile')
    @include('frontend.layouts.menu-mobile')
@endsection

@section('content')
<div class="wp-content">
    <div class="get-list-cat" data-list="{{$list_cat}}"></div>
    <div class="container-page">
        <div id="content">
            <div class="content-left">
                @if (!empty($banner_sidebar))
                    <div class="banner-image">
                        <a href="{{$banner_sidebar->link_target}}">
                            <img src="{{asset('upload/images/slider/'.$banner_sidebar->image)}}" alt="">
                        </a>
                    </div>
                @endif
                <div class="block-services" style="margin-bottom: 30px;">
                    <ul class="clearfix">
                        <li>
                            <div class="item">
                                <div class="sv-icon"><img src="{{asset('/asset/images/item-5.png')}}" alt="Slide Image" width="57" height="57"></div>
                                <div class="sv-info">
                                    <div class="top-sv">Miễn phí vận chuyển</div>
                                    <div class="bottom-sv">Áp dụng cho đơn hàng 2 sản phẩm</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <div class="sv-icon"><img src="{{asset('/asset/images/item-6.png')}}" alt="Slide Image" width="57" height="57"></div>
                                <div class="sv-info">
                                    <div class="top-sv">Thanh toán dễ dàng</div>
                                    <div class="bottom-sv">Trả tiền mặt, Banking, trả góp 0%</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <div class="sv-icon"><img src="{{asset('/asset/images/item-7.png')}}" alt="Slide Image" width="57" height="57"></div>
                                <div class="sv-info">
                                    <div class="top-sv">Hỗ trợ 24/7</div>
                                    <div class="bottom-sv">Tư vấn giải đáp mọi thắc mắc</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <div class="sv-icon"><img src="{{asset('/asset/images/item-8.png')}}" alt="Slide Image" width="57" height="57"></div>
                                <div class="sv-info">
                                    <div class="top-sv">Quà tặng hấp dẫn</div>
                                    <div class="bottom-sv">Nhiều chính sách quà tặng lớn</div>
                                </div>
                            </div>
                    </li>
                    </ul>
                </div>

            </div>
            <div class="content-right">
                <div class="slider-banner" style="margin-bottom: 40px;">
                    <div class="slider">
                        <div class="slider-show">
                            <div class="owl-carousel owl-theme owl-loaded owl-drag" id="slider-show">
                                @foreach ($sliders as $item)
                                    <a href="{{$item->link_target}}">
                                        <img class="owl-lazy" data-src="{{asset('upload/images/slider/'.$item->image)}}" alt="">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="banner">
                        <ul>
                            @if (!empty($banner_sidebar_1))
                                <li class="banner-image">
                                    <a href="{{$banner_sidebar_1->link_target}}">
                                        <img src="{{asset('upload/images/slider/'.$banner_sidebar_1->image)}}" alt="">
                                    </a>
                                </li>
                            @endif
                            @if (!empty($banner_sidebar_2))
                                <li class="banner-image">
                                    <a href="{{$banner_sidebar_2->link_target}}">
                                        <img src="{{asset('upload/images/slider/'.$banner_sidebar_2->image)}}" alt="">
                                    </a>
                                </li>
                            @endif
                            @if (!empty($banner_sidebar_3))
                                <li class="banner-image">
                                    <a href="{{$banner_sidebar_2->link_target}}">
                                        <img src="{{asset('upload/images/slider/'.$banner_sidebar_3->image)}}" alt="">
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="categories-slider-home" style="margin-bottom: 60px;">
                    <div class="block-title">
                        <strong>Sản phẩm theo danh mục</strong>
                    </div>
                    <div class="wp-list-categories">
                        <div class="owl-carousel owl-theme owl-loaded owl-drag" id="list-cat-slider">
                            @foreach ($get_cat_parents as $item)
                                <div class="wp-category">
                                    <div class="cat-thumb">
                                        <a href="{{route('product_cat', $item->slug)}}">
                                            @if ($item->thumb == 'no-image-product.jpg' || empty($item->thumb))
                                                <img class="owl-lazy" data-src="{{asset('upload/images/common_img/no-image-product.jpg')}}" />
                                            @else
                                                <img class="owl-lazy" data-src="{{asset('upload/images/products/thumb/'.$item->thumb)}}" alt="">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="child-cat">
                                        <div class="cat-title">
                                            <a href="{{route('product_cat', $item->slug)}}">{{$item->name}}</a>
                                        </div>
                                        <ul class="sub-cats">
                                            @foreach ($item->cat_child as $cat_child)
                                                <li><a href="{{route('product_cat', $cat_child->slug)}}">{{$cat_child->name}} <span class="count">({{$cat_child->get_product_by_cat()->count()}})</span></a></li>
                                            @endforeach
                                        </ul>
                                        <a href="{{route('product_cat', $item->slug)}}" class="view-all">Xem tất cả</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="wp-supper-deal" style="margin-bottom: 50px;">
                    <div class="block-filterproducts clearfix">
                        <div class="block-title">
                            <strong>Siêu Ưu Đãi <br> trong Tháng Này</strong>
                            <p class="note-deal">
                                Chương trình ưu đãi, giảm giá cực lớn. Nhanh tay mua hàng!
                            </p>
                            <div class="time-sale time-dem-nguoc" data-date="{{$time_deal}}">
                                <div class="countdown">
                                    <div class="countdown-item">
                                        <div class="countdown-digits countdown-days" id="d"></div>
                                        <div class="countdown-label">Ngày</div>
                                    </div>
                                    <div class="countdown-item">
                                        <div class="countdown-digits countdown-hours" id="h"></div>
                                        <div class="countdown-label">Giờ</div>
                                    </div>
                                    <div class="countdown-item">
                                        <div class="countdown-digits countdown-minutes" id="m"></div>
                                        <div class="countdown-label">Phút</div>
                                        </div>
                                    <div class="countdown-item">
                                        <div class="countdown-digits countdown-seconds" id="s"></div>
                                        <div class="countdown-label">Giây</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="slider-content">
                                <div class="owl-carousel owl-theme owl-loaded owl-drag" id="slider-deal-supper">
                                    @foreach ($dealProduct as $item)
                                        <div class="wp-product">
                                            <div class="thumb">
                                                <a href="{{ route('detailproduct', $item->slug)}}">
                                                    <img class="owl-lazy lazy" data-src="{{asset('upload/images/products/medium/'.$item->thumb)}}" alt="">
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
                    </div>
                </div>

                <div class="tabs-product" style="margin-bottom: 40px;">
                    <div class="block-content">
                        <div class="ltabs-tabs-wrap">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-new-tab" data-bs-toggle="pill" data-bs-target="#pills-new" type="button" role="tab" aria-controls="pills-new" aria-selected="true">Sản phẩm mới</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-hot-tab" data-bs-toggle="pill" data-bs-target="#pills-hot" type="button" role="tab" aria-controls="pills-hot" aria-selected="false">Sản phẩm bán chạy</button>
                                </li>
                            </ul>
                        </div>
                        <div class="listing-tab">
                            <div class="tab-content container-home" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-new" role="tabpanel" aria-labelledby="pills-new-tab">
                                    <div class="wp-info-product owl-carousel owl-theme owl-loaded owl-drag" id="slider-product-new-tab">
                                        @foreach ($product_new->chunk(2) as $chunk)
                                            <!--2 product -->
                                            <div class="wp-prouct-item">
                                                @foreach ($chunk as $item)
                                                    <!-- product -->
                                                    <div class="product-item-info mb-3">
                                                        <div class="thumb">
                                                            <a href="{{ route('detailproduct', $item->slug)}}">
                                                                <img class="owl-lazy lazy" data-src="{{asset('upload/images/products/medium/'.$item->thumb)}}" alt="">
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

                                                            <div class="name">
                                                                <a href="{{ route('detailproduct', $item->slug)}}">{{$item->name}}</a>
                                                            </div>
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
                                        @endforeach
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-hot" role="tabpanel" aria-labelledby="pills-hot-tab">
                                    <div class="wp-info-product owl-carousel owl-theme owl-loaded owl-drag" id="slider-product-hot-tab">
                                        @foreach ($product_hot_sale->chunk(2) as $chunk)
                                            <!--2 product -->
                                            <div class="wp-prouct-item">
                                                @foreach ($chunk as $item)
                                                    <!-- product -->
                                                    <div class="product-item-info mb-3">
                                                        <div class="thumb">
                                                            <a href="{{ route('detailproduct', $item->slug)}}">
                                                                <img class="owl-lazy lazy" data-src="{{asset('upload/images/products/medium/'.$item->thumb)}}" alt="">
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

                                                            <div class="name">
                                                                <a href="{{ route('detailproduct', $item->slug)}}">{{$item->name}}</a>
                                                            </div>
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
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Danh sách sp theo danh mục -->
            <div class="group-product">

                <!-- Danh mục -->
                @foreach ($get_cat_parents as $cat_parent)
                    <div class="product-content" style="margin-bottom: 40px;" id="category-{{$cat_parent->id}}">
                        <div class="block-title">
                            <h2>{{$cat_parent->name}}</h2>

                            <ul class="nav nav-pills sub_cat_title_slider owl-carousel owl-theme owl-loaded owl-drag" id="pills-tab sub_cat_title_slider" role="tablist">
                                @php
                                    $t=0;
                                @endphp
                                @foreach ($cat_parent->cat_child as $cat_child)
                                    @php
                                        $t++;
                                    @endphp
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{($t==1) ? 'active' : ''}}" id="pills-cat{{$cat_child->id}}-tab" data-bs-toggle="pill" data-bs-target="#pills-cat{{$cat_child->id}}" type="button" role="tab" aria-controls="pills-cat{{$cat_child->id}}" aria-selected="true">{{$cat_child->name}}</button>
                                    </li>
                                @endforeach
                            </ul>
                            <a href="" class="show-all">Xem tất cả <i class="far fa-angle-right"></i></a>
                        </div>
                        <div id="data-{{$cat_parent->id}}" class="wp-slider-pro">

                        </div>
                    </div>
                @endforeach


            </div>
        </div>

        <div class="brand-slider-bottom" style="margin-bottom: 30px;">
            <div class="brand-slider owl-carousel owl-theme owl-loaded owl-drag" id="brand-slider">
                @foreach ($list_brand as $item)
                    <a href="" class="brand">
                        <img class="owl-lazy" data-src="{{asset('upload/images/products/large/'.$item->image)}}" alt="">
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    @include('frontend.layouts.footer')
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            //Add to Cart
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

            function isOnScreen(elem) {
            if( elem.length == 0 ) {
                return;
            }
            var $window = jQuery(window)
            var viewport_top = $window.scrollTop() //vị trí đang scroll
            var viewport_height = $window.height()  // chiều cao màn hình
            var viewport_bottom = viewport_top + viewport_height
            var $elem = jQuery(elem)
            var top = $elem.offset().top-500
            var height = $elem.height()
            var bottom = top + height + 1000

            return (top >= viewport_top && top < viewport_bottom) ||
                (bottom > viewport_top && bottom <= viewport_bottom) ||
                (height > viewport_height && top <= viewport_top && bottom >= viewport_bottom)
            }
            function laySp(category_id) {
                var _token = $('meta[name="csrf-token"]').attr('content');
                var id= category_id;
                var data = {
                    id: category_id,
                    _token: _token
                };
                $.ajax({
                    url:"{{route('getProducts')}}",
                    type:"post",
                    dataType:"json",
                    data: data,
                    success: function (data) {
                        // console.log(data);
                        $('#data-'+id).append(data);
                        $('.list-product-group').owlCarousel({
                            autoplay: true,
                            autoplayHoverPause: true,
                            loop: false,
                            margin: 10,
                            nav: true,
                            dots: false,
                            mouseDrag: true,
                            touchDrag: true,
                            lazyLoad: true,
                            responsive: {
                                0: {
                                    items: 1
                                },
                                375: {
                                    items: 2
                                },
                                768:{
                                    items: 3
                                },
                                992:{
                                    items: 4
                                },
                                1200:{
                                    items: 5
                                },
                                1650: {
                                    items: 6
                                },
                                1920: {
                                    items: 6
                                },
                            }
                        });
                    },
                })
            }

            var list_product = [];
            let list_cat_1 = $('.get-list-cat').data('list');
            let list_cat = String(list_cat_1);
            let cat_ids = list_cat.split(' ');
            cat_ids.forEach(function(element){
                list_product.push(element);
            });



            function runOnScroll() {
                list_product.forEach(function(category_id) {
                    if (isOnScreen($("#category-"+ category_id)) && ($("#category-"+ category_id).hasClass("loaded") == false)) {
                        laySp(category_id);
                        $("#category-"+ category_id).addClass("loaded");
                    }
                });
            }
            $(window).scroll(runOnScroll);
        });
    </script>
@endsection

