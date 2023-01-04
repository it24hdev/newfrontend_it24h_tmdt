<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('title')
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"  media='screen and (min-width: 1024px)'>
    <link rel="stylesheet" href="{{asset('asset/lib/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset/lib/OwlCarousel/dist/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset/lib/OwlCarousel/dist/assets/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="/asset/lib/fontawesomePro5/css/all.min.css">
    <link rel="stylesheet" href="{{asset('asset/css/mobile/header_mobile.css')}}">
    <link rel="stylesheet" href="{{asset('asset/css/mobile/body_mobile.css')}}">
    <link rel="stylesheet" href="{{asset('asset/css/mobile/footer_mobile.css')}}">
    @yield('css')
</head>
<body>
<div class="contentt">
    @yield('header_mobile')
    @yield('content')
    @yield('footer')
</div>
<div class="frame-w">
    <div class="menu-mobile d-none">
        <div id="menu_mobile" class="menu-tree"></div>
        <div class="menu-tree-child m-0 box">
            <div class="mgb_cat_m">
                <div class="box-title">
                    <a  target="_self" class="box-title__title"></a>
                    <a target="_self" class="box-title__btn-show-all">Xem tất cả</a>
                </div>
                <div id="menu_mobile_child">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="notification">
    <div id="go_top"><i class="fal fa-angle-up"></i></div>
    <div id="snackbar">
        <div class="d-grid">
            <i class="far fa-check-circle"></i>
            <span>Đã thêm vào giỏ hàng</span>
        </div>
    </div>
    <div id="snackbar_false">
        <div class="d-grid">
            <i class="far fa-times-circle"></i>
            <span>Vui lòng thử lại</span>
        </div>
    </div>
    <div id="success_cm">
        <div class="d-grid">
            <i class="far fa-check-circle"></i>
            <span>Đánh giá của bạn đã được ghi nhận.</span>
        </div>
    </div>
</div>
@include('frontend.mobile.templatemenumobile')
@include('frontend.mobile.templatemenumobilechild')
@include('frontend.mobile.template_chose_label_img_menu')
@include('frontend.mobile.templatechildcategories')
@include('frontend.mobile.templateproductmobile')
@include('frontend.mobile.templatereviewmobile')
@include('frontend.mobile.templatesearchmobile')
@include('frontend.mobile.route')
<!-- javascript -->
<script src="{{ asset('lib/jquery360.min.js') }}"></script>
<script src="{{ asset('asset/lib/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('asset/lib/OwlCarousel/dist/owl.carousel.min.js') }}"></script>
<script src="{{ asset('asset/js/mobile.js') }}"></script>
<script src="{{ asset('asset/js/placeholder_autotyping.js') }}"></script>

@yield('js')
</body>
</html>
