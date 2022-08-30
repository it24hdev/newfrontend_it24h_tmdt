<div class="tab-content container-home" id="pills-tabContent">
    @php
            $e=0;
    @endphp
    @foreach ($cat_parent->cat_child as $cat_child)
        @php
            $e++;
        @endphp
            <div class="tab-pane fade {{($e==1) ? 'show active' : ''}}" id="pills-cat{{$cat_child->id}}" role="tabpanel" aria-labelledby="pills-cat{{$cat_child->id}}-tab">
                <div class="list-product owl-carousel owl-theme owl-loaded owl-drag list-product-group" id="list-product-group">
                    @foreach ($cat_child->get_list_product_by_cat() as $item)
                        <!-- product -->
                    <div class="product-item mb-3">
                        <div class="thumb">
                            <a href="{{ route('detailproduct', $item->slug)}}">
                                <img class="owl-lazy" data-src="{{asset('upload/images/products/medium/'.$item->thumb)}}" alt="">
                                @if (!empty($item->brand))
                                    <span class="brand" style="background-image: url('{{asset("upload/images/products/thumb/".$item->brands->image)}}');"></span>
                                @endif
                                <div class="wp-tag">
                                    @if (!empty($item->year))
                                        <span class="years">{{$item->year}}</span>
                                    @endif
                                    @if (!empty($item->installment))
                                        <span class="payment">Trả góp 0%</span>
                                    @endif
                                </div>
                            </a>
                        </div>
                        <div class="detail">
                            <div class="wp-event">
                                @if (!empty($item->event))
                                    <p class="event" style="background: linear-gradient(to right,{{$item->events->color_left}},{{$item->events->color_right}});">
                                        <img src="{{asset('upload/images/products/thumb/'.$item->events->icon)}}" alt="">
                                        <span>{{$item->events->name}}</span>
                                    </p>
                                @else
                                    <p class="event" style="min-height: 20px;"></p>
                                @endif
                                <p class="code">Mã: {{$item->id}}</p>
                            </div>
                            <div class="name">
                                <a href="{{ route('detailproduct', $item->slug)}}">{{$item->name}}</a>
                            </div>
                            @if (!empty($item->specifications))
                                <ul class="product-attributes">
                                    @foreach ($item->get_specifications() as $k)
                                        <li>{{$k}}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="price-review clearfix">
                                <div class="price">
                                    @if (!empty($item->onsale))
                                        <span class="onsale">- {{$item->onsale}}%</span>
                                        <div class="price-old">{{number_format($item->price,0,',','.')}} đ</div>
                                        <div class="price-new">{{number_format($item->price_onsale,0,',','.')}} đ</div>
                                    @else
                                        <div class="price-new">{{number_format($item->price,0,',','.')}} đ</div>
                                    @endif
                                </div>
                                <div class="review">
                                    <div class="rating2">
                                        <div class="rating-upper" style="width: {{$item->count_vote()}}%">
                                            <span><i class="fas fa-star"></i></span>
                                            <span><i class="fas fa-star"></i></span>
                                            <span><i class="fas fa-star"></i></span>
                                            <span><i class="fas fa-star"></i></span>
                                            <span><i class="fas fa-star"></i></span>
                                        </div>
                                        <div class="rating-lower">
                                            <span><i class="fal fa-star"></i></span>
                                            <span><i class="fal fa-star"></i></span>
                                            <span><i class="fal fa-star"></i></span>
                                            <span><i class="fal fa-star"></i></span>
                                            <span><i class="fal fa-star"></i></span>
                                        </div>
                                    </div>
                                    <div class="count-review">({{$item->votes->count()}})</div>
                                    @if (!empty($item->sold))
                                        <div class="sold"><i class="fas fa-badge-check"></i>Đã bán {{$item->sold}}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="detail-bottom">
                                @if (!empty($item->still_stock))
                                    <div class="qty" style="color: #01aa42;
                                    background-color: #dbf8e1;">{{$item->still_stock}}</div>
                                @endif
                                <div class="action">
                                    <a href="javascript:;" class="repeat" title="So sánh"><i class="far fa-repeat"></i></a>
                                    <a href="javascript:;" class="heart add-wish" title="Lưu sản phẩm" onclick="add_wish({{$item->id}})"><i class="far fa-heart"></i></a>
                                    <a href="javascript:;" title="Thêm vào giỏ hàng" class="add-cart" onclick="add_cart({{$item->id}})"><i class="far fa-shopping-cart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
    @endforeach
</div>
