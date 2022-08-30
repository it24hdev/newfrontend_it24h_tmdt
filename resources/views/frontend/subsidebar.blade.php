
<div class="submenu-child">
    <ul>
    @foreach($childs as $child)
        <li>
        <a href="{!! route('product_cat', $child->slug) !!}">
            {{-- @if($locale == 'vi') --}}
            {{$child->name}}
            {{-- @else {{$child->name2}} --}}
            {{-- @endif --}}
            @if(count($child->childs))
            <span class="next-right">
                <i class="far fa-angle-right"></i>
            </span>
            @endif
        </a>

            @if(count($child->childs))
                @include('frontend.subsidebar',['childs' => $child->childs])
            @endif
        </li>
    @endforeach
    </ul>
    </div>
