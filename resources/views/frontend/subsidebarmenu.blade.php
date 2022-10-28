<ul style="margin-left: 5px;">
    @foreach($Sidebars as $subsidebar)
    @if($subsidebar->parent == $Sidebarid)
    <li><a href="{!! $subsidebar->link !!}">- {{$subsidebar->label}}</a>
        @if(count($subsidebar->childs))
       <span class="icon-right-child" style="color: #222;"><i class="far fa-angle-right"></i></span>
            @include('frontend.subsidebarmenuchild',['childs' => $subsidebar->childs, 'menu' =>$subsidebar->menu])
        @endif
    </li>
    @endif
    @endforeach
</ul>

<script>
    $(document).ready(function () {
     $('.icon-right-child').click(function(){
        $(this).parent('li').children('.submenu-parent-mobile-1').slideToggle();
        $(this).html('<i class="far fa-angle-down"></i>');
    });
 });
</script>