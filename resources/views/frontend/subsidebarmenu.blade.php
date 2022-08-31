<span class="icon-right-child" style="color: #222;"><i class="far fa-angle-right"></i></span>
<div class="submenu-parent-mobile-1">
    <ul style="margin-left: 15px;">
        @foreach($childs as $child)
        <li><a style="position:initial" href="{!! route('product_cat', $child->slug) !!}">{{$child->name}}</a>  
            @if(count($child->childs))
                @include('frontend.subsidebarmenu',['childs' => $child->childs])
            @endif
        </li>
        @endforeach
    </ul>
</div>