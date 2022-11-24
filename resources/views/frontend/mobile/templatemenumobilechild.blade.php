{{--       right--}}
{{--<div class="mgb_cat_m">--}}
{{--    <div class="box-title">--}}
{{--        <a href="{{$current_parent->link}}" target="_self" class="box-title__title"> {{$current_parent->label}}</a>--}}
{{--        <a href="{{$current_parent->link}}" target="_self" class="box-title__btn-show-all">Xem tất--}}
{{--            cả</a>--}}
{{--    </div>--}}
{{--    @foreach($child as $value)--}}
{{--        @if($value->parent == $current_parent->id)--}}
{{--            <div class="mt-1"><strong class="group-title">{{$value->label}}</strong>--}}
{{--                <div class="group-list">--}}
{{--                    <div class="menu-child-item group">--}}
{{--                        @foreach($child2 as $item)--}}
{{--                            @if($item->parent == $value->id)--}}
{{--                                <div class="group-item">--}}
{{--                                    <div class="menu-child-item menu-item">--}}
{{--                                        <a href="{{$item->link}}" class="label-wrapper">--}}
{{--                                            <div class="label-item">--}}
{{--                                                @if($item->img_caption == 0)--}}
{{--                                                        <span>{{$item->label}}</span>--}}
{{--                                                @elseif($item->img_caption == 1)--}}
{{--                                                    @if(!empty($item->img_brand) && $item->filter_by == 3)--}}
{{--                                                        <img src="{{asset('upload/images/products/thumb/'.$item->img_brand)}}">--}}
{{--                                                    @elseif(!empty($item->img_property) && $item->filter_by == 1)--}}
{{--                                                        <img src="{{asset('upload/images/products/thumb/'.$item->img_brand)}}">--}}
{{--                                                    @else--}}
{{--                                                        @if($item->img_cat != 'no-images.jpg')--}}
{{--                                                            <img src="{{asset('upload/images/products/thumb/'.$item->img_cat)}}">--}}
{{--                                                        @endif--}}
{{--                                                    @endif--}}
{{--                                                @else--}}
{{--                                                    @if(!empty($item->img_brand) && $item->filter_by == 3)--}}
{{--                                                        <img src="{{asset('upload/images/products/thumb/'.$item->img_brand)}}">--}}
{{--                                                        <span>{{$item->label}}</span>--}}
{{--                                                    @elseif(!empty($item->img_property) && $item->filter_by == 1)--}}
{{--                                                        <img src="{{asset('upload/images/products/thumb/'.$item->img_brand)}}">--}}
{{--                                                        <span>{{$item->label}}</span>--}}
{{--                                                    @else--}}
{{--                                                        @if($item->img_cat != 'no-images.jpg')--}}
{{--                                                            <img src="{{asset('upload/images/products/thumb/'.$item->img_cat)}}">--}}
{{--                                                        @endif--}}
{{--                                                        <span>{{$item->label}}</span>--}}
{{--                                                    @endif--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    @endforeach--}}
{{--</div>--}}


{{--       right--}}
<script id="template-menu-child" type="text/x-custom-template">
    <div class="mt-1"><strong class="group-title"></strong>
        <div class="group-list">
            <div class="menu-child-item group">
                <div class="group-item">
                    <div class="menu-child-item menu-item">
                        <a class="label-wrapper">
                            <div class="label-item">

                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>
