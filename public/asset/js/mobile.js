$(document).ready(function () {

    var _token = $('meta[name="csrf-token"]').attr('content');
    //doi mau cho danh muc
    // var colors = ['#f72a2aba', '#f7972aba', '#f7e32aba','#74f72aba','#2af75bba','#2af2f7ba','#3c2af7ba','#dd2af7ba','#f72a83ba'];
    var colors = ['#ff8d508f', '#ffb5508f', '#ffee508f','#e0ff508f','#6eff508f','#50ffb380','#5089ff80','#5069ff80','#9050ff80',
        '#e150ff80','#ff50ed80','#ff50b480','#ff507480','#fb386080','#ff16458f'];

    $('.item-categories').each(function (){
        // var random_color = colors[Math.floor(Math.random() * colors.length)];
        // colors.splice($.inArray(random_color, colors), 1);
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
    $(document).on('click', '.add-cart', function(){
        var id  =  $(this).attr('get-id');
        var x = this;
        var data = {
            id: id,
            _token: _token
        };
        $.ajax({
            url: base_url+"/add-cart-ajax",
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
            url: base_url+"/get_new_mobile",
            type: "post",
            dataType: "json",
            data: data,
            success: function (data) {
                $('#load_promotion').append(data);
            }
        })
    }

    // lay sp ban chay
    function lay_ban_chay() {
        var data = {
            _token: _token
        };
        $.ajax({
            url: base_url+"/get_hot_sale_mobile",
            type: "post",
            dataType: "json",
            data: data,
            success: function (data) {
                $('#load_promotion').append(data);
            }
        })
    }
    $(document).on('click', '#new_p', function (){
        var data = {
            _token: _token
        };
        $.ajax({
            url: base_url+"/get_new_mobile",
            type: "post",
            dataType: "json",
            data: data,
            success: function (data) {
                $('#load_promotion').html('');
                $('#load_promotion').append(data);
            }
        })

    });
    $(document).on('click', '#hot_p', function (){
        var data = {
            _token: _token
        };
        $.ajax({
            url: base_url+"/get_hot_sale_mobile",
            type: "post",
            dataType: "json",
            data: data,
            success: function (data) {
                $('#load_promotion').html('');
                $('#load_promotion').append(data);
            }
        })
    });

    var list_product = [];
    let list_cat_1 = $('#categories_p').attr('list-cat');
    let list_cat = String(list_cat_1);
    let cat_ids = list_cat.split(' ');
    cat_ids.forEach(function (element) {
        list_product.push(element);
    });

    function laySp(category_id) {
        var id = category_id;
        var data = {
            id: category_id,
            _token: _token
        };
        $.ajax({
            url: base_url+"/get_product_mobile",
            type: "post",
            dataType: "json",
            data: data,
            success: function (data) {
                $('#list_tag_' + id).append(data.list_child_categories);
                $('#list_products_' + id).append(data.product);
            }
        })
    }

    $(document).on("click", '#filter_by_price, .close_p', function (){
        if($('.p_filter').hasClass('d-none')){
            $('.p_filter').removeClass('d-none');
        }
        else{
            $('.p_filter').addClass('d-none');
        }
    });

    $(document).on("click", '.btn-f, .btnclose', function (){
        if($('.filterall').hasClass('active_mn')){
            $('.filterall').removeClass('active_mn');
        }
        else{
            $('.filterall').addClass('active_mn');
        }
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
