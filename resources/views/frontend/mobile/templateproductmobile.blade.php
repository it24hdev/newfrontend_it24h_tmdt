@foreach($get_product_mobile as $value)
    <div class="component-product">
        <div style="width: 100%;
    height: auto;
    display: block;
    float: left;
    min-height: 30px;">
            <div class="tag_p">
                @if (!empty($value->year))
                    <span class="years2">{{$value->year}}</span>
                @endif
                @if (!empty($value->installment))
                    <span class="payment2">Trả góp 0%</span>
                @endif
            </div>
            @if (!empty($value->brands->image))
                <span class="dbrand2" style="background-image: url('{{asset("upload/images/products/thumb/".$value->brands->image)}}');"></span>
            @endif
        </div>
        <div class="p-img">
            <a href="{{ route('detailproduct', $value->slug)}}">
                <img src="{{asset('upload/images/products/thumb/'.$value->thumb)}}" alt="{{$value->name}}">
            </a>
        </div>
        <div style="display:block; float: left;">
        <div class="p-info">
            <a href="{{ route('detailproduct', $value->slug)}}" class="p-name">{{$value->name}}</a>
            @if (!empty($item->onsale))
                <div class="promotion2">
                    <span class="pprice2">{{number_format($value->price,0,',','.')}} đ</span>
                    <span class="dpercent2">- {{$value->onsale}}%</span>
                </div>
                <span class="p-price">{{number_format($value->price_onsale,0,',','.')}} đ</span>
            @else
                <span class="p-price">{{number_format($value->price,0,',','.')}} đ</span>
            @endif
        </div>
        </div>
        
        <div class="p_rev">
            <div class="review" style="float:left;">
                <div class="rating2">
                    <div class="rating-upper" style="width: {{$value->count_vote()}}%">
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
                @if(!empty($value->sold))
                    <div class="sold2"><i class="fas fa-badge-check"></i>Đã bán {{$value->sold}}</div>
                @endif
            </div>
        </div>
    <div style="display:block; float:left;">
        <div class="detail-bottom">
            @if (($value->quantity - $value->sold > 0))
                <div class="qty" style="color: #01aa42; background-color: #dbf8e1;">Còn hàng</div>
            @else
                <div class="qty" style="color: #ffffff; background-color: #fb0000;">Hết hàng</div>
            @endif
            <div class="action" style="position: absolute;right: 0;">
                <a href="javascript:;" get-id="{{$value->id}}" class="heart add-wish" title="Lưu sản phẩm">
                    @if(in_array($value->id,explode(' ', Cookie::get('list_wish'))))
                        <i class="fas fa-heart heart_red"></i>
                    @else
                        <i class="far fa-heart"></i>
                    @endif
                </a>
                <a href="javascript:;" get-id="{{$value->id}}"  title="Thêm vào giỏ hàng" class="add-cart">
                    <i class="far fa-shopping-cart"></i>
                </a>
            </div>
        </div>
    </div>
    </div>
@endforeach
