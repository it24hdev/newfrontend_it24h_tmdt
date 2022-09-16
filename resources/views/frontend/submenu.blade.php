@foreach($childs as $child)
@if( $child->menu ==1)
    <li class="levelmenu_li1">
        <a href="#"> {{$child->label}}</a>
        @if(count($child->childs))
        <ul class="levelmenu_ul2">
                @include('user.submenu',['childs' => $child->childs])
        </ul>
        @endif
    </li>
@endif
@endforeach