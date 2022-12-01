$(document).ready(function () {

    var _token = $('meta[name="csrf-token"]').attr('content');
    //doi mau cho danh muc
    var colors =  ['#ff8d508f', '#ffb5508f', '#ffee508f','#e0ff508f','#6eff508f','#50ffb380','#5089ff80','#5069ff80','#9050ff80',
                                '#e150ff80', '#ff50ed80', '#ff50b480', '#ff507480',  '#fb386080',  '#ff16458f','#fb385080','#fb385080','#ff50b380','#ff50ed70','#e150ff70','#9050ff70','#5069ff70','#5089ff70','#50ffb370','#6eff408f','#e0ff408f','#ffee408f','#ffb5408f','#ff8d408f'];

    $('.item-categories').each(function (){
        var firts_color = colors[0];
        colors.splice($.inArray(firts_color, colors), 1);
        $(this).css("background-color", firts_color);
    })

    // slider banner
    $('#slider-show').owlCarousel({
        autoplay: true,
        autoplayHoverPause: true,
        loop: true,
        center: true,
        margin: 5,
        stagePadding: true,
        nav: true,
        dots: true,
        mouseDrag: true,
        touchDrag: true,
        lazyLoad: true,
        responsive: {
            0: {
                items: 1
            },
        }
    });

    // chon san pham yeu thich
    $(document).on('click', '.add-wish', function(){
        var id  =  $(this).attr('get-id');
        var x = this;
        var data = {
            id: id,
            _token: _token
        };
        $.ajax({
            url: base_url+"/add-wish",
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function (data) {
                $(x).html('');
                $(x).append("<i class='fas fa-heart heart_red'></i>");
                $('#count-wish').text(data.count_wish);
            }
        });
    });

    // them san pham vao gio hang
    $(document).on('click', '.add-cart', function(){
        var id  =  $(this).attr('get-id');
        var x = this;
        var data = {
            id: id,
            _token: _token
        };
        $.ajax({
            url: add_cart_ajax,
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function (data) {
                $('#count-cart').text(data.count);
                $('#count-cart2').text(data.count);
                var x = document.getElementById("snackbar");
                x.className = "show";
                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
            }
        });
    });

    //su kien load noi dung khi cuon toi truoc vung load noi dung
    function isOnScreen(elem) {
        if (elem.length == 0) {
            return;
        }
        var $window = jQuery(window)
        var viewport_top = $window.scrollTop() //vị trí đang scroll
        var viewport_height = $window.height()  // chiều cao màn hình
        var viewport_bottom = viewport_top + viewport_height
        var $elem = jQuery(elem)
        var top = $elem.offset().top - 400
        var height = $elem.height()
        var bottom = top + height + 400

        return (top >= viewport_top && top < viewport_bottom) ||
            (bottom > viewport_top && bottom <= viewport_bottom) ||
            (height > viewport_height && top <= viewport_top && bottom >= viewport_bottom)
    }

    //lay thoi gian cho hot sale
    var time = $('#timesale').attr('get-time-sale');
    var countDownDate = new Date(time).getTime();
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
                document.getElementById("d").innerHTML = days+'d';
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

    // lay sp moi
    function lay_sp_moi() {
        var data = {
            _token: _token
        };
        $.ajax({
            url: get_new_mobile,
            type: "post",
            dataType: "json",
            data: data,
            success: function (data) {
                var template_product_mobile = $('#template_product_mobile').html();
                $.each(data.data_product_mobile, function(k,v) {
                    var tmp = $(template_product_mobile).clone();
                    if(v.year != null && v.year != ''){
                        $(tmp).find('.years2').removeClass('d-none');
                        $(tmp).find('.years2').html(v.year);
                    }
                    if(v.installment != null && v.installment != '' && v.installment != 0){
                        $(tmp).find('.payment2').removeClass('d-none');
                    }
                    if(v.img_brands != null && v.img_brands != ''){
                        var url_img_brands = img_product_mobile;
                        $(tmp).find('.dbrand2').removeClass('d-none');
                        img = 'url('+url_img_brands+')';
                        img = img.replace('img_name', v.img_brands);
                        $(tmp).find('.dbrand2').css('background-image',img);
                    }
                    detailproduct = detailproduct.replace('slug_code', v.slug);
                    $(tmp).find('.p-img a').attr('href',detailproduct);
                    var url_img_product = img_product_mobile;
                    url_img_product = url_img_product.replace('img_name', v.thumb);
                    $(tmp).find('.p-img img').attr('src',url_img_product);
                    $(tmp).find('.p-info a').attr('href',detailproduct);
                    $(tmp).find('.p-name').html(v.name);
                    if(v.onsale != null && v.onsale != ''){
                        $(tmp).find('.price_p').removeClass('d-none');
                        var price = new Intl.NumberFormat().format(v.price);
                        var price_onsale = new Intl.NumberFormat().format(v.price_onsale);
                        $(tmp).find('.promotion2 .pprice2').html(price+' đ');
                        $(tmp).find('.promotion2 .dpercent2').html('- '+v.onsale+'%');
                        $(tmp).find('.price_p .p-price').html(price_onsale+' đ');
                    }
                    else{
                        var prices = new Intl.NumberFormat().format(v.price);
                        $(tmp).find('.price_p_2').removeClass('d-none');
                        $(tmp).find('.price_p_2 .p-price').html(prices+' đ');
                    }
                    $(tmp).find('.rating-upper').css('width', v.count_vote+'%');
                    if(v.sold != null && v.sold != ''){
                        $(tmp).find('.sold2').removeClass('d-none');
                        $(tmp).find('.sold2 span').html('Đã bán '+v.sold);
                    }
                    if(v.quantity - v.sold > 0){
                        $(tmp).find('.qty').html('Còn hàng');
                        $(tmp).find('.qty').css({"color":"#01aa42", "background-color": "#dbf8e1"});
                    }
                    else{
                        $(tmp).find('.qty').html('Hết hàng');
                        $(tmp).find('.qty').css({"color":"#ffffff", "background-color": "#fb0000"});
                    }
                    $(tmp).find('.add-wish').attr('get-id',v.id);
                    if($.inArray(''+v.id+'',v.list_wish) > -1){
                        $(tmp).find('.action .add-wish .like').addClass('fas fa-heart heart_red');
                    }
                    else{
                        $(tmp).find('.action .add-wish .like').addClass('far fa-heart');
                    }
                    $(tmp).find('.add-cart').attr('get-id',v.id);
                    $('#load_promotion').append(tmp.html());
                    // $('#list_products_' + id).append(tmp.html());
                })
            }
        })
    }

    // click chon san pham moi
    $(document).on('click', '#new_p', function (){
        var data = {
            _token: _token
        };
        $.ajax({
            url: get_new_mobile,
            type: "post",
            dataType: "json",
            data: data,
            success: function (data) {
                $('#load_promotion').html('');
                var template_product_mobile = $('#template_product_mobile').html();
                get_list_product(data.data_product_mobile, template_product_mobile,'#load_promotion');
            }
        })
    });

    // click chon san pham hot
    $(document).on('click', '#hot_p', function (){
        var data = {
            _token: _token
        };
        $.ajax({
            url: get_hot_sale_mobile,
            type: "post",
            dataType: "json",
            data: data,
            success: function (data) {
                $('#load_promotion').html('');
                var template_product_mobile = $('#template_product_mobile').html();
                get_list_product(data.data_product_mobile, template_product_mobile,'#load_promotion');
            }
        })
    });

    var list_product = [];
    var list_cat_1 = $('#categories_p').attr('list-cat');
    var list_cat = String(list_cat_1);
    var cat_ids = list_cat.split(' ');
    cat_ids.forEach(function (element) {
        list_product.push(element);
    });

    // lay san pham
    function laySp(category_id) {
        var id = category_id;
        var data = {
            id: category_id,
            _token: _token
        };
        $.ajax({
            url: get_product_mobile,
            type: "post",
            dataType: "json",
            data: data,
            success: function (data) {
                var template_child_categories = $('#template_child_categories').html();
                var template_product_mobile = $('#template_product_mobile').html();
                $.each(data.list_cat_childs, function(k,v) {
                    var tmp = $(template_child_categories).clone();
                    $url = '';
                    $url = product_cat.replace('slug_code', v.slug);
                    $(tmp).find('a').html(v.name);
                    $(tmp).find('a').attr('href',$url);
                    $('#list_tag_' + id).append(tmp.html());
                })
                get_list_product(data.data_product_mobile, template_product_mobile,'#list_products_'+id);
            }
        })
    }

    // ham template san pham
    function get_list_product(data,template, id_append){
        $.each(data, function(k,v) {
            var tmp = $(template).clone();
            if(v.year != null && v.year != ''){
                $(tmp).find('.years2').removeClass('d-none');
                $(tmp).find('.years2').html(v.year);
            }
            if(v.installment != null && v.installment != '' && v.installment != 0){
                $(tmp).find('.payment2').removeClass('d-none');
            }
            if(v.img_brands != null && v.img_brands != ''){
                var url_img_brands = img_product_mobile;
                $(tmp).find('.dbrand2').removeClass('d-none');
                img = 'url('+url_img_brands+')';
                img = img.replace('img_name', v.img_brands);
                $(tmp).find('.dbrand2').css('background-image',img);
            }
            detailproduct = detailproduct.replace('slug_code', v.slug);
            $(tmp).find('.p-img a').attr('href',detailproduct);
            var url_img_product = img_product_mobile;
            url_img_product = url_img_product.replace('img_name', v.thumb);
            $(tmp).find('.p-img img').attr('src',url_img_product);
            $(tmp).find('.p-info a').attr('href',detailproduct);
            $(tmp).find('.p-name').html(v.name);
            if(v.onsale != null && v.onsale != ''){
                $(tmp).find('.price_p').removeClass('d-none');
                var price = new Intl.NumberFormat().format(v.price);
                var price_onsale = new Intl.NumberFormat().format(v.price_onsale);
                $(tmp).find('.promotion2 .pprice2').html(price+' đ');
                $(tmp).find('.promotion2 .dpercent2').html('- '+v.onsale+'%');
                $(tmp).find('.price_p .p-price').html(price_onsale+' đ');
            }
            else{
                var prices = new Intl.NumberFormat().format(v.price);
                $(tmp).find('.price_p_2').removeClass('d-none');
                $(tmp).find('.price_p_2 .p-price').html(prices+' đ');
            }
            $(tmp).find('.rating-upper').css('width', v.count_vote+'%');
            if(v.sold != null && v.sold != ''){
                $(tmp).find('.sold2').removeClass('d-none');
                $(tmp).find('.sold2 span').html('Đã bán '+v.sold);
            }
            if(v.quantity - v.sold > 0){
                $(tmp).find('.qty').html('Còn hàng');
                $(tmp).find('.qty').css({"color":"#01aa42", "background-color": "#dbf8e1"});
            }
            else{
                $(tmp).find('.qty').html('Liên hệ');
                $(tmp).find('.qty').css({"color":"#337bff", "background-color": "#dbe9f8"});
            }
            $(tmp).find('.add-wish').attr('get-id',v.id);
            if($.inArray(''+v.id+'',v.list_wish) > -1){
                $(tmp).find('.action .add-wish .like').addClass('fas fa-heart heart_red');
            }
            else{
                $(tmp).find('.action .add-wish .like').addClass('far fa-heart');
            }
            $(tmp).find('.add-cart').attr('get-id',v.id);
            $(id_append).append(tmp.html());
        })
    }
    //memu
    var template_menu_parent = $('#template-menu-parent').html();
    $(document).on('click', '#menubar , #menubar2', function (){
        if ($('.menu-mobile').hasClass('active_mn')) {
            $('.menu-mobile').removeClass('active_mn');
            $('body').removeClass('disable_scoll');
        }
        else {
            $('body').addClass('disable_scoll');
            $('.menu-mobile').addClass('active_mn');
            if(!$('.menu-mobile').hasClass('loaded')){
                var data = {
                    _token: _token
                };
                $.ajax({
                    url: get_menu_mobile,
                    type: "post",
                    dataType: "json",
                    data: data,
                    success: function (data) {
                        // cap 1
                        $.each(data.menu_mobile, function(k,v) {
                            var item = $(template_menu_parent).clone();
                            $(item).find('.label-menu-tree').attr('get-id',v.id);
                            if(v.id == data.current_parent.id){
                                $(item).find('.label-menu-tree').addClass('active')
                            }
                            var img_name = v.img_cat;
                            var imageUrl = 'url('+img_category+')';
                            if(img_name !=null && img_name !=''){

                                imageUrl = imageUrl.replace('img_name', img_name);
                            }
                            else{
                                imageUrl = imageUrl.replace('img_name', 'no-images.jpg');
                            }
                            $(item).find('.icons-cate').css('background-image',imageUrl);
                            $(item).find('.name_menu').html(v.label);
                            $('#menu_mobile').append(item.html());
                        });
                        //menu cap 2 3 4
                        load_child_menu(data.current_parent, data.child, data.child2);
                    }
                });
                $('.menu-mobile').addClass('loaded');
            }
            else{
                $('.menu-mobile').addClass('active_mn');
            }
        }
    });

    //ham load menu con
    function load_child_menu(menu_level2, menu_level3, menu_level4){
        // cap 2
        $('.box-title__title').attr('href',menu_level2.link);
        $('.box-title__title').html(menu_level2.label);
        $('.box-title__btn-show-all').attr('href',menu_level2.link);
        var template_menu_child = $('#template-menu-child').html();
        var template_chose_label_img_menu = $('#template_chose_label_img_menu').html();
        //cap 3
        $.each(menu_level3, function(k,v) {
            var item = $(template_menu_child).clone();
            if(v.parent == menu_level2.id){
                $(item).find('.group-title').html(v.label);
                //cap 4
                $.each(menu_level4, function(k2,v2) {
                    var item_label_img = $(template_chose_label_img_menu).clone();
                    if(v2.parent == v.id){
                        $(item_label_img).find('.label-wrapper').attr('href',v2.link);
                        if(v2.img_caption == 0){
                            $(item_label_img).find('.label-item>img').remove();
                            $(item_label_img).find('.label-item span').html(v2.label);
                            $(item).find('.menu-item').append(item_label_img.html());
                        }
                        else if(v2.img_caption == 1){
                            if(v2.img_brand!=null && v2.filter_by == 3){
                                var img_name = v2.img_brand;
                                var imageUrl = img_brands;
                                if(img_name != null && img_name != ''){
                                    imageUrl = imageUrl.replace('img_name', img_name);
                                }
                                else{
                                    imageUrl = imageUrl.replace('img_name', 'no-images.jpg');
                                }
                                $(item_label_img).find('.label-item img').attr('src',imageUrl);
                                $(item_label_img).find('.label-item>span').remove();
                                $(item).find('.menu-item').append(item_label_img.html());
                            }
                            else if(v2.img_property!=null && v2.filter_by == 1){
                                var img_name = v2.img_property;
                                var imageUrl = img_detailproperties;
                                if(img_name != null && img_name != ''){
                                    imageUrl = imageUrl.replace('img_name', img_name);
                                }
                                else{
                                    imageUrl = imageUrl.replace('img_name', 'no-images.jpg');
                                }
                                $(item_label_img).find('.label-item img').attr('src',imageUrl);
                                $(item_label_img).find('.label-item>span').remove();
                                $(item).find('.menu-item').append(item_label_img.html());
                            }
                            else{
                                if(v2.img_cat != 'no-images.jpg'){
                                    var img_name = v2.img_cat;
                                    var imageUrl = img_category;
                                    if(img_name != null && img_name != ''){
                                        imageUrl = imageUrl.replace('img_name', img_name);
                                    }
                                    else{
                                        imageUrl = imageUrl.replace('img_name', 'no-images.jpg');
                                    }
                                    $(item_label_img).find('.label-item img').attr('src',imageUrl);
                                    $(item_label_img).find('.label-item span').remove();
                                    $(item).find('.menu-item').append(item_label_img.html());
                                }
                            }
                        }
                        else{
                            if(v2.img_brand!=null && v2.filter_by == 3){
                                var img_name = v2.img_brand;
                                var imageUrl = img_brands;
                                if(img_name != null && img_name != ''){
                                    imageUrl = imageUrl.replace('img_name', img_name);
                                }
                                else{
                                    imageUrl = imageUrl.replace('img_name', 'no-images.jpg');
                                }
                                $(item_label_img).find('.label-item img').attr('src',imageUrl);
                                $(item_label_img).find('.label-item span').html(v2.label);
                                $(item).find('.menu-item').append(item_label_img.html());

                            }
                            else if(v2.img_property!=null && v2.filter_by == 1){
                                var img_name = v2.img_property;
                                var imageUrl = img_detailproperties;
                                if(img_name != null && img_name != ''){
                                    imageUrl = imageUrl.replace('img_name', img_name);
                                }
                                else{
                                    imageUrl = imageUrl.replace('img_name', 'no-images.jpg');
                                }
                                $(item_label_img).find('.label-item img').attr('src',imageUrl);
                                $(item_label_img).find('.label-item span').html(v2.label);
                                $(item).find('.menu-item').append(item_label_img.html());
                            }
                            else{
                                if(v2.img_cat != 'no-images.jpg'){
                                    var img_name = v2.img_cat;
                                    var imageUrl = img_category;
                                    if(img_name != null && img_name != ''){
                                        imageUrl = imageUrl.replace('img_name', img_name);
                                    }
                                    else{
                                        imageUrl = imageUrl.replace('img_name', 'no-images.jpg');
                                    }
                                    $(item_label_img).find('.label-item img').attr('src',imageUrl);
                                }
                                $(item_label_img).find('.label-item span').html(v2.label);
                                $(item).find('.menu-item').append(item_label_img.html());
                            }
                        }
                    }
                });
            }
            if(v.id == menu_level2.id){
                $(item).find('.label-menu-tree').addClass('active')
            }
            var img_name = v.img_cat;
            var imageUrl = 'url('+img_category+')';
            if(img_name != null && img_name != ''){
                imageUrl = imageUrl.replace('img_name', img_name);
            }
            else{
                imageUrl = imageUrl.replace('img_name', 'no-images.jpg');
            }
            $(item).find('.icons-cate').css('background-image',imageUrl);
            $(item).find('.name_menu').html(v.label);
            $('#menu_mobile_child').append(item.html());
        });

        var colors2 = ['#ff8d508f', '#ffb5508f', '#ffee508f','#e0ff508f','#6eff508f','#50ffb380','#5089ff80','#5069ff80','#9050ff80',
            '#e150ff80', '#ff50ed80', '#ff50b480', '#ff507480',  '#fb386080',  '#ff16458f','#fb385080','#fb385080','#ff50b380','#ff50ed70','#e150ff70','#9050ff70','#5069ff70','#5089ff70','#50ffb370','#6eff408f','#e0ff408f','#ffee408f','#ffb5408f','#ff8d408f'];
        $('.label-menu-tree').each(function (){
            var firts_color = colors2[0];
            colors2.splice($.inArray(firts_color, colors2), 1);
            $(this).css("background-color", firts_color);
        })
    }
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
            url: get_menu_child,
            type: "post",
            dataType: "json",
            data: data,
            success: function (data) {
                $('#menu_mobile_child').html('');
                // menu cap 2 3 4
                load_child_menu(data.current_parent, data.child, data.child2);
            }
        })
    });

    //len dau trang
    $(document).on("click",'#go_top',function(){
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    })

    // su kien cuon man hinh
    function runOnScroll() {
        // an hien thanh tim kiem khi cuon
        if(jQuery(window).scrollTop() >30){
            document.getElementById("scroll_d").style.display="block";
            document.getElementById("scroll_h").style.display="none";
            document.getElementById("go_top").style.display="block";
        }
        else{
            document.getElementById("scroll_d").style.display="none";
            document.getElementById("scroll_h").style.display="block";
            document.getElementById("go_top").style.display="none";
        }
        //load sp khuyen mai khi cuon
        if (isOnScreen($("#load_promotion")) && ($("#load_promotion").hasClass("loaded") == false)) {
            lay_sp_moi();
            $("#load_promotion").addClass("loaded");
        }

        list_product.forEach(function (category_id) {
            if (isOnScreen($("#category_product_" + category_id)) && ($("#category_product_" + category_id).hasClass("loaded") == false)) {
                laySp(category_id);
                $("#category_product_" + category_id).addClass("loaded");
            }
        });
    }

    $(window).scroll(runOnScroll);
});
