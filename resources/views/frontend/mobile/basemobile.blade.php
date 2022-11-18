<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('title')
    <link href="{{asset('upload/images/common_img/icon-head.png')}}" rel="shortcut icon">
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
<div class="col-12">
    @yield('header_mobile')
    @yield('content')
    @yield('footer')
</div>
<!-- javascript -->
    <script src="{{ asset('lib/jquery360.min.js') }}"></script>
    <script src="{{ asset('asset/lib/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('asset/lib/OwlCarousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('asset/js/mobile.js') }}"></script>
    <script type="text/javascript">
        var base_url = '{{route('user')}}';
    </script>
    @yield('js')
</body>

</html>
