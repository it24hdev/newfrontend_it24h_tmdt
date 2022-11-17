{{--        left--}}
<div class="menu-tree">
    @foreach($parent as $value)
    <a href="{{$value->link}}" class="label-menu-tree @if($value->id == $current_parent->id)active @endif">
        @if($value->img_cat)
        <i class="icons-cate" style="background-image:url({{asset('upload/images/products/thumb/'.$value->img_cat)}});"></i>
        @endif
        <p>{{$value->label}}</p>
    </a>
    @endforeach
</div>
{{--       right--}}
<div class="menu-tree-child m-0 box">
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
                                            @if(!empty($item->img_brand))
                                            <img src="{{asset('upload/images/products/thumb/'.$item->img_brand)}}" >
                                            @else
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
    <div class="mt-1"><strong class="group-title">Chọn theo mức giá</strong>
        <div class="group-list">
            <div class="menu-child-item group"><!---->
                <div class=""><!---->
                    <div class="group-item">
                        <div class="menu-child-item menu-item"><a
                                href="https://cellphones.com.vn/mobile.html?price=1-5000001" target="_self"
                                class="label-wrapper">
                                <div class="label-item"><!----> <span>Dưới 5 triệu</span></div>
                            </a></div>
                    </div>
                </div>
                <div class=""><!---->
                    <div class="group-item">
                        <div class="menu-child-item menu-item"><a
                                href="https://cellphones.com.vn/mobile.html?price=10000001-15000001"
                                target="_self" class="label-wrapper">
                                <div class="label-item"><!----> <span>Từ 10 - 15 triệu</span></div>
                            </a></div>
                    </div>
                </div>
                <div class=""><!---->
                    <div class="group-item">
                        <div class="menu-child-item menu-item"><a
                                href="https://cellphones.com.vn/mobile.html?price=5000001-10000001"
                                target="_self" class="label-wrapper">
                                <div class="label-item"><!----> <span>Từ 5 - 10 triệu</span></div>
                            </a></div>
                    </div>
                </div>
                <div class=""><!---->
                    <div class="group-item">
                        <div class="menu-child-item menu-item"><a
                                href="https://cellphones.com.vn/mobile.html?price=15000001-20000001"
                                target="_self" class="label-wrapper">
                                <div class="label-item"><!----> <span>Từ 15 - 20 triệu</span></div>
                            </a></div>
                    </div>
                </div>
                <div class=""><!---->
                    <div class="group-item">
                        <div class="menu-child-item menu-item"><a
                                href="https://cellphones.com.vn/mobile.html?price=20000001-" target="_self"
                                class="label-wrapper">
                                <div class="label-item"><!----> <span>Trên 20 triệu</span></div>
                            </a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-1"><strong class="group-title">Loại điện thoại</strong>
        <div class="group-list">
            <div class="menu-child-item group"><!---->
                <div class=""><!---->
                    <div class="group-item">
                        <div class="menu-child-item menu-item"><a
                                href="https://cellphones.com.vn/mobile.html?mobile_os_filter=1740"
                                target="_self" class="label-wrapper">
                                <div class="label-item"><!----> <span>Android</span></div>
                            </a></div>
                    </div>
                </div>
                <div class=""><!---->
                    <div class="group-item">
                        <div class="menu-child-item menu-item"><a
                                href="https://cellphones.com.vn/mobile.html?mobile_os_filter=1741"
                                target="_self" class="label-wrapper">
                                <div class="label-item"><!----> <span>iPhone (iOS)</span></div>
                            </a></div>
                    </div>
                </div>
                <div class=""><!---->
                    <div class="group-item">
                        <div class="menu-child-item menu-item"><a
                                href="https://cellphones.com.vn/mobile.html?mobile_os_filter=1742"
                                target="_self" class="label-wrapper">
                                <div class="label-item"><!----> <span>Điện thoại phổ thông</span></div>
                            </a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-1"><strong class="group-title">Chọn theo nhu cầu</strong>
        <div class="group-list">
            <div class="menu-child-item group"><!---->
                <div class=""><!---->
                    <div class="group-item">
                        <div class="menu-child-item menu-item"><a
                                href="https://cellphones.com.vn/mobile.html?mobile_tinh_nang_dac_biet=1757"
                                target="_self" class="label-wrapper">
                                <div class="label-item"><img
                                        src="https://cdn2.cellphones.com.vn/x/media/tmp/catalog/product/t/_/t_i_xu_ng_81_.png"
                                        alt="Hỗ trợ 5G" loading="lazy"> <span>Hỗ trợ 5G</span></div>
                            </a></div>
                    </div>
                </div>
                <div class=""><!---->
                    <div class="group-item">
                        <div class="menu-child-item menu-item"><a
                                href="https://cellphones.com.vn/mobile/dien-thoai-gaming.html" target="_self"
                                class="label-wrapper">
                                <div class="label-item"><img
                                        src="https://cdn2.cellphones.com.vn/x/media/tmp/catalog/product/t/_/t_i_xu_ng_82_.png"
                                        alt="Điện thoại Gaming" loading="lazy"> <span>Điện thoại Gaming</span>
                                </div>
                            </a></div>
                    </div>
                </div>
                <div class=""><!---->
                    <div class="group-item">
                        <div class="menu-child-item menu-item"><a
                                href="https://cellphones.com.vn/mobile.html?mobile_nhu_cau_sd=3136"
                                target="_self" class="label-wrapper">
                                <div class="label-item"><img
                                        src="https://cdn2.cellphones.com.vn/x/media/tmp/catalog/product/d/i/dien-thoai-dung-luong-lon-01.png"
                                        alt="Dung lượng lớn" loading="lazy"> <span>Dung lượng lớn</span></div>
                            </a></div>
                    </div>
                </div>
                <div class=""><!---->
                    <div class="group-item">
                        <div class="menu-child-item menu-item"><a
                                href="https://cellphones.com.vn/mobile.html?mobile_nhu_cau_sd=3141"
                                target="_self" class="label-wrapper">
                                <div class="label-item"><img
                                        src="https://cdn2.cellphones.com.vn/x/media/tmp/catalog/product/d/i/dien-thoai-pin-trau-7000mah-3.png"
                                        alt="Pin trâu" loading="lazy"> <span>Pin trâu</span></div>
                            </a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-1"><strong class="group-title">Điện thoại hot ⚡</strong>
        <div class="group-list">
            <div class="menu-child-item group"><!---->
                <div class=""><!---->
                    <div class="group-item">
                        <div class="menu-child-item menu-item"><a
                                href="https://cellphones.com.vn/mobile/apple/iphone-14.html" target="_self"
                                class="label-wrapper">
                                <div class="label-item"><!----> <span>iPhone 14</span></div>
                            </a></div>
                    </div>
                </div>
                <div class=""><!---->
                    <div class="group-item">
                        <div class="menu-child-item menu-item"><a
                                href="https://cellphones.com.vn/samsung-galaxy-z-fold-4.html" target="_self"
                                class="label-wrapper">
                                <div class="label-item"><!----> <span>Galaxy Z Fold4</span></div>
                            </a></div>
                    </div>
                </div>
                <div class=""><!---->
                    <div class="group-item">
                        <div class="menu-child-item menu-item"><a
                                href="https://cellphones.com.vn/samsung-galaxy-z-flip-4.html" target="_self"
                                class="label-wrapper">
                                <div class="label-item"><!----> <span>Galaxy Z Flip4</span></div>
                            </a></div>
                    </div>
                </div>
                <div class=""><!---->
                    <div class="group-item">
                        <div class="menu-child-item menu-item"><a
                                href="https://cellphones.com.vn/mobile/apple/iphone-13.html" target="_self"
                                class="label-wrapper">
                                <div class="label-item"><!----> <span>iPhone 13</span></div>
                            </a></div>
                    </div>
                </div>
                <div class=""><!---->
                    <div class="group-item">
                        <div class="menu-child-item menu-item"><a
                                href="https://cellphones.com.vn/oppo-reno7-pro.html" target="_self"
                                class="label-wrapper">
                                <div class="label-item"><!----> <span>OPPO Reno7 Pro</span></div>
                            </a></div>
                    </div>
                </div>
                <div class=""><!---->
                    <div class="group-item">
                        <div class="menu-child-item menu-item"><a href="https://cellphones.com.vn/vivo-y35.html"
                                                                  target="_self" class="label-wrapper">
                                <div class="label-item"><!----> <span>vivo Y35</span></div>
                            </a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
