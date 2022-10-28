<ul class="menu-cat-mobile">
@foreach($Sidebars  as $Sidebar)
    @if($Sidebar->parent==0)
    <li>
        <a href="{!! $Sidebar->link !!}"><span class="icon-menu me-1">
        {!! $Sidebar->class !!} {{$Sidebar->label}}</a>
        @if(count($Sidebar->childs))
        <span class="icon-right" get-id="{{$Sidebar->id}}" get-menu="{{$Sidebar->menu}}"><i class="far fa-angle-right"></i></span>
        @endif
        
        <div class="submenu-parent-mobile ajaxsubmenu" >
            <div id="subid-{{$Sidebar->id}}" class="full_sub">

            </div>
        </div> 
    </li>
    @endif
@endforeach
</ul>
<script>
    $('.icon-right').click(function(){
        $(this).parent('li').children('.submenu-parent-mobile').slideToggle();
        if(($(this).hasClass("loaded") == false)){
            var id = $(this).attr('get-id');
            var menu = $(this).attr('get-menu');
            var _token = $('meta[name="csrf-token"]').attr('content');
            var data = {
                id: id,
                menu: menu,
                _token: _token
            };
            $.ajax({
                url:"{{route('menucontent2')}}",
                type:"post",
                dataType:"json",
                data: data,
                success: function (data) {

                   $("#subid-"+ id).append(data); 
                },
            })
            $(this).addClass("loaded");
        }
    });
    $('.icon-right-child').click(function(){
        $(this).parent('li').children('.submenu-parent-mobile-1').slideToggle();
        $(this).html('<i class="far fa-angle-down"></i>');
    });
</script>