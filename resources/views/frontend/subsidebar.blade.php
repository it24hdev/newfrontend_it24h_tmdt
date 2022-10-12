<div class="submenu-child">
    <ul>
    @foreach($childs as $child)
        <li>
            <a href="{!! $child->link !!}">{{$child->label}}</a>
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
 