@foreach($childs as $child)
@if( $child->sidebar == 1)
    <li class="levelmenu_li1">
    <a href="{!! route('product_cat', ['slug' => $child->slug]) !!}">
        @if($locale == 'vi'){{$child->name}}
        @else {{$child->name2}}
        @endif
    </a>
        @if(count($child->childs))
        <ul class="levelmenu_ul2">
                @include('frontend.subsidebar',['childs' => $child->childs])
        </ul>
        @endif
    </li>
@endif
@endforeach