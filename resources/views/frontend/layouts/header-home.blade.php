<!-- ==== site-menu ===== -->
<header class="page-header">
    <div class="container-page">
        <div class="header-top">
            <ul class="social-header">
                <li class="facebook">
                    <a  title="Facebook" href="https://www.facebook.com/it24h.vnn"><i class="fab fa-facebook-f"></i></a>
                </li>
                <li class="youtube">
                    <a class="icon-youtube1" title="Youtube" href="#"><i class="fab fa-youtube"></i></a>
                </li>
                <li class="twitter">
                    <a class="icon-twitter" title="Twitter" href="#"><i class="fab fa-twitter"></i></a>
                </li>
                <li class="instagram">
                    <a class="icon-instagram" title="Instagram" href="#"><i class="fab fa-instagram"></i></a>
                </li>
                <li class="tiktok">
                    <a class="icon-instagram" title="Tiktok" href="#"><i class="fab fa-tiktok"></i></a>
                </li>
            </ul>
            <div class="wp-language-email">
                <div class="language"><div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        @lang('lang.Language')
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      <li><a class="dropdown-item" href="{{ route('app.setLocale',['vi']) }}">@lang('lang.Vietnamese')</a></li>
                      <li><a class="dropdown-item" href="{{ route('app.setLocale',['en']) }}">@lang('lang.English')</a></li>
                    </ul>
                  </div></div>
                <div class="email-header"><a href="mailto:contact@it24h.vn">contact@it24h.vn</a></div>
            </div>
        </div>
        <div class="header-mid">
            <div class="middle-content">
                <div class="logo-container">
                    <h1 class="logo-content">
                        <strong style="display: none;">IT24H - Máy tính văn phòng, PC gaming, phụ kiện máy tính, camera an linh</strong>
                        <a href="{{route('user')}}" title="IT24H - Máy tính văn phòng, PC gaming, phụ kiện máy tính, camera an linh">
                            <img src="{{asset('/asset/images/it24h.png')}}" alt="">
                        </a>
                    </h1>
                </div>
                <div class="action-middle">
                    <div class="block-table">
                        <div class="search-header">
                            <div class="search-wrapper">
                                <form action="{{route('list_product')}}">
                                    <input type="text" name="search" id="searchs" placeholder="@lang('lang.Search')" autocomplete="off">
                                    <button class="icon-search"><i class="far fa-search"></i></button>
                                    <div class="dropdown">
                                        <button class="select-cat dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            @lang('lang.Allcategory')
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            @foreach($Sidebars as $Sidebar)
                                                @if($Sidebar->parent_id==0)
                                                    <li><a class="dropdown-item" href="{{route('product_cat', $Sidebar->slug)}}">{{$Sidebar->name}}</a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </form>
                                <div class="ajax-search-result" id="ajax-search">
                                </div>
                            </div>
                        </div>
                        <div class="header-wishlist">
                            <a href="{{route('list_wish')}}" class="icon-heart"><i class="far fa-heart"></i>
                                <span class="count" id="count-wish">
                                    @if (!empty(Cookie::get('count_wish')))
                                        {{Cookie::get('count_wish')}}
                                        @else
                                        0
                                    @endif
                                </span>
                            </a>
                        </div>
                        <div class="header-cart">
                            <a href="{{route('list_cart')}}" class="icon-cart"><i class="fal fa-shopping-cart"></i>
                                <span class="count" id="count-cart">{{Cart::count()}}</span>
                            </a>
                        </div>
                        <div class="header-user-account">
                            @if ((Session::has('is_login') && Session::get('is_login') == true) || !empty(Cookie::get('remember-me')))
                                <a href="{{route('user_account')}}" class="icon-user"><i class="fal fa-user"></i></a>
                            @else
                                <div class="wp-dropdown">
                                    <a href="javascript:;" class="dropdown-login-toggle icon-user">
                                        <i class="fal fa-user"></i>
                                    </a>
                                    <div class="dropdown-login">
                                        <div class="form-error-header"></div>
                                        <form action="">
                                            <div class="header-form">
                                                <span>@lang('lang.Signin')</span>
                                                <a href="{{route('user_login_register')}}">@lang('lang.Createaccount')</a>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="">@lang('lang.Email')</label>
                                                <input type="email" class="form-control" name="email" id="email-header" placeholder="@lang('lang.Email')" required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="">@lang('lang.Password')</label>
                                                <input type="password" class="form-control" name="password" id="password-header" placeholder="@lang('lang.Password')" required>
                                            </div>
                                            <a href="javascript:;" class="btn btn-primary btn-login" id="login-ajax">@lang('lang.Login')</a>
                                            <a href="{{route('forgot_password')}}">@lang('lang.Forgetpassword')</a>
                                        </form>
                                        <a href="{{route('login-facebook')}}" class="btn-login-facebook btn btn-primary w-100 mt-2"><i class="fab fa-facebook-square me-2"></i>
                                        @lang('lang.loginwithfb')</a>
                                        <a href="{{route('login-google')}}" class="btn-login-google btn btn-danger w-100 mt-2"><i class="fab fa-google me-2"></i>
                                        @lang('lang.loginwithgg')</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="desktop-menu clearfix">
                <div class="vertical-block">
                    <div class="title-vertical">
                        <i class="fas fa-bars"></i>
                        @lang('lang.Productcategory')
                    </div>
                    <div class="vertical-menu">
                        <div class="vertical-menu-content">
                            <nav>
                                <ul class="menu-cat">
                                    <li>
                                        <a href=""><span class="icon-menu"><i class="fas fa-laptop"></i></span>
                                            Laptop, Tablet, Mobile
                                            <span class="icon-right"><i class="far fa-angle-right"></i></span>
                                        </a>
                                        <div class="wp-submenu">
                                            <div class="content-submenu">
                                                <div class="submenu">
                                                    <div class="wp-menu-parent">
                                                        <span class="title-cat">Laptop</span>
                                                        <ul>
                                                            <li>
                                                                <a href="" class="cat-child">
                                                                    <span>Laptop Asus</span>
                                                                    <span class="next-right"><i class="far fa-angle-right"></i></span>
                                                                </a>
                                                                <div class="submenu-child">
                                                                    <ul>
                                                                        <li><a href="">Laptop Asus 1</a></li>
                                                                        <li><a href="">Laptop Asus 2</a></li>
                                                                        <li>
                                                                            <a href="">Laptop Asus 3
                                                                                <span class="next-right"><i class="far fa-angle-right"></i></span>
                                                                            </a>
                                                                            <div class="submenu-child">
                                                                                <ul>
                                                                                    <li><a href="">Laptop Asus 3.1</a></li>
                                                                                    <li><a href="">Laptop Asus 3.2</a></li>
                                                                                    <li><a href="">Laptop Asus 3.3</a></li>
                                                                                    <li>
                                                                                        <a href="">Laptop Asus 3.4
                                                                                            <span class="next-right"><i class="far fa-angle-right"></i>
                                                                                        </a>
                                                                                        <div class="submenu-child">
                                                                                            <ul>
                                                                                                <li><a href="">Laptop Asus 3.4.1</a></li>
                                                                                                <li><a href="">Laptop Asus 3.4.2</a></li>
                                                                                                <li><a href="">Laptop Asus 3.4.3</a></li>
                                                                                                <li><a href="">Laptop Asus 3.4.4</a></li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </li>
                                                                        <li><a href="">Laptop Asus 4</a></li>
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                            <li><a href="">Laptop gaming</a></li>
                                                            <li><a href="">Laptop HP</a></li>
                                                            <li><a href="">Laptop Dell</a></li>
                                                            <li><a href="">Laptop MSI</a></li>
                                                            <li><a href="">Laptop MSI</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="wp-menu-parent">
                                                        <span class="title-cat">Laptop</span>
                                                        <ul>
                                                            <li><a href="">Laptop Asus</a></li>
                                                            <li><a href="">Laptop gaming</a></li>
                                                            <li><a href="">Laptop HP</a></li>
                                                            <li><a href="">Laptop Dell</a></li>
                                                            <li><a href="">Laptop MSI</a></li>
                                                            <li><a href="">Laptop HP</a></li>
                                                            <li><a href="">Laptop Dell</a></li>
                                                            <li><a href="">Laptop MSI</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="wp-menu-parent">
                                                        <span class="title-cat">Laptop</span>
                                                        <ul>
                                                            <li><a href="">Laptop Asus</a></li>
                                                            <li><a href="">Laptop gaming</a></li>
                                                            <li><a href="">Laptop HP</a></li>
                                                            <li><a href="">Laptop Dell</a></li>
                                                            <li><a href="">Laptop MSI</a></li>
                                                            <li><a href="">Laptop Dell</a></li>
                                                            <li><a href="">Laptop MSI</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="wp-menu-parent">
                                                        <span class="title-cat">Laptop</span>
                                                        <ul>
                                                            <li><a href="">Laptop Asus</a></li>
                                                            <li><a href="">Laptop gaming</a></li>
                                                            <li><a href="">Laptop HP</a></li>
                                                            <li><a href="">Laptop Dell</a></li>
                                                            <li><a href="">Laptop MSI</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="wp-product-banner">
                                                    <div class="wp-product">
                                                        <a href="">
                                                            <div class="thumb">
                                                                <img src="/asset/images/l-04_2.jpg" alt="">
                                                                <span class="sale">Sale</span>
                                                                <span class="new">New</span>
                                                            </div>
                                                            <div class="desc">
                                                                <div class="name">Laptop gaming MSI</div>
                                                                <div class="rating2">
                                                                    <div class="rating-upper" style="width: 80%">
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
                                                                <div class="price-old">
                                                                    25.990.000 đ
                                                                </div>
                                                                <div class="price-new">
                                                                    22.890.000 đ
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a href=""><span class="icon-menu"><i class="fas fa-laptop"></i></span>
                                            Laptop, Tablet, Mobile
                                        </a>
                                    </li>
                                    <li>
                                        <a href=""><span class="icon-menu"><i class="fas fa-laptop"></i></span>
                                            Laptop, Tablet, Mobile
                                        </a>
                                    </li>
                                    <li>
                                        <a href=""><span class="icon-menu"><i class="fas fa-laptop"></i></span>
                                            Laptop, Tablet, Mobile
                                        </a>
                                    </li>
                                    <li>
                                        <a href=""><span class="icon-menu"><i class="fas fa-laptop"></i></span>
                                            Laptop, Tablet, Mobile
                                        </a>
                                    </li>
                                    <li>
                                        <a href=""><span class="icon-menu"><i class="fas fa-laptop"></i></span>
                                            Laptop, Tablet, Mobile
                                        </a>
                                    </li>
                                    <li>
                                        <a href=""><span class="icon-menu"><i class="fas fa-laptop"></i></span>
                                            Laptop, Tablet, Mobile
                                        </a>
                                    </li>
                                    <li>
                                        <a href=""><span class="icon-menu"><i class="fas fa-laptop"></i></span>
                                            Laptop, Tablet, Mobile
                                        </a>
                                    </li>
                                    <li>
                                        <a href=""><span class="icon-menu"><i class="fas fa-laptop"></i></span>
                                            Laptop, Tablet, Mobile
                                        </a>
                                    </li>
                                    <li>
                                        <a href=""><span class="icon-menu"><i class="fas fa-laptop"></i></span>
                                            Laptop, Tablet, Mobile
                                        </a>
                                    </li>
                                    <li>
                                        <a href=""><span class="icon-menu"><i class="fas fa-laptop"></i></span>
                                            Laptop, Tablet, Mobile
                                        </a>
                                    </li>
                                    <li>
                                        <a href=""><span class="icon-menu"><i class="fas fa-laptop"></i></span>
                                            Laptop, Tablet, Mobile
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="horizontal-block clearfix">
                    <div class="horizontal-menu">
                        <nav>
                            <ul class="menu-header">
                                <li><a href="{{route('user')}}" class="active"><span><i class="far fa-home"></i></span> @lang('lang.Home')</a></li>
                                <li><a href="{{route('list_product')}}"><span><i class="fal fa-shopping-bag"></i></span> @lang('lang.Shop')</a></li>
                                <li><a href="{{route('categoryBlogs')}}"><span><i class="fal fa-newspaper"></i></span> @lang('lang.Blog')</a></li>
                                <li><a href="{{route('contact')}}"><span><i class="far fa-phone-rotary"></i></span> @lang('lang.Contact')</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="header-shipping">
                        <strong>Free ship</strong> @lang('lang.whenyouby2products')
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
