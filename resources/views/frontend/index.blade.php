@extends('frontend.layouts.base')

@section('title')
    <title>IT24H - Trang chủ</title>
@endsection


@section('header-home')
    @include('frontend.layouts.header-home', [$Sidebars])
@endsection


@section('header-mobile')
    @include('frontend.layouts.menu-mobile')
@endsection
@include('frontend.mobile.route')
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
                    <div class="form-group wp-supper-deal p-3 mb-4">
                        <h3>Đăng ký dịch vụ</h3>
                        <form enctype="multipart/form-data" class="register_form">
                            <div class="form-group">
                                <div class="input-wrapper" >
                                    <span class="icon-wrapper" >
                                        <i class="fal fa-user"></i>
                                    </span>
                                    <span class="position-relative">
                                        <input class="form-control register_service" type="text" name="customer_name" placeholder="Họ và tên" required>
                                        <span class="required_name text-danger d-none"><i>Bạn chưa nhập họ và tên.</i></span>
                                </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-wrapper" >
                                    <span class="icon-wrapper" >
                                        <i class="fal fa-phone-alt"></i>
                                    </span>
                                    <span class="position-relative">
                                        <input class="form-control register_service" type="tel" name="customer_numberphone" placeholder="Số điện thoại" maxlength="12" required>
                                        <span class="required_phone text-danger d-none"><i>Bạn chưa nhập số điện thoại.</i></span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-wrapper" >
                                    <span class="icon-wrapper" >
                                        <i class="fal fa-envelope"></i>
                                    </span>
                                    <span class="position-relative">
                                        <input class="form-control register_service" type="email" name="customer_email" placeholder="Email">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-wrapper" >
                                    <span class="position-relative">
                                    <textarea class="form-control " name="customer_request" rows="3" placeholder="Nhập yêu cầu.." required></textarea>
                                    <span class="required_request text-danger d-none"><i>Bạn chưa nhập yêu cầu.</i></span>
                                    </span>
                                </div>
                            </div>
                                    <input id="registerservice" type="button" class="btn-submit btn btn-primary px-2 form-control mt-4" value="Đăng ký">
                        </form>
                        <div class="respone_register d-none">
                            <div class="register_error d-none">
                                <p>Đăng ký dịch vụ không thành công, xin vui lòng thử lại</p>
                                <input id="re_register" type="button" class="form-control btn btn-primary" value="Đăng ký lại">
                            </div>
                            <div class="register_success d-none">
                                <p>Cảm ơn bạn đã đăng ký dịch vụ IT24h</p>
                                <input id="newrequest" type="button" class="form-control btn btn-primary" value="Thêm yêu cầu">
                            </div>
                        </div>

                    </div>
                    <div class="block-services mb-5">
                    </div>
                    <div class="wp-supper-deal p-1">
                        <div class="title_activity form-control">Hoạt động gần đây</div>
                        <div class="vwrap p-1">
                            <div class="vmove">
                                <ul>
                                    @foreach($recentactivity as $value)
                                    <li class="vitem"><a
                                            href="#" target="_blank">{{$value->name}}</a>
                                        {{$value->activities}} <span class="colorattr">{{$value->attr}}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-right">
                    <div class="slider-banner mb-4">
                        <div class="slider">
                            <div class="slider-show">
                                <div class="owl-carousel owl-theme owl-loaded owl-drag" id="slider-show">
                                    @foreach ($sliders as $item)
                                        <a href="{{$item->link_target}}">
                                            @if($isMobile=='phone')
                                                <img class="owl-lazy"
                                                     data-src="{{asset('upload/images/slider/thumb/'.$item->image)}}"
                                                     alt="" width="100%" height="100%">
                                            @else
                                                <img class="owl-lazy"
                                                     data-src="{{asset('upload/images/slider/'.$item->image)}}" alt=""
                                                     width="100%" height="100%">
                                            @endif
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="banner">
                            <ul>
                                @if (!empty($banner_1))
                                    <li class="banner-image">
                                        <a href="{{$banner_1->link_target}}">
                                            <img src="{{asset('upload/images/slider/'.$banner_1->image)}}" alt="">
                                        </a>
                                    </li>
                                @endif
                                @if (!empty($banner_2))
                                    <li class="banner-image">
                                        <a href="{{$banner_2->link_target}}">
                                            <img src="{{asset('upload/images/slider/'.$banner_2->image)}}" alt="">
                                        </a>
                                    </li>
                                @endif
                                @if (!empty($banner_3))
                                    <li class="banner-image">
                                        <a href="{{$banner_2->link_target}}">
                                            <img src="{{asset('upload/images/slider/'.$banner_3->image)}}" alt="">
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="categories-slider-home mb-5">
                        <div class="block-title">
                            <strong>Sản phẩm theo danh mục</strong>
                        </div>
                        <div class="wp-list-categories">
                            <div class="owl-carousel owl-theme owl-loaded owl-drag" id="list-cat-slider">
                                @foreach ($list_cat_head as $item)
                                    <div class="wp-category">
                                        <div class="cat-thumb">
                                            <a href="{{route('product_cat', ['slug' =>  $item->slug])}}">
                                                @if ($item->thumb == 'no-image-product.jpg' || empty($item->thumb))
                                                    <img class="owl-lazy"
                                                         data-src="{{asset('upload/images/common_img/no-image-product.jpg')}}"/>
                                                @else
                                                    <img class="owl-lazy"
                                                         data-src="{{asset('upload/images/products/thumb/'.$item->thumb)}}"
                                                         alt="">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="child-cat">
                                            <div class="cat-title">
                                                <a href="{{route('product_cat',['slug' =>  $item->slug])}}">{{$item->name}}</a>
                                            </div>
                                            <ul class="sub-cats">
                                                @foreach ($item->cat_child as $key => $cat_child)
                                                    @if($key<8)
                                                        <li>
                                                            <a href="{{route('product_cat',['slug' =>  $cat_child->slug])}}">{{$cat_child->name}}
                                                                <span class="count">({{$cat_child->get_product_by_cat()->count()}})</span></a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                            <a href="{{route('product_cat', ['slug' => $item->slug])}}"
                                               class="view-all">Xem tất cả</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div id="slider-deal"></div>
                    <div id="slider-new"></div>
                </div>
                <!-- Danh sách sp theo danh mục -->
                <div class="group-product">
                    <!-- Danh mục -->
                    @foreach ($get_cat_parents as $cat_parent)
                        @if(in_array($cat_parent->id, $cat_arr))
                            <div class="product-content mb-4" id="category-{{$cat_parent->id}}">
                                <div class="block-title">
                                    <h2>{{$cat_parent->name}}</h2>
                                    <ul class="nav nav-pills sub_cat_title_slider owl-carousel owl-theme owl-loaded owl-drag"
                                        id="pills-tab sub_cat_title_slider" role="tablist">
                                        @php
                                            $t=0;
                                        @endphp
                                        @foreach ($cat_parent->cat_child as $cat_child)
                                            @php
                                                $t++;
                                            @endphp
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link {{($t==1) ? 'active' : ''}}"
                                                        id="pills-cat{{$cat_child->id}}-tab" data-bs-toggle="pill"
                                                        data-bs-target="#pills-cat{{$cat_child->id}}" type="button"
                                                        role="tab" aria-controls="pills-cat{{$cat_child->id}}"
                                                        aria-selected="true">{{$cat_child->name}}</button>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <a href="{{route('product_cat', ['slug' =>  $cat_parent->slug])}}" class="show-all">Xem
                                        tất cả <i class="far fa-angle-right"></i></a>
                                </div>
                                <div id="data-{{$cat_parent->id}}" class="wp-slider-pro"></div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div id="slider-bottom"></div>
        </div>
    </div>

    <div id="loadfooter"></div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            //Add to Cart
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
                        alert('Thêm thành công sản phẩm vào giỏi hàng!');
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

            function isOnScreen(elem) {
                if (elem.length == 0) {
                    return;
                }
                var $window = jQuery(window)
                var viewport_top = $window.scrollTop() //vị trí đang scroll
                var viewport_height = $window.height()  // chiều cao màn hình
                var viewport_bottom = viewport_top + viewport_height
                var $elem = jQuery(elem)
                let width = screen.width;
                var top = $elem.offset().top - 500
                // if(width < 1024)
                // top = $elem.offset().top-5000
                // console.log(top);


                var height = $elem.height()
                var bottom = top + height + 1000

                return (top >= viewport_top && top < viewport_bottom) ||
                    (bottom > viewport_top && bottom <= viewport_bottom) ||
                    (height > viewport_height && top <= viewport_top && bottom >= viewport_bottom)
            }

            function laySp(category_id) {
                var _token = $('meta[name="csrf-token"]').attr('content');
                var id = category_id;
                var data = {
                    id: category_id,
                    _token: _token
                };
                $.ajax({
                    url: "{{route('getProducts')}}",
                    type: "post",
                    dataType: "json",
                    data: data,
                    success: function (data) {
                        // console.log(data);
                        $('#data-' + id).append(data);
                        $('.list-product-group').owlCarousel({
                            autoplay: false,
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
                                768: {
                                    items: 3
                                },
                                992: {
                                    items: 4
                                },
                                1200: {
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
            cat_ids.forEach(function (element) {
                list_product.push(element);
            });


            function laySpdeal() {
                var _token = $('meta[name="csrf-token"]').attr('content');
                var data = {
                    _token: _token
                };
                $.ajax({
                    url: "{{route('getdealProduct')}}",
                    type: "post",
                    dataType: "json",
                    data: data,
                    success: function (data) {
                        // console.log(data);
                        $('#slider-deal').append(data);

                    },
                })
            }


            function laySpnew() {
                var _token = $('meta[name="csrf-token"]').attr('content');
                var data = {
                    _token: _token
                };
                $.ajax({
                    url: "{{route('getnewProduct')}}",
                    type: "post",
                    dataType: "json",
                    data: data,
                    success: function (data) {
                        $('#slider-new').append(data);

                    },
                })
            }

            function loadfooter() {
                var _token = $('meta[name="csrf-token"]').attr('content');
                var data = {
                    _token: _token
                };
                $.ajax({
                    url: "{{route('loadfooter')}}",
                    type: "post",
                    dataType: "json",
                    data: data,
                    success: function (data) {
                        $('#loadfooter').append(data);

                    },
                })
            }

            function loadsliderbottom() {
                var _token = $('meta[name="csrf-token"]').attr('content');
                var data = {
                    _token: _token
                };
                $.ajax({
                    url: "{{route('loadsliderbottom')}}",
                    type: "post",
                    dataType: "json",
                    data: data,
                    success: function (data) {
                        $('#slider-bottom').append(data);
                    },
                })
            }

            function runOnScroll() {
                list_product.forEach(function (category_id) {
                    if (isOnScreen($("#category-" + category_id)) && ($("#category-" + category_id).hasClass("loaded") == false)) {
                        laySp(category_id);

                        $("#category-" + category_id).addClass("loaded");
                    }
                });

                if (isOnScreen($("#slider-deal")) && ($("#slider-deal").hasClass("loaded") == false)) {
                    laySpdeal();
                    $("#slider-deal").addClass("loaded");
                }


                if (isOnScreen($("#slider-new")) && ($("#slider-new").hasClass("loaded") == false)) {
                    laySpnew();
                    $("#slider-new").addClass("loaded");
                }

                if (isOnScreen($("#loadfooter")) && ($("#loadfooter").hasClass("loaded") == false)) {
                    loadfooter();
                    $("#loadfooter").addClass("loaded");
                }

                if (isOnScreen($("#slider-bottom")) && ($("#slider-bottom").hasClass("loaded") == false)) {
                    loadsliderbottom();
                    $("#slider-bottom").addClass("loaded");
                }
            }
            $(window).scroll(runOnScroll);
            $(document).on('click', '#registerservice', function (){

                var name =   $("input[name='customer_name']").val();
                var phone =   $("input[name='customer_numberphone']").val();
                var email =   $("input[name='customer_email']").val();
                var customer_request =   $("textarea[name='customer_request']").val();
                var _token = $('meta[name="csrf-token"]').attr('content');
                var data = {
                    name: name,
                    phone: phone,
                    email: email,
                    customer_request: customer_request,
                    _token: _token
                };
                if(name==""){
                    $('.required_name').removeClass('d-none');
                }else{
                    if(!$('.required_name').hasClass('d-none')){
                        $('.required_name').addClass('d-none');
                    }
                }

                if(phone==""){
                    $('.required_phone').removeClass('d-none');
                }else{
                    if(!$('.required_phone').hasClass('d-none')){
                        $('.required_phone').addClass('d-none');
                    }
                }

                if(customer_request==""){
                    $('.required_request').removeClass('d-none');
                }else{
                    if(!$('.required_request').hasClass('d-none')){
                        $('.required_request').addClass('d-none');
                    }
                }

                if(name!='' && customer_request !='' && phone !=''){
                    $.ajax({
                        url: "{{route('registerservice.create')}}",
                        data: data,
                        method: "POST",
                        dataType: "json",
                        success: function(data){
                            $('.respone_register').removeClass('d-none');
                            $('.register_form').addClass('d-none');
                            if(data.success){
                                $('.register_success').removeClass('d-none');
                            }
                            else{
                                $('.register_error').removeClass('d-none');
                            }
                        }
                    });
                }
            });

            $(document).on('click', '#re_register , #newrequest', function (){
                $('.respone_register').addClass('d-none');
                $('.register_form').removeClass('d-none');
                $("textarea[name='customer_request']").val('');
            });
        });
    </script>
@endsection

