<header>
    <div class="header_mobile">
        <div class="headerL1">
            {{--logo--}}
            <div id="scroll_h">
                <div class="d-flex pl-2 pr-2 pt-2">
                    <div class="col-2 d-flex justify-content-start align-items-center">
                        <a id="menubar2"><i class="far fa-bars"></i></a>
                    </div>
                    <div class="col-8 d-flex align-items-center logo_t justify-content-center">
                        <a href="/">
                            <img src="{{asset('asset/images/it24hvn.png')}}">
                        </a>
                    </div>
                    <div class="col-2 d-flex justify-content-end align-items-center">
                        <div class="shop d-none">
                            <a href="{{route('list_wish')}}" class="icon-heart">
                                <i class="far fa-heart"> </i>
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
                            <a href="{{route('list_cart')}}">
                                <i class="fal fa-shopping-cart"></i>
                                <span class="count_c" id="count-cart">
                                    @if (!empty(Cookie::get('count_cart')))
                                        {{Cookie::get('count_cart')}}
                                    @else
                                        0
                                    @endif
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="mt-3 mb-2">
                    <a class="search_input">
                        <img src="{{asset('asset/images/searchmobile.png')}}"
                             alt="icon-search">
                        <input type="search" aria-label="search" class="search" placeholder="">
                    </a>
                </div>
            </div>
            <div id="scroll_d">
                <div class="d-flex pl-2 pr-2 pt-2 justify-content-around">
                    <div class="col-1 d-flex justify-content-start align-items-center mx-3 px-2">
                        <a id="menubar"><i class="far fa-bars"></i></a>
                    </div>
                    <div class="col-9 d-flex justify-content-center align-items-center search_form_input">
                        <div class="w-100">
                            <a class="search_input">
                                <img src="{{asset('asset/images/searchmobile.png')}}" alt="icon-search" class="submit_search">
                                <input type="search" aria-label="search" class="search_input_scroll" placeholder="">
                            </a>
                        </div>
                    </div>
                    <div class="shop col-1 align-items-center d-flex justify-content-end mx-3 position-relative">
                        <a href="{{route('list_cart')}}"> <i class="fal fa-shopping-cart"></i> </a>
                        <span class="count_c_2" id="count-cart2">
                        @if (!empty(Cookie::get('count_cart')))
                                {{Cookie::get('count_cart')}}
                            @else
                                0
                            @endif
                    </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="autocomplete_search">
    <div class="box_search">
        <div class="box_result">
            <div class="box_info_result">

            </div>
        </div>
    </div>
</div>

