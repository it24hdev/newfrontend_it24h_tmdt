<ul class="menu-cat-mobile">
@foreach($Sidebars  as $Sidebar)
    @if($Sidebar->parent_id==0)
    <li>
        <a href="{!! route('product_cat',  $Sidebar->slug) !!}"><span class="icon-menu me-1"><i class="fas fa-laptop"></i></span> {{$Sidebar->name}}</a>
        @if(count($Sidebar->childs))
        <span class="icon-right"><i class="far fa-angle-right"></i></span>
        @endif
        
        <div class="submenu-parent-mobile">
            @if(count($Sidebar->childs))
            <ul style="margin-left: 5px;">
                @foreach($Sidebars as $subsidebar)
                @if($subsidebar->parent_id == $Sidebar->id)

                <li><a href="{!! route('product_cat',  $subsidebar->slug) !!}">- {{$subsidebar->name}}</a>
                    @if(count($subsidebar->childs))
                        @include('frontend.subsidebarmenu',['childs' => $subsidebar->childs])
                    @endif
                </li>
                @endif
                @endforeach
            </ul>
            @endif
        </div> 
    </li>
    @endif
@endforeach
</ul>
<script>
    $('.icon-right').click(function(){
        $(this).parent('li').children('.submenu-parent-mobile').slideToggle();
        $(this).html('<i class="far fa-angle-down"></i>');
    });
    $('.icon-right-child').click(function(){
        $(this).parent('li').children('.submenu-parent-mobile-1').slideToggle();
        $(this).html('<i class="far fa-angle-down"></i>');
    });
</script>