<div class="submenu-child">
    <ul>
    @foreach($childs as $child)
        @if($menu == $child->menu)
        <li>
             <a href="{{$child->link}}">{{$child->label}}</a>
        </li>
        @endif
    @endforeach
    </ul>
</div>
