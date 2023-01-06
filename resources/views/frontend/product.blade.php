@extends('frontend.layouts.base')

@section('title')
    <title>@lang('lang.It24hproduct')</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('asset/css/product-categories.css')}}">
@endsection

@section('header-home')
    @include('frontend.layouts.header-page', [$Sidebars, $active_menu])
@endsection

@section('content')
    <div class="wp-content">
            <div class="wp-breadcrumb-page">
                <div class="container-page">
                    <div class="breadcrumb-page">
                        @if (!empty($cat))
                            <a href="{{route('user')}}">@lang('lang.Home')</a><i class="fas fa-angle-right mx-1"></i>
                            <a href="{{route('list_product')}}">@lang('lang.Shop')</a><i class="fas fa-angle-right mx-1"></i>
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
                                @if (count($categories) > 0)
                                    @foreach ($categories as $item)
                                        <li class="cat-item">
                                            <a href="{{route('product_cat', ['slug' => $item->slug])}}" style="font-size: 16px; font-weight:500;">{{$item->name}}</a>
                                            <span class="count">({{$item->get_product_by_cat()->count()}})</span>
                                        </li>
                                    @endforeach
                                @else
                                    @foreach ($cat_parent as $item)
                                        <li class="cat-item">
                                            <a href="{{route('product_cat', ['slug' => $item->slug])}}" style="font-size: 16px; font-weight:500;">{{$item->name}}</a>
                                            <span class="count">({{$item->get_product_by_cat()->count()}})</span>
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

                                        @lang('lang.Price'): <input type="text" value="10000" class="from" id="slider-range-value1" disabled>VNĐ —
                                        <input type="text" value="100000000" class="to" id="slider-range-value2" disabled>VNĐ
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                            <input type="hidden" id="min-value" name="min-value" value="">
                                            <input type="hidden" id="max-value" name="max-value" value="">
                                            <button type="button" class="button btn-filter-price filter_price" data-target="ds">@lang('lang.Filter')</button>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                        <div class="filter-color-sidebar">
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
                        <div class="product-tag-sidebar">
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
                            <a href="javascript:;" class="filter-mobile" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                                <i class="fas fa-sliders-v"></i>

                                <span>@lang('lang.Filterby')</span>
                            </a>
                            <div class="dropdown ordering">
                                <a class="dropdown-toggle text-secondary" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                @lang('lang.Filterby')
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item sort_price_asc" data-target="gia_thap_den_cao">Giá tăng dần</a></li>
                                    <li><a class="dropdown-item sort_price_desc" data-target="gia_cao_den_thap">Giá giảm dần</a></li>
                                </ul>
                            </div>
                            <p class="showing">
                                @lang('lang.Showing') {{$products->firstItem()}}–{{$products->lastItem()}} @lang('lang.Of') {{$products->total()}} @lang('lang.Results')
                            </p>
                        </div>
                        <div class="wp-list-product">
                            <div class="body_products">
                                <div class="products_default">
                                    <div class="products_border" style="border: none !important;">
                                        <ul class="list-product">
                                            @foreach($products as $item)
                                            <li class="item-pro">
                                                <div class="product-item mb-3">
                                                    <div class="thumb">
                                                        <a href="{{ route('detailproduct', $item->slug)}}">
                                                            <img class="owl-lazy" src="{{asset('upload/images/products/medium/'.$item->thumb)}}" alt="">
                                                            @if (!empty($item->brands->image))
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
                                                            <p class="code">Mã: {{$item->ma}}</p>
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
                                                           @if (($item->quantity - $item->sold > 0))
                                                                <div class="qty" style="color: #01aa42; background-color: #dbf8e1;">Còn hàng
                                                                </div>
                                                            @else
                                                                 <div class="qty" style="color: #ffffff; background-color: #fb0000;">Hết hàng
                                                                </div>
                                                            @endif
                                                            <div class="action">
                                                                <a href="javascript:;" class="repeat" title="So sánh"><i class="far fa-repeat"></i></a>
                                                                <a href="javascript:;" class="heart add-wish" title="Lưu sản phẩm" onclick="add_wish({{$item->id}})"><i class="far fa-heart"></i></a>
                                                                <a href="javascript:;" title="Thêm vào giỏ hàng" class="add-cart" onclick="add_cart({{$item->id}})"><i class="far fa-shopping-cart"></i></a>
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
                        {!! $products->links('frontend.pagination') !!}
                            <div>
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
                    @foreach ($categories as $item)
                        <li class="cat-item">
                            <a href="{{route('product_cat',['slug' =>  $item->slug])}}" style="font-size: 16px; font-weight:500;">{{$item->name}}</a>
                            <span class="count">({{$item->get_product_by_cat()->count()}})</span>
                        </li>
                    @endforeach
                </ul>
            </div>
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

                            @lang('lang.Price'): <input type="text" value="10000" class="from" id="slider-range-value3" disabled>VNĐ —
                                    <input type="text" value="100000000" class="to" id="slider-range-value4" disabled>VNĐ
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input type="hidden" id="min-value-tl" name="min-value" value="">
                            <input type="hidden" id="max-value-tl" name="max-value" value="">
                            <button type="button" class="button btn-filter-price-1 filter_price" data-targe="tb">@lang('lang.Filter')</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <div class="filter-color-sidebar">
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

            <div class="product-tag-sidebar">
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
    @include('frontend.layouts.footer', [$posts_footer])
@endsection

@section('js')
<script src="{{asset('asset/js/filter-price.js')}}"></script>
<script>
    $(document).ready(function(){

            //Loc gia
            $(document).on('click','.filter_price', function (){
                var params_string = window.location.search;
                var searchparams =  new URLSearchParams(params_string);
                var device = $(this).attr('data-target');
                if(device == "ds"){
                    var min_price = $('#min-value').val();
                    var max_price = $('#max-value').val();
                }
                else{
                    var min_price = $('#min-value-tl').val();
                    var max_price = $('#max-value-tl').val();
                }
                var between = min_price + ';' + max_price;
                if(searchparams.has('p')==true){
                    searchparams.delete('p');
                    searchparams.append('p',between);
                }
                else{
                    searchparams.append('p',between);
                }
                window.location = window.location.origin + window.location.pathname + '?' +searchparams.toString();
            });

            //sap xep
            $(document).on('click','.sort_price_asc, .sort_price_desc', function (){
                var params_string = window.location.search;
                var searchparams =  new URLSearchParams(params_string);
                var orderby  =  $(this).attr('data-target');
                if(searchparams.has('order')==true){
                    searchparams.delete('order');
                    searchparams.append('order',orderby);
                }
                else{
                    searchparams.append('order',orderby);
                }
                window.location = window.location.origin + window.location.pathname + '?' +searchparams.toString();
            });


            //Add to Cart
            var mess = document.getElementById('message_add_cart').innerHTML;
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
                            alert(mess);
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
    });
</script>
@endsection
