{{--        left--}}
<div class="">
    @foreach($parent as $value)
    <a get-id="{{$value->id}}" class="label-menu-tree @if($value->id == $current_parent->id)active @endif">
        @if($value->img_cat)
        <i class="icons-cate" style="background-image:url({{asset('upload/images/products/thumb/'.$value->img_cat)}});"></i>
        @endif
        <p>{{$value->label}}</p>
    </a>
    @endforeach
</div>

