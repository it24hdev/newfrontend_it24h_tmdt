
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

    //doi mau cho khuyen mai
    var colors =  ['#ff8d50', '#ffb550', '#ffee50','#e0ff50','#6eff50','#50ffb3','#5089ff','#5069ff','#9050ff',
        '#e150ff80', '#ff50ed80', '#ff50b480', '#ff507480',  '#fb386080',  '#ff16458f','#fb385080','#fb385080','#ff50b380','#ff50ed70','#e150ff70','#9050ff70','#5069ff70','#5089ff70','#50ffb370','#6eff408f','#e0ff408f','#ffee408f','#ffb5408f','#ff8d408f'];

    $('.icon_promtion_menu').each(function (){
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
        var top = $elem.offset().top - 700
        var topnow = $elem.offset().top
        var height = $elem.height()
        var bottom = top + height + 400
        var bottomnow = topnow + height
        return (top >= viewport_top && top < viewport_bottom) ||
            (bottom > viewport_top && bottom <= viewport_bottom) ||
            (height > viewport_height && top <= viewport_top && bottom >= viewport_bottom ||  viewport_top >= topnow && topnow <= bottomnow)
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

    // lay sp khuyen mai
    function lay_sp_km(active) {

        var url="";
        var data = {
            _token: _token
        };
        if(active=="new_p"){
            if(!$('#'+active).hasClass('active')){
                $('#'+active).addClass('active');
            }
            url = get_new_mobile;
        }
        else if(active=="hot_p"){
            if(!$('#'+active).hasClass('active')){
                $('#'+active).addClass('active');
            }
            url = get_hot_product;
        }
        else if(active=="promotion_p"){
            if(!$('#'+active).hasClass('active')){
                $('#'+active).addClass('active');
            }
            url = get_promotion_mobile;
        }
        else{
            if(!$('#category_promotion_'+active).hasClass('active')){
                $('#category_promotion_'+active).addClass('active');
            }
            url = get_category_promotion_mobile;
            data = {
                category_id: active,
                _token: _token
            };
        }

        $.ajax({
            url: url,
            type: "post",
            dataType: "json",
            data: data,
            success: function (data) {
                var template_product_mobile = $('#template_product_mobile').html();
                if(!$('#load_promotion').hasClass('active')){
                    get_list_product(data.data_product_mobile, template_product_mobile,'#load_promotion');
                    $('#load_promotion').addClass('active');
                    if(data.data_product_mobile.length>=6) {
                        var url = "";
                        if(active=="new_p"){
                            url = url_new_product;
                        }
                        else if(active=="hot_p"){
                            url = url_hot_product;
                        }
                        else if(active=="promotion_p"){
                            url = url_promotion_product;
                        }
                        else{
                            if(data.url_category){
                                url = product_cat;
                                url = url.replace('slug_code',data.url_category);
                            }
                        }
                        var see_more = '<div class="see_more"><a href="' + url + '"><svg enable-background="new 0 0 40 40" viewBox="0 0 40 40" role="img" class="stardust-icon stardust-icon-arrow-right-bold-circle"><circle cx="20" cy="20" fill="none" r="18.5" stroke-miterlimit="10"></circle><path d="m11.1 9.9l-9-9-2.2 2.2 8 7.9-8 7.9 2.2 2.1 9-9 1-1z" transform="translate(15 9)"></path></svg>Xem thêm</a></div>';
                        $('#load_promotion').append(see_more);
                    }
                }
            }
        })
    }

    // click chon san pham moi
    $(document).on('click', '#new_p', function (){
        $('.box_promtion_menu').removeClass('active');
        $(this).addClass('active');
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
                if(data.data_product_mobile.length>=6) {
                    var see_more = '<div class="see_more"><a href="' + url_new_product + '"><svg enable-background="new 0 0 40 40" viewBox="0 0 40 40" role="img" class="stardust-icon stardust-icon-arrow-right-bold-circle"><circle cx="20" cy="20" fill="none" r="18.5" stroke-miterlimit="10"></circle><path d="m11.1 9.9l-9-9-2.2 2.2 8 7.9-8 7.9 2.2 2.1 9-9 1-1z" transform="translate(15 9)"></path></svg>Xem thêm</a></div>';
                    $('#load_promotion').append(see_more);
                }
            }
        });
    });

    // click chon san pham hot
    $(document).on('click', '#hot_p', function (){
        $('.box_promtion_menu').removeClass('active');
        $(this).addClass('active');
        var data = {
            _token: _token
        };
        $.ajax({
            url: get_hot_product,
            type: "post",
            dataType: "json",
            data: data,
            success: function (data) {
                $('#load_promotion').html('');
                var template_product_mobile = $('#template_product_mobile').html();
                get_list_product(data.data_product_mobile, template_product_mobile,'#load_promotion');
                if(data.data_product_mobile.length>=6) {
                    var see_more = '<div class="see_more"><a href="' + url_hot_product + '"><svg enable-background="new 0 0 40 40" viewBox="0 0 40 40" role="img" class="stardust-icon stardust-icon-arrow-right-bold-circle"><circle cx="20" cy="20" fill="none" r="18.5" stroke-miterlimit="10"></circle><path d="m11.1 9.9l-9-9-2.2 2.2 8 7.9-8 7.9 2.2 2.1 9-9 1-1z" transform="translate(15 9)"></path></svg>Xem thêm</a></div>';
                    $('#load_promotion').append(see_more);
                }
            }
        })
    });

    // click chon san pham khuyen mai
    $(document).on('click', '#promotion_p', function (){
        $('.box_promtion_menu').removeClass('active');
        $(this).addClass('active');
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
                if(data.data_product_mobile.length>=6) {
                    var see_more = '<div class="see_more"><a href="' + url_promotion_product + '"><svg enable-background="new 0 0 40 40" viewBox="0 0 40 40" role="img" class="stardust-icon stardust-icon-arrow-right-bold-circle"><circle cx="20" cy="20" fill="none" r="18.5" stroke-miterlimit="10"></circle><path d="m11.1 9.9l-9-9-2.2 2.2 8 7.9-8 7.9 2.2 2.1 9-9 1-1z" transform="translate(15 9)"></path></svg>Xem thêm</a></div>';
                    $('#load_promotion').append(see_more);
                }
            }
        })
    });

    // click chon danh muc khuyen mai
    $(document).on('click', '.category_promotion', function (){
        $('.box_promtion_menu').removeClass('active');
        $(this).addClass('active');
        var category_id = $(this).attr('data-target');
        var data = {
            category_id: category_id,
            _token: _token
        };
        $.ajax({
            url: get_category_promotion_mobile,
            type: "post",
            dataType: "json",
            data: data,
            success: function (data) {
                $('#load_promotion').html('');
                var template_product_mobile = $('#template_product_mobile').html();
                get_list_product(data.data_product_mobile, template_product_mobile,'#load_promotion');
                var url = product_cat;
                url = url.replace('slug_code',data.url_category);
                if(data.data_product_mobile.length>=6) {
                    var see_more = '<div class="see_more"><a href="' + url + '"><svg enable-background="new 0 0 40 40" viewBox="0 0 40 40" role="img" class="stardust-icon stardust-icon-arrow-right-bold-circle"><circle cx="20" cy="20" fill="none" r="18.5" stroke-miterlimit="10"></circle><path d="m11.1 9.9l-9-9-2.2 2.2 8 7.9-8 7.9 2.2 2.1 9-9 1-1z" transform="translate(15 9)"></path></svg>Xem thêm</a></div>';
                    $('#load_promotion').append(see_more);
                }
                // $('#viewall_promotion').attr('href',url_promotion_product);
            }
        })
    });

    // danh sach danh muc hien thi tren trang chu
    var list_product = [];
    var list_cat = $('#categories_p').attr('list-cat');
    if(list_cat){
        var cat_ids = list_cat.split('_');
        cat_ids.forEach(function (element) {
            list_product.push(element);
        });
    }

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
                var url_category = product_cat.replace('slug_code', data.category_slug);
                var template_child_categories = $('#template_child_categories').html();
                var template_product_mobile = $('#template_product_mobile').html();
                $.each(data.list_cat_childs, function(k,v) {
                    var tmp = $(template_child_categories).clone();
                    var url = product_cat.replace('slug_code', v.slug);
                    $(tmp).find('a').html(v.name);
                    $(tmp).find('a').attr('category_child_id',v.id);
                    $('#list_tag_' + id).append(tmp.html());
                    $('#list_tag_' + id).attr('data-target',id);
                })
                if(!$('#list_products_'+id).hasClass('active')){
                    get_list_product(data.data_product_mobile, template_product_mobile,'#list_products_'+id);
                    if(data.data_product_mobile.length>=6) {
                        var see_more = '<div class="see_more"><a href="' + url_category + '"><svg enable-background="new 0 0 40 40" viewBox="0 0 40 40" role="img" class="stardust-icon stardust-icon-arrow-right-bold-circle"><circle cx="20" cy="20" fill="none" r="18.5" stroke-miterlimit="10"></circle><path d="m11.1 9.9l-9-9-2.2 2.2 8 7.9-8 7.9 2.2 2.1 9-9 1-1z" transform="translate(15 9)"></path></svg>Xem thêm</a></div>';
                        $('#list_products_'+id).append(see_more);
                    }
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
            if(v.year){
                $(tmp).find('.years2').removeClass('d-none');
                $(tmp).find('.years2').html(v.year);
            }
            if(v.installment){
                $(tmp).find('.payment2').removeClass('d-none');
                $(tmp).find('.payment2').html(v.installment);
            }
            if(v.img_brands){
                var url_img_brands = img_product_mobile;
                $(tmp).find('.dbrand2').removeClass('d-none');
                img = 'url('+url_img_brands+')';
                img = img.replace('img_name', v.img_brands);
                $(tmp).find('.dbrand2').css('background-image',img);
            }
            var dt_p = detail_p.replace('slug_code', v.slug);
            $(tmp).find('.p-img a').attr('href',dt_p);
            if(v.thumb !="no-images.jpg"){
                var url_img_product = img_product_mobile;
            }
            else{
                var url_img_product = common_img_mobile;
            }
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
                $(tmp).find('.add-cart').addClass('d-none');
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

    // chon danh muc con load lai sp cho danh muc con
    $(document).on('click','.related-tag', function (){
        if($(this).attr('category_child_id')){
            var category_child_id = $(this).attr('category_child_id');
            var category_id = $(this).parent().attr('data-target');
            var template_product_mobile = $('#template_product_mobile').html();
            $('#list_products_'+category_id).html('');
            var data = {
                id: category_child_id,
                _token: _token
            };
            $.ajax({
                url: get_product_category_child_mobile,
                type: "post",
                dataType: "json",
                data: data,
                success: function (data) {
                    var url_category = product_cat.replace('slug_code', data.category_slug);
                    get_list_product(data.data_product_mobile, template_product_mobile,'#list_products_'+category_id);
                    if(data.data_product_mobile.length>=6){
                        var see_more = '<div class="see_more"><a href="'+url_category+'"><svg enable-background="new 0 0 40 40" viewBox="0 0 40 40" role="img" class="stardust-icon stardust-icon-arrow-right-bold-circle"><circle cx="20" cy="20" fill="none" r="18.5" stroke-miterlimit="10"></circle><path d="m11.1 9.9l-9-9-2.2 2.2 8 7.9-8 7.9 2.2 2.1 9-9 1-1z" transform="translate(15 9)"></path></svg>Xem thêm</a></div>';
                        $('#list_products_'+category_id).append(see_more);
                    }
                }
            });
        }
    })

    //memu
    var template_menu_parent = $('#template-menu-parent').html();
    $(document).on('click', '#menubar , #menubar2', function (){
        $('.menu-mobile').removeClass('d-none');
        if ($('.menu-mobile').hasClass('active_mn')){
            $('.menu-mobile').removeClass('active_mn');
            if($('.box_info_result').html('')){
                $('body').removeClass('disable_scoll');
            }
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
                            if(k==0){
                                $(item).find('.label-menu-tree').addClass('active');
                            }
                            var img_name = v.img_cat;
                            var imageUrl = 'url('+img_category+')';
                            if(img_name && img_name !="no-images.jpg"){
                                imageUrl = imageUrl.replace('img_name', img_name);
                            }
                            else{
                                imageUrl = 'url('+common_img_mobile+')';
                                imageUrl = imageUrl.replace('img_name', 'no-images.jpg');
                            }
                            $(item).find('.icons-cate').css('background-image',imageUrl);
                            $(item).find('.name_menu').html(v.label);
                            $('#menu_mobile').append(item.html());
                        });
                        //menu cap 2 3
                        load_child_menu(data.child);
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
    function load_child_menu(data){
        $.each(data, function (k, v) {
            var template_menu_child = $('#template-menu-child').html();
            var template_chose_label_img_menu = $('#template_chose_label_img_menu').html();
            // cap 1(cha)
            if(v.depth == 0){
                $('.box-title__title').attr('href',v.link);
                $('.box-title__title').html(v.label);
                $('.box-title__btn-show-all').attr('href',v.link);
            }
            else if(v.depth == 1){
                var item = $(template_menu_child).clone();
                $(item).find('.group-title').html(v.label);
                $(item).find('.menu-item').attr('id','menu_item_'+v.id);
                $('#menu_mobile_child').append(item.html());
            }
            else{
                var item_label_img = $(template_chose_label_img_menu).clone();
                $(item_label_img).find('.label-wrapper').attr('href',v.link);
                if(v.img_caption == 0){
                    $(item_label_img).find('.label-item>img').remove();
                    $(item_label_img).find('.label-item span').html(v.label);
                }
                else if(v.img_caption == 1){
                    if(v.img_brand!=null && v.filter_by == 3){
                        var img_name = v.img_brand;
                        var imageUrl = img_brands;
                        if(img_name && img_name !="no-images.jpg"){
                            imageUrl = imageUrl.replace('img_name', img_name);
                        }
                        else{
                            imageUrl = common_img_mobile.replace('img_name', 'no-images.jpg');
                        }
                        $(item_label_img).find('.label-item img').attr('src',imageUrl);
                        $(item_label_img).find('.label-item>span').remove();
                    }
                    else if(v.img_property!=null && v.filter_by == 1){
                        var img_name = v.img_property;
                        var imageUrl = img_detailproperties;
                        if(img_name && img_name !="no-images.jpg"){
                            imageUrl = imageUrl.replace('img_name', img_name);
                        }
                        else{
                            imageUrl = common_img_mobile.replace('img_name', 'no-images.jpg');
                        }
                        $(item_label_img).find('.label-item img').attr('src',imageUrl);
                        $(item_label_img).find('.label-item>span').remove();
                    }
                    else{
                        if(v.img_cat != 'no-images.jpg'){
                            var img_name = v.img_cat;
                            var imageUrl = img_category;
                            if(img_name && img_name !="no-images.jpg"){
                                imageUrl = imageUrl.replace('img_name', img_name);
                            }
                            else{
                                imageUrl = common_img_mobile.replace('img_name', 'no-images.jpg');
                            }
                            $(item_label_img).find('.label-item img').attr('src',imageUrl);
                            $(item_label_img).find('.label-item span').remove();
                        }
                    }
                }
                else{
                    if(v.img_brand!=null && v.filter_by == 3){
                        var img_name = v.img_brand;
                        var imageUrl = img_brands;
                        if(img_name && img_name !="no-images.jpg"){
                            imageUrl = imageUrl.replace('img_name', img_name);
                        }
                        else{
                            imageUrl = common_img_mobile.replace('img_name', 'no-images.jpg');
                        }
                        $(item_label_img).find('.label-item img').attr('src',imageUrl);
                        $(item_label_img).find('.label-item span').html(v2.label);
                    }
                    else if(v.img_property!=null && v.filter_by == 1){
                        var img_name = v.img_property;
                        var imageUrl = img_detailproperties;
                        if(img_name && img_name !="no-images.jpg"){
                            imageUrl = imageUrl.replace('img_name', img_name);
                        }
                        else{
                            imageUrl = common_img_mobile.replace('img_name', 'no-images.jpg');
                        }
                        $(item_label_img).find('.label-item img').attr('src',imageUrl);
                        $(item_label_img).find('.label-item span').html(v.label);
                    }
                    else{
                        if(v.img_cat != 'no-images.jpg'){
                            var img_name = v.img_cat;
                            var imageUrl = img_category;
                            if(img_name && img_name !="no-images.jpg"){
                                imageUrl = imageUrl.replace('img_name', img_name);
                            }
                            else{
                                imageUrl = common_img_mobile.replace('img_name', 'no-images.jpg');
                            }
                            $(item_label_img).find('.label-item img').attr('src',imageUrl);
                        }
                        $(item_label_img).find('.label-item span').html(v.label);
                    }
                }
                $('#menu_item_'+v.parent).append(item_label_img.html());
            }
        })
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
                // menu cap 2 3
                $('#menu_mobile_child').html('');
                load_child_menu(data.child);
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
            $('#scroll_d').css({"display":"block"});
            $('#scroll_h').css({"display":"none"});
            $('#go_top').css({"display":"block"});
            $('#affix_h').css({"top":"65px"});
            $('.autocomplete_search').css({"top":"45px"});
            $('.box_search').css({"width":"66.66666667%","padding": "0 8px","margin-left":"21.8%"});
        }
        else{
            $('#scroll_d').css({"display":"none"});
            $('#scroll_h').css({"display":"block"});
            $('#go_top').css({"display":"none"});
            $('#affix_h').css({"top":"123px"});
            $('.autocomplete_search').css({"top":"96px"});
            $('.box_search').css({"width":"100%","padding": "0 12px","margin-left":"auto"});
        }
        //load sp khuyen mai khi cuon
        if (isOnScreen($("#load_promotion")) && ($("#load_promotion").hasClass("loaded") == false)) {
            if($('#new_p').length>0){
                lay_sp_km('new_p');
            }
            else if($('#hot_p').length>0){
                lay_sp_km('hot_p');
            }
            else if($('#promotion_p').length>0){
                lay_sp_km('promotion_p');
            }
            else if($('.category_promotion').length>0){
                var category_id = $('.category_promotion').first().attr('data-target');
                lay_sp_km(category_id);
            }
            else{
                $('.cat_box_sale').addClass('d-none');
            }

            $("#load_promotion").addClass("loaded");
        }

        //load sp trang chi tiet
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
        if ($('.filterall').hasClass('active_filter')) {
            $('.filterall').removeClass('active_filter');
        } else {
            $('.filterall').addClass('active_filter');
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
        var params_string = window.location.search;
        var searchparams =  new URLSearchParams(params_string);
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
        if(searchparams.has('promotion')==true){
            params.append('promotion', searchparams.get('promotion'));
        }
        if(searchparams.has('search')==true){
            params.append('search', searchparams.get('search'));
        }
        window.location = window.location.origin + window.location.pathname + '?' + params.toString();
    }

    //===============================trang chi tiet san pham====================================
    $("table").addClass('table table-striped table_border');

    //mua ngay san pham
    $(document).on('click','.add-cart-now',function(){
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
        var phone_number = $('input[name="phone_number"]').val();
        var mailformat = /^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!\.)){0,61}[a-zA-Z0-9]?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!$)){0,61}[a-zA-Z0-9]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/;
        var email = $('input[name="email"]').val();
        var address = $('select[name="district"]').val() +" - "+ $('select[name="city"] option:selected').text();
        if($('input[name="street"]').val()){
            address = $('input[name="street"]').val() + " - " + address;
        }
        var note = $('input[name="note"]').val();
        var payment_method = $('input[name="payment_method"]:checked').val();
        var vat = $('input[name="VAT"]');
        var name_company = address_company = tax_code = email_company ="";
        if($('input[name="name_company"]').val() != ""){
            name_company = $('input[name="name_company"]').val();
        }
        var address_company = $('input[name="address_company"]').val();
        var tax_code = $('input[name="tax_code"]').val();
        var email_company = $('input[name="email_company"]').val();
        var data = {
            customer_name: customer_name,
            email: email,
            phone_number: phone_number,
            address: address,
            note: note,
            address_company: address_company,
            tax_code: tax_code,
            email_company: email_company,
            name_company: name_company,
            payment_method: payment_method,
            _token: _token
        };
        $('.requite_name i').html('');
        $('.requite_numberphone i').html('');
        $('.requite_email i').html('');
        switch (true){
            case ($('input[name="check_rules"]').is(":checked") == false) : {
                break;
            }
            case (customer_name.split(" ").join("").length==0) : {
                $('.requite_name i').html('Vui lòng nhập Họ và tên của bạn.');
                $('input[name="customer_name"]').focus();
                break;
            }
            case (customer_name.split(" ").join("").length<2) : {
                $('.requite_name i').html('Họ và tên không hợp lệ, vui lòng nhập lại.');
                $('input[name="customer_name"]').focus();
                break;
            }
            case ((phone_number.split(" ").join("").length<10) || (phone_number.split(" ").join("").length>12)) :{
                $('.requite_numberphone i').html('Số điện thoại không hợp lệ, vui lòng nhập lại.');
                $('input[name="phone_number"]').focus();
                break;
            }
            case(email.split(" ").join("").length>0 && !email.match(mailformat)):{
                $('.requite_email i').html('Địa chỉ email không hợp lệ, vui lòng nhập lại.');
                $('input[name="email"]').focus();
                break;
                }
            case(vat.is(":checked")):{
                $('.requite_name_company i').html('');
                $('.requite_address_company i').html('');
                $('.requite_tax_code i').html('');
                $('.requite_email_company i').html('');
                switch (true){
                    case (name_company.split(" ").join("").length==0) : {
                        $('.requite_name_company i').html('Tên công ty không được phép bỏ trống.');
                        break;
                    }
                    case (name_company.split(" ").join("").length<2 || !/^[A-Za-z ]+$/.test(name_company)) : {
                        $('.requite_name_company i').html('Tên công ty không hợp lệ, vui lòng nhập lại.');
                        break;
                    }
                    case (address_company.split(" ").join("").length==0) : {
                        $('.requite_address_company i').html('Địa chỉ công ty không được phép bỏ trống.');
                        break;
                    }
                    case (address_company.split(" ").join("").length<2 || !/^[A-Za-z ]+$/.test(address_company)) : {
                        $('.requite_address_company i').html('Địa chỉ công ty không hợp lệ, vui lòng nhập lại.');
                        break;
                    }
                    case (tax_code.split(" ").join("").length==0) : {
                        $('.requite_tax_code i').html('Mã số thuế không được phép bỏ trống.');
                        break;
                    }
                    case (tax_code.split(" ").join("").length<10 || tax_code.split(" ").join("").length>15) : {
                        $('.requite_tax_code i').html('Mã số thuế không hợp lệ, vui lòng nhập lại.');
                        break;
                    }
                    case (email_company.split(" ").join("").length==0) : {
                        $('.requite_email_company i').html('Email công ty không được phép bỏ trống, vui lòng nhập lại');
                        break;
                    }
                    case (!email_company.match(mailformat)) : {
                        $('.requite_email_company i').html('Email công ty không hợp lệ, vui lòng nhập lại.');
                        break;
                    }
                    default:{
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
                    }
                }
                break;
            }
            default:{
                $.ajax({
                    url: complete_payment,
                    method: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function (data) {
                        if(data.success==true){
                            window.location = successorder;
                        }
                        if(data.success==false){
                            $( "#snackbar_false" ).fadeIn( 300 ).delay( 1000 ).fadeOut( 400 );
                        }
                    }
                });
            }
        }
    });
    $(document).on('change', 'select[name="city"]', function(){
        var ma_tp = $(this).val();
        data = {
            ma_tp : ma_tp,
            _token: _token
        }
        $.ajax({
            url: get_district,
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function (data) {
                if(data.success){
                    $('select[name="district"]').html('');
                    $.each(data.district, function(k,v) {
                        $('select[name="district"]').append($('<option>',
                            {
                                value: v.name,
                                text : v.name
                            }));
                    });
                }
            }
        });
    })

    // ==============================Tìm kiếm==============================
    function delay(callback, ms) {
        var timer = 0;
        return function() {
            var context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function () {
                callback.apply(context, args);
            }, ms || 0);
        };
    }
    $('input[type=search]').on('search', function () {
        $('body').removeClass('disable_scoll');
        $('.box_info_result').html('');
    });
    $url_search = url_list_products;
    $(".search , .search_input_scroll").keyup(delay(function(e){
        var keyword =  $(this).val();
        if (e.key === 'Enter' || e.keyCode === 13) {
            var url_search = $url_search.replace('key_word',keyword);
            window.location=url_search;
        }
        else
        {
            if(keyword!=""){
                $('body').addClass('disable_scoll');
            }
            else{
                if($('body').hasClass('disable_scoll')){
                    $('body').removeClass('disable_scoll');
                }
            }
            $.ajax({
                url: autotypeahead,
                type:"post",
                dataType:"json",
                data:{
                    _token: _token,
                    data: keyword
                } ,
                success: function (data) {
                    if(data.result_search){
                        $('.box_info_result').html('');
                        var template_search_mobile = $('#template_search_mobile').html();
                        $.each(data.result_search, function(k,v) {
                            var tmp = $(template_search_mobile).clone();
                            var url = detailproduct.replace('slug_code', v.slug);
                            $(tmp).find('a').attr('href',url);
                            if(v.thumb && v.thumb !="no-images.jpg"){
                                var img = img_product_mobile;
                            }
                            else{
                                var img = common_img_mobile;
                            }
                            img = img.replace('img_name', v.thumb);
                            $(tmp).find('img').attr('src',img);
                            $(tmp).find('.header-search-name').html(v.name);
                            if(v.price_onsale==0){
                                $(tmp).find('.header-search-special').html(v.price);
                            }
                            else{
                                $(tmp).find('.header-search-special').html(v.price_onsale);
                                $(tmp).find('.header-search-price').html(v.price_onsale);
                            }
                            $('.box_info_result').append(tmp);
                        });
                    }
                    else{
                        $('.box_info_result').html('');
                    }
                },
            })
        }
    },200));
});
