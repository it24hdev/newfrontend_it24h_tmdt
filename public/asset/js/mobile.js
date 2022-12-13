$(document).ready(function () {
    var _token = $('meta[name="csrf-token"]').attr('content');

    //================================ trang chu =============================
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

    //doi mau cho danh muc
    var colors =  ['#ff8d508f', '#ffb5508f', '#ffee508f','#e0ff508f','#6eff508f','#50ffb380','#5089ff80','#5069ff80','#9050ff80',
        '#e150ff80', '#ff50ed80', '#ff50b480', '#ff507480',  '#fb386080',  '#ff16458f','#fb385080','#fb385080','#ff50b380','#ff50ed70','#e150ff70','#9050ff70','#5069ff70','#5089ff70','#50ffb370','#6eff408f','#e0ff408f','#ffee408f','#ffb5408f','#ff8d408f'];

    $('.item-categories').each(function (){
        var firts_color = colors[0];
        colors.splice($.inArray(firts_color, colors), 1);
        $(this).css("background-color", firts_color);
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
        var top = $elem.offset().top - 1000
        var height = $elem.height()
        var bottom = top + height + 100

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
                document.getElementById("d").innerHTML = days+'N';
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
                if(!$('#load_promotion').hasClass('active')){
                    get_list_product(data.data_product_mobile, template_product_mobile,'#load_promotion');
                    $('#load_promotion').addClass('active');
                }
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
        });
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

    // click chon san pham khuyen mai
    $(document).on('click', '#promotion_p', function (){
        var data = {
            _token: _token
        };
        $.ajax({
            url: get_promotion_mobile,
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
                if(!$('#list_products_'+id).hasClass('active')){
                    get_list_product(data.data_product_mobile, template_product_mobile,'#list_products_'+id);
                    $('#list_products_'+id).addClass('active');
                }
            }
        })
    }

    // ham template san pham
    function get_list_product(data,template, id_append){
        $.each(data, function(k,v) {
            var detail_p = detailproduct;
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
            var dt_p = detail_p.replace('slug_code', v.slug);
            $(tmp).find('.p-img a').attr('href',dt_p);
            var url_img_product = img_product_mobile;
            url_img_product = url_img_product.replace('img_name', v.thumb);
            $(tmp).find('.p-img img').attr('src',url_img_product);
            $(tmp).find('.p-info a').attr('href',dt_p);
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
            if(v.quantity > 0){
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

        //load sp khuyen mai khi cuon
        if (isOnScreen($("#load_p_detail")) && ($("#load_p_detail").hasClass("loaded") == false)) {
            sptuongtu();
            $("#load_p_detail").addClass("loaded");
        }

        if (isOnScreen($("#load_p_watched")) && ($("#load_p_watched").hasClass("loaded") == false)) {
            spdaxem();
            $("#load_p_watched").addClass("loaded");
        }

        list_product.forEach(function (category_id) {
            if (isOnScreen($("#category_product_" + category_id)) && ($("#category_product_" + category_id).hasClass("loaded") == false)) {
                laySp(category_id);
                $("#category_product_" + category_id).addClass("loaded");
            }
        });
    }

    $(window).scroll(runOnScroll);

    // =========================trang danh sach san pham===============================
    $(document).on('click', '.listFilter li', function () {
        var target = $(this).attr('data-target');
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $(target).removeClass('ac');
        } else {
            $(this).addClass('active');
            $(target).addClass('ac');
        }
    });
    // chon button loc
    $(document).on("click", '#filter_by_price, .close_p', function () {
        if ($('.p_filter').hasClass('d-none')) {
            $('.p_filter').removeClass('d-none');
        } else {
            $('.p_filter').addClass('d-none');
        }
        $('.list-filter-child').removeClass('active');
    });

    // dong button loc
    $(document).on("click", '.btn-f, .btnclose', function () {
        if ($('.filterall').hasClass('active_mn')) {
            $('.filterall').removeClass('active_mn');
        } else {
            $('.filterall').addClass('active_mn');
        }
        $('.list-filter-child').removeClass('active');
        $('.p_filter').addClass('d-none');
    });

    $(document).on('click', '#submitfilter, .button_submit, #filter_price', function () {
        filter();
    });

    $(document).on('click', '#filter_price', function () {
        if (!$('#active_price').hasClass('active')) {
            $('#active_price').addClass('active')
        }
        filter();
    });

    // an hien thuoc tinh dang loc
    if (window.location.search != "") {
        $('.filtering_by').removeClass('d-none');
    }

    //xoa thuoc tinh
    $(document).on('click', '.cancel_filter', function () {
        var url = $(this).attr('get-url-cancel');
        window.location = url;
    });

    //xoa gia
    $(document).on('click', '.cancel_price', function () {
        var parth = window.location.search.split('?')[1];
        var params = Object.fromEntries(new URLSearchParams(parth));
        delete params.p;
        var url2 = new URLSearchParams(params).toString();
        window.location = window.location.origin + window.location.pathname + '?' + url2;
    })

    //xoa tat ca loc
    $(document).on('click', '.cancel_all', function () {
        window.location = window.location.origin + window.location.pathname;
    })

    //loc thuoc tinh con - loc theo tieu chi
    $(document).on('click', '.btn-filter-child', function () {
        if (!$('.p_filter ').hasClass('d-none')) {
            $('.p_filter ').addClass('d-none');
        }
        var target = $(this).attr('data-target');
        if ($(target).hasClass('active')) {
            $(target).removeClass('active');
        } else {
            $('.list-filter-child').removeClass('active');
            $(target).addClass('active');
        }
    });

    $(document).on('click', '.chose_f', function () {
        var target = $(this).attr('data-target');
        if ($(this).hasClass('ac')) {
            $(this).removeClass('ac');
        } else {
            $(this).addClass('ac');
            $(target).addClass('active');
        }
    })

    //dong form loc thuoc tinh con
    $(document).on('click', '.button_close', function () {
        var target = $(this).attr('data-target');
        $(target).removeClass('active');
    });

    // Sap xep
    $(document).on('click', '.btn-sort', function () {
        if ($(this).hasClass('ac')) {
            $('.btn-sort').removeClass('ac');
        } else {
            $('.btn-sort').removeClass('ac');
            $(this).addClass('ac');
        }
        filter();
        // var attr =  $(this).attr('data-target-attr');
        // var parth = window.location.search.split('?')[1];
        // const params = Object.fromEntries(new URLSearchParams(parth));
        // params.order = attr;
        // const url2 = new URLSearchParams(params).toString();
        // window.location = window.location.origin + window.location.pathname + '?' + url2;
    });

    //loc thuoc tinh
    function filter() {
        var params = new URLSearchParams();
        var arr = [];
        //thuoc tinh
        $('.listFilter .filter-wrapper').each(function (index) {
            var name_attrs = $(this).attr('get-name-attrs');
            arr = [];
            $('.filter-wrapper li').each(function (index) {
                var name_attr = $(this).attr('get-name-attr');
                if ($(this).hasClass('active')) {
                    if (name_attrs == name_attr) {
                        var attr = $(this).attr('get-attr');
                        arr.push(attr);
                    }
                }
            });
            if (arr != '')
                params.append(name_attrs, arr);
        });
        //gia
        if ($('#active_price').hasClass('active')) {
            var min_price = document.getElementsByName('min-value').value;
            var max_price = document.getElementsByName('max-value').value;
            var between = min_price + ';' + max_price;
            params.append('p', between);
        }

        if ($('.btn-sort').hasClass('ac')) {
            var attr = $('.btn-sort.ac').attr('data-target-attr');
            params.append('order', attr);
        }
        window.location = window.location.origin + window.location.pathname + '?' + params.toString();
    }

    //===============================trang chi tiet san pham====================================
    $("table").addClass('table table-striped table_border');

    //mua ngay san pham
    $(document).on('click','.add-cart-now',function(){
        console.log('cong');
        var product_id = $(this).data('id');
        var _token = $('meta[name="csrf-token"]').attr('content');
        var data = {
            product_id: product_id,
            _token: _token
        };
        $.ajax({
            url: update_shopping_cart,
            method: 'POST',
            data: data,
            dataType: "json",
            success: function(data) {
                window.location = list_cart;
            }
        });
    });

    //ham lay san pham da xem
    function spdaxem() {
        var id = $('#load_p_watched').attr('data-target');
        var data = {
            _token: _token,
            id: id
        };
        $.ajax({
            url: get_product_watched,
            type: "post",
            dataType: "json",
            data: data,
            success: function (data) {
                $('#load_p_detail2').html('');
                var template_product_mobile = $('#template_product_mobile').html();
                if(!$('#load_p_detail2').hasClass('active')){
                    get_list_product(data.data_product_mobile, template_product_mobile, '#load_p_detail2');
                    $('#load_p_detail2').addClass('active');
                }
            }
        })
    }
    //ham lay san pham da xem
     function sptuongtu(){
         var slug = $('#load_p_similar').attr('data-target');
        var data = {
            _token: _token,
            slug: slug
        };
        $.ajax({
            url: get_product_similar,
            type: "post",
            dataType: "json",
            data: data,
            success: function (data) {
                $('#load_p_detail').html('');
                var template_product_mobile = $('#template_product_mobile').html();
                if(!$('#load_p_detail').hasClass('active')){
                    get_list_product(data.data_product_mobile, template_product_mobile,'#load_p_detail');
                    $('#load_p_detail').addClass('active');
                }
            }
        })
    }

    //xem them
    $(document).on('click', '.btn_view_content_all', function () {
        $(this).addClass('d-none');
        $('#des_show').css({"max-height":"6000px","overflow-y":"auto"});
    });
    $(document).on('click', '.btn_review', function () {
        $('#author_customer_review').val('');
        $('#contact_customer_review').val('');
        $('#comment_customer_review').val('');
        $('.modal-review').removeClass('d-none');
        $('body').addClass('disable_scoll');
    });
    $(document).on('click', '#close-review', function () {
        $('.modal-review').addClass('d-none');
        $('body').removeClass('disable_scoll');
    });
    $(document).on('click', '.btn_view_detail_p', function () {
        $('.modal-tskt').removeClass('d-none');
        $('body').addClass('disable_scoll');
    });

    $(document).on('click', '.bnt-close-tskt', function () {
        $('.modal-tskt').addClass('d-none');
        $('body').removeClass('disable_scoll');
    });
    $(document).on('click', '.btn-show-more-review', function () {
        if($('.list_cm').hasClass('max_list_cm')){
            $('.list_cm').removeClass('max_list_cm');
        }
        else{
            const current_page = $(this).attr('data-target');
            const next_page = parseInt(current_page) + 1;
            var product_id = $(this).attr('data-id');
            var data = {page:next_page, product_id:product_id, _token:_token};
            $.ajax({
                url: get_review_more,
                type: "post",
                dataType: "json",
                data: data,
                success: function (data) {
                    if(data.last_page==1){
                        $('.btn-show-more-review').addClass('d-none');
                    }
                    if(data.comments.data != null){
                        var template_review_mobile = $('#template_review_mobile').html();
                        $.each(data.comments.data, function(k,v) {
                            var item = $(template_review_mobile).clone();
                            var name_user = v.name_user;
                            $(item).find('.first_k').html(name_user.substring(0, 1));
                            $(item).find('.name_c').html(name_user);
                            var time = new Date(v.created_at).toLocaleDateString();
                            $(item).find('.time_comment').html(time);
                            $(item).find('.rating-upper').css({"width":""+v.level*20+""+"%"});
                            $(item).find('.cment').html(v.comment);
                            $('.list_cm').append(item);
                        });
                        $('.btn-show-more-review').attr('data-target',next_page);
                    }
                }
            })
        }
    });

    //chon sao danh gia
    $(document).on('click', '#star1, #star2, #star3, #star4, #star5', function () {
        var value_star = $(this).val();
        $('#lb_star').html('');
        if(value_star == 5){
            $('#lb_star').html('Tuyệt vời')
        }
        if(value_star == 4){
            $('#lb_star').html('Hài lòng')
        }
        if(value_star == 3){
            $('#lb_star').html('Bình thường')
        }
        if(value_star == 2){
            $('#lb_star').html('Không hài lòng')
        }
        if(value_star == 1){
            $('#lb_star').html('Tệ')
        }
    });

    //Đánh giá và bình luận
    $(document).on('click','#submit_review',function(){
        var rating  = $(".check-rate:checked").val();
        var author  = $("#author_customer_review").val();
        var contact = $("#contact_customer_review").val();
        var comment = $("#comment_customer_review").val();
        var id      = $(this).attr('data-target');
        var _token = $('meta[name="csrf-token"]').attr('content');
        var data = {rating: rating, author: author, email:contact, comment:comment, id:id, _token:_token};
        if ($.trim(author) == ''){
            $('.rv_name').removeClass('d-none');
        }
        else{
            $('.rv_name').addClass('d-none');
        }
        if ($.trim(contact) == ''){
            $('.rv_contact').removeClass('d-none');
        }
        else{
            $('.rv_contact').addClass('d-none');
        }
        if ($.trim(comment) == ''){
            $('.rv_comment').removeClass('d-none');
        }
        else{
            $('.rv_comment').addClass('d-none');
        }
        $.ajax({
            url: commentProduct,
            method: 'POST',
            data: data,
            dataType: "json",
            success: function(data) {
                if(data.success){
                    var template_review_mobile = $('#template_review_mobile').html();
                    var tmp = $(template_review_mobile).clone();
                        if(author != ''){
                            $(tmp).find('.first_k').html(author.substring(0, 1));
                            $(tmp).find('.name_c').html(author);
                        }
                        var time =  new Date().toLocaleDateString();
                        $(tmp).find('.time_comment').html(time);
                        $(tmp).find('.rating-upper').css({"width":""+rating*20+""+"%"});
                        $(tmp).find('.cment').html(comment);
                        $('.list_cm').prepend(tmp);
                        if(!$('.modal-review').hasClass('d-none')){
                            $('.modal-review').addClass('d-none');
                        }
                    $( "#success_cm" ).fadeIn( 300 ).delay( 500 ).fadeOut( 400 );
                }
            },
        });
    });

    //thay doi anh khi chon anh con
    $(document).on('click','.ac_img_p',function(){
        let src = $(this).find('img').attr('src');
        let picture_src = src.replace(url_img_thumb_product, '');
        $('.box-ksp img').attr('src', url_img_large_product + picture_src);
        $('.ac_img_p').removeClass('active');
        $(this).addClass('active');
    });
    // ===============================trang gio hang============================
    // them san pham vao gio hang
    $(document).on('click', '.add-cart', function(){
        console.log('cong');
        var product_id  =  $(this).attr('get-id');
        var data = {
            product_id: product_id,
            status: "plus",
            _token: _token
        };
        $.ajax({
            url: update_shopping_cart,
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function (data) {
                if(data.success){
                    $('#count-cart').text(data.count);
                    $('#count-cart2').text(data.count);
                    $( "#snackbar" ).fadeIn( 300 ).delay( 500 ).fadeOut( 400 );
                }
                else{
                    $( "#snackbar_false" ).fadeIn( 300 ).delay( 500 ).fadeOut( 400 );
                }
            }
        });
    });

    count_cart();
    checkall();

    // chon tat ca san pham trong gio hang khi load trang
    function checkall(){
        $('input[name="check_cart"]').each(function(index) {
            $(this).attr('checked','true');
        });
        total_cart();
    }
    //dem so luong san pham trong gio hang
    function count_cart(){
        if($('.block-cart-product').attr('data-target')>0){
            $('.block-cart-product').removeClass('d-none');
            $('.box-bottom').removeClass('d-none');
            $('.cnt_empty_cart').addClass('d-none');
        }
        else{
            if(!$('.block-cart-product').hasClass('d-none')){
                $('.block-cart-product').addClass('d-none');
            }
            if($('.cnt_empty_cart').hasClass('d-none')){
                $('.cnt_empty_cart').removeClass('d-none');
            }
            if(!$('.box-bottom').hasClass('d-none')){
                $('.box-bottom').addClass('d-none');
            }
        }
    }

    // xoa san pham khoi gio hang
    $(document).on('click', '.cart_delete', function(){
        var product_id  =  $(this).attr('data-target');
        var data = {
            product_id: product_id,
            _token: _token
        };
        $.ajax({
            url: remove_cart_data,
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function (data) {
                if(data.success){
                    $('#count-cart').text(data.count);
                    $('#count-cart2').text(data.count);
                    $('#cart_'+product_id).remove();
                }
                total_cart();
                $('.block-cart-product').attr('data-target',data.count);
                count_cart();
            }
        });
    });
    //Cong so luong san pham
    $('.plus_cart').on('click',function(){
        console.log('cong');
        $(this).prev().val(+$(this).prev().val() + 1);
        var $t = $(this);
        var product_id  =  $(this).attr('product-id');
        var quantity  =  $(this).attr('quantity');
        var data = {
            product_id: product_id,
            quantity: quantity,
            status: "plus",
            _token: _token
        };
        $.ajax({
            url: update_shopping_cart,
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function (data) {
                if(data.success){
                    $('#count-cart').text(data.count);
                    $('#count-cart2').text(data.count);
                    $t.parent().find('.minus_cart').attr('quantity',data.quantity);
                    $t.parent().find('.plus_cart').attr('quantity',data.quantity);
                    $t.parent().find('input[name="qty_cart"]').val(data.quantity);
                    total_cart();
                }
            }
        });
    });

    //tru sl san pham
    $('.minus_cart').click('click',function(){
        if ($(this).next().val() > 1){
            var $t = $(this);
            var product_id  =  $(this).attr('product-id');
            var quantity  =  $(this).attr('quantity');
            var data = {
                product_id: product_id,
                quantity: quantity,
                status: "minus",
                _token: _token
            };
            $.ajax({
                url: update_shopping_cart,
                method: 'POST',
                data: data,
                dataType: 'json',
                success: function (data) {
                    if(data.success){
                        $('#count-cart').text(data.count);
                        $('#count-cart2').text(data.count);
                        $t.parent().find('.minus_cart').attr('quantity',data.quantity);
                        $t.parent().find('.plus_cart').attr('quantity',data.quantity);
                        $t.parent().find('input[name="qty_cart"]').val(data.quantity);
                        total_cart();
                    }
                }
            });
        }
    });
    $(document).on('change', '.check_cart', function() {
        total_cart();
    });

    //tinh tong tien tam thoi
    function total_cart(){
        let total = price = sale_price = 0;
        $('.product-item-cart').each(function(index) {
             price = $(this).find('.regular-price').attr('data-target');
             sale_price = $(this).find('.sale-price').attr('data-target');
             qty_cart = $(this).find('input[name="qty_cart"]').val();
            if($(this).find('input[name="check_cart"]').is(":checked")){
                if(sale_price !=null && sale_price!=0){
                    total = total + (sale_price*qty_cart);
                }
                else{
                    if (price !=null){
                        total = total + (price*qty_cart);
                    }
                }
            }
        });
        var total_cart = new Intl.NumberFormat().format(total);
        $('.total').html(total_cart+" đ");
    }
    // tien hanh dat hang
    $(document).on('click', '.btn-sm-cart', function(){
        list_cart_success =  [];
        $('input[name="check_cart"]').each(function(index) {
            if($(this).is(":checked")){
               var product_id = $(this).attr('data-target');
               list_cart_success.push(product_id);
            }
        });
        if(list_cart_success.length !=0){
            var data = {
                list_cart_success: list_cart_success,
                _token: _token
            };
            $.ajax({
                url: order_processing,
                method: 'POST',
                data: data,
                dataType: 'json',
                success: function (data) {
                    if(data.success){
                        window.location = checkout;
                    }
                }
            });
        }
    });

    // ==============================Thong tin dat hang==============================
    $(document).on('click', '#VAT', function(){
        if($(this).is(':checked')){
            if($('.receipt_ip').hasClass('d-none')){
                $('.receipt_ip').removeClass('d-none');
            }
        }
        else{
            $('.receipt_ip').addClass('d-none');
        }
    });
    $(document).on('click', '.btn-complte-payment', function(){
        var customer_name = $('input[name="customer_name"]').val();
        var email = $('input[name="email"]').val();
        var phone_number = $('input[name="phone_number"]').val();
        var address = $('input[name="city"]').val()+" - "+ $('input[name="district"]').val()+" - "+ $('input[name="street"]').val();
        var note = $('input[name="note"]').val();
        var payment_method = $('input[name="payment_method"]:checked').val();
        console.log(customer_name,email,phone_number,address,note,payment_method);
        var data = {
            customer_name: customer_name,
            email: email,
            phone_number: phone_number,
            address: address,
            note: note,
            payment_method: payment_method,
            _token: _token
        };
        $.ajax({
            url: complete_payment,
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function (data) {
                if(data.success){
                    window.location = successorder;
                }
            }
        });
    });
});
