
<div class="submenu-child">
    <ul>
    @foreach($childs as $child)
        <li>
        <a href="{!! route('product_cat', ['slug' => $child->link, $child->code_property]) !!}">
            {{-- @if($locale == 'vi') --}}
            {{$child->label}}
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
 