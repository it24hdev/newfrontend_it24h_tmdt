
<div class="submenu-parent-mobile-1">
    <ul style="margin-left: 15px;">
        @foreach($childs as $child)
        @if($menu == $child->menu)
        <li>
            @if(!empty($child->link))
                  <a style="position:initial"  href="https://{{$child->link}}">{{$child->label}}</a>
            @else
                @if(!empty($child->slug))
                    <a style="position:initial"  href="{!!route('product_cat',['slug' => $child->slug,$child->filter_name => $child->filter_value])!!}">{{$child->label}}</a>
                    @if(count($child->childs))
                       <span class="icon-right-child" style="color: #222;"><i class="far fa-angle-right"></i></span>
                    @endif
                    </a>
                    @if(count($child->childs))
                        @include('frontend.subsidebarmenuchild',[ 'childs' => $child->childs, 'menu' => $menu])
                    @endif

                @else
                    <a style="position:initial"  href="#">{{$child->label}}</a>
                    @if(count($child->childs))
                        <span class="icon-right-child" style="color: #222;"><i class="far fa-angle-right"></i></span>
                    @endif
                    </a>
                    @if(count($child->childs))
                        @include('frontend.subsidebarmenuchild',[ 'childs' => $child->childs, 'menu' => $menu])
                    @endif

                @endif
            @endif
        </li>
        @endif
        @endforeach
    </ul>
</div>