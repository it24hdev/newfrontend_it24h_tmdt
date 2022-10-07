
<div class="submenu-child">
    <ul>
    @foreach($childs as $child)
        <li>
            <p> {{$child}}</p>

            @if($child->form_filter == 0)
            <a href="{!! route('product_cat',  ['slug' => $child->link]) !!}">{{$child->label}}</a>
            @elseif($child->form_filter == 1)
            <a href="{!! route('product_cat',  ['slug' => $child->link,$child->code_categoryproperties =>  $child->code_property]) !!}" >{{$child->label}}</a>
            @else
            <a href="{!! route('product_cat',  ['slug' => $child->link, 'p' =>  $child->min_price.','.$child->max_price]) !!}">{{$child->label}}</a>
            @endif

{{-- 
        <a href="{!! route('product_cat', ['slug' => $child->link, $child->code_categoryproperties => $child->code_property]) !!}"> --}}


            {{-- @if($locale == 'vi') --}}
            {{-- {{$child->label}} --}}
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
 