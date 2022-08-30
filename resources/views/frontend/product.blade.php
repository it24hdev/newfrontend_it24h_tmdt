@extends('frontend.layouts.base')

@section('title')
    <title>@lang('lang.It24hproduct')</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('asset/css/product-categories.css')}}">
@endsection

@section('header-home')
    @include('frontend.layouts.header-page', [$Sidebars, $Menus])
@endsection

@section('header-mobile')
    @include('frontend.layouts.menu-mobile', [$Sidebars, $Menus])
@endsection

@section('content')
    <div class="wp-content">
            <div class="wp-breadcrumb-page">
                <div class="container-page">
                    <div class="breadcrumb-page">
                        <a href="{{route('user')}}">Trang chủ</a><i class="fas fa-angle-right mx-1"></i>
                        <a href="{{route('list_product')}}">Sản phẩm</a>
                    </div>
                </div>
            </div>

            <div class="container-page">
                <div class="wp-content clearfix">
                    <div class="sidebar">
                        <div class="categories-product-sidebar">
                            <div class="header-sidebar">
                                <span>Danh mục sản phẩm</span>
                            </div>
                            <ul class="list-categories">
                                <li class="cat-item">
                                    <a href="">Laptop, Tablet, Mobile</a>
                                    <span class="count">(20)</span>
                                </li>
                                <li class="cat-item">
                                    <a href="">Laptop, Tablet, Mobile</a>
                                    <span class="count">(20)</span>
                                </li>
                                <li class="cat-item">
                                    <a href="">Laptop, Tablet, Mobile</a>
                                    <span class="count">(20)</span>
                                </li>
                                <li class="cat-item">
                                    <a href="">Laptop, Tablet, Mobile</a>
                                    <span class="count">(20)</span>
                                </li>
                                <li class="cat-item">
                                    <a href="">Laptop, Tablet, Mobile</a>
                                    <span class="count">(20)</span>
                                </li>
                                <li class="cat-item">
                                    <a href="">Laptop, Tablet, Mobile</a>
                                    <span class="count">(20)</span>
                                </li>
                            </ul>
                        </div>
                        <div class="filter-price-sidebar">
                            <div class="header-sidebar">
                                <span>Giá tiền</span>
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

                                        Giá: <input type="text" value="10000" class="from" id="slider-range-value1" disabled>VNĐ —
                                        <input type="text" value="100000000" class="to" id="slider-range-value2" disabled>VNĐ
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                            <input type="hidden" id="min-value" name="min-value" value="">
                                            <input type="hidden" id="max-value" name="max-value" value="">
                                            <button type="submit" class="button btn-filter-price">Tìm kiếm</button>
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
                        <div class="categories-product-sidebar">
                            <div class="header-sidebar">
                                <span>Thương hiệu</span>
                            </div>
                            <ul class="list-categories list-categories-brand">
                                <li class="cat-item">
                                    <a href="#">
                                        <i class="far fa-square"></i> Apple
                                    </a>
                                    <span class="count">(14)</span>
                                </li>
                                <li class="cat-item">
                                    <a href="#">
                                        <i class="far fa-square"></i> Asano
                                    </a>
                                    <span class="count">(2)</span>
                                </li>
                                <li class="cat-item">
                                    <a href="#">
                                        <i class="far fa-square"></i> Digital
                                    </a>
                                    <span class="count">(8)</span>
                                </li>
                                <li class="cat-item">
                                    <a href="#">
                                        <i class="far fa-square"></i> Digitechno
                                    </a>
                                    <span class="count">(10)</span>
                                </li>
                                <li class="cat-item">
                                    <a href="#">
                                        <i class="far fa-square"></i> Electronic
                                    </a>
                                    <span class="count">(3)</span>
                                </li>
                                <li class="cat-item">
                                    <a href="#">
                                        <i class="far fa-square"></i> Hightech
                                    </a>
                                    <span class="count">(16)</span>
                                </li>
                                <li class="cat-item">
                                    <a href="#">
                                        <i class="far fa-square"></i> Sony
                                    </a>
                                    <span class="count">(2)</span>
                                </li>
                                <li class="cat-item">
                                    <a href="#">
                                        <i class="far fa-square"></i> Samsung
                                    </a>
                                    <span class="count">(2)</span>
                                </li>
                                <li class="cat-item">
                                    <a href="#">
                                        <i class="far fa-square"></i> Technolo
                                    </a>
                                    <span class="count">(2)</span>
                                </li>
                                <li class="cat-item">
                                    <a href="#">
                                        <i class="far fa-square"></i> Oppo
                                    </a>
                                    <span class="count">(0)</span>
                                </li>
                            </ul>
                        </div>
                        <div class="categories-product-sidebar">
                            <div class="header-sidebar">
                                <span>CPU</span>
                            </div>
                            <ul class="list-categories">
                                <li class="cat-item">
                                    <a href="#">
                                        <i class="far fa-square"></i> Intel Core i3
                                    </a>
                                    <span class="count">(14)</span>
                                </li>
                                <li class="cat-item">
                                    <a href="#">
                                        <i class="far fa-square"></i> Intel Core i5
                                    </a>
                                    <span class="count">(2)</span>
                                </li>
                                <li class="cat-item">
                                    <a href="#">
                                        <i class="far fa-square"></i> Intel Core i7
                                    </a>
                                    <span class="count">(8)</span>
                                </li>
                                <li class="cat-item">
                                    <a href="#">
                                        <i class="far fa-square"></i> Intel Core i9
                                    </a>
                                    <span class="count">(10)</span>
                                </li>
                                <li class="cat-item">
                                    <a href="#">
                                        <i class="far fa-square"></i> AMD Ryzen 5
                                    </a>
                                    <span class="count">(3)</span>
                                </li>
                            </ul>
                        </div>
                        <div class="categories-product-sidebar">
                            <div class="header-sidebar">
                                <span>Ổ cứng</span>
                            </div>
                            <ul class="list-categories">
                                <li class="cat-item">
                                    <a href="#">
                                        <i class="far fa-square"></i> Chỉ có SSD
                                    </a>
                                    <span class="count">(14)</span>
                                </li>
                                <li class="cat-item">
                                    <a href="#">
                                        <i class="far fa-square"></i> Chỉ có HDD
                                    </a>
                                    <span class="count">(2)</span>
                                </li>
                                <li class="cat-item">
                                    <a href="#">
                                        <i class="far fa-square"></i> SSD + HDD
                                    </a>
                                    <span class="count">(8)</span>
                                </li>
                            </ul>
                        </div>
                        <div class="categories-product-sidebar">
                            <div class="header-sidebar">
                                <span>Ram</span>
                            </div>
                            <ul class="list-categories">
                                <li class="cat-item">
                                    <a href="#">
                                        <i class="far fa-square"></i> 4GB
                                    </a>
                                    <span class="count">(14)</span>
                                </li>
                                <li class="cat-item">
                                    <a href="#">
                                        <i class="far fa-square"></i> 8GB
                                    </a>
                                    <span class="count">(2)</span>
                                </li>
                                <li class="cat-item">
                                    <a href="#">
                                        <i class="far fa-square"></i> 16GB
                                    </a>
                                    <span class="count">(8)</span>
                                </li>
                                <li class="cat-item">
                                    <a href="#">
                                        <i class="far fa-square"></i> 32GB
                                    </a>
                                    <span class="count">(10)</span>
                                </li>
                                <li class="cat-item">
                                    <a href="#">
                                        <i class="far fa-square"></i> 64GB
                                    </a>
                                    <span class="count">(3)</span>
                                </li>
                            </ul>
                        </div>

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

                                <span>Bộ lọc</span>
                            </a>
                            <div class="dropdown ordering">
                                <a class="dropdown-toggle text-secondary" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                Lọc theo
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="">Từ A-Z</a></li>
                                <li><a class="dropdown-item" href="">Từ Z-A</a></li>
                                <li><a class="dropdown-item" href="">Giá giảm dần</a></li>
                                <li><a class="dropdown-item" href="">Giá tăng dần</a></li>
                                </ul>
                            </div>
                            <p class="showing">Hiển thị 1–12 trong số 100 kết quả</p>
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
                                            </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        {!! $products->links('frontend.pagination') !!}
                        </div>
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
    $(document).ready(function(){
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
