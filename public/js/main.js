$(document).ready(function () {
 
    /*categories slideToggle*/
    $(".categories_title").on("click", function() {
        $(this).toggleClass('active');
        $('.categories_menu_toggle').slideToggle('medium');
    }); 

    /*----------  Category more toggle  ----------*/

	$(".categories_menu_toggle li.hidden").hide();
	   $("#more-btn").on('click', function (e) {

		e.preventDefault();
		$(".categories_menu_toggle li.hidden").toggle(500);
		var htmlAfter = '<i class="fa fa-minus" aria-hidden="true"></i> Less Categories';
		var htmlBefore = '<i class="fa fa-plus" aria-hidden="true"></i> More Categories';


		if ($(this).html() == htmlBefore) {
			$(this).html(htmlAfter);
		} else {
			$(this).html(htmlBefore);
		}
	});
    
    
    
    
});	