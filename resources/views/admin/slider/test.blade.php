<!DOCTYPE html>
<html lang="en" class="light">
<!-- BEGIN: Head -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Rubick admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Rubick Admin Template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - Rubick - Tailwind HTML Admin Template</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->
<body class="main">
    <div class="container-fluid">
        <div style="background: #8000ff;width: 100%;height: 500px"></div>
        @foreach($cate as $item)
            <div style="margin-top: 15px">
                <div id="category-{{$item->id}}">
                    <h2>{{$item->name}}</h2>
                </div>
                <div id="list-product-{{$item->id}}">
                    <div class="row" id="{{$item->id}}">
                        {{--                    <div class="col-md-3">--}}
                        {{--                        <div class="card" style="width: 18rem;">--}}
                        {{--                            <img src="{{asset('upload/images/common_img/no-images.jpg')}}" class="card-img-top" alt="...">--}}
                        {{--                            <div class="card-body">--}}
                        {{--                                <h5 class="card-title">Card title</h5>--}}
                        {{--                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                    </div>--}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
<!-- BEGIN: JS Assets-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@17.8.2/dist/lazyload.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>

        function isOnScreen(elem) {
            // if the element doesn't exist, abort
            if( elem.length == 0 ) {
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

        function laySpHotDanhMucNoiBat(id) {
            // Hura.Ajax.get('product', { type: '', show: 30, category : id , sort : 'order'}).then(function(data){
            //     let response = JSON.parse(data);
            //     //console.log(data);
            //     let item_list = transformProductList(response.list);
            //     if(response.total > 0) {
            //         var html = Hura.Template.parse(product_template, item_list);
            //         Hura.Template.render("#featured-cate-"+id, html);
            //         ajaxSlider(".js-productslide-cate" + id);
            //         if($("#category-"+ id + " .p-component").hasClass("loaded")==false){
            //             layicon("#category-"+ id + " .p-component");
            //         }
            //     }
            // });
            var _token = $('meta[name="csrf-token"]').attr('content');
            var data = {
                id: id,
                _token: _token
            };
            $.ajax({
                url:"{{route('slider.getdata')}}",
                type:"post",
                dataType:"json",
                data: data,
                success: function (data) {
                    // console.log(data);
                    var product = '';
                    $.each(data,function (i, item) {
                        product += '<div class="col-md-3">' +
                            '<div class="card" style="width: 18rem;">' +
                            '<img class="lazy" src="" style="width:286px;height:191px" data-src="{{asset('upload/images/post/')}}'+'/'+item.thumb+'" class="card-img-top">' +
                            '<div class="card-body">' +
                            '<h5 class="card-title">'+item.title+'</h5>'+
                            '</div> </div> </div>'
                    })
                    $('#'+id).append(product);
                },


            })
        }


        var list_product = [];
        list_product.push('1');
        list_product.push('2');
        list_product.push('3');
        list_product.push('4');
        list_product.push('5');
        list_product.push('6');
        list_product.push('7');

        function runOnScroll() {
            //var win_scroll_top = $(window).scrollTop();
            //var win_height = $(window).height();

            //lay sp hot theo danh muc noi bat
            list_product.forEach(function(category_id) {
                if (isOnScreen($("#category-"+ category_id)) && ($("#category-"+ category_id).hasClass("loaded") == false)) {
                    laySpHotDanhMucNoiBat(category_id);
                    
                    $("#category-"+ category_id).addClass("loaded");

                }
            });
        loadimg();
        }

        function loadimg(){

            var lazyloadImages = document.querySelectorAll('img.lazy');
           
            lazyloadImages.forEach(function (img) {
            img.src = img.dataset.src;
            img.classList.remove('lazy');
            });
        }

        $(document).ready(function () {
            $(window).scroll(runOnScroll);
        })
    </script>
<!-- END: JS Assets-->
</body>
</html>
