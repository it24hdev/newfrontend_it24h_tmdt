<div class="submenu-child">
    <ul>
    @foreach($childs as $child)
        @if($menu == $child->menu)
        <li>
            @if(!empty($child->link))
                  <a href="https://{{$child->link}}">{{$child->label}}</a>
            @else
                @if(!empty($child->slug))
                    <a href="{!!route('product_cat',['slug' => $child->slug,$child->filter_name => $child->filter_value])!!}">{{$child->label}}</a>
                    @if(count($child->childs))
                        <span class="next-right"><i class="far fa-angle-right"></i></span>
                    @endif
                    </a>
                    @if(count($child->childs))
                        @include('frontend.subsidebar',[ 'childs' => $child->childs, 'menu' => $menu])
                    @endif

                @else
                    <a href="#">{{$child->label}}</a>
                    @if(count($child->childs))
                        <span class="next-right"><i class="far fa-angle-right"></i></span>
                    @endif
                    </a>
                    @if(count($child->childs))
                        @include('frontend.subsidebar',[ 'childs' => $child->childs, 'menu' => $menu])
                    @endif

                @endif
            @endif
        </li>
        @endif
    @endforeach
    </ul>
</div>
 