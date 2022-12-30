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
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet" media='screen and (min-width: 1024px)'>
    <link rel="stylesheet" href="{{asset('asset/lib/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset/lib/OwlCarousel/dist/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset/lib/OwlCarousel/dist/assets/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="/asset/lib/fontawesomePro5/css/all.min.css">
    <link rel="stylesheet" href="{{asset('asset/css/header-home.css')}}">
    <link rel="stylesheet" href="{{asset('asset/css/content-home.css')}}">
    @yield('css')
    <link rel="stylesheet" href="{{asset('asset/css/footer.css')}}">
    <!-- css -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));
            let active = false;

            const lazyLoad = function () {
                if (active === false) {
                    active = true;

                    setTimeout(function () {
                        lazyImages.forEach(function (lazyImage) {
                            if ((lazyImage.getBoundingClientRect().top <= window.innerHeight && lazyImage.getBoundingClientRect().bottom >= 0) && getComputedStyle(lazyImage).display !== "none") {
                                lazyImage.src = lazyImage.dataset.src;
                                lazyImage.classList.remove("lazy");

                                lazyImages = lazyImages.filter(function (image) {
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
<div id="wrapper-page">
    @yield('header-home')
    @yield('header-mobile')
    @yield('content')
    @yield('footer')
    <!-- Messenger Plugin chat Code -->
    <div id="scroll_up" class="top-visible"><i class="fal fa-angle-up"></i></div>
    <div id="zalo"><a href="https://zalo.me/" target="_blank">Zalo</a></div>
    <div id="hotline"><a href="tel:0886776286"><i class="fas fa-phone-alt"></i></a></div>
    <div id="messenger"><a href="https://m.me/106139498237028/" target="_blank"><i
                class="fab fa-facebook-messenger"></i></a></div>
</div>
@include('frontend.desktop.template.template_menu_lv2_desktop')
@include('frontend.desktop.template.template_menu_lv3_desktop')
@include('frontend.desktop.template.template_menu_lv4_desktop')
<!-- javascript -->
<script src="{{ asset('lib/jquery360.min.js') }}"></script>
<script src="{{ asset('asset/lib/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('asset/lib/OwlCarousel/dist/owl.carousel.min.js') }}"></script>
<script src="{{ asset('asset/js/home.js') }}"></script>
@yield('js')
<script>
    $(document).ready(function () {
        $("#login-ajax").click(function () {
            var email = $("#email-header").val();
            var password = $("#password-header").val();
            var _token = $('meta[name="csrf-token"]').attr('content');
            var data = {email: email, password: password, _token: _token};
            if ($.trim(email) == '') {
                alert('Bạn chưa nhập Email!');
                return false;
            }

            if ($.trim(password) == '') {
                alert('Bạn chưa nhập Mật khẩu');
                return false;
            }
            $.ajax({
                url: "{{route('user_login_ajax')}}",
                data: data,
                method: "POST",
                dataType: "json",
                success: function (data) {
                    if (data.error) {
                        $('.form-error-header').html("<div class='alert alert-danger' role='alert'>" + data.error + "</div>");
                    }
                    if (data.success) {
                        window.location.href = "{{ route('user_account')}}";
                    }
                }
            });
        });

    });
</script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

        function delay(callback, ms) {
            var timer = 0;
            return function () {
                var context = this, args = arguments;
                clearTimeout(timer);
                timer = setTimeout(function () {
                    callback.apply(context, args);
                }, ms || 0);
            };
        }

        $("#searchs").keyup(delay(function (e) {
            var keyword = document.getElementById('searchs').value;
            $.ajax({
                url: "{{route('autotypeahead')}}",
                type: "post",
                dataType: "json",
                data: {
                    data: keyword,
                },
                success: function (data) {
                    var dt = data.html;
                    $('.ajax-search-result').html('');
                    let result = dt.replaceAll("src_dt", "src");
                    $('.ajax-search-result').append(result);
                },
            })
            document.getElementById("ajax-search").style.display = "block";
        }, 200));
        $("#select_cat").on("change", function () {
            location.replace('/san-pham/' + this.value);
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.menucontent').hover(function () {
            if (($(this).hasClass("loaded") == false)) {
                $(this).addClass("loaded");
                var id = $(this).find('.ajaxsubmenu').attr('get-id');
                var menu = $(this).find('.ajaxsubmenu').attr('get-menu');
                var data = {
                    id: id,
                    menu: menu
                };
                $.ajax({
                    url: "{{route('menucontent')}}",
                    type: "post",
                    dataType: "json",
                    async: false,
                    data: data,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        var template_menu_lv2_desktop = $('#template_menu_lv2_desktop').html();
                        var template_menu_lv3_desktop = $('#template_menu_lv3_desktop').html();
                        var template_menu_lv4_desktop = $('#template_menu_lv4_desktop').html();
                        $.each(data, function (k, v) {
                            if (v.depth == 1) {
                                var tmp_clone_lv2 = $(template_menu_lv2_desktop).clone();
                                $(tmp_clone_lv2).find('a').html(v.label);
                                $(tmp_clone_lv2).find('a').attr('href', v.link);
                                $(tmp_clone_lv2).find('.tmp_lv3 ul').attr('id', 'item_menu_'+v.id);
                                $("#subid-" + id).append(tmp_clone_lv2);
                            }
                            else if(v.depth == 2){
                                var tmp_clone_lv3 = $(template_menu_lv3_desktop).clone();
                                $(tmp_clone_lv3).find('.label_menu').html(v.label);
                                $(tmp_clone_lv3).find('a').attr('href', v.link);
                                $(tmp_clone_lv3).find('.parent_lv3').attr('id', 'item_menu_'+v.id);
                                $("#item_menu_" + v.parent).append(tmp_clone_lv3);
                            }
                            else{
                                var tmp_clone_lv4 = $(template_menu_lv4_desktop).clone();
                                $(tmp_clone_lv4).find('a').html(v.label);
                                $(tmp_clone_lv4).find('a').attr('href', v.link);
                                $("#item_menu_" + v.parent+" ul").append(tmp_clone_lv4);
                                if($('#item_menu_' + v.parent+ " .submenu-child").hasClass('d-none')){
                                    $('#item_menu_' + v.parent + ' .next-right').removeClass('d-none');
                                    $('#item_menu_' + v.parent+ " .submenu-child").removeClass('d-none')
                                }
                            }
                        });
                    },
                })
            }
        });
        $("#pills-2-tab").on("click", function () {
            if (($("#pills-2").hasClass("loaded") == false)) {
                var _token = $('meta[name="csrf-token"]').attr('content');
                var data = {
                    _token: _token
                };
                $.ajax({
                    url: "{{route('menucontent')}}",
                    type: "post",
                    dataType: "json",
                    data: data,
                    success: function (data) {
                        $("#pills-2").append(data);
                    },
                })
                $("#pills-2").addClass("loaded");
            }
        });
    });
</script>
</body>

</html>
