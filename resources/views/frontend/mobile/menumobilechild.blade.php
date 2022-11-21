{{--       right--}}
<div class="">
    <div class="box-title">
        <a href="{{$current_parent->link}}" target="_self" class="box-title__title"> {{$current_parent->label}}</a>
        <a href="{{$current_parent->link}}" target="_self" class="box-title__btn-show-all">Xem tất
            cả</a>
    </div>
    @foreach($child as $value)
        @if($value->parent == $current_parent->id)
            <div class="mt-1"><strong class="group-title">{{$value->label}}</strong>
                <div class="group-list">
                    <div class="menu-child-item group">
                        @foreach($child2 as $item)
                            @if($item->parent == $value->id)
                                <div class="group-item">
                                    <div class="menu-child-item menu-item">
                                        <a href="{{$item->link}}" class="label-wrapper">
                                            <div class="label-item">
                                                @if(!empty($item->img_brand) && $item->filter_by == 3)
                                                    <img src="{{asset('upload/images/products/thumb/'.$item->img_brand)}}">
                                                    <span>{{$item->label}}</span>
                                                @elseif(!empty($item->img_property) && $item->filter_by == 1)
                                                        <img src="{{asset('upload/images/products/thumb/'.$item->img_brand)}}">
                                                        <span>{{$item->label}}</span>
                                                @else
                                                    @if($item->img_cat != 'no-images.jpg')
                                                    <img src="{{asset('upload/images/products/thumb/'.$item->img_cat)}}">
                                                    @endif
                                                    <span>{{$item->label}}</span>
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
