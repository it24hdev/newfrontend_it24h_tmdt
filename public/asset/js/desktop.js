$(document).ready(function () {
    // =======================menu sidebar=============================
    $('.menucontent').hover(function() {
        if(($(this).hasClass("loaded") == false)){
            var id = $(this).find('.ajaxsubmenu').attr('get-id');
            var menu = $(this).find('.ajaxsubmenu').attr('get-menu');
            var data = {
                id: id,
                menu: menu
            };
            $.ajax({
                url:"{{route('menucontent')}}",
                type:"post",
                dataType:"json",
                data: data,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    $("#subid-"+ id).append(data);
                },
            })
            $(this).addClass("loaded");
        }
    });

});
