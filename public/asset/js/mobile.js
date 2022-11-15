$(document).ready(function () {
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

    $(document).on('click', '.fa-bars', function (){
        if(!$('.menu-mobile').hasClass('active_mn')){
            $('.menu-mobile').addClass('active_mn');
        }
        else{
            $('.menu-mobile').removeClass('active_mn');
        }
    });

    function runOnScroll() {

        // if(jQuery(window).scrollTop() >80){
        //     document.getElementById("scroll_up").style.display = "block";
        // }
        // if(jQuery(window).scrollTop() <80){
        //     document.getElementById("scroll_up").style.display = "none";
        // }

        if(jQuery(window).scrollTop() >30){
            document.getElementById("scroll_d").style.display="block";
            document.getElementById("scroll_h").style.display="none";
        }
        else{
            document.getElementById("scroll_d").style.display="none";
            document.getElementById("scroll_h").style.display="block";
        }
    }
    $(window).scroll(runOnScroll);
});
