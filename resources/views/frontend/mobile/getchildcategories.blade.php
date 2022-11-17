@foreach($list_child as $value)
<a href="{{route('product_cat', ['slug' =>  $value->slug])}}" class="related-tag">{{$value->name}}</a>
@endforeach
