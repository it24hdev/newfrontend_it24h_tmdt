<div class="body_mobile">
    {{--    slider banner--}}
    <div class="home_top">
        <div class="banner_top">
            <div class="border_slider">
                <div class="owl-carousel owl-theme owl-loaded owl-drag" id="slider-show">
                    @foreach ($sliders as $item)
                        <a href="{{$item->link_target}}">
                            <img class="owl-lazy"
                                 data-src="{{asset('upload/images/slider/thumb/'.$item->image)}}"
                                 alt="">
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    {{--    category--}}
    <div class="category_">
        <div class="b_cate">
            <div class="content_cat">
                <div class="content_cat_w">
                    @foreach ($get_cat_parents as $item)
{{--                    item--}}
                    <div class="item-categories-outer">
                        <a href="{{route('product_cat', ['slug' =>  $item->slug])}}"
                           class="item-categories square"
                           style="background-color:transparent;background-image:url({{asset('upload/images/products/thumb/'.$item->thumb)}});">
                        </a>
                        <p class="title-under">{{$item->name}}</p>
                    </div>
{{--                    end item--}}
                        @endforeach
                </div>
            </div>
        </div>
    </div>
    {{--    hotsale --}}
    <div class="hot_sale col-12">
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
                                    <div class="count-down" id="timesale" get-time-sale="{{$time_sale}}">
                                        <span id="d"></span> &nbsp;<span id="h"></span>&nbsp;:&nbsp;<span id="m"></span>&nbsp;:&nbsp;<span id="s"></span></div>
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
                                                    <div class="promotion">
                                                        <div class="dprice dpromotion">{{number_format($value->price,0,',','.')}} đ</div>
                                                        <div class="dprice dpercent">- 0%</div>
                                                    </div>
                                                    <div class="p_price">{{number_format($value->price,0,',','.')}} đ</div>
                                                @endif
                                            </div>
                                            @if (!empty($value->brands->image))
                                                <span class="dbrand" style="background-image: url('{{asset("upload/images/products/thumb/".$value->brands->image)}}');"></span>
                                            @endif
                                            <div class="dtag">
                                                @if (!empty($value->year))
                                                    <span class="years">NEW 2022</span>
                                                @endif
                                                @if (!empty($value->installment))
                                                    <span class="payment">Trả góp 0%</span>
                                                @endif
                                            </div>
                                            <div class="sold">
                                                <div class="dealsqty">
                                                    <div class="dprogress" style="width:{{$value->pt_sl_daban()}}%"></div>
                                                    @if (!empty($value->sold))
                                                        <span>Đã bán {{$value->sold}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{--khuyen mai hot--}}
    <div class="category-container">
        <div class="cat_box_sale">
            <div class="cat_box_s_h">
                <div class="title_s">
                    <i class="fas fa-fire"></i>
                    <h2>Khuyến mãi hot</h2></div>
            </div>
            <div class="featured-product-list" id="load_promotion">
            </div>
            <div class="viewall_s">
                <a href="#">Xem tất cả
                    <i class="fa fa-angle-down ml-2"></i>
                </a>
            </div>
        </div>
    </div>
    {{--categoryproduct--}}
    <div class="block-product" id="categories_p" list-cat="{{$list_cat}}" >
        @foreach($get_cat_parents as $item)
        <div class="block-featured-product" id="category_product_{{$item->id}}">
            {{--            list title--}}
            <div class="product-list-title is-flex is-flex-wrap-wrap">
                <a href="{{route('product_cat', ['slug' =>  $item->slug])}}" class="title"><h2>{{$item->name}}</h2>
                </a>
                <a href="{{route('product_cat', ['slug' =>  $item->slug])}}" class="more-product">Xem tất cả</a>

                <div class="list-related-tag" id="list_tag_{{$item->id}}">
                    <a href="https://cellphones.com.vn/man-hinh/gaming.html" class="related-tag">Màn hình Gaming</a>
                </div>
            </div>
            {{--                product--}}
            <div class="featured-product-list" id="list_products_{{$item->id}}">
                {{--                item--}}
                <div class="component-product">
                    <div class="tag_p">
                        <span class="years2">NEW</span>
                        <span class="payment2">Trả góp 0%</span>
                    </div>
                    <span class="dbrand2"
                          style="background-image: url('https://it24h.vn/tmdt_directory/public/upload/images/products/thumb/acer-1666346916.png');">
                    </span>
                    <div class="p-img">
                        <a href="#">
                            <img
                                src="https://it24h.vn/tmdt_directory/public/upload/images/products/medium/laptop-acer-aspire-5-a515-56g-51yl-nxa1lsv002-i5-1135g78gb-ram512gb-ssdmx350-2g156-inch-fhdwin10bac-1666337560.png"
                                alt="PC Asus All in One M5401WU (R5 5500U/8GB RAM/512GB SSD/23.8 inch Full HD/Touch/WL+BT/K+M/Win 10) (M5401WUAT-BA040T)">
                        </a>
                    </div>
                    <div class="p-info">
                        <a href="#" class="p-name">Laptop Acer Aspire 5 A515-56G-51YL (NX.A1LSV.002) (i5 1135G7/8GB
                            RAM/512GB SSD/MX350 2G/15.6 inch FHD/Win10/Bạc)
                        </a>
                        <div class="promotion2">
                            <span class="pprice2"> 18.599.000đ </span>
                            <span class="dpercent2">- 5%</span>
                        </div>
                        <span class="p-price"> 19.799.000đ </span>
                    </div>
                    <div class="p_rev">
                        <div class="review">
                            <div class="rating2">
                                <div class="rating-upper" style="width: 0%">
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
                            <div class="sold2"><i class="fas fa-badge-check"></i>Đã bán 1</div>
                        </div>

                    </div>
                    <div class="detail-bottom">
                        <div class="qty" style="color: #01aa42; background-color: #dbf8e1;">Còn hàng</div>
                        <div class="action">
                            <a href="javascript:;" class="heart add-wish" title="Lưu sản phẩm"><i
                                    class="far fa-heart"></i></a>
                            <a href="javascript:;" title="Thêm vào giỏ hàng" class="add-cart"><i
                                    class="far fa-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>
                {{--                end item--}}
                {{--                item--}}
                <div class="component-product">
                    <div class="tag_p">
                        <span class="years2">NEW</span>
                        <span class="payment2">Trả góp 0%</span>
                    </div>
                    <span class="dbrand2"
                          style="background-image: url('https://it24h.vn/tmdt_directory/public/upload/images/products/thumb/lenovo-1666407200.png');">
                    </span>
                    <div class="p-img">
                        <a href="#">
                            <img src="https://hanoicomputercdn.com/media/product/120_60623_asus_m5401.jpg"
                                 alt="PC Asus All in One M5401WU (R5 5500U/8GB RAM/512GB SSD/23.8 inch Full HD/Touch/WL+BT/K+M/Win 10) (M5401WUAT-BA040T)">
                        </a>
                    </div>
                    <div class="p-info">
                        <a href="#" class="p-name">
                            PC Asus All in One M5401WU (R5 5500U/8GB RAM/512GB SSD/23.8 inch Full HD/Touch/WL+BT/K+M/Win
                            10) (M5401WUAT-BA040T)
                        </a>
                        <div class="promotion2">
                            <span class="pprice2"> 18.599.000đ </span>
                            <span class="dpercent2">- 5%</span>
                        </div>
                        <span class="p-price"> 19.799.000đ </span>
                    </div>
                    <div class="p_rev">
                        <div class="review">
                            <div class="rating2">
                                <div class="rating-upper" style="width: 0%">
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
                            <div class="sold2"><i class="fas fa-badge-check"></i>Đã bán 1</div>
                        </div>

                    </div>
                    <div class="detail-bottom">
                        <div class="qty" style="color: #01aa42; background-color: #dbf8e1;">Còn hàng</div>
                        <div class="action">
                            <a href="javascript:;" class="heart add-wish" title="Lưu sản phẩm"><i
                                    class="far fa-heart"></i></a>
                            <a href="javascript:;" title="Thêm vào giỏ hàng" class="add-cart"><i
                                    class="far fa-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>
                {{--                end item--}}
                {{--                item--}}
                <div class="component-product">
                    <div class="tag_p">
                        <span class="years2">NEW</span>
                        <span class="payment2">Trả góp 0%</span>
                    </div>
                    <span class="dbrand2"
                          style="background-image: url('https://it24h.vn/tmdt_directory/public/upload/images/products/thumb/lenovo-1666407200.png');">
                    </span>
                    <div class="p-img">
                        <a href="#">
                            <img src="https://hanoicomputercdn.com/media/product/120_60623_asus_m5401.jpg"
                                 alt="PC Asus All in One M5401WU (R5 5500U/8GB RAM/512GB SSD/23.8 inch Full HD/Touch/WL+BT/K+M/Win 10) (M5401WUAT-BA040T)">
                        </a>
                    </div>
                    <div class="p-info">
                        <a href="#" class="p-name">
                            PC Asus All in One M5401WU (R5 5500U/8GB RAM/512GB SSD/23.8 inch Full HD/Touch/WL+BT/K+M/Win
                            10) (M5401WUAT-BA040T)
                        </a>
                        <div class="promotion2">
                            <span class="pprice2"> 18.599.000đ </span>
                            <span class="dpercent2">- 5%</span>
                        </div>
                        <span class="p-price"> 19.799.000đ </span>
                    </div>
                    <div class="p_rev">
                        <div class="review">
                            <div class="rating2">
                                <div class="rating-upper" style="width: 0%">
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
                            <div class="sold2"><i class="fas fa-badge-check"></i>Đã bán 1</div>
                        </div>

                    </div>
                    <div class="detail-bottom">
                        <div class="qty" style="color: #01aa42; background-color: #dbf8e1;">Còn hàng</div>
                        <div class="action">
                            <a href="javascript:;" class="heart add-wish" title="Lưu sản phẩm"><i
                                    class="far fa-heart"></i></a>
                            <a href="javascript:;" title="Thêm vào giỏ hàng" class="add-cart"><i
                                    class="far fa-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>
                {{--                end item--}}
            </div>
        </div>
            @endforeach
    </div>
</div>
