$(document).ready(function () {
    
    //an hien sidebar
    $(".title-icon").on("click", function() {
        $('.vertical-menu').slideToggle();
    }); 

    // button an hien menu con sidebar moblie
    $(".angledown").on("click", function() {
        var id = $(this).attr('id');
        id = "sub-"+id;
        $('#'+id).slideToggle();
    }); 

    $(".angledown2").on("click", function() {
        var id = $(this).attr('id');
        id = "sub-"+id;
        $('#'+id).slideToggle();
    }); 

    // tab sidebar
    $(".mobile-tab-title").on("click",function(){
     	var title = $(this).attr("data-menu");
     	if(title == "pages"){
     	document.getElementById("subpage").style.display = "block";
     	document.getElementById("subcate").style.display = "none";
     	$('.mobile-categories-title').removeClass("active");
     	$('.mobile-pages-title').addClass("active");
     	}
     	else{
     	document.getElementById("subpage").style.display = "none";
     	document.getElementById("subcate").style.display = "block";
     	$('.mobile-categories-title').addClass("active");
     	$('.mobile-pages-title').removeClass("active");
     	}
    });
        
    // tat sidebar dang moblie
    $(".mobile-nav-close").on("click",function(){
    document.getElementById("mobilenav").style.visibility = "hidden";
    document.getElementById("mobilenav").style.opacity = "0";
    document.getElementById("mobilenav").style.transform = "translate3d(-330px,0,0)";
    document.getElementById('iconmenumobile').style.visibility="visible";
    document.getElementById('iconmenumobile').style.opacity="1";
    });

    // nut menu an hien silebar dang mobile
    $("#iconmenumobile").on("click",function(){
    document.getElementById("mobilenav").style.visibility = "visible";
    document.getElementById("mobilenav").style.opacity = "1";
    document.getElementById("subpage").style.display = "block";
    document.getElementById("subcate").style.display = "none";
    document.getElementById("mobilenav").style.transform = "translate3d(0,0,0)";
    
    document.getElementById('iconmenumobile').style.visibility= "hidden";
    document.getElementById('iconmenumobile').style.opacity= "1";
    });

    // zoom anh trang chi tiet san pham
    $("#img-zoomer-box").mousemove(function(e) {
    let original  = document.querySelector('#img-1'),
        magnified = document.querySelector('#img-2'),
        style     = magnified.style,
        x         = e.pageX - this.offsetLeft,
        y         = e.pageY - this.offsetTop,
        imgWidth  = original.offsetWidth,
        imgHeight = original.offsetHeight,
        xperc     = ((x/imgWidth)  * 100),
        yperc     = ((y/imgHeight) * 100);

        //lets user scroll past right edge of image
        if(x > (.01 * imgWidth)) {
          xperc += (.15 * xperc);
        };

        //lets user scroll past bottom edge of image
        if(y    >= (.01 * imgHeight)) {
          yperc += (.15 * yperc);
        };
        x=x-300;
        y=y-300;

        style.maxWidth        ='none';
        style.maxHeight       ='none';
        style.position        = 'absolute';
        style.backgroundcolor = 'white';
        style.border          ='none';
        style.width           = '1000px';
        style.height          ='1500px';
        style.transform       = 'translate(-'+x+'px,-'+y+'px)';
        style.left            = '0px';
        style.top             = '0px';
      });
    //tab thong tin chi tiet trang chi tiet san pham
    $(".tab-product-info").on("click",function(){
        var title                      = $(this).attr("data-tab");
        var subdecription              = document.getElementById("subdecription");
        var subAdditional_information  = document.getElementById("subAdditional_information");
        var subvenderinfo              = document.getElementById("subvenderinfo");
        var subreviews                 = document.getElementById("subreviewsinfo");
        var tab_description            = $(".tab_description");
        var tab_Additional_information = $(".tab_Additional_information");
        var tab_vender                 = $(".tab_vender");
        var tab_reviews                = $(".tab_reviews");

        if(title == "decription"){
            tab_description.addClass("borderbottom_tabs");
            tab_Additional_information.removeClass("borderbottom_tabs");
            tab_vender.removeClass("borderbottom_tabs");
            tab_reviews.removeClass("borderbottom_tabs");
            subdecription.style.display             = "block";
            subAdditional_information.style.display = "none";
            subvenderinfo.style.display             = "none";
            subreviews.style.display                = "none";
        }
        if(title == "Additional_information"){

            tab_Additional_information.addClass("borderbottom_tabs");
            tab_description.removeClass("borderbottom_tabs");
            tab_vender.removeClass("borderbottom_tabs");
            tab_reviews.removeClass("borderbottom_tabs");
            subdecription.style.display             = "none";
            subAdditional_information.style.display = "block";
            subvenderinfo.style.display             = "none";
            subreviews.style.display                = "none";
        }
        if(title == "vender"){
            tab_vender.addClass("borderbottom_tabs");
            tab_description.removeClass("borderbottom_tabs");
            tab_Additional_information.removeClass("borderbottom_tabs");
            tab_reviews.removeClass("borderbottom_tabs");
            subdecription.style.display             = "none";
            subAdditional_information.style.display = "none";
            subvenderinfo.style.display             = "block";
            subreviews.style.display                = "none";
        }
        if(title == "reviews"){
            tab_reviews.addClass("borderbottom_tabs");
            tab_vender.removeClass("borderbottom_tabs");
            tab_description.removeClass("borderbottom_tabs");
            tab_Additional_information.removeClass("borderbottom_tabs");
            subreviews.style.display                = "block";
            subdecription.style.display             = "none";
            subAdditional_information.style.display = "none";
            subvenderinfo.style.display             = "none";
        }

     });

    //Doi anh minh hoa san pham trang ctsp
    $(".imgproduct_thumb").on("click",function(){
        // thay doi border
        var imgproduct_thumb = $(".imgproduct_thumb");
        imgproduct_thumb.removeClass('borderimg');
        $(this).addClass('borderimg');
        //thay doi anh
        var datasrc   = $(this).attr("data-o_src");
        var id_img1   = document.getElementById("img-1");
        var id_img2   = document.getElementById("img-2");
        var zoomer_a  = document.getElementById("zoomer_a");

        id_img1.src   = datasrc;
        id_img2.style = 'background: url('+datasrc+') no-repeat #FFF;';
        zoomer_a.href = datasrc;
    });
     //tooltip
    $("body").tooltip({ selector: '[data-toggle=tooltip]' });

    // select size trang ctsp
    $(".size_value_check").each(function(){
        $(this).on("click",function(){
                var size_value_check = $(".size_value_check");
                size_value_check.removeClass("checked_size_background");
                $(this).addClass("checked_size_background");
                $(".sub_size_name").text($(this).data("title"));
            });
    });

    //select color trang ctsp
    $(".color_value_check").on("click",function(){
        var size_value_check = $(".color_value_check");
        size_value_check.removeClass("checked_color_background");
        $(this).addClass("checked_color_background");
        $(".sub_color_name").text($(this).data("title"));
    });
    
    //Cong so luong san pham
    $(".plus").on("click",function(){
        $(this).prev().val(+$(this).prev().val() + 1);
    });

    //tru sl san pham
    $(".minus").on("click",function(){
        if ($(this).next().val() > 0)
            $(this).next().val(+$(this).next().val() - 1);
    });
});	