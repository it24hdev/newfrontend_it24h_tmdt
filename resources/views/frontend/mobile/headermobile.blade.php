<header>
    <div class="header_mobile">
        <div class="headerL1">
            {{--logo--}}
            <div id="scroll_h">
                <div class="d-flex pl-2 pr-2 pt-2">
                    <div class="col-1 d-flex justify-content-start align-items-center">
                        <div id="menubar2">
                            <i class="far fa-bars"></i>
                        </div>
                    </div>
                    <div class="col-7 d-flex align-items-center logo_t">
                        <div>
                            <a href="/">
                                <img src="{{asset('asset/images/it24hvn.png')}}">
                            </a>
                        </div>
                    </div>
                    <div class="col-4 d-flex justify-content-end align-items-center">
                        <div class="shop">
                            <a href="{{route('list_wish')}}" class="icon-heart">
                                <i class="far fa-heart">  </i>
                                <span class="count" id="count-wish">
                                @if (!empty(Cookie::get('count_wish')))
                                       {{Cookie::get('count_wish')}}
                                   @else
                                       0
                                   @endif
                                </span>
                            </a>
                        </div>
                        <div class="shop">
                            <a href="#">
                                <i class="fal fa-shopping-cart"></i>
                                <span class="count_c" id="count-cart">{{Cart::count()}}</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="mt-3 mb-2">
                    <a class="search_input">
                        <img src="{{asset('asset/images/searchmobile.png')}}"
                             alt="icon-search">
                        <input type="search" aria-label="search" class="search" placeholder="Bạn đang tìm gì?">
                    </a>
                </div>
            </div>
            <div id="scroll_d">
                <div class="d-flex pl-2 pr-2 pt-2">
                <div class="col-1 d-flex justify-content-start align-items-center">
                    <div id="menubar">
                        <i class="far fa-bars"></i>
                    </div>
                </div>
                <div class="col-9 d-flex justify-content-center mx-3 align-items-center">
                    <div class="w-100">
                        <a class="search_input">
                            <img src="{{asset('asset/images/searchmobile.png')}}"
                                 alt="icon-search">
                            <input type="search" aria-label="search" class="search_input_scroll" placeholder="Bạn đang tìm gì?">
                        </a>
                    </div>
                </div>
                <div class="shop col-1 d-flex justify-content-end align-items-center">
                    <a href="#"> <i class="fal fa-shopping-cart"></i> </a>
                    <span class="count_c_2" id="count-cart2">{{Cart::count()}}</span>
                </div>
            </div>
            </div>
        </div>
    </div>
</header>
{{--background header--}}
<div class="background_header">
</div>
<div>
    <div class="menu-mobile" >
        <div id="menu_mobile" class="menu-tree"></div>
        <div id="menu_mobile_child" class="menu-tree-child m-0 box"></div>
    </div>
</div>
<div id="snackbar">Đã thêm vào giỏ hàng</div>
