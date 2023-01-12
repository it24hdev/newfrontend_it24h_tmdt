@extends('frontend.layouts.base')

@section('title')
    <title>@lang('lang.It24hproduct')</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('asset/css/product-categories.css')}}">
@endsection
@section('header-home')
    @include('frontend.layouts.header-home', [$Sidebars, $active_menu])
@endsection
@section('content')
    <div class="wp-content">
        <div class="wp-breadcrumb-page">
            <div class="container-page">
                <div class="breadcrumb-page">
                    @if (!empty($cat))
                        <a href="{{route('user')}}">@lang('lang.Home')</a><i class="fas fa-angle-right mx-1"></i>
                        <a href="{{route('list_product')}}">@lang('lang.Shop')</a><i
                            class="fas fa-angle-right mx-1"></i>
                        <a href="{{route('product_cat',[ 'slug' => $cat->slug])}}">{{$cat->name}}</a>
                    @else
                        <a href="{{route('user')}}">@lang('lang.Home')</a><i class="fas fa-angle-right mx-1"></i>
                        <a href="{{route('list_product')}}">@lang('lang.Shop')</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="container-page">
            <div class="wp-content clearfix">
                <div class="sidebar">
                    <div class="categories-product-sidebar">
                        <div class="header-sidebar">
                            <span>@lang('lang.Productcategories')</span>
                        </div>
                        <ul class="list-categories">
                            @if ($categories->count() > 0)
                                @foreach ($categories as $item)
                                    <li class="cat-item">
                                        <a class="list_cat_item" href="{{route('product_cat', ['slug' => $item->slug])}}">{{$item->name}}</a>
                                        <span class="count">({{$item->count_product_in_catgory()}})</span>
                                    </li>
                                @endforeach
                            @else
                                @foreach ($cat_parent as $item)
                                    <li class="cat-item">
                                        <a class="list_cat_item" href="{{route('product_cat', ['slug' => $item->slug])}}">{{$item->name}}</a>
                                        <span class="count">({{$item->count_product_in_catgory()}})</span>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="filter-price-sidebar">
                        <div class="header-sidebar">
                            <span>@lang('lang.Filterbyprice')</span>
                        </div>
                        <div class="form-filter">
                            <form>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div id="slider-range"></div>
                                    </div>
                                </div>
                                <div class="slider-labels">
                                    <div class="price_label">

                                        @lang('lang.Price'): <input type="text" value="10000" class="from"
                                                                    id="slider-range-value1" disabled>VNĐ —
                                        <input type="text" value="100000000" class="to" id="slider-range-value2"
                                               disabled>VNĐ
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <input type="hidden" id="min-value" name="min-value" value="">
                                        <input type="hidden" id="max-value" name="max-value" value="">
                                        <button type="button" class="button btn-filter-price filter_price"
                                                data-target="ds">@lang('lang.Filter')</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="filter-color-sidebar d-none">
                        <div class="header-sidebar">
                            <span>Màu sắc</span>
                        </div>
                        <ul class="list-color">
                            <li>
                                <a rel="nofollow" class="color-type" href="">
                                    <span class="color-label" style="background: #05abde;"></span>
                                    <span class="color-name">Xanh dương</span>
                                </a>
                            </li>
                            <li>
                                <a rel="nofollow" class="color-type" href="">
                                    <span class="color-label" style="background: #475a8b;"></span>
                                    <span class="color-name">Xanh tím than</span>
                                </a>
                            </li>
                            <li>
                                <a rel="nofollow" class="color-type" href="">
                                    <span class="color-label" style="background: #7ab052;"></span>
                                    <span class="color-name">Xanh lá cây</span>
                                </a>
                            </li>
                            <li>
                                <a rel="nofollow" class="color-type" href="">
                                    <span class="color-label" style="background: #d64749;"></span>
                                    <span class="color-name">Đỏ</span>
                                </a>
                            </li>
                            <li>
                                <a rel="nofollow" class="color-type" href="">
                                    <span class="color-label" style="background: #f7cac9;"></span>
                                    <span class="color-name">Hồng</span>
                                </a>
                            </li>
                            <li>
                                <a rel="nofollow" class="color-type" href="">
                                    <span class="color-label" style="background: #6b5b95;"></span>
                                    <span class="color-name">Tím</span>
                                </a>
                            </li>
                            <li>
                                <a rel="nofollow" class="color-type" href="">
                                    <span class="color-label" style="background: #ffffff;"></span>
                                    <span class="color-name">Trắng</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- ==== Foreach bộ lọc -->
                    @if(!empty($attributes))
                        @foreach($attributes as $key => $value)
                            @if($value->count_attr>0)
                                <div class="categories-product-sidebar">
                                    <div class="header-sidebar">
                                        <span>{{$value->name}}</span>
                                    </div>
                                    <ul class="list-categories list-categories-brand">
                                        @foreach($value->detailproperty as $property)
                                            @if($property->count_product>0)
                                                <li class="cat-item" onclick="location.href='{{$property->fullurl}}'">
                                                    <a href="{{$property->fullurl}}">
                                                        @if($property->attr_checked == 1)
                                                            <i class="far fa-check-square"></i>
                                                        @else
                                                            <i class="far fa-square"></i>
                                                        @endif
                                                        {{$property->name}}
                                                    </a>
                                                    <span class="count">({{$property->count_product}})</span>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        @endforeach
                    @endif
                    <div class="product-tag-sidebar d-none">
                        <div class="header-sidebar">
                            <span>Thẻ tags</span>
                        </div>
                        <div class="tagcloud">
                            <a href="#">Accessories</a>
                            <a href="#">Camera & Videos</a>
                            <a href="#">Computer & Laptop</a>
                            <a href="#">Gaming</a>
                            <a href="#">Headphone</a>
                            <a href="#">Mobile & Tablets</a>
                        </div>
                    </div>
                </div>
                <div class="content">
                    <div class="sorting">
                        <a href="javascript:" class="filter-mobile" data-bs-toggle="offcanvas"
                           data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                            <i class="fas fa-sliders-v"></i>
                            <span>@lang('lang.Filterby')</span>
                        </a>
                        <div class="dropdown ordering">
                            <a class="dropdown-toggle text-secondary" href="#" role="button" id="dropdownMenuLink"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                @lang('lang.Filterby')
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li>
                                    <a class="dropdown-item sort_price_asc" data-target="gia_thap_den_cao">Giá tăng
                                        dần</a>
                                </li>
                                <li>
                                    <a class="dropdown-item sort_price_desc" data-target="gia_cao_den_thap">Giá giảm
                                        dần</a>
                                </li>
                            </ul>
                        </div>
                        <p class="showing">
                            @lang('lang.Showing') {{$products->firstItem()}}
                            – {{$products->lastItem()}} @lang('lang.Of') {{$products->total()}} @lang('lang.Results')
                        </p>
                    </div>
                    <div class="wp-list-product">
                        <div class="body_products">
                            <div class="products_default">
                                <div class="owl-carousel owl-theme owl-loaded owl-drag" id="list_products">
                                    <ul class="list-product">
                                        @foreach($products as $item)
                                            <li class="item-pro">
                                                <div class="tmp_product">
                                                    <div class="box_product">
                                                        <div class="upper_half">
                                                            <div class="head_p">
                                                                @if($item->brand_img!="no-images.jpg" && $item->brand_img)
                                                                    <div class="brand visible_cpn">
                                                                        <div class="brand_img"
                                                                             style="background-image: url('{{asset("upload/images/products/thumb/".$item->brand_img)}}')"></div>
                                                                    </div>
                                                                @else
                                                                    <div class="brand">
                                                                        <div class="brand_img"></div>
                                                                    </div>
                                                                @endif
                                                                <div class="tag_p">
                                                                    @if($item->year)
                                                                        <span class="years">{{$item->year}}</span>
                                                                    @else
                                                                        <span class="years d-none"></span>
                                                                    @endif
                                                                    @if($item->installment)
                                                                        <span
                                                                            class="payment">{{$item->installment}}</span>
                                                                    @else
                                                                        <span class="payment d-none"></span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="thumb">
                                                                <a class="link_detail"
                                                                   href="{{route('detailproduct', $item->slug)}}">
                                                                    @if($item->thumb!="no-images.jpg")
                                                                        <img
                                                                            src="{{asset('upload/images/products/medium/'.$item->thumb)}}"
                                                                            alt="{{$item->name}}">
                                                                    @else
                                                                        <img
                                                                            src="{{asset('upload/images/common_img/no-images.jpg')}}"
                                                                            alt="{{$item->name}}">
                                                                    @endif
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="lower_half">
                                                            <div class="detail">
                                                                <a class="link_detail"
                                                                   href="{{route('detailproduct', $item->slug)}}">
                                                                    <div class="event_tag">
                                                                        @if($item->event != 0 && $item->event_icon)
                                                                            <p class="event visible_cpn"
                                                                               style="background: linear-gradient(to right, {{$item->event_color_left}},{{$item->event_color_right}})">
                                                                                <img
                                                                                    src="{{asset("upload/images/products/thumb/".$item->event_icon)}}">
                                                                                <span>{{$item->event_name}}</span>
                                                                            </p>
                                                                        @else
                                                                            <p class="event">
                                                                                <img>
                                                                                <span></span>
                                                                            </p>
                                                                        @endif
                                                                        <p class="code"></p>
                                                                    </div>
                                                                    <div class="name"><span>{{$item->name}}</span></div>
                                                                    <div>
                                                                        @if (!empty($item->specifications))
                                                                            <ul class="product-attributes">
                                                                                @foreach ($item->get_specifications() as $k)
                                                                                    <li>{{$k}}</li>
                                                                                @endforeach
                                                                            </ul>
                                                                        @else
                                                                            <ul class="product-attributes"></ul>
                                                                        @endif
                                                                    </div>
                                                                    <div class="price-review clearfix">
                                                                        <div class="price">
                                                                            @if($item->price_onsale > 0 && $item->onsale > 0)
                                                                                <div class="price_sale">
                                                                                    <div
                                                                                        class="price-old">{{number_format($item->price,0,',','.')}}
                                                                                        VNĐ
                                                                                    </div>
                                                                                    <div
                                                                                        class="onsale">{{$item->onsale}}
                                                                                        %
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="price-new">{{number_format($item->price_onsale,0,',','.')}}
                                                                                    VNĐ
                                                                                </div>
                                                                            @else
                                                                                <div class="price_sale hidden_cpn">
                                                                                    <div class="price-old"></div>
                                                                                    <div class="onsale"></div>
                                                                                </div>
                                                                                <div
                                                                                    class="price-new">{{number_format($item->price,0,',','.')}}
                                                                                    VNĐ
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                        <div class="review">
                                                                            <div>
                                                                                <div class="rating2">
                                                                                    <div class="rating-upper"
                                                                                         style="width: @if($item->votes_count>0) {{$item->votes_sum/$item->votes_count*20}}% @else 0% @endif">
                                                                                        <span><i
                                                                                                class="fas fa-star"></i></span>
                                                                                        <span><i
                                                                                                class="fas fa-star"></i></span>
                                                                                        <span><i
                                                                                                class="fas fa-star"></i></span>
                                                                                        <span><i
                                                                                                class="fas fa-star"></i></span>
                                                                                        <span><i
                                                                                                class="fas fa-star"></i></span>
                                                                                    </div>
                                                                                    <div class="rating-lower">
                                                                                        <span><i
                                                                                                class="fal fa-star"></i></span>
                                                                                        <span><i
                                                                                                class="fal fa-star"></i></span>
                                                                                        <span><i
                                                                                                class="fal fa-star"></i></span>
                                                                                        <span><i
                                                                                                class="fal fa-star"></i></span>
                                                                                        <span><i
                                                                                                class="fal fa-star"></i></span>
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="count-review">({{$item->votes_count}})</div>
                                                                            </div>
                                                                            <div class="sold"><i
                                                                                    class="fas fa-badge-check"></i><span>Đã bán {{$item->sold}}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="detail-bottom">
                                                                @if($item->quantity>0)
                                                                    <div class="qty"
                                                                         style="color:#01aa42;background-color:#dbf8e1;">
                                                                        Còn hàng
                                                                    </div>
                                                                @else
                                                                    <div class="qty"
                                                                         style="color:#ffffff;background-color:#fb0000;">
                                                                        Liên hệ
                                                                    </div>
                                                                @endif
                                                                <div class="action">
                                                                    <a href="javascript:" class="heart add-wish"
                                                                       title="Lưu sản phẩm"><i class="far fa-heart"></i></a>
                                                                    <a href="javascript:"
                                                                       class="add-cart @if($item->quantity < 0) d-none @endif"
                                                                       get-id="{{$item->id}}" title="Thêm vào giỏ hàng"><i
                                                                            class="far fa-shopping-cart"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="link_p">
                            {!! $products->links('frontend.pagination') !!}
                        </div>
                        <div class="discription_cat my-5">
                            @if(!empty($cat->content))
                                {!! $cat->content !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sidebar mobile -->
    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title HideFilter" id="offcanvasScrollingLabel">Đóng bộ lọc</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="sidebar">
            <div class="categories-product-sidebar">
                <div class="header-sidebar">
                    <span>@lang('lang.Productcategories')</span>
                </div>
                <ul class="list-categories">
                    @if ($categories->count() > 0)
                        @foreach ($categories as $item)
                            <li class="cat-item">
                                <a class="list_cat_item" href="{{route('product_cat', ['slug' => $item->slug])}}">{{$item->name}}</a>
                                <span class="count">({{$item->count_product_in_catgory()}})</span>
                            </li>
                        @endforeach
                    @else
                        @foreach ($cat_parent as $item)
                            <li class="cat-item">
                                <a class="list_cat_item" href="{{route('product_cat', ['slug' => $item->slug])}}">{{$item->name}}</a>
                                <span class="count">({{$item->count_product_in_catgory()}})</span>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
            {{--            Bộ lọc giá--}}
            <div class="filter-price-sidebar">
                <div class="header-sidebar"><span>@lang('lang.Filterbyprice')</span></div>
                <div class="form-filter">
                    <form>
                        <div class="row">
                            <div class="col-sm-12">
                                <div id="slider-range1"></div>
                            </div>
                        </div>
                        <div class="slider-labels">
                            <div class="price_label">
                                @lang('lang.Price'): <input type="text" value="10000" class="from"
                                                            id="slider-range-value3" disabled>VNĐ —
                                <input type="text" value="100000000" class="to" id="slider-range-value4" disabled>VNĐ
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <input type="hidden" id="min-value-tl" name="min-value" value="">
                                <input type="hidden" id="max-value-tl" name="max-value" value="">
                                <button type="button" class="button btn-filter-price-1 filter_price"
                                        data-targe="tb">@lang('lang.Filter')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="filter-color-sidebar d-none">
                <div class="header-sidebar">
                    <span>Màu sắc</span>
                </div>
                <ul class="list-color">
                    <li>
                        <a rel="nofollow" class="color-type" href="">
                            <span class="color-label" style="background: #05abde;"></span>
                            <span class="color-name">Xanh dương</span>
                        </a>
                    </li>
                    <li>
                        <a rel="nofollow" class="color-type" href="">
                            <span class="color-label" style="background: #475a8b;"></span>
                            <span class="color-name">Xanh tím than</span>
                        </a>
                    </li>
                    <li>
                        <a rel="nofollow" class="color-type" href="">
                            <span class="color-label" style="background: #7ab052;"></span>
                            <span class="color-name">Xanh lá cây</span>
                        </a>
                    </li>
                    <li>
                        <a rel="nofollow" class="color-type" href="">
                            <span class="color-label" style="background: #d64749;"></span>
                            <span class="color-name">Đỏ</span>
                        </a>
                    </li>
                    <li>
                        <a rel="nofollow" class="color-type" href="">
                            <span class="color-label" style="background: #f7cac9;"></span>
                            <span class="color-name">Hồng</span>
                        </a>
                    </li>
                    <li>
                        <a rel="nofollow" class="color-type" href="">
                            <span class="color-label" style="background: #6b5b95;"></span>
                            <span class="color-name">Tím</span>
                        </a>
                    </li>
                    <li>
                        <a rel="nofollow" class="color-type" href="">
                            <span class="color-label" style="background: #ffffff;"></span>
                            <span class="color-name">Trắng</span>
                        </a>
                    </li>
                </ul>
            </div>
            {{--            Bộ lọc thuộc tính--}}
            @if(!empty($attributes))
                @foreach($attributes as $key => $value)
                    @if($value->count_attr>0)
                        <div class="categories-product-sidebar">
                            <div class="header-sidebar">
                                <span>{{$value->name}}</span>
                            </div>
                            <ul class="list-categories list-categories-brand">
                                @foreach($value->detailproperty as $property)
                                    @if($property->count_product>0)
                                        <li class="cat-item" onclick="location.href='{{$property->fullurl}}'">
                                            <a href="{{$property->fullurl}}">
                                                @if($property->attr_checked == 1)
                                                    <i class="far fa-check-square"></i>
                                                @else
                                                    <i class="far fa-square"></i>
                                                @endif
                                                {{$property->name}}
                                            </a>
                                            <span class="count">({{$property->count_product}})</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endforeach
            @endif
            <div class="product-tag-sidebar d-none">
                <div class="header-sidebar">
                    <span>Thẻ tags</span>
                </div>
                <div class="tagcloud">
                    <a href="#">Accessories</a>
                    <a href="#">Camera & Videos</a>
                    <a href="#">Computer & Laptop</a>
                    <a href="#">Gaming</a>
                    <a href="#">Headphone</a>
                    <a href="#">Mobile & Tablets</a>
                </div>
            </div>
        </div>
    </div>
    <p id="message_add_cart" style="display:none;">@lang('lang.Productaddedtocartsuccessfully')</p>
@endsection
@section('footer')
    @include('frontend.layouts.footer')
@endsection
@section('js')
    <script src="{{asset('asset/js/filter-price.js')}}"></script>
    <script>
        $(document).ready(function () {

            //Loc gia
            $(document).on('click', '.filter_price', function () {
                var params_string = window.location.search;
                var searchparams = new URLSearchParams(params_string);
                var device = $(this).attr('data-target');
                if (device == "ds") {
                    var min_price = $('#min-value').val();
                    var max_price = $('#max-value').val();
                } else {
                    var min_price = $('#min-value-tl').val();
                    var max_price = $('#max-value-tl').val();
                }
                var between = min_price + ';' + max_price;
                if (searchparams.has('p') == true) {
                    searchparams.delete('p');
                    searchparams.append('p', between);
                } else {
                    searchparams.append('p', between);
                }
                window.location = window.location.origin + window.location.pathname + '?' + searchparams.toString();
            });

            //sap xep
            $(document).on('click', '.sort_price_asc, .sort_price_desc', function () {
                var params_string = window.location.search;
                var searchparams = new URLSearchParams(params_string);
                var orderby = $(this).attr('data-target');
                if (searchparams.has('order') == true) {
                    searchparams.delete('order');
                    searchparams.append('order', orderby);
                } else {
                    searchparams.append('order', orderby);
                }
                window.location = window.location.origin + window.location.pathname + '?' + searchparams.toString();
            });

            //Add to Cart
            var mess = document.getElementById('message_add_cart').innerHTML;
            add_cart = function (id) {
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
                    success: function (data) {
                        alert(mess);
                        $('#count-cart').text(data.count);
                    },
                });
            }

            add_wish = function (id) {
                var _token = $('meta[name="csrf-token"]').attr('content');
                var data = {id: id, _token: _token};
                $.ajax({
                    url: "{{route('add_wish')}}",
                    method: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function (data) {
                        alert('Thêm thành công sản phẩm vào danh sách yêu thích!');
                        $('#count-wish').text(data.count_wish);
                    },
                });
            }
        });
    </script>
@endsection
