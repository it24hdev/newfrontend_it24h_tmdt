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
                    @foreach ($list_cat_head as $item)
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
    <div class="hot_sale col-12" id="load_sale">

    </div>
    {{--khuyen mai hot--}}
    <div class="category-container">
        <div class="cat_box_sale">
            <div class="cat_box_s_h">
                <div class="title_s">
                    <i class="fas fa-fire"></i>
                    <h2>Khuyến mãi hot</h2></div>
            </div>
            <div class="featured-product-list">
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
            <div class="viewall_s">
                <a href="#">Xem tất cả
                    <i class="fa fa-angle-down ml-2"></i>
                </a>
            </div>
        </div>
    </div>
    {{--categoryproduct--}}
    <div class="block-product">
        <div class="block-featured-product">
            {{--            list title--}}
            <div class="product-list-title is-flex is-flex-wrap-wrap">
                <a href="https://cellphones.com.vn/man-hinh.html" class="title"><h2>MÀN HÌNH, MÁY TÍNH ĐỂ BÀN</h2>
                </a>
                <a href="https://cellphones.com.vn/man-hinh.html" class="more-product">Xem tất cả</a>
                <div class="list-related-tag">
                    <a href="https://cellphones.com.vn/may-tinh-de-ban.html" class="related-tag">Máy tính bàn</a>
                    <a href="https://cellphones.com.vn/may-tinh-de-ban/dong-bo.html" class="related-tag">PC đồng
                        bộ</a>
                    <a href="https://cellphones.com.vn/may-tinh-de-ban/pc-gaming.html"
                       class="related-tag">PC Gaming</a>
                    <a href="https://cellphones.com.vn/may-tinh-de-ban/do-hoa.html" class="related-tag">PC Đồ
                        họa</a>
                    <a href="https://cellphones.com.vn/may-tinh-de-ban/build-pc.html" class="related-tag">Build PC</a>
                    <a href="https://cellphones.com.vn/man-hinh/van-phong.html" class="related-tag">Màn hình văn
                        phòng</a>
                    <a href="https://cellphones.com.vn/man-hinh/gaming.html" class="related-tag">Màn hình Gaming</a>
                    <a href="https://cellphones.com.vn/man-hinh.html" class="related-tag" style="display: none;">Xem tất
                        cả</a>
                </div>
            </div>
            {{--                product--}}
            <div class="featured-product-list">
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
    </div>
</div>
