<!-- === Menu mobile ==== -->
<header class="header-mobile">
    <div class="header-top">
        <div class="container-page">
            <div class="wp-header">
                <div class="mobile-menu">
                    <a class="icon-menu-mobile" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                        <i class="far fa-bars"></i>
                    </a>
                </div>
                <div class="mobile-logo">
                    <img src="/asset/images/it24h.png" alt="" style="height: 44px; width: auto;">
                </div>
                <div class="mobile-cart">
                    <a href=""><i class="far fa-shopping-cart"></i>
                        <span class="count">1</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="container-page">
            <form action="">
                <input type="text" name="" id="" placeholder="Tìm kiếm...">
                <button><i class="far fa-search"></i></button>
            </form>
        </div>
    </div>

    <!-- Menu-mobile -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header" style="justify-content: flex-end;">
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <div>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-1-tab" data-bs-toggle="pill" data-bs-target="#pills-1" type="button" role="tab" aria-controls="pills-1" aria-selected="true">Menu</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-2-tab" data-bs-toggle="pill" data-bs-target="#pills-2" type="button" role="tab" aria-controls="pills-2" aria-selected="false">Danh mục sản phẩm</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-3-tab" data-bs-toggle="pill" data-bs-target="#pills-3" type="button" role="tab" aria-controls="pills-3" aria-selected="false">Tài khoản</button>
                    </li>

            </ul>
          </div>
          <div class="dropdown mt-3">
            <div class="tab-content container-home" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab">
                    <ul class="menu-mobile-site">
                        <li><a href=""><span class="icon-menu"><i class="far fa-home"></i></span> Trang chủ</a></li>
                        <li><a href=""><span class="icon-menu"><i class="fal fa-shopping-bag"></i></span> Sản phẩm</a></li>
                        <li><a href=""><span class="icon-menu"><i class="fas fa-newspaper"></i></span> Tin tức</a></li>
                        <li><a href=""><span class="icon-menu"><i class="far fa-phone-rotary"></i></span> Liên hệ</a></li>
                    </ul>
                </div>
                <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
                     @foreach($Sidebars  as $Sidebar)
                    <ul class="menu-cat-mobile">
                        <li>
                            @if($Sidebar->parent_id==0)
                            <a href="{!! route('product_cat',  $Sidebar->slug) !!}"><span class="icon-menu me-1"><i class="fas fa-laptop"></i></span> {{$Sidebar->name}}</a>
                            @if(count($Sidebar->childs))
                            <span class="icon-right"><i class="far fa-angle-right"></i></span>
                            @endif
                            <div class="submenu-parent-mobile">
                                @if(count($Sidebar->childs))
                                <ul style="margin-left: 5px;">
                                    @foreach($Sidebars as $subsidebar)
                                    @if($subsidebar->parent_id == $Sidebar->id)

                                    <li><a href="{!! route('product_cat',  $subsidebar->slug) !!}">- {{$subsidebar->name}}</a>
                                        @if(count($subsidebar->childs))
                                            @include('frontend.subsidebarmenu',['childs' => $subsidebar->childs])
                                        @endif
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                            @endif
                        </li>
                    </ul>
                    @endforeach
                </div>
                <div class="tab-pane fade" id="pills-3" role="tabpanel" aria-labelledby="pills-3-tab">
                    <div class="wp-account-user-mobile">
                        <a href="" class="login-mobile">Đăng nhập</a>
                        <a href="" class="register-mobile">Đăng ký</a>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>

</header>
