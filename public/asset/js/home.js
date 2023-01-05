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
                items:4,
            },
            700: {
                items:5,
            },
            1350: {
                items:6,
            },
            1600: {
                items:7,
            },
        },
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
        autoplay: true,
        autoplayHoverPause: false,
        loop: false,
        margin: 10,
        nav: false,
        dots: false,
        autoWidth: true,
        callbacks: true,
    });
    $('.list-product-group').owlCarousel({
        autoplay: false,
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

    $('.sub_cat_title_slider .nav-link').click(function(){
        $('.sub_cat_title_slider .nav-link').removeClass('active');
        $(this).addClass('active');
        return false;
    });
});
