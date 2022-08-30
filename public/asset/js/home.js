$(document).ready(function () {
    function runOnScroll() {

		if(jQuery(window).scrollTop() >80){
			document.getElementById("scroll_up").style.display = "block";
		}
		if(jQuery(window).scrollTop() <80){
            document.getElementById("scroll_up").style.display = "none";
		}
	}
	$(window).scroll(runOnScroll);

    $('#scroll_up').on("click",function(){
		document.body.scrollTop = 0;
  		document.documentElement.scrollTop = 0;
	})
    //xu ly an hien hop thoai dang nhap header
    $(".dropdown-login-toggle").click(function(){
        $(".dropdown-login").toggleClass("active-form-login");
    })


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
    $('.icon-right').click(function(){
        $(this).parent('li').children('.submenu-parent-mobile').slideToggle();
        $(this).html('<i class="far fa-angle-down"></i>');
    });
    $('.icon-right-child').click(function(){
        $(this).parent('li').children('.submenu-parent-mobile-1').slideToggle();
        $(this).html('<i class="far fa-angle-down"></i>');
    });

    $('#list-cat-slider').owlCarousel({
        autoplay: true,
        autoplayHoverPause: true,
        loop: true,
        margin: 30,
        nav: true,
        dots: false,
        mouseDrag: true,
        touchDrag: true,
        lazyLoad: true,
        responsive: {
            0: {
                items: 1
            },
            375: {
                items: 2
            },
            600: {
                items: 3
            },
            840: {
                items: 4
            },
            1024: {
                items: 3
            },
            1150: {
                items: 4
            },
            1200: {
                items: 4
            },
            1441: {
                items: 5
            },
            1920: {
                items: 6
            },
        }
    });
    $('#slider-deal-supper').owlCarousel({
        autoplay: true,
        autoplayHoverPause: true,
        loop: true,
        margin: 10,
        nav: true,
        dots: false,
        mouseDrag: true,
        touchDrag: true,
        callbacks: true,
        lazyLoad: true,
        responsive: {
            0: {
                items: 1
            },
            415: {
                items: 2
            },
            600: {
                items: 3
            },
            1920: {
                items: 4
            },
        }
    });
    $('.wp-info-product').owlCarousel({
        autoplay: true,
        autoplayHoverPause: true,
        loop: true,
        margin: 10,
        nav: true,
        dots: false,
        mouseDrag: true,
        touchDrag: true,
        lazyLoad: true,
        callbacks: true,
        responsive: {
            0: {
                items: 1
            },
            375:{
                items: 2
            },
            1649: {
                items: 3
            },
        }
    });


    $('.sub_cat_title_slider').owlCarousel({
        autoplay: false,
        autoplayHoverPause: true,
        loop: false,
        margin: 10,
        nav: false,
        dots: false,
        autoWidth: true,
        autoplayTimeout: 6000,
        callbacks: false,
    });
    $('.list-product-group').owlCarousel({
        autoplay: true,
        autoplayHoverPause: true,
        loop: false,
        margin: 10,
        nav: true,
        dots: false,
        mouseDrag: true,
        touchDrag: true,
        lazyLoad: true,
        responsive: {
            0: {
                items: 1
            },
            375: {
                items: 2
            },
            768:{
                items: 3
            },
            992:{
                items: 4
            },
            1200:{
                items: 5
            },
            1650: {
                items: 6
            },
            1920: {
                items: 6
            },
        }
    });
    $('.list-product-recommend-slider').owlCarousel({
        autoplay: true,
        autoplayHoverPause: true,
        loop: false,
        margin: 10,
        nav: true,
        dots: false,
        mouseDrag: true,
        touchDrag: true,
        lazyLoad: true,
        responsive: {
            0: {
                items: 1
            },
            375: {
                items: 2
            },
            768:{
                items: 3
            },
            992:{
                items: 4
            },
            1200:{
                items: 5
            },
            1650: {
                items: 6
            },
            1920: {
                items: 6
            },
        }
    });

    $('#brand-slider').owlCarousel({
        autoplay: true,
        autoplayHoverPause: true,
        loop: true,
        margin: 15,
        nav: false,
        dots: false,
        mouseDrag: true,
        touchDrag: true,
        lazyLoad: true,
        responsive: {
            0: {
                items: 2
            },
            375: {
                items: 3
            },
            600:{
                items: 4
            },
            992:{
                items: 6
            },
            1200:{
                items: 7
            },
            1350:{
                items: 8
            },
        }
    });

    var $time = $('.time-dem-nguoc').attr('data-date');
    var countDownDate = new Date($time).getTime();
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
                document.getElementById("d").innerHTML = days;
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

    $('.sub_cat_title_slider .nav-link').click(function(){
        $('.sub_cat_title_slider .nav-link').removeClass('active');
        $(this).addClass('active');
        return false;
    });
});
