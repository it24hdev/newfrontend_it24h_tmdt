@extends('frontend.layouts.base')
@section('title')
    <title>IT24H - Trang chủ</title>
@endsection
@section('header-home')
    @include('frontend.layouts.header-home', [$Sidebars])
@endsection
@section('content')
    <div class="wp-content">
        <div class="get-list-cat" data-list="{{$list_cat}}"></div>
        <div class="container-page">
            <div id="content">
                <div class="col-12">
                <div class="content-left">
                    @if (!empty($banner_sidebar))
                        <div class="banner-image">
                            <a href="{{$banner_sidebar->link_target}}">
                                <img src="{{asset('upload/images/slider/'.$banner_sidebar->image)}}" alt="">
                            </a>
                        </div>
                    @endif
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
                    <div class="categories-slider-home">
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
                </div>
                </div>
                <div class="col-12">
                    <div class="action_form">
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
                    <div class="deal_form">
                        <div id="slider-deal"></div>
                        <div id="slider-categories-promotion"></div>
                    </div>
                </div>
                <!-- Danh sách sp theo danh mục -->
                <div class="group-product">
                    <!-- Danh mục -->
                    @foreach ($get_cat_parents as $cat_parent)
                        <div class="product-content mb-4" id="category-{{$cat_parent->id}}">
                            <div class="block-title flex-wrap">
                                <div class="d-flex w-100 overflow-hidden justify-content-between">
                                    <div class="name_cat_parent"> <h2>{{$cat_parent->name}}</h2> </div>
                                    <div class="linktocat"><a href="{{route('product_cat', ['slug' =>  $cat_parent->slug])}}" class="show-all"><span>Xem tất cả</span><i class="far fa-angle-right"></i></a></div>
                                </div>
                                <div class="d-flex align-items-center overflow-hidden w-100"> <ul class="owl-carousel owl-theme owl-loaded owl-drag px-0 my-0" id="list-cat-child-{{$cat_parent->id}}"></ul></div>
                            </div>
                            <div id="data-{{$cat_parent->id}}" class="owl-carousel owl-theme owl-loaded owl-drag"></div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="owl-carousel owl-theme owl-loaded owl-drag" id="load_brand"></div>
        </div>
    </div>
@include('frontend.desktop.template.template_deals_time')
@include('frontend.desktop.template.template_title_categories_promotion')
@include('frontend.desktop.template.template_product_two_rows')
@include('frontend.desktop.template.template_brand')
@endsection
@section('footer')
    @include('frontend.layouts.footer')
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            var _token = $('meta[name="csrf-token"]').attr('content');
            //Them san pham vao gio hang
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
            //ham them san pham yeu thich
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
            // danh sach danh muc hien thi tren trang chu
            var list_product = [];
            let list_cat = $('.get-list-cat').data('list');
            let cat_ids = list_cat.split('_');
            cat_ids.forEach(function (element) {
                list_product.push(element);
            });
            //load san pham theo danh muc
            function get_product_categories_loading(category_id) {
                var id = category_id;
                var data = {
                    id: category_id,
                    _token: _token
                };
                $.ajax({
                    url: "{{route('get_product_categories_loading')}}",
                    type: "post",
                    dataType: "json",
                    data: data,
                    success: function (data) {
                        get_title_categories_loading(id);
                        var append_id = $('#data-'+id);
                        append_id.html('');
                        tmp_product(data.product_promotion,'#data-'+id);
                        append_id.owlCarousel('destroy');
                        append_id.owlCarousel({
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
                                    items: 2
                                },
                                650: {
                                    items: 3
                                },
                                870: {
                                    items: 4
                                },
                                1000: {
                                    items: 5
                                },
                                1600: {
                                    items: 6
                                }
                            }
                        });
                    },
                })
            }
            //load danh muc con
            function get_title_categories_loading(id){
                var append_id = $('#list-cat-child-'+id);
                var data = {
                    id: id,
                    _token: _token
                };
                $.ajax({
                    url: "{{route('get_list_categories_child_loading')}}",
                    type: "post",
                    dataType: "json",
                    data: data,
                    success: function (data) {
                        $.each(data, function (k, v) {
                            append_id.append('<li class="item_categoreis_child" data-target="' + v.id + '" data-parent="'+v.parent_id+'">' + v.name + '</li>');
                        });
                        append_id.owlCarousel('destroy');
                        append_id.owlCarousel({
                            autoplay: false,
                            autoplayHoverPause: false,
                            loop: false,
                            margin: 10,
                            nav: false,
                            dots: false,
                            autoWidth: true,
                            callbacks: true,
                        });
                    }
                });
            }
            //load san pham deal
            function get_deal() {
                var data = {
                    _token: _token
                };
                $.ajax({
                    url: "{{route('get_deal')}}",
                    type: "post",
                    dataType: "json",
                    data: data,
                    success: function (data) {
                        var template_deals_time = $('#template_deals_time').html();
                        var tmp_deals_time = $(template_deals_time).clone();
                        $(tmp_deals_time).find('.time-deal').attr('data-target',data.time_deal);
                        $('#slider-deal').prepend(tmp_deals_time);
                        time_deal();
                        tmp_product(data.deal,'#slider-deal-supper');
                        $('#slider-deal-supper').owlCarousel({
                            autoplay: true,
                            autoplayHoverPause: true,
                            loop: true,
                            margin: 10,
                            nav: true,
                            dots: false,
                            mouseDrag: true,
                            touchDrag: true,
                            callbacks: true,
                            lazyLoad: true,
                            responsive: {
                                0: {
                                    items:3,
                                },
                                730: {
                                    items:3,
                                },
                                1200: {
                                    items:4,
                                },
                                1350: {
                                    items:3,
                                },
                                1510: {
                                    items:4,
                                },

                            },
                        });
                    },
                })
            }
            //bo dem thoi gian
            function time_deal(){
                var $time = $('.time-deal').attr('data-target');
                var countDownDate = new Date($time).getTime();
                if(countDownDate){
                    // cập nhập thời gian sau mỗi 1 giây
                    var x = setInterval(function() {

                        // Lấy thời gian hiện tại
                        var now = new Date().getTime();

                        // Lấy số thời gian chênh lệch
                        var distance = countDownDate - now;

                        // Tính toán số ngày, giờ, phút, giây từ thời gian chênh lệch
                        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                        // HIển thị chuỗi thời gian trong thẻ
                        if (days > 0)
                            document.getElementById("d").innerHTML = days;
                        if (hours < 10)
                            document.getElementById("h").innerHTML = '0'+ hours;
                        else
                            document.getElementById("h").innerHTML = hours;
                        if (minutes < 10 )
                            document.getElementById("m").innerHTML = '0'+ minutes;
                        else
                            document.getElementById("m").innerHTML = minutes;

                        if (seconds < 10)
                            document.getElementById("s").innerHTML = '0'+ seconds;
                        else
                            document.getElementById("s").innerHTML = seconds;
                    }, 1000);
                }
            }
            //template product
            function tmp_product(data, id_append){
                var template_product_desktop = $('#template_product_desktop').html();
                $.each(data, function(k,v) {
                    var url ="";
                    var tmp = $(template_product_desktop).clone();
                    if(v.img_brands !="no-images.jpg"){
                        $(tmp).find('.brand').css({'visibility':'visible','opacity':'1'});
                        url = '{{asset("upload/images/products/thumb/img_brand")}}';
                        url = url.replace('img_brand',v.img_brands);
                        img = 'url('+url+')';
                        $(tmp).find('.brand_img').css('background-image',img);
                    }
                    if(v.year){
                        $(tmp).find('.years').removeClass('d-none');
                        $(tmp).find('.years').html(v.year);
                    }
                    if(v.installment){
                        $(tmp).find('.payment').removeClass('d-none');
                        $(tmp).find('.payment').html(v.installment);
                    }
                    url = '{{route('detailproduct', "slug_detail")}}';
                    url = url.replace('slug_detail',v.slug);

                    $(tmp).find('.link_detail').attr('href',url);
                    if(v.thumb!='no-images.jpg'){
                        url = '{{asset('upload/images/products/medium/img_product')}}';
                        url = url.replace('img_product',v.thumb);
                        $(tmp).find('.thumb img').attr('data-src',url);
                    }
                    else{
                        url = '{{asset('upload/images/common_img/img_product')}}';
                        url = url.replace('img_product',v.thumb);
                        $(tmp).find('.thumb img').attr('data-src',url);
                    }
                    $(tmp).find('.name span').html(v.name);
                    if(v.event!=0 && v.event_icon){
                        $(tmp).find('.event').css({'background':'linear-gradient(to right,'+v.event_color_left+','+v.event_color_right+')','visibility':'visible','opacity':'1'});
                        url = '{{asset("upload/images/products/thumb/event_icon")}}';
                        url = url.replace('event_icon',v.event_icon);
                        $(tmp).find('.event img').attr('src',url);
                        $(tmp).find('.event span').html(v.event_name);
                    }
                    // $(tmp).find('.code').html('Mã: '+v.ma);
                    var list_specifications = $.parseJSON(v.specifications);
                    $.each(list_specifications, function(k,v) {
                        if(k<=6)
                         $(tmp).find('.product-attributes').append('<li>'+v+'</li>');
                    });
                    if(v.price_onsale>0 && v.onsale>0){
                        $(tmp).find('.onsale').html('-'+v.onsale+'%');
                        $(tmp).find('.price-old').html((new Intl.NumberFormat().format(v.price))+' VNĐ');
                        $(tmp).find('.price-new').html((new Intl.NumberFormat().format(v.price_onsale))+' VNĐ');
                    }
                    else{
                        $(tmp).find('.price_sale').css('visibility','hidden')
                        $(tmp).find('.price-new').html((new Intl.NumberFormat().format(v.price))+' VNĐ');
                    }
                    var votes_sum = 0;
                    if(v.votes_count>0){
                        votes_sum = (v.votes_sum/v.votes_count)*20;
                    }
                    $(tmp).find('.rating-upper').css('width',votes_sum+'%');
                    $(tmp).find('.count-review').html('('+v.votes_count+')');
                    $(tmp).find('.sold span').html('Đã bán '+v.sold);
                    if(v.quantity>0){
                        $(tmp).find('.qty').css({'color':'#01aa42','background-color':'#dbf8e1'});
                        $(tmp).find('.qty').html('Còn hàng');
                    }
                    else{
                        $(tmp).find('.qty').css({'color':'#ffffff','background-color':'#fb0000'});
                        $(tmp).find('.qty').html('Liên hệ');
                    }
                    if(v.quantity<0){
                        $(tmp).find('.qty').addClass('d-none');
                    }
                    $(tmp).find('.add-wish').attr('data-target',v.id);
                    $(tmp).find('.add-cart').attr('data-target',v.id);
                    $(id_append).append(tmp);
                });
            }
            //template product 2 rows slider
            function tmp_product_2(data, id_append){
                var template_product_desktop = $('#template_product_desktop').html();
                var template_two_rows = $('#template_product_two_rows').html();
                var tmp_two_rows ="";
                $.each(data, function(k,v) {
                    var  tmp = $(template_product_desktop).clone();
                    var url ="";
                    if(v.img_brands != "no-images.jpg"){
                        $(tmp).find('.brand').css({'visibility':'visible','opacity':'1'});
                        url = '{{asset("upload/images/products/thumb/img_brand")}}';
                        url = url.replace('img_brand',v.img_brands);
                        img = 'url('+url+')';
                        $(tmp).find('.brand_img').css('background-image',img);
                    }
                    if(v.year){
                        $(tmp).find('.years').removeClass('d-none');
                        $(tmp).find('.years').html(v.year);
                    }
                    if(v.installment){
                        $(tmp).find('.payment').removeClass('d-none');
                        $(tmp).find('.payment').html(v.installment);
                    }
                    url = '{{route('detailproduct', "slug_detail")}}';
                    url = url.replace('slug_detail',v.slug);

                    $(tmp).find('.link_detail').attr('href',url);
                    if(v.thumb!='no-images.jpg'){
                        url = '{{asset('upload/images/products/medium/img_product')}}';
                        url = url.replace('img_product',v.thumb);
                        $(tmp).find('.thumb img').attr('data-src',url);
                    }
                    else{
                        url = '{{asset('upload/images/common_img/img_product')}}';
                        url = url.replace('img_product',v.thumb);
                        $(tmp).find('.thumb img').attr('data-src',url);
                    }
                    $(tmp).find('.name span').html(v.name);
                    if(v.event!=0 && v.event_icon){
                        $(tmp).find('.event').css({'background':'linear-gradient(to right,'+v.event_color_left+','+v.event_color_right+')','visibility':'visible','opacity':'1'});
                        url = '{{asset("upload/images/products/thumb/event_icon")}}';
                        url = url.replace('event_icon',v.event_icon);
                        $(tmp).find('.event img').attr('src',url);
                        $(tmp).find('.event span').html(v.event_name);
                    }
                    // $(tmp).find('.code').html('Mã: '+v.ma);
                    var list_specifications = $.parseJSON(v.specifications);
                    $.each(list_specifications, function(k,v) {
                        if(k<=6)
                            $(tmp).find('.product-attributes').append('<li>'+v+'</li>');
                    });
                    if(v.price_onsale>0 && v.onsale>0){
                        $(tmp).find('.onsale').html('-'+v.onsale+'%');
                        $(tmp).find('.price-old').html((new Intl.NumberFormat().format(v.price))+' VNĐ');
                        $(tmp).find('.price-new').html((new Intl.NumberFormat().format(v.price_onsale))+' VNĐ');
                    }
                    else{
                        $(tmp).find('.price_sale').css('visibility','hidden')
                        $(tmp).find('.price-new').html((new Intl.NumberFormat().format(v.price))+' VNĐ');
                    }
                    var votes_sum = 0;
                    if(v.votes_count>0){
                        votes_sum = (v.votes_sum/v.votes_count)*20;
                    }
                    $(tmp).find('.rating-upper').css('width',votes_sum+'%');
                    $(tmp).find('.count-review').html('('+v.votes_count+')');
                    $(tmp).find('.sold span').html('Đã bán '+v.sold);
                    if(v.quantity>0){
                        $(tmp).find('.qty').css({'color':'#01aa42','background-color':'#dbf8e1'});
                        $(tmp).find('.qty').html('Còn hàng');
                    }
                    else{
                        $(tmp).find('.qty').css({'color':'#ffffff','background-color':'#fb0000'});
                        $(tmp).find('.qty').html('Liên hệ');
                    }
                    if(v.quantity<0){
                        $(tmp).find('.qty').addClass('d-none');
                    }
                    $(tmp).find('.add-wish').attr('data-target',v.id);
                    $(tmp).find('.add-cart').attr('data-target',v.id);
                    if((k+1)%2!=0){
                        tmp_two_rows = $(template_two_rows).clone();
                        $(tmp_two_rows).find('.p_two_rows').append(tmp);
                    }
                    else{
                        $(tmp_two_rows).find('.p_two_rows').append(tmp);
                        $(id_append).append(tmp_two_rows);
                    }
                });
            }
            //load san pham danh muc khuyen mai
            function get_categories_promotion() {
                var data = {
                    _token: _token
                };
                $.ajax({
                    url: "{{route('get_categories_promotion')}}",
                    type: "post",
                    dataType: "json",
                    data: data,
                    success: function (data) {
                        title_categories_promotion(data.title);
                        product_categories_promotion(data.product_promotion,"#list_pcp");
                    },
                })
            }
            //ten danh muc khuyen mai
            function title_categories_promotion(data){
                var template_title_categories_promotion = $('#template_title_categories_promotion').html();
                $('#slider-categories-promotion').append(template_title_categories_promotion);
                $.each(data, function(k,v){
                    if(k==0){
                        $('#item_cp').append('<div class="item_title active"  data-target="'+v.id+'">'+v.name+'</div>');
                    }
                    else{
                        $('#item_cp').append('<div class="item_title" data-target="'+v.id+'">'+v.name+'</div>');
                    }
                });
                $('#item_cp').owlCarousel({
                    autoplay: false,
                    autoplayHoverPause: true,
                    loop: false,
                    margin: 10,
                    nav: false,
                    dots: false,
                    mouseDrag: true,
                    touchDrag: true,
                    callbacks: true,
                    items:5,
                    responsive:false
                });
            }
            //danh sach san pham danh muc khuyen mai
            function product_categories_promotion(data,id_append){
                tmp_product_2(data,id_append);
                $(id_append+' .tmp_product .box_product').addClass('active');
                $(id_append+' .tmp_product .lower_half').addClass('active');
                $(id_append+' .tmp_product .upper_half').addClass('active');
                $(id_append+'.tmp_product').addClass('active');
                $(id_append).owlCarousel('destroy');
                $(id_append).owlCarousel({
                    autoplay: true,
                    autoplayHoverPause: true,
                    loop: true,
                    margin: 10,
                    nav: false,
                    dots: false,
                    mouseDrag: true,
                    touchDrag: true,
                    callbacks: true,
                    lazyLoad: true,
                    responsive: {
                        0: {
                            items:1,
                        },
                        700: {
                            items:2,
                        },
                        1650: {
                            items:3
                        },
                    },
                });
            }
            //chon lai danh muc khuyen mai
            $(document).on('click', '.item_title', function(){
                var id =  $(this).attr('data-target');
                $('.item_title').removeClass('active');
                $(this).addClass('active');
                $('#list_pcp').html('');
                var data = {
                    _token: _token,
                    id:id
                };
                $.ajax({
                    url: "{{route('get_product_categories_loading')}}",
                    type: "post",
                    dataType: "json",
                    data: data,
                    success: function (data) {
                        product_categories_promotion(data.product_promotion,'#list_pcp');
                    },
                })
            })
            //chon danh muc con- hien thi danh sach san pham danh muc con
            $(document).on('click','.item_categoreis_child',function () {
                var id = $(this).attr('data-target');
                var parent_id = $(this).attr('data-parent');
                var append_id = '#data-'+parent_id;
                $('.item_categoreis_child').removeClass('active');
                $(this).addClass('active');
                $(append_id).html('');
                var data = {
                    _token: _token,
                    id:id
                };
                $.ajax({
                    url: "{{route('get_product_categories_loading')}}",
                    type: "post",
                    dataType: "json",
                    data: data,
                    success: function (data) {
                        tmp_product(data.product_promotion,append_id);
                        $(append_id).owlCarousel('destroy');
                        $(append_id).owlCarousel({
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
                                    items: 2
                                },
                                650: {
                                    items: 3
                                },
                                870: {
                                    items: 4
                                },
                                1000: {
                                    items: 5
                                },
                                1600: {
                                    items: 6
                                }
                            }
                        });
                    },
                });
            })
            //load thuong hieu
            function load_brand() {
                var data = {
                    _token: _token
                };
                $.ajax({
                    url: "{{route('load_brand')}}",
                    type: "post",
                    dataType: "json",
                    data: data,
                    success: function (data) {
                        var tmp_brand = $(template_brand).html();
                        $.each(data, function (k,v){
                            var url_img = '{{asset('upload/images/products/large/brand_img')}}';
                            var tmp = $(tmp_brand).clone();
                            url_img = url_img.replace('brand_img', v.image);
                            $(tmp).find('img').attr('src',url_img);
                            $('#load_brand').append(tmp);
                        });
                        $('#load_brand').owlCarousel('destroy');
                        $('#load_brand').owlCarousel({
                            autoplay: true,
                            autoplayHoverPause: true,
                            loop: true,
                            margin: 10,
                            nav: false,
                            dots: false,
                            autoWidth: true,
                            callbacks: true,
                        });
                    },
                })
            }

            //ham cai dat load khung hinh
            function isOnScreen(elem) {
                if (elem.length == 0) {
                    return;
                }
                var $window = jQuery(window)
                var viewport_top = $window.scrollTop() //vị trí đang scroll
                var viewport_height = $window.height()  // chiều cao màn hình
                var viewport_bottom = viewport_top + viewport_height
                var $elem = jQuery(elem)
                var top = $elem.offset().top
                var height = $elem.height()
                var bottom = top + height

                return (top >= viewport_top && top < viewport_bottom) ||
                    (bottom > viewport_top && bottom <= viewport_bottom) ||
                    (height > viewport_height && top <= viewport_top && bottom >= viewport_bottom)
            }
            //ham xu ly khi cuon man hinh
            function runOnScroll() {
                list_product.forEach(function (category_id) {
                    if (isOnScreen($("#category-" + category_id)) && ($("#category-" + category_id).hasClass("loaded") == false)) {
                        get_product_categories_loading(category_id);
                        $("#category-" + category_id).addClass("loaded");
                    }
                });
                if (isOnScreen($("#slider-deal")) && ($("#slider-deal").hasClass("loaded") == false)) {
                    get_deal();
                    $("#slider-deal").addClass("loaded");
                }
                if (isOnScreen($("#slider-categories-promotion")) && ($("#slider-categories-promotion").hasClass("loaded") == false)) {
                    get_categories_promotion();
                    $("#slider-categories-promotion").addClass("loaded");
                }
                if (isOnScreen($("#load_brand")) && ($("#load_brand").hasClass("loaded") == false)) {
                    load_brand();
                    $("#load_brand").addClass("loaded");
                }
            }
            $(window).scroll(runOnScroll);

            //dang ky dich vu
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

