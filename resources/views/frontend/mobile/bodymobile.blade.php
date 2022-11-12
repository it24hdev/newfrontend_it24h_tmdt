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
    {{--    hotsale --}}
    <div class="hot_sale col-12">
        <div class="block_hot_sale">
            <div class="hot_sale_l1">
                {{--                header-time sale--}}
                <div class="header_sale">
                    <div class="top_header_sale">
                        <div class="h_inner">
                            <a href="#">
                                <img width="66" src="https://frontend.tikicdn.com/_mobile-next/static/img/giasoc.svg"
                                     alt="flash deal">
                                <img width="21" src="https://frontend.tikicdn.com/_mobile-next/static/img/dealFlashIcon.svg"
                                     alt="flash deal" class="style__Flash-sc-eqzktw-1 eXUQVs">
                                <img width="84" src="https://frontend.tikicdn.com/_mobile-next/static/img/homnay.svg"
                                    alt="flash deal">
                            </a>
                            <div class="time_count">
                                <a title="Xem tất cả Deal Hot" href="#">
                                    <div class="count-down">
                                        <span>02</span>&nbsp;:&nbsp;<span>57</span>&nbsp;:&nbsp;<span>43</span></div>
                                    <img width="20" height="20" src="https://frontend.tikicdn.com/_mobile-next/static/img/iconsChevronRight.png"
                                         alt="see_more">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                {{--                sale--}}
                <div class="deal_sale">
                    <div class="h_block hp_sale">
                        <div class="hide-scrollbar">
                            <div class="scroll_view">
                                <div class="size_block">
                                    <div class="p_sale">
{{--                                        item--}}
                                        <div class="round_ps">
                                            <div class="item_p">
                                                <a class="ditem" href="#">
                                                    <div class="p_img">
                                                        <img src="https://salt.tikicdn.com/cache/280x280/ts/product/a6/de/4e/e96e2035f72c97c218ba9917f4e6d5ca.jpg">
                                                    </div>
                                                    <div class="dprice">3.690.000 ₫</div>
                                                    <div class="ddiscount">-18%</div>
                                                    <div class="dealsqty">
                                                        <div class="dprogress"></div>
                                                        <span>Đã bán 22</span>
                                                        <img class="fire-icon" src="https://frontend.tikicdn.com/_mobile-next/static/img/fire_icon.svg">
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
{{--                                        end item--}}
                                        <div class="round_ps">
                                            <div class="item_p">
                                                <a class="ditem" href="#">
                                                    <div class="p_img">
                                                        <img src="https://salt.tikicdn.com/cache/280x280/ts/product/a6/de/4e/e96e2035f72c97c218ba9917f4e6d5ca.jpg">
                                                    </div>
                                                    <div class="dprice">3.690.000 ₫</div>
                                                    <div class="ddiscount">-18%</div>
                                                    <div class="dealsqty">
                                                        <div class="dprogress"></div>
                                                        <span>Đã bán 22</span>
                                                        <img class="fire-icon" src="https://frontend.tikicdn.com/_mobile-next/static/img/fire_icon.svg">
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="round_ps">
                                            <div class="item_p">
                                                <a class="ditem" href="#">
                                                    <div class="p_img">
                                                        <img src="https://salt.tikicdn.com/cache/280x280/ts/product/a6/de/4e/e96e2035f72c97c218ba9917f4e6d5ca.jpg">
                                                    </div>
                                                    <div class="dprice">3.690.000 ₫</div>
                                                    <div class="ddiscount">-18%</div>
                                                    <div class="dealsqty">
                                                        <div class="dprogress"></div>
                                                        <span>Đã bán 22</span>
                                                        <img class="fire-icon" src="https://frontend.tikicdn.com/_mobile-next/static/img/fire_icon.svg">
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="round_ps">
                                            <div class="item_p">
                                                <a class="ditem" href="#">
                                                    <div class="p_img">
                                                        <img src="https://salt.tikicdn.com/cache/280x280/ts/product/a6/de/4e/e96e2035f72c97c218ba9917f4e6d5ca.jpg">
                                                    </div>
                                                    <div class="dprice">3.690.000 ₫</div>
                                                    <div class="ddiscount">-18%</div>
                                                    <div class="dealsqty">
                                                        <div class="dprogress"></div>
                                                        <span>Đã bán 22</span>
                                                        <img class="fire-icon" src="https://frontend.tikicdn.com/_mobile-next/static/img/fire_icon.svg">
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="round_ps">
                                            <div class="item_p">
                                                <a class="ditem" href="#">
                                                    <div class="p_img">
                                                        <img src="https://salt.tikicdn.com/cache/280x280/ts/product/a6/de/4e/e96e2035f72c97c218ba9917f4e6d5ca.jpg">
                                                    </div>
                                                    <div class="dprice">3.690.000 ₫</div>
                                                    <div class="ddiscount">-18%</div>
                                                    <div class="dealsqty">
                                                        <div class="dprogress"></div>
                                                        <span>Đã bán 22</span>
                                                        <img class="fire-icon" src="https://frontend.tikicdn.com/_mobile-next/static/img/fire_icon.svg">
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="round_ps">
                                            <div class="item_p">
                                                <a class="ditem" href="#">
                                                    <div class="p_img">
                                                        <img src="https://salt.tikicdn.com/cache/280x280/ts/product/a6/de/4e/e96e2035f72c97c218ba9917f4e6d5ca.jpg">
                                                    </div>
                                                    <div class="dprice">3.690.000 ₫</div>
                                                    <div class="ddiscount">-18%</div>
                                                    <div class="dealsqty">
                                                        <div class="dprogress"></div>
                                                        <span>Đã bán 22</span>
                                                        <img class="fire-icon" src="https://frontend.tikicdn.com/_mobile-next/static/img/fire_icon.svg">
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="round_ps">
                                            <div class="item_p">
                                                <a class="ditem" href="#">
                                                    <div class="p_img">
                                                        <img src="https://salt.tikicdn.com/cache/280x280/ts/product/a6/de/4e/e96e2035f72c97c218ba9917f4e6d5ca.jpg">
                                                    </div>
                                                    <div class="dprice">3.690.000 ₫</div>
                                                    <div class="ddiscount">-18%</div>
                                                    <div class="dealsqty">
                                                        <div class="dprogress"></div>
                                                        <span>Đã bán 22</span>
                                                        <img class="fire-icon" src="https://frontend.tikicdn.com/_mobile-next/static/img/fire_icon.svg">
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--    second slider--}}
        <div class="col-12 mt-3">
            <div class="home_brand">
                <div class="r_brand">
                    <div>
                    </div>
                    <a href="#" class="side-brand">
                        <img src="https://salt.tikicdn.com/ts/banner/6f/44/63/5087c1ae7a11391c4b5fcbac470f077c.png">
                    </a>
                    <a href="#" class="center-brand">
                        <img src="https://salt.tikicdn.com/ts/banner/0a/43/f2/205082fece3d9c8f6b04342b4242063c.png">
                    </a>
                    <a href="#" class="side-brand">
                        <img src="https://salt.tikicdn.com/ts/banner/b3/f9/5a/7703a3f5e28881b3f67cb9b087d9a44e.png">
                    </a>
                </div>
            </div>
        </div>
        {{--    category--}}
        <div class="col-12">
            <div class="categories_home">
                <div class="h_block iSyKie">
                    <div class="hide-scrollbar">
                        <div class="scroll_view">
                            <div class="size_block">
                                <div class="l_cat">
{{--                                    item--}}
                                    <div class="i_cat">
                                        <a class="text-decoration-none" href="#">
                                            <div class="position-relative">
                                                <img width="invalid-value" height="invalid-value"
                                                     alt="Khung Giờ Săn Sale" class="aVI9cK s1KOz9"
                                                     style="object-fit: contain"
                                                     src="https://it24h.vn/tmdt_directory/public/upload/images/products/thumb/pc-vp-gaming-do-hoa-server-1666061497.png">
                                            </div>
                                            <div class="name_cat">PC VP, Gaming Đồ họa Serve</div>
                                        </a>
                                    </div>
{{--                                    end item--}}
                                    <div class="i_cat">
                                        <a class="text-decoration-none" href="#">
                                            <div class="position-relative">
                                                <img width="invalid-value" height="invalid-value"
                                                     alt="Khung Giờ Săn Sale" class="aVI9cK s1KOz9"
                                                     style="object-fit: contain"
                                                     src="https://it24h.vn/tmdt_directory/public/upload/images/products/thumb/pc-vp-gaming-do-hoa-server-1666061497.png">
                                            </div>
                                            <div class="name_cat">PC VP, Gaming Đồ họa Serve</div>
                                        </a>
                                    </div>
                                    <div class="i_cat">
                                        <a class="text-decoration-none" href="#">
                                            <div class="position-relative">
                                                <img width="invalid-value" height="invalid-value"
                                                     alt="Khung Giờ Săn Sale" class="aVI9cK s1KOz9"
                                                     style="object-fit: contain"
                                                     src="https://it24h.vn/tmdt_directory/public/upload/images/products/thumb/pc-vp-gaming-do-hoa-server-1666061497.png">
                                            </div>
                                            <div class="name_cat">PC VP, Gaming Đồ họa Serve</div>
                                        </a>
                                    </div>
                                    <div class="i_cat">
                                        <a class="text-decoration-none" href="#">
                                            <div class="position-relative">
                                                <img width="invalid-value" height="invalid-value"
                                                     alt="Khung Giờ Săn Sale" class="aVI9cK s1KOz9"
                                                     style="object-fit: contain"
                                                     src="https://it24h.vn/tmdt_directory/public/upload/images/products/thumb/pc-vp-gaming-do-hoa-server-1666061497.png">
                                            </div>
                                            <div class="name_cat">PC VP, Gaming Đồ họa Serve</div>
                                        </a>
                                    </div>
                                    <div class="i_cat">
                                        <a class="text-decoration-none" href="#">
                                            <div class="position-relative">
                                                <img width="invalid-value" height="invalid-value"
                                                     alt="Khung Giờ Săn Sale" class="aVI9cK s1KOz9"
                                                     style="object-fit: contain"
                                                     src="https://it24h.vn/tmdt_directory/public/upload/images/products/thumb/pc-vp-gaming-do-hoa-server-1666061497.png">
                                            </div>
                                            <div class="name_cat">PC VP, Gaming Đồ họa Serve</div>
                                        </a>
                                    </div>
                                    <div class="i_cat">
                                        <a class="text-decoration-none" href="#">
                                            <div class="position-relative">
                                                <img width="invalid-value" height="invalid-value"
                                                     alt="Khung Giờ Săn Sale" class="aVI9cK s1KOz9"
                                                     style="object-fit: contain"
                                                     src="https://it24h.vn/tmdt_directory/public/upload/images/products/thumb/pc-vp-gaming-do-hoa-server-1666061497.png">
                                            </div>
                                            <div class="name_cat">PC VP, Gaming Đồ họa Serve</div>
                                        </a>
                                    </div>
                                    <div class="i_cat">
                                        <a class="text-decoration-none" href="#">
                                            <div class="position-relative">
                                                <img width="invalid-value" height="invalid-value"
                                                     alt="Khung Giờ Săn Sale" class="aVI9cK s1KOz9"
                                                     style="object-fit: contain"
                                                     src="https://it24h.vn/tmdt_directory/public/upload/images/products/thumb/pc-vp-gaming-do-hoa-server-1666061497.png">
                                            </div>
                                            <div class="name_cat">PC VP, Gaming Đồ họa Serve</div>
                                        </a>
                                    </div>
                                    <div class="i_cat">
                                        <a class="text-decoration-none" href="#">
                                            <div class="position-relative">
                                                <img width="invalid-value" height="invalid-value"
                                                     alt="Khung Giờ Săn Sale" class="aVI9cK s1KOz9"
                                                     style="object-fit: contain"
                                                     src="https://it24h.vn/tmdt_directory/public/upload/images/products/thumb/pc-vp-gaming-do-hoa-server-1666061497.png">
                                            </div>
                                            <div class="name_cat">PC VP, Gaming Đồ họa Serve</div>
                                        </a>
                                    </div>
                                    <div class="i_cat">
                                        <a class="text-decoration-none" href="#">
                                            <div class="position-relative">
                                                <img width="invalid-value" height="invalid-value"
                                                     alt="Khung Giờ Săn Sale" class="aVI9cK s1KOz9"
                                                     style="object-fit: contain"
                                                     src="https://it24h.vn/tmdt_directory/public/upload/images/products/thumb/pc-vp-gaming-do-hoa-server-1666061497.png">
                                            </div>
                                            <div class="name_cat">PC VP, Gaming Đồ họa Serve</div>
                                        </a>
                                    </div>
                                    <div class="i_cat">
                                        <a class="text-decoration-none" href="#">
                                            <div class="position-relative">
                                                <img width="invalid-value" height="invalid-value"
                                                     alt="Khung Giờ Săn Sale" class="aVI9cK s1KOz9"
                                                     style="object-fit: contain"
                                                     src="https://it24h.vn/tmdt_directory/public/upload/images/products/thumb/pc-vp-gaming-do-hoa-server-1666061497.png">
                                            </div>
                                            <div class="name_cat">PC VP, Gaming Đồ họa Serve</div>
                                        </a>
                                    </div>
                                    <div class="i_cat">
                                        <a class="text-decoration-none" href="#">
                                            <div class="position-relative">
                                                <img width="invalid-value" height="invalid-value"
                                                     alt="Khung Giờ Săn Sale" class="aVI9cK s1KOz9"
                                                     style="object-fit: contain"
                                                     src="https://it24h.vn/tmdt_directory/public/upload/images/products/thumb/pc-vp-gaming-do-hoa-server-1666061497.png">
                                            </div>
                                            <div class="name_cat">PC VP, Gaming Đồ họa Serve</div>
                                        </a>
                                    </div>
                                    <div class="i_cat">
                                        <a class="text-decoration-none" href="#">
                                            <div class="position-relative">
                                                <img width="invalid-value" height="invalid-value"
                                                     alt="Khung Giờ Săn Sale" class="aVI9cK s1KOz9"
                                                     style="object-fit: contain"
                                                     src="https://it24h.vn/tmdt_directory/public/upload/images/products/thumb/pc-vp-gaming-do-hoa-server-1666061497.png">
                                            </div>
                                            <div class="name_cat">PC VP, Gaming Đồ họa Serve</div>
                                        </a>
                                    </div>
                                    <div class="i_cat">
                                        <a class="text-decoration-none" href="#">
                                            <div class="position-relative">
                                                <img width="invalid-value" height="invalid-value"
                                                     alt="Khung Giờ Săn Sale" class="aVI9cK s1KOz9"
                                                     style="object-fit: contain"
                                                     src="https://it24h.vn/tmdt_directory/public/upload/images/products/thumb/pc-vp-gaming-do-hoa-server-1666061497.png">
                                            </div>
                                            <div class="name_cat">PC VP, Gaming Đồ họa Serve</div>
                                        </a>
                                    </div>
                                    <div class="i_cat">
                                        <a class="text-decoration-none" href="#">
                                            <div class="position-relative">
                                                <img width="invalid-value" height="invalid-value"
                                                     alt="Khung Giờ Săn Sale" class="aVI9cK s1KOz9"
                                                     style="object-fit: contain"
                                                     src="https://it24h.vn/tmdt_directory/public/upload/images/products/thumb/pc-vp-gaming-do-hoa-server-1666061497.png">
                                            </div>
                                            <div class="name_cat">PC VP, Gaming Đồ họa Serve</div>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--    product--}}
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
            <div class="featured-product-list" style="min-height:376px;">
                <div class="component-product" style="min-height:356px;">
                    <span class="percent">-6% </span>
                    <p class="p-sku">PCAS189</p>
                    <div class="p-img">
                        <a href="/pc-asus-all-in-one-m5401wu-r5-5500u-8gb-ram-512gb-ssd-23.8-inch-full-hd-touch-wl-bt-k-m-win-10-m5401wuat-ba040t">
                            <img src="https://hanoicomputercdn.com/media/product/120_60623_asus_m5401.jpg"
                                 style="min-width:150px;min-height:150px;"
                                 alt="PC Asus All in One M5401WU (R5 5500U/8GB RAM/512GB SSD/23.8 inch Full HD/Touch/WL+BT/K+M/Win 10) (M5401WUAT-BA040T)">
                        </a>
                    </div>
                    <div class="p-info" style="min-height:98px;">
                        <a href="/pc-asus-all-in-one-m5401wu-r5-5500u-8gb-ram-512gb-ssd-23.8-inch-full-hd-touch-wl-bt-k-m-win-10-m5401wuat-ba040t"
                           class="p-name">
                            PC Asus All in One M5401WU (R5 5500U/8GB RAM/512GB SSD/23.8 inch Full HD/Touch/WL+BT/K+M/Win
                            10) (M5401WUAT-BA040T)
                        </a>
                        <span class="p-price"> 18.599.000đ </span>
                        <span class="p-nprice"> 19.799.000đ </span>
                    </div>
                    <div class="p-action" style="height:24px;">
                        <span class="p-qty-0"> <i class="fas fa-phone fa-flip-horizontal"></i> Liên hệ </span>

                        <a href="javascript:;" style="font-size: 13px;" class="p-cart p-cart js-add-to-cart"
                           data-id=""> <i class="far fa-shopping-cart"></i> Giỏ hàng
                        </a>
                    </div>
                </div>
                <div class="component-product" style="min-height:356px;">
                    <span class="percent">-2% </span>
                    <p class="p-sku">PCAC115</p>
                    <div class="p-img">
                        <a href="/pc-acer-as-all-in-one-c22-963-i3-1005g1-8gb-ram-1tb-hdd-128gb-ssd-21.5-inch-fhd-wl-bt-k-m-win-10-dq.bensv.001">
                            <img src="https://hanoicomputercdn.com/media/product/120_56788_pc_acer_as_c22.jpg"
                                 style="min-width:150px;min-height:150px;"
                                 alt="PC Acer AS All in One C22-963 (i3-1005G1/8GB RAM/1TB HDD+128GB SSD/21.5 inch FHD/WL+BT/K+M/Win 10) (DQ.BENSV.001)">
                        </a>
                    </div>
                    <div class="p-info" style="min-height:98px;">
                        <a href="/pc-acer-as-all-in-one-c22-963-i3-1005g1-8gb-ram-1tb-hdd-128gb-ssd-21.5-inch-fhd-wl-bt-k-m-win-10-dq.bensv.001"
                           class="p-name">
                            PC Acer AS All in One C22-963 (i3-1005G1/8GB RAM/1TB HDD+128GB SSD/21.5 inch
                            FHD/WL+BT/K+M/Win 10) (DQ.BENSV.001)
                        </a>
                        <span class="p-price"> 15.699.000đ </span>
                        <span class="p-nprice"> 15.999.000đ </span>
                    </div>
                    <div class="p-action" style="height:24px;">
                        <span class="p-qty-0"> <i class="fas fa-phone fa-flip-horizontal"></i> Liên hệ </span>

                        <a href="javascript:;" style="font-size: 13px;" class="p-cart p-cart js-add-to-cart"
                           data-id=""> <i class="far fa-shopping-cart"></i> Giỏ hàng
                        </a>
                    </div>
                </div>
                <div class="component-product" style="min-height:356px;">
                    <span class="percent">-17% </span>
                    <p class="p-sku">PCHP665</p>
                    <div class="p-img">
                        <a href="/pc-hp-pavilion-tp01-1003d-i3-10105-4gb-ram-256gb-ssd-dvdrw-wl-bt-k-m-win-11-46j98pa">
                            <img
                                src="https://hanoicomputercdn.com/media/product/120_59908_hp_pavilion_590_tp01_850x850.jpg"
                                style="min-width:150px;min-height:150px;"
                                alt="PC HP Pavilion TP01-1003d (i3-10105/4GB RAM/256GB SSD/DVDRW/WL+BT/K+M/Win 11) (46J98PA)">
                        </a>
                    </div>
                    <div class="p-info" style="min-height:98px;">
                        <a href="/pc-hp-pavilion-tp01-1003d-i3-10105-4gb-ram-256gb-ssd-dvdrw-wl-bt-k-m-win-11-46j98pa"
                           class="p-name">
                            PC HP Pavilion TP01-1003d (i3-10105/4GB RAM/256GB SSD/DVDRW/WL+BT/K+M/Win 11) (46J98PA)
                        </a>
                        <span class="p-price"> 8.799.000đ </span>
                        <span class="p-nprice"> 10.659.000đ </span>
                    </div>
                    <div class="p-action" style="height:24px;">
                        <span class="p-qty"> <i class="far fa-check"></i> Còn hàng </span>

                        <a href="javascript:;" style="font-size: 13px;" class="p-cart p-cart js-add-to-cart"
                           data-id=""> <i class="far fa-shopping-cart"></i> Giỏ hàng
                        </a>
                    </div>
                </div>
            </div>
        </div>

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
            <div class="featured-product-list" style="min-height:376px;">
                <div class="component-product" style="min-height:356px;">
                    <span class="percent">-6% </span>
                    <p class="p-sku">PCAS189</p>
                    <div class="p-img">
                        <a href="/pc-asus-all-in-one-m5401wu-r5-5500u-8gb-ram-512gb-ssd-23.8-inch-full-hd-touch-wl-bt-k-m-win-10-m5401wuat-ba040t">
                            <img src="https://hanoicomputercdn.com/media/product/120_60623_asus_m5401.jpg"
                                 style="min-width:150px;min-height:150px;"
                                 alt="PC Asus All in One M5401WU (R5 5500U/8GB RAM/512GB SSD/23.8 inch Full HD/Touch/WL+BT/K+M/Win 10) (M5401WUAT-BA040T)">
                        </a>
                    </div>
                    <div class="p-info" style="min-height:98px;">
                        <a href="/pc-asus-all-in-one-m5401wu-r5-5500u-8gb-ram-512gb-ssd-23.8-inch-full-hd-touch-wl-bt-k-m-win-10-m5401wuat-ba040t"
                           class="p-name">
                            PC Asus All in One M5401WU (R5 5500U/8GB RAM/512GB SSD/23.8 inch Full HD/Touch/WL+BT/K+M/Win
                            10) (M5401WUAT-BA040T)
                        </a>
                        <span class="p-price"> 18.599.000đ </span>
                        <span class="p-nprice"> 19.799.000đ </span>
                    </div>
                    <div class="p-action" style="height:24px;">
                        <span class="p-qty-0"> <i class="fas fa-phone fa-flip-horizontal"></i> Liên hệ </span>

                        <a href="javascript:;" style="font-size: 13px;" class="p-cart p-cart js-add-to-cart"
                           data-id=""> <i class="far fa-shopping-cart"></i> Giỏ hàng
                        </a>
                    </div>
                </div>
                <div class="component-product" style="min-height:356px;">
                    <span class="percent">-2% </span>
                    <p class="p-sku">PCAC115</p>
                    <div class="p-img">
                        <a href="/pc-acer-as-all-in-one-c22-963-i3-1005g1-8gb-ram-1tb-hdd-128gb-ssd-21.5-inch-fhd-wl-bt-k-m-win-10-dq.bensv.001">
                            <img src="https://hanoicomputercdn.com/media/product/120_56788_pc_acer_as_c22.jpg"
                                 style="min-width:150px;min-height:150px;"
                                 alt="PC Acer AS All in One C22-963 (i3-1005G1/8GB RAM/1TB HDD+128GB SSD/21.5 inch FHD/WL+BT/K+M/Win 10) (DQ.BENSV.001)">
                        </a>
                    </div>
                    <div class="p-info" style="min-height:98px;">
                        <a href="/pc-acer-as-all-in-one-c22-963-i3-1005g1-8gb-ram-1tb-hdd-128gb-ssd-21.5-inch-fhd-wl-bt-k-m-win-10-dq.bensv.001"
                           class="p-name">
                            PC Acer AS All in One C22-963 (i3-1005G1/8GB RAM/1TB HDD+128GB SSD/21.5 inch
                            FHD/WL+BT/K+M/Win 10) (DQ.BENSV.001)
                        </a>
                        <span class="p-price"> 15.699.000đ </span>
                        <span class="p-nprice"> 15.999.000đ </span>
                    </div>
                    <div class="p-action" style="height:24px;">
                        <span class="p-qty-0"> <i class="fas fa-phone fa-flip-horizontal"></i> Liên hệ </span>

                        <a href="javascript:;" style="font-size: 13px;" class="p-cart p-cart js-add-to-cart"
                           data-id=""> <i class="far fa-shopping-cart"></i> Giỏ hàng
                        </a>
                    </div>
                </div>
                <div class="component-product" style="min-height:356px;">
                    <span class="percent">-17% </span>
                    <p class="p-sku">PCHP665</p>
                    <div class="p-img">
                        <a href="/pc-hp-pavilion-tp01-1003d-i3-10105-4gb-ram-256gb-ssd-dvdrw-wl-bt-k-m-win-11-46j98pa">
                            <img
                                src="https://hanoicomputercdn.com/media/product/120_59908_hp_pavilion_590_tp01_850x850.jpg"
                                style="min-width:150px;min-height:150px;"
                                alt="PC HP Pavilion TP01-1003d (i3-10105/4GB RAM/256GB SSD/DVDRW/WL+BT/K+M/Win 11) (46J98PA)">
                        </a>
                    </div>
                    <div class="p-info" style="min-height:98px;">
                        <a href="/pc-hp-pavilion-tp01-1003d-i3-10105-4gb-ram-256gb-ssd-dvdrw-wl-bt-k-m-win-11-46j98pa"
                           class="p-name">
                            PC HP Pavilion TP01-1003d (i3-10105/4GB RAM/256GB SSD/DVDRW/WL+BT/K+M/Win 11) (46J98PA)
                        </a>
                        <span class="p-price"> 8.799.000đ </span>
                        <span class="p-nprice"> 10.659.000đ </span>
                    </div>
                    <div class="p-action" style="height:24px;">
                        <span class="p-qty"> <i class="far fa-check"></i> Còn hàng </span>

                        <a href="javascript:;" style="font-size: 13px;" class="p-cart p-cart js-add-to-cart" data-id="">
                            <i class="far fa-shopping-cart"></i> Giỏ hàng
                        </a>
                    </div>
                </div>
            </div>
        </div>

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
            <div class="featured-product-list" style="min-height:376px;">
                <div class="component-product" style="min-height:356px;">
                    <span class="percent">-6% </span>
                    <p class="p-sku">PCAS189</p>
                    <div class="p-img">
                        <a href="/pc-asus-all-in-one-m5401wu-r5-5500u-8gb-ram-512gb-ssd-23.8-inch-full-hd-touch-wl-bt-k-m-win-10-m5401wuat-ba040t">
                            <img src="https://hanoicomputercdn.com/media/product/120_60623_asus_m5401.jpg"
                                 style="min-width:150px;min-height:150px;"
                                 alt="PC Asus All in One M5401WU (R5 5500U/8GB RAM/512GB SSD/23.8 inch Full HD/Touch/WL+BT/K+M/Win 10) (M5401WUAT-BA040T)">
                        </a>
                    </div>
                    <div class="p-info" style="min-height:98px;">
                        <a href="/pc-asus-all-in-one-m5401wu-r5-5500u-8gb-ram-512gb-ssd-23.8-inch-full-hd-touch-wl-bt-k-m-win-10-m5401wuat-ba040t"
                           class="p-name">
                            PC Asus All in One M5401WU (R5 5500U/8GB RAM/512GB SSD/23.8 inch Full HD/Touch/WL+BT/K+M/Win
                            10) (M5401WUAT-BA040T)
                        </a>
                        <span class="p-price"> 18.599.000đ </span>
                        <span class="p-nprice"> 19.799.000đ </span>
                    </div>
                    <div class="p-action" style="height:24px;">
                        <span class="p-qty-0"> <i class="fas fa-phone fa-flip-horizontal"></i> Liên hệ </span>

                        <a href="javascript:;" style="font-size: 13px;" class="p-cart p-cart js-add-to-cart"
                           data-id=""> <i class="far fa-shopping-cart"></i> Giỏ hàng
                        </a>
                    </div>
                </div>
                <div class="component-product" style="min-height:356px;">
                    <span class="percent">-2% </span>
                    <p class="p-sku">PCAC115</p>
                    <div class="p-img">
                        <a href="/pc-acer-as-all-in-one-c22-963-i3-1005g1-8gb-ram-1tb-hdd-128gb-ssd-21.5-inch-fhd-wl-bt-k-m-win-10-dq.bensv.001">
                            <img src="https://hanoicomputercdn.com/media/product/120_56788_pc_acer_as_c22.jpg"
                                 style="min-width:150px;min-height:150px;"
                                 alt="PC Acer AS All in One C22-963 (i3-1005G1/8GB RAM/1TB HDD+128GB SSD/21.5 inch FHD/WL+BT/K+M/Win 10) (DQ.BENSV.001)">
                        </a>
                    </div>
                    <div class="p-info" style="min-height:98px;">
                        <a href="/pc-acer-as-all-in-one-c22-963-i3-1005g1-8gb-ram-1tb-hdd-128gb-ssd-21.5-inch-fhd-wl-bt-k-m-win-10-dq.bensv.001"
                           class="p-name">
                            PC Acer AS All in One C22-963 (i3-1005G1/8GB RAM/1TB HDD+128GB SSD/21.5 inch
                            FHD/WL+BT/K+M/Win 10) (DQ.BENSV.001)
                        </a>
                        <span class="p-price"> 15.699.000đ </span>
                        <span class="p-nprice"> 15.999.000đ </span>
                    </div>
                    <div class="p-action" style="height:24px;">
                        <span class="p-qty-0"> <i class="fas fa-phone fa-flip-horizontal"></i> Liên hệ </span>

                        <a href="javascript:;" style="font-size: 13px;" class="p-cart p-cart js-add-to-cart" data-id="">
                            <i class="far fa-shopping-cart"></i> Giỏ hàng
                        </a>
                    </div>
                </div>
                <div class="component-product" style="min-height:356px;">
                    <span class="percent">-17% </span>
                    <p class="p-sku">PCHP665</p>
                    <div class="p-img">
                        <a href="/pc-hp-pavilion-tp01-1003d-i3-10105-4gb-ram-256gb-ssd-dvdrw-wl-bt-k-m-win-11-46j98pa">
                            <img
                                src="https://hanoicomputercdn.com/media/product/120_59908_hp_pavilion_590_tp01_850x850.jpg"
                                style="min-width:150px;min-height:150px;"
                                alt="PC HP Pavilion TP01-1003d (i3-10105/4GB RAM/256GB SSD/DVDRW/WL+BT/K+M/Win 11) (46J98PA)">
                        </a>
                    </div>
                    <div class="p-info" style="min-height:98px;">
                        <a href="/pc-hp-pavilion-tp01-1003d-i3-10105-4gb-ram-256gb-ssd-dvdrw-wl-bt-k-m-win-11-46j98pa"
                           class="p-name">
                            PC HP Pavilion TP01-1003d (i3-10105/4GB RAM/256GB SSD/DVDRW/WL+BT/K+M/Win 11) (46J98PA)
                        </a>
                        <span class="p-price"> 8.799.000đ </span>
                        <span class="p-nprice"> 10.659.000đ </span>
                    </div>
                    <div class="p-action" style="height:24px;">
                        <span class="p-qty"> <i class="far fa-check"></i> Còn hàng </span>

                        <a href="javascript:;" style="font-size: 13px;" class="p-cart p-cart js-add-to-cart" data-id="">
                            <i class="far fa-shopping-cart"></i> Giỏ hàng
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    end home--}}
    <div class="block-endhome">
        <div class="qvch6f">
            <div class="r1tReH">
                <div class="UQkGa9"><a href="https://shopee.vn/legaldoc/privacy/" target="_blank"
                                       rel="noopener noreferrer" class="+GZ0Pb typo-r10"><img class="ITerhe"
                                                                                              src="https://cf.shopee.vn/file/8ee559562d123cf132a7cec374784442"><span
                            class="_1gUfY9">CHÍNH SÁCH BẢO MẬT</span></a></div>
                <div class="UQkGa9"><a href="https://shopee.vn/legaldoc/termsOfService/" target="_blank"
                                       rel="noopener noreferrer" class="+GZ0Pb typo-r10"><img class="ITerhe"
                                                                                              src="https://cf.shopee.vn/file/5e2ef7014b7a5004ebc7383e115364d5"><span
                            class="_1gUfY9">QUY CHẾ HOẠT ĐỘNG</span></a></div>
                <div class="UQkGa9"><a href="https://mall.shopee.vn/legaldoc/shipping/" target="_blank"
                                       rel="noopener noreferrer" class="+GZ0Pb typo-r10"><img class="ITerhe"
                                                                                              src="https://cf.shopee.vn/file/b334ced59fb923afa9f6cc41be2c2e14"><span
                            class="_1gUfY9">CHÍNH SÁCH VẬN CHUYỂN</span></a></div>
                <div class="UQkGa9"><a
                        href="https://help.shopee.vn/portal/article/77265-QUY-TRI%CC%80NH-GIA%CC%89I-QUY%C3%8A%CC%81T-TRANH-CH%C3%82%CC%81P%2F-X%C6%AF%CC%89-LY%CC%81-KHI%C3%8A%CC%81U-NA%CC%A3I?previousPage=search%20recommendation%20bar"
                        target="_blank" rel="noopener noreferrer" class="+GZ0Pb typo-r10"><img class="ITerhe"
                                                                                               src="https://cf.shopee.vn/file/9055ca43afee3425736586fd115cb197"><span
                            class="_1gUfY9">QUY TRÌNH GIẢI QUYẾT TRANH CHẤP</span></a></div>
            </div>
            <div class="PJhg+l">
                <div class="naT42F"><a class="D5TJiN"
                                       href="http://online.gov.vn/HomePage/WebsiteDisplay.aspx?DocId=18375"
                                       target="_blank" rel="noopener noreferrer"><img class="pivxyG"
                                                                                      src="https://deo.shopeemobile.com/shopee/shopee-mobilemall-live-sg/homepage/d7a172fea14bd73f86a6e77feea33bbc.png"></a><a
                        class="D5TJiN" href="http://online.gov.vn/HomePage/AppDisplay.aspx?DocId=29" target="_blank"
                        rel="noopener noreferrer"><img class="pivxyG"
                                                       src="https://deo.shopeemobile.com/shopee/shopee-mobilemall-live-sg/homepage/d7a172fea14bd73f86a6e77feea33bbc.png"></a>
                </div>
                <div class="naT42F"><a class="D5TJiN" href="https://shopee.vn/docs/170" target="_blank"
                                       rel="noopener noreferrer"><img class="-p38uf"
                                                                      src="https://deo.shopeemobile.com/shopee/shopee-mobilemall-live-sg/homepage/8bb670a16c842d5af3b7aa4cbb97f655.png"></a>
                </div>
            </div>
            <div class="_2iFB03">
                <div class="_1GYBJy typo-r10"><p class="u5-Pqi">Công ty TNHH Shopee</p>
                    <p class="_3dS+Hd">Địa chỉ: Tầng 28, Tòa nhà trung tâm Lotte Hà Nội, 54 Liễu Giai, phường Cống Vị,
                        Quận Ba Đình, Hà Nội</p>
                    <p class="_3dS+Hd">Tổng đài hỗ trợ: 19001221 - Email: support@shopee.vn</p>
                    <p class="_3dS+Hd">Mã số doanh nghiệp: 0106773786 do Sở Kế hoạch &amp; Đầu tư TP Hà Nội cấp lần đầu
                        ngày 10/02/2015</p>
                    <p class="_3dS+Hd">© 2015 - Bản quyền thuộc về Công ty TNHH Shopee<br></p></div>
            </div>
        </div>
    </div>
</div>
