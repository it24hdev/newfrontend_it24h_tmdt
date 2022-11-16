<div class="block_hot_sale">
    <div class="hot_sale_l1">
        {{--                header-time sale--}}
        <div class="header_sale">
            <div class="top_header_sale">
                <div class="h_inner title_s">
                    <div class="d-flex">
                        <i class="fas fa-bolt"></i>
                        <p>SIÊU ƯU ĐÃI TRONG THÁNG NÀY</p>
                    </div>
                    <div class="time_count">
                        <a title="Xem tất cả Deal Hot" href="#">
                            <div class="count-down">
                                <span>02</span>&nbsp;:&nbsp;<span>57</span>&nbsp;:&nbsp;<span>43</span></div>
                            <img width="20" height="20"
                                 src="https://frontend.tikicdn.com/_mobile-next/static/img/iconsChevronRight.png"
                                 alt="see_more">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        {{--                sale--}}
        <div class="block_c_s">
            <div class="content_h_sale">
                <div class="hs_content_wrapper">
                    @foreach($get_hot_sale_mobile as $value)
                    <div class="round_ps">
                        <div class="item_p">
                            <a class="ditem" href="{{ route('detailproduct', $value->slug)}}">
                                <div class="p_img">
                                    <img src="{{asset('upload/images/products/thumb/'.$value->thumb)}}">
                                </div>
                                <div class="p_price">
                                    @if (!empty($value->onsale))
                                        <div class="promotion">
                                            <div class="dprice dpromotion">{{number_format($value->price,0,',','.')}} đ</div>
                                            <div class="dprice dpercent">- {{$value->onsale}}%</div>
                                        </div>
                                        <div class="p_price">{{number_format($value->price_onsale,0,',','.')}} đ</div>
                                    @else
                                        <div class="p_price">{{number_format($value->price,0,',','.')}} đ</div>
                                    @endif
                                </div>
                                @if (!empty($item->brands->image))
                                <span class="dbrand" style="background-image: url('{{asset("upload/images/products/thumb/".$value->brands->image)}}');"></span>
                                @endif
                                <div class="dtag">
                                    @if (!empty($item->year))
                                    <span class="years">NEW 2022</span>
                                    @endif
                                    @if (!empty($item->installment))
                                    <span class="payment">Trả góp 0%</span>
                                        @endif
                                </div>
                                <div class="sold">
                                    <div class="dealsqty">
                                        <div class="dprogress" style="width:{{$edit->pt_sl_daban()}}%"></div>
                                        @if (!empty($item->sold))
                                        <span>Đã bán {{$item->sold}}</span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
