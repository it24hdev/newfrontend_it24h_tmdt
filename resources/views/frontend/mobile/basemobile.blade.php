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
<div class="col-12 contentt" style="z-index: 1">
    @yield('header_mobile')
    @yield('content')
    @yield('footer')
</div>
<div>
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
<!-- javascript -->
    <script src="{{ asset('lib/jquery360.min.js') }}"></script>
    <script src="{{ asset('asset/lib/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('asset/lib/OwlCarousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('asset/js/mobile.js') }}"></script>
    <script type="text/javascript">
        var base_url = '{{route('user')}}';
    </script>
<script>
    $(document).ready(function (){
        var _token = $('meta[name="csrf-token"]').attr('content');
        // an hien danh muc khi chon menu
        var template_menu_parent = $('#template-menu-parent').html();
        var template_menu_child = $('#template-menu-child').html();
        var template_chose_label_img_menu = $('#template_chose_label_img_menu').html();
        // var item_label_img1 = $(template_chose_label_img_menu).clone();
        // var template_menu_child1 = $(template_menu_child).clone();
        // console.log(template_menu_child1,item_label_img1);
        $(document).on('click', '#menubar , #menubar2', function (){
            if ($('.menu-mobile').hasClass('active_mn')) {
                $('.menu-mobile').removeClass('active_mn');
            }
            else {
                if(!$('.menu-mobile').hasClass('loaded')){
                    var data = {
                        _token: _token
                    };
                    $.ajax({
                        url: base_url+"/get_menu_mobile",
                        type: "post",
                        dataType: "json",
                        data: data,
                        success: function (data) {
                            // them memu cha
                            var str = '';
                            $.each(data.menu_mobile, function(k,v) {
                                var item = $(template_menu_parent).clone();
                                $(item).find('.label-menu-tree').attr('get-id',v.id);
                                if(v.id == data.current_parent.id){
                                    $(item).find('.label-menu-tree').addClass('active')
                                }
                                var img_name = v.img_cat;
                                var imageUrl = 'url({{ URL::asset('upload/images/products/thumb/img_name')}})';
                                imageUrl = imageUrl.replace('img_name', img_name);
                                $(item).find('.icons-cate').css('background-image',imageUrl);
                                $(item).find('.name_menu').html(v.label);
                                str += item.html();
                            });
                            $('#menu_mobile').append(str);

                            // them menu con
                            $('.box-title__title').attr('href',data.current_parent.link);
                            $('.box-title__title').html(data.current_parent.label);
                            $('.box-title__btn-show-all').attr('href',data.current_parent.link);
                            var str2 = '';
                            $.each(data.child, function(k,v) {
                                var item = $(template_menu_child).clone();
                                var item_label_img = $(template_chose_label_img_menu).clone();

                                // $(item_label_img).find('.sss .name_li').append('dsaf');
                                // console.log(template_chose_label_img_menu,item_label_img);
                                if(v.parent == data.current_parent.id){
                                    $(item).find('.group-title').html(v.label);
                                    var str3='';
                                    $.each(data.child2, function(k2,v2) {
                                        if(v2.parent == v.id){
                                            $(item).find('.label-wrapper').attr('href',v2.link);

                                            if(v2.img_caption == 0){
                                                $(item_label_img).find('.img_li').addClass('d-none');
                                                $(item_label_img).find('.name_li').html(v2.label);
                                                var strr = item_label_img.html();
                                                $(item).find('.label-item').append(strr);
                                            }
                                            else if(v2.img_caption == 1){
                                                if(v2.img_brand!=null && v2.filter_by == 3){
                                                    var img_name = v.img_brand;
                                                    var imageUrl ='{{ URL::asset('upload/images/products/thumb/img_name')}}';
                                                    imageUrl = imageUrl.replace('img_name', img_name);
                                                    $(item_label_img).find('.img_li').attr('src',imageUrl);
                                                    $(item_label_img).find('.name_li').addClass('d-none');
                                                    var strr = item_label_img.html();
                                                    $(item).find('.label-item').append(strr);
                                                }
                                                else if(v2.img_property!=null && v2.filter_by == 1){
                                                    var img_name = v.img_property;
                                                    var imageUrl = '{{ URL::asset('upload/images/products/thumb/img_name')}}';
                                                    imageUrl = imageUrl.replace('img_name', img_name);
                                                    $(item_label_img).find('.img_li').attr('src',imageUrl);
                                                    $(item_label_img).find('.name_li').addClass('d-none');
                                                    var strr = item_label_img.html();
                                                    $(item).find('.label-item').append(strr);
                                                }
                                                else{
                                                    if(v2.img_cat != 'no-images.jpg'){
                                                        var img_name = v.img_cat;
                                                        var imageUrl = '{{ URL::asset('upload/images/products/thumb/img_name')}}';
                                                        imageUrl = imageUrl.replace('img_name', img_name);
                                                        $(item_label_img).find('.img_li').attr('src',imageUrl);
                                                        $(item_label_img).find('.name_li').addClass('d-none');
                                                        var strr = item_label_img.html();
                                                        $(item).find('.label-item').append(strr);
                                                    }
                                                }
                                            }
                                            else{

                                                if(v2.img_brand!=null && v2.filter_by == 3){
                                                    var img_name = v.img_brand;
                                                    var imageUrl = '{{ URL::asset('upload/images/products/thumb/img_name')}}';
                                                    imageUrl = imageUrl.replace('img_name', img_name);
                                                    $(item_label_img).find('.img_li').attr('src',imageUrl);
                                                    $(item_label_img).find('.name_li').html(v2.label);
                                                    var strr = item_label_img.html();
                                                    $(item).find('.label-item').append(strr);

                                                }
                                                else if(v2.img_property!=null && v2.filter_by == 1){
                                                    var img_name = v.img_property;
                                                    var imageUrl = '{{ URL::asset('upload/images/products/thumb/img_name')}}';
                                                    imageUrl = imageUrl.replace('img_name', img_name);
                                                    $(item_label_img).find('.img_li').attr('src',imageUrl);
                                                    $(item_label_img).find('.name_li').html(v2.label);
                                                    var strr = item_label_img.html();
                                                    $(item).find('.label-item').append(strr);
                                                }
                                                else{

                                                    if(v2.img_cat != 'no-images.jpg'){
                                                        var img_name = v.img_cat;
                                                        var imageUrl = '{{ URL::asset('upload/images/products/thumb/img_name')}}';
                                                        imageUrl = imageUrl.replace('img_name', img_name);
                                                        $(item_label_img).find('.img_li').attr('src',imageUrl);
                                                    }
                                                    $(item_label_img).find('.name_li').html(v2.label);
                                                    var strr = item_label_img.html();
                                                    $(item).find('.label-item').append(strr);

                                                }
                                            }
                                            // str3 += item_label_img.html();

                                        }
                                    });

                                    // $(item).find('.label-item').html(str3);
                                }
                                if(v.id == data.current_parent.id){
                                    $(item).find('.label-menu-tree').addClass('active')
                                }
                                var img_name = v.img_cat;
                                var imageUrl = 'url({{ URL::asset('upload/images/products/thumb/img_name')}})';
                                imageUrl = imageUrl.replace('img_name', img_name);
                                $(item).find('.icons-cate').css('background-image',imageUrl);
                                $(item).find('.name_menu').html(v.label);
                                str2 += item.html();
                            });
                            $('#menu_mobile_child').append(str2);

                            var colors2 = ['#ff8d508f', '#ffb5508f', '#ffee508f','#e0ff508f','#6eff508f','#50ffb380','#5089ff80','#5069ff80','#9050ff80',
                                '#e150ff80','#ff50ed80','#ff50b480','#ff507480','#fb386080','#ff16458f'];
                            $('.label-menu-tree').each(function (){
                                var firts_color = colors2[0];
                                colors2.splice($.inArray(firts_color, colors2), 1);
                                $(this).css("background-color", firts_color);
                            })
                            $('.menu-mobile').addClass('loaded');
                            $('.menu-mobile').addClass('active_mn');
                        }
                    });
                }
                else{
                    $('.menu-mobile').addClass('active_mn');
                }
            }
        });
        // load menu con khi chon menu cha mobile
        $(document).on('click', '.label-menu-tree', function (){
            var id = $(this).attr('get-id');
            var data = {
                id: id,
                _token: _token
            };
            $('.label-menu-tree').removeClass('active');
            $(this).addClass('active');
            $.ajax({
                url: base_url+"/get_menu_child",
                type: "post",
                dataType: "json",
                data: data,
                success: function (data) {
                    $('#menu_mobile_child').html('');
                    $('#menu_mobile_child').append(data.menu_mobile_child);
                }
            })
        });
    })
</script>
    @yield('js')
</body>

</html>
