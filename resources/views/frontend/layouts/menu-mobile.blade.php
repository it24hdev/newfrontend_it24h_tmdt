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
                    <img src="{{asset('asset/images/it24h.png')}}" alt="" style="height: 44px; width: auto;">
                </div>
                <div class="mobile-cart">
                    <a href="{{route('list_cart')}}"><i class="far fa-shopping-cart"></i>
                        <span class="count">{{Cart::count()}}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="container-page">
            <form action="{{route('list_product')}}">
                <input type="text" name="search" placeholder="Tìm kiếm...">
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
                        <li><a href="{{route('user')}}"><span class="icon-menu"><i class="far fa-home"></i></span> Trang chủ</a></li>
                        <li><a href="{{route('list_product')}}"><span class="icon-menu"><i class="fal fa-shopping-bag"></i></span> Sản phẩm</a></li>
                        <li><a href="{{route('categoryBlogs')}}"><span class="icon-menu"><i class="fas fa-newspaper"></i></span> Tin tức</a></li>
                        <li><a href="{{route('contact')}}"><span class="icon-menu"><i class="far fa-phone-rotary"></i></span> Liên hệ</a></li>
                    </ul>
                </div>
                <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
                    <ul class="menu-cat-mobile">
                        <li>
                            <a href=""><span class="icon-menu me-1"><i class="fas fa-laptop"></i></span> Laptop, Tablet, Mobile</a>
                            <span class="icon-right"><i class="far fa-angle-right"></i></span>
                            <div class="submenu-parent-mobile">
                                <ul style="margin-left: 5px;">
                                    <span class="title-cat">Laptop</span>
                                    <li><a href="">- Laptop Asus</a></li>
                                    <li><a href="">- Laptop HP</a></li>
                                    <li><a href="">- Laptop Gaming</a>
                                        <span class="icon-right-child" style="color: #222;"><i class="far fa-angle-right"></i></span>
                                        <div class="submenu-parent-mobile-1">
                                            <ul style="margin-left: 15px;">
                                                <li><a href="">Laptop gaming 1</a></li>
                                                <li><a href="">Laptop gaming 2</a></li>
                                                <li><a href="">Laptop gaming 3</a></li>
                                                <li><a href="">Laptop gaming 4</a>
                                                    <span class="icon-right-child" style="color: #222;"><i class="far fa-angle-right"></i></span>
                                                    <div class="submenu-parent-mobile-1">
                                                        <ul style="margin-left: 20px;">
                                                            <li><a href="">Laptop gaming 1</a></li>
                                                            <li><a href="">Laptop gaming 2</a></li>
                                                            <li><a href="">Laptop gaming 3</a></li>
                                                            <li><a href="">Laptop gaming 4</a></li>
                                                            <li><a href="">Laptop gaming 5</a></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                                <li><a href="">Laptop gaming 5</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li><a href="">- Laptop Dell</a></li>
                                    <li><a href="">- Laptop MSI</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href=""><span class="icon-menu me-1"><i class="fas fa-laptop"></i></span>
                            Laptop, Tablet, Mobile</a>
                        </li>
                        <li><a href=""><span class="icon-menu me-1"><i class="fas fa-laptop"></i></span>Laptop, Tablet, Mobile</a></li>
                        <li><a href=""><span class="icon-menu me-1"><i class="fas fa-laptop"></i></span>Laptop, Tablet, Mobile</a></li>
                        <li><a href=""><span class="icon-menu me-1"><i class="fas fa-laptop"></i></span>Laptop, Tablet, Mobile</a></li>
                        <li><a href=""><span class="icon-menu me-1"><i class="fas fa-laptop"></i></span>Laptop, Tablet, Mobile</a></li>
                        <li><a href=""><span class="icon-menu me-1"><i class="fas fa-laptop"></i></span>Laptop, Tablet, Mobile</a></li>
                        <li><a href=""><span class="icon-menu me-1"><i class="fas fa-laptop"></i></span>Laptop, Tablet, Mobile</a></li>
                    </ul>
                </div>
                <div class="tab-pane fade" id="pills-3" role="tabpanel" aria-labelledby="pills-3-tab">
                    <div class="wp-account-user-mobile">
                        @if ((Session::has('is_login') && Session::get('is_login') == true) || !empty(Cookie::get('remember-me')))
                            <a href="{{route('user_account')}}" class="login-mobile">Quản lý tài khoản</a>
                        @else
                            <a href="{{route('user_login_register')}}" class="login-mobile">Đăng nhập</a>
                            <a href="{{route('user_login_register')}}" class="register-mobile">Đăng ký</a>
                        @endif
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>

</header>
