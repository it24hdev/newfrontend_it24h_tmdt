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
    <link rel="stylesheet" href="{{asset('asset/css/mobile/detailproduct.css')}}">
    @yield('css')
<!-- css -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));
            let active = false;

            const lazyLoad = function() {
                if (active === false) {
                    active = true;

                    setTimeout(function() {
                        lazyImages.forEach(function(lazyImage) {
                            if ((lazyImage.getBoundingClientRect().top <= window.innerHeight && lazyImage.getBoundingClientRect().bottom >= 0) && getComputedStyle(lazyImage).display !== "none") {
                                lazyImage.src = lazyImage.dataset.src;
                                lazyImage.classList.remove("lazy");

                                lazyImages = lazyImages.filter(function(image) {
                                    return image !== lazyImage;
                                });

                                if (lazyImages.length === 0) {
                                    document.removeEventListener("scroll", lazyLoad);
                                    window.removeEventListener("resize", lazyLoad);
                                    window.removeEventListener("orientationchange", lazyLoad);
                                }
                            }
                        });

                        active = false;
                    }, 200);
                }
            };
            document.addEventListener("scroll", lazyLoad);
            window.addEventListener("resize", lazyLoad);
            window.addEventListener("orientationchange", lazyLoad);
        });
    </script>
</head>
<body>
<div class="contentt">
    @yield('header_mobile')
    @yield('content')
    @yield('footer')
</div>
<div class="frame-w">
    <div class="menu-mobile" >
        <div id="menu_mobile" class="menu-tree"></div>
        <div class="menu-tree-child m-0 box">
            <div class="mgb_cat_m">
                <div class="box-title">
                    <a  target="_self" class="box-title__title"></a>
                    <a target="_self" class="box-title__btn-show-all">Xem tất
                        cả</a>
                </div>
                <div id="menu_mobile_child">

                </div>
        </div>
    </div>
</div>
@include('frontend.mobile.templatemenumobile')
@include('frontend.mobile.templatemenumobilechild')
@include('frontend.mobile.template_chose_label_img_menu')
@include('frontend.mobile.templatechildcategories')
@include('frontend.mobile.templateproductmobile')
@include('frontend.mobile.templatereviewmobile')
<!-- javascript -->
    <script src="{{ asset('lib/jquery360.min.js') }}"></script>
    <script src="{{ asset('asset/lib/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('asset/lib/OwlCarousel/dist/owl.carousel.min.js') }}"></script>
    <script type="text/javascript">
        var base_url = '{{route('user')}}';
        var add_cart_ajax = '{{route('add_cart_ajax')}}';
        var list_cart = '{{route('list_cart')}}';
        var get_menu_mobile = '{{route('get_menu_mobile')}}';
        var get_menu_child = '{{route('get_menu_child')}}';
        var get_hot_sale_mobile = '{{route('get_hot_sale_mobile')}}';
        var get_new_mobile = '{{route('get_new_mobile')}}';
        var get_product_mobile = '{{route('get_product_mobile')}}';
        var get_product_watched = '{{route('get_product_watched')}}';
        var get_product_similar = '{{route('get_product_similar')}}';
        var product_cat = '{{route('product_cat',['slug' => 'slug_code'])}}';
        var commentProduct = '{{route('commentProduct')}}';
        var detailproduct = '{{route('detailproduct', ['slug' => 'slug_code'])}}';
        var img_product_mobile = '{{asset('upload/images/products/thumb/img_name')}}';
        var  url_img_thumb_product= '{{asset('upload/images/products/thumb/')}}';
        var  url_img_large_product= '{{asset('upload/images/products/large/')}}';
        var img_brands = '{{asset('upload/images/products/thumb/img_name')}}';
        var img_category = '{{asset('upload/images/products/thumb/img_name')}}';
        var img_detailproperties = '{{asset('upload/images/detailproperties/thumb/img_name')}}';
    </script>
    <script src="{{ asset('asset/js/mobile.js') }}"></script>
@yield('js')
</body>
</html>
