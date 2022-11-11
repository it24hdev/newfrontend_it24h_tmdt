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
                <div class="header_sale">
                    <div class="top_header_sale">
                        <div class="header__inner">
                            <a href="/deal-hot">
                                <img width="66" src="https://frontend.tikicdn.com/_mobile-next/static/img/giasoc.svg"
                                     alt="flash deal">
                                <img width="21"
                                     src="https://frontend.tikicdn.com/_mobile-next/static/img/dealFlashIcon.svg"
                                     alt="flash deal" class="style__Flash-sc-eqzktw-1 eXUQVs"><img
                                    width="84" src="https://frontend.tikicdn.com/_mobile-next/static/img/homnay.svg"
                                    alt="flash deal">
                            </a>
                            <div class="time_count">
                                <a data-view-id="home_flashdeal_view.all" title="Xem tất cả Deal Hot"
                                   href="/deal-hot?tab=now">
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
                <div class="item_hot_sale">
                    <div class="inner">
                        <div class="deals d-flex">
                            <div class="item_p">
                                <a class="deals__item" data-view-id="home_flashdeal_product_item" data-view-index="0"
                                   href="/deal-hot?tab=now&amp;from_item=189658087">
                                    <div style="background: white;">
                                        <div class="style__StyledWrapImage-sc-zodvj8-0 ekkfGn">
                                            <picture class="webpimg-container">
                                                <source type="image/webp"
                                                        srcset="https://salt.tikicdn.com/cache/280x280/ts/product/a6/de/4e/e96e2035f72c97c218ba9917f4e6d5ca.jpg.webp">
                                                <img
                                                    src="https://salt.tikicdn.com/cache/280x280/ts/product/a6/de/4e/e96e2035f72c97c218ba9917f4e6d5ca.jpg"
                                                    alt="Điện Thoại Oppo A57 (4GB/64GB) - Hàng Chính Hãng - Đen"
                                                    class="WebpImg__StyledImg-sc-h3ozu8-0 fWjUGo style__StyledImage-sc-zodvj8-1 cFoyeO"
                                                    srcset="https://salt.tikicdn.com/cache/280x280/ts/product/a6/de/4e/e96e2035f72c97c218ba9917f4e6d5ca.jpg"
                                                    style="border-radius: 0px;">
                                            </picture>
                                        </div>
                                    </div>
                                    <div class="deals__price">3.690.000 ₫</div>
                                    <div class="deals__discount">-18%</div>
                                    <div class="deals__qty">
                                        <div class="deals__progress"
                                             style="width: 55%; background-color: rgb(255, 66, 78);"></div>
                                        <span>Đã bán 22</span>
                                        <img class="fire-icon"
                                             src="https://frontend.tikicdn.com/_mobile-next/static/img/fire_icon.svg"
                                             alt="flash deal">
                                    </div>
                                </a>
                            </div>
                            <div class="item_p">
                                <a class="deals__item" data-view-id="home_flashdeal_product_item" data-view-index="0"
                                   href="/deal-hot?tab=now&amp;from_item=189658087">
                                    <div style="background: white;">
                                        <div class="style__StyledWrapImage-sc-zodvj8-0 ekkfGn">
                                            <picture class="webpimg-container">
                                                <source type="image/webp"
                                                        srcset="https://salt.tikicdn.com/cache/280x280/ts/product/a6/de/4e/e96e2035f72c97c218ba9917f4e6d5ca.jpg.webp">
                                                <img
                                                    src="https://salt.tikicdn.com/cache/280x280/ts/product/a6/de/4e/e96e2035f72c97c218ba9917f4e6d5ca.jpg"
                                                    alt="Điện Thoại Oppo A57 (4GB/64GB) - Hàng Chính Hãng - Đen"
                                                    class="WebpImg__StyledImg-sc-h3ozu8-0 fWjUGo style__StyledImage-sc-zodvj8-1 cFoyeO"
                                                    srcset="https://salt.tikicdn.com/cache/280x280/ts/product/a6/de/4e/e96e2035f72c97c218ba9917f4e6d5ca.jpg"
                                                    style="border-radius: 0px;">
                                            </picture>
                                        </div>
                                    </div>
                                    <div class="deals__price">3.690.000 ₫</div>
                                    <div class="deals__discount">-18%</div>
                                    <div class="deals__qty">
                                        <div class="deals__progress"
                                             style="width: 55%; background-color: rgb(255, 66, 78);"></div>
                                        <span>Đã bán 22</span>
                                        <img class="fire-icon"
                                             src="https://frontend.tikicdn.com/_mobile-next/static/img/fire_icon.svg"
                                             alt="flash deal">
                                    </div>
                                </a>
                            </div>
                            <div class="item_p">
                                <a class="deals__item" data-view-id="home_flashdeal_product_item" data-view-index="0"
                                   href="/deal-hot?tab=now&amp;from_item=189658087">
                                    <div style="background: white;">
                                        <div class="style__StyledWrapImage-sc-zodvj8-0 ekkfGn">
                                            <picture class="webpimg-container">
                                                <source type="image/webp"
                                                        srcset="https://salt.tikicdn.com/cache/280x280/ts/product/a6/de/4e/e96e2035f72c97c218ba9917f4e6d5ca.jpg.webp">
                                                <img
                                                    src="https://salt.tikicdn.com/cache/280x280/ts/product/a6/de/4e/e96e2035f72c97c218ba9917f4e6d5ca.jpg"
                                                    alt="Điện Thoại Oppo A57 (4GB/64GB) - Hàng Chính Hãng - Đen"
                                                    class="WebpImg__StyledImg-sc-h3ozu8-0 fWjUGo style__StyledImage-sc-zodvj8-1 cFoyeO"
                                                    srcset="https://salt.tikicdn.com/cache/280x280/ts/product/a6/de/4e/e96e2035f72c97c218ba9917f4e6d5ca.jpg"
                                                    style="border-radius: 0px;">
                                            </picture>
                                        </div>
                                    </div>
                                    <div class="deals__price">3.690.000 ₫</div>
                                    <div class="deals__discount">-18%</div>
                                    <div class="deals__qty">
                                        <div class="deals__progress"
                                             style="width: 55%; background-color: rgb(255, 66, 78);"></div>
                                        <span>Đã bán 22</span>
                                        <img class="fire-icon"
                                             src="https://frontend.tikicdn.com/_mobile-next/static/img/fire_icon.svg"
                                             alt="flash deal">
                                    </div>
                                </a>
                            </div>
                            <div class="item_p">
                                <a class="deals__item" data-view-id="home_flashdeal_product_item" data-view-index="0"
                                   href="/deal-hot?tab=now&amp;from_item=189658087">
                                    <div style="background: white;">
                                        <div class="style__StyledWrapImage-sc-zodvj8-0 ekkfGn">
                                            <picture class="webpimg-container">
                                                <source type="image/webp"
                                                        srcset="https://salt.tikicdn.com/cache/280x280/ts/product/a6/de/4e/e96e2035f72c97c218ba9917f4e6d5ca.jpg.webp">
                                                <img
                                                    src="https://salt.tikicdn.com/cache/280x280/ts/product/a6/de/4e/e96e2035f72c97c218ba9917f4e6d5ca.jpg"
                                                    alt="Điện Thoại Oppo A57 (4GB/64GB) - Hàng Chính Hãng - Đen"
                                                    class="WebpImg__StyledImg-sc-h3ozu8-0 fWjUGo style__StyledImage-sc-zodvj8-1 cFoyeO"
                                                    srcset="https://salt.tikicdn.com/cache/280x280/ts/product/a6/de/4e/e96e2035f72c97c218ba9917f4e6d5ca.jpg"
                                                    style="border-radius: 0px;">
                                            </picture>
                                        </div>
                                    </div>
                                    <div class="deals__price">3.690.000 ₫</div>
                                    <div class="deals__discount">-18%</div>
                                    <div class="deals__qty">
                                        <div class="deals__progress"
                                             style="width: 55%; background-color: rgb(255, 66, 78);"></div>
                                        <span>Đã bán 22</span>
                                        <img class="fire-icon"
                                             src="https://frontend.tikicdn.com/_mobile-next/static/img/fire_icon.svg"
                                             alt="flash deal">
                                    </div>
                                </a>
                            </div>
                            <div class="item_p">
                                <a class="deals__item" data-view-id="home_flashdeal_product_item" data-view-index="0"
                                   href="/deal-hot?tab=now&amp;from_item=189658087">
                                    <div style="background: white;">
                                        <div class="style__StyledWrapImage-sc-zodvj8-0 ekkfGn">
                                            <picture class="webpimg-container">
                                                <source type="image/webp"
                                                        srcset="https://salt.tikicdn.com/cache/280x280/ts/product/a6/de/4e/e96e2035f72c97c218ba9917f4e6d5ca.jpg.webp">
                                                <img
                                                    src="https://salt.tikicdn.com/cache/280x280/ts/product/a6/de/4e/e96e2035f72c97c218ba9917f4e6d5ca.jpg"
                                                    alt="Điện Thoại Oppo A57 (4GB/64GB) - Hàng Chính Hãng - Đen"
                                                    class="WebpImg__StyledImg-sc-h3ozu8-0 fWjUGo style__StyledImage-sc-zodvj8-1 cFoyeO"
                                                    srcset="https://salt.tikicdn.com/cache/280x280/ts/product/a6/de/4e/e96e2035f72c97c218ba9917f4e6d5ca.jpg"
                                                    style="border-radius: 0px;">
                                            </picture>
                                        </div>
                                    </div>
                                    <div class="deals__price">3.690.000 ₫</div>
                                    <div class="deals__discount">-18%</div>
                                    <div class="deals__qty">
                                        <div class="deals__progress"
                                             style="width: 55%; background-color: rgb(255, 66, 78);"></div>
                                        <span>Đã bán 22</span>
                                        <img class="fire-icon"
                                             src="https://frontend.tikicdn.com/_mobile-next/static/img/fire_icon.svg"
                                             alt="flash deal">
                                    </div>
                                </a>
                            </div>
                            <div class="item_p">
                                <a class="deals__item" data-view-id="home_flashdeal_product_item" data-view-index="0"
                                   href="/deal-hot?tab=now&amp;from_item=189658087">
                                    <div style="background: white;">
                                        <div class="style__StyledWrapImage-sc-zodvj8-0 ekkfGn">
                                            <picture class="webpimg-container">
                                                <source type="image/webp"
                                                        srcset="https://salt.tikicdn.com/cache/280x280/ts/product/a6/de/4e/e96e2035f72c97c218ba9917f4e6d5ca.jpg.webp">
                                                <img
                                                    src="https://salt.tikicdn.com/cache/280x280/ts/product/a6/de/4e/e96e2035f72c97c218ba9917f4e6d5ca.jpg"
                                                    alt="Điện Thoại Oppo A57 (4GB/64GB) - Hàng Chính Hãng - Đen"
                                                    class="WebpImg__StyledImg-sc-h3ozu8-0 fWjUGo style__StyledImage-sc-zodvj8-1 cFoyeO"
                                                    srcset="https://salt.tikicdn.com/cache/280x280/ts/product/a6/de/4e/e96e2035f72c97c218ba9917f4e6d5ca.jpg"
                                                    style="border-radius: 0px;">
                                            </picture>
                                        </div>
                                    </div>
                                    <div class="deals__price">3.690.000 ₫</div>
                                    <div class="deals__discount">-18%</div>
                                    <div class="deals__qty">
                                        <div class="deals__progress"
                                             style="width: 55%; background-color: rgb(255, 66, 78);"></div>
                                        <span>Đã bán 22</span>
                                        <img class="fire-icon"
                                             src="https://frontend.tikicdn.com/_mobile-next/static/img/fire_icon.svg"
                                             alt="flash deal">
                                    </div>
                                </a>
                            </div>
                            <div class="item_p">
                                <a class="deals__item" data-view-id="home_flashdeal_product_item" data-view-index="0"
                                   href="/deal-hot?tab=now&amp;from_item=189658087">
                                    <div style="background: white;">
                                        <div class="style__StyledWrapImage-sc-zodvj8-0 ekkfGn">
                                            <picture class="webpimg-container">
                                                <source type="image/webp"
                                                        srcset="https://salt.tikicdn.com/cache/280x280/ts/product/a6/de/4e/e96e2035f72c97c218ba9917f4e6d5ca.jpg.webp">
                                                <img
                                                    src="https://salt.tikicdn.com/cache/280x280/ts/product/a6/de/4e/e96e2035f72c97c218ba9917f4e6d5ca.jpg"
                                                    alt="Điện Thoại Oppo A57 (4GB/64GB) - Hàng Chính Hãng - Đen"
                                                    class="WebpImg__StyledImg-sc-h3ozu8-0 fWjUGo style__StyledImage-sc-zodvj8-1 cFoyeO"
                                                    srcset="https://salt.tikicdn.com/cache/280x280/ts/product/a6/de/4e/e96e2035f72c97c218ba9917f4e6d5ca.jpg"
                                                    style="border-radius: 0px;">
                                            </picture>
                                        </div>
                                    </div>
                                    <div class="deals__price">3.690.000 ₫</div>
                                    <div class="deals__discount">-18%</div>
                                    <div class="deals__qty">
                                        <div class="deals__progress"
                                             style="width: 55%; background-color: rgb(255, 66, 78);"></div>
                                        <span>Đã bán 22</span>
                                        <img class="fire-icon"
                                             src="https://frontend.tikicdn.com/_mobile-next/static/img/fire_icon.svg"
                                             alt="flash deal">
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    category--}}
    <div class="col-12 mt-4">
        <div class="categories_home">
            <div class="categories_title">
                <h2>Danh mục</h2>
            </div>
            <div class="categorires_content">
                <div class="categories_item col">
                    <div class="item-categories-outer">
                        <a href="https://cellphones.com.vn/mobile.html" class="item-categories square"
                           style="background-color:null;background-image:url(https://cdn2.cellphones.com.vn/180x/https://cdn2.cellphones.com.vn/x/media/tmp/catalog/product/t/_/t_i_xu_ng_69_.png);">
                        </a>
                        <p class="title-under">Điện thoại</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
