
<div class="submenu-parent-mobile-1">
    <ul style="margin-left: 15px;">
        @foreach($childs as $child)
        @if($menu == $child->menu)
        <li>
            <a style="position:initial"  href="{{$child->link}}">{{$child->label}}</a>
            @if(count($child->childs))
               <span class="icon-right-child" style="color: #222;"><i class="far fa-angle-right"></i></span>
            @endif
            </a>
            @if(count($child->childs))
                @include('frontend.subsidebarmenuchild',[ 'childs' => $child->childs, 'menu' => $menu])
            @endif
        </li>
        @endif
        @endforeach
    </ul>
</div>
