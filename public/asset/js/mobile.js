$(document).ready(function () {

    //doi mau cho danh muc
    var colors = ['#f72a2aba', '#f7972aba', '#f7e32aba','#74f72aba','#2af75bba','#2af2f7ba','#3c2af7ba','#dd2af7ba','#f72a83ba'];
    $('.item-categories').each(function (){
        var random_color = colors[Math.floor(Math.random() * colors.length)];
        colors.splice($.inArray(random_color, colors), 1);
        $(this).css("background-color", random_color);
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

    // an hien danh muc khi chon menu
    $(document).on('click', '.fa-bars', function (){
        if(!$('.menu-mobile').hasClass('active_mn')){
            $('.menu-mobile').addClass('active_mn');
        }
        else{
            $('.menu-mobile').removeClass('active_mn');
        }
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
        var top = $elem.offset().top - 200
        var height = $elem.height()
        var bottom = top + height + 400

        return (top >= viewport_top && top < viewport_bottom) ||
            (bottom > viewport_top && bottom <= viewport_bottom) ||
            (height > viewport_height && top <= viewport_top && bottom >= viewport_bottom)
    }

    function lay_sp_hot_sale() {
        console.log(1);
        var _token = $('meta[name="csrf-token"]').attr('content');
        var data = {
            _token: _token
        };
        $.ajax({
            url: base_url+"get_hot_sale_mobile')}}",
            type: "post",
            dataType: "json",
            data: data,
            success: function (data) {
                console.log(data);
                $('#load_sale').append(data);
            },
        })
    }

    // su kien cuon man hinh
    function runOnScroll() {
        // an hien thanh tim kiem khi cuon
        if(jQuery(window).scrollTop() >30){
            document.getElementById("scroll_d").style.display="block";
            document.getElementById("scroll_h").style.display="none";
        }
        else{
            document.getElementById("scroll_d").style.display="none";
            document.getElementById("scroll_h").style.display="block";
        }

        if (isOnScreen($("#load_sale")) && ($("#load_sale").hasClass("loaded") == false)) {
            lay_sp_hot_sale();
            $("#load_sale").addClass("loaded");
        }
    }
    $(window).scroll(runOnScroll);
});
