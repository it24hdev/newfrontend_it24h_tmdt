<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="{{ route('dashboard') }}" class="flex mr-auto">
            <img alt="" class="w-6" src="/upload/images/common_img/logo.svg">
        </a>
        <a href="javascript:" id="mobile-menu-toggler"> <i data-feather="bar-chart-2"
                                                           class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    @php
        $module_active = session('module_active');
    @endphp
    <ul class="border-t border-theme-29 py-5 hidden">
        <li>
            <a href="{{ route('dashboard') }}" class="menu {{ $module_active == 'dashboard' ? 'menu--active' : '' }}">
                <div class="menu__icon"><i data-feather="home"></i></div>
                <div class="menu__title">
                    Dashboard
                    <div class="menu__sub-icon transform rotate-180"></div>
                </div>
            </a>
        </li>
        <li>
            <a href="javascript:" class="menu {{ $module_active == 'post' ? 'menu--active' : '' }}">
                <div class="menu__icon"><i data-feather="file-text"></i></div>
                <div class="menu__title">
                    Bài viết
                    <div class="menu__sub-icon "><i
                            data-feather="{{ $module_active == 'post' ? 'chevron-up' : 'chevron-down' }}"
                            class="{{ $module_active == 'post' ? 'menu__sub-icon transform rotate-180' : '' }}"></i>
                    </div>
                </div>
            </a>
            <ul class="{{ $module_active == 'post' ? 'menu__sub-open' : '' }}">
                @can('view', App\Models\Post::class)
                    <li>
                        <a href="{{ route('post.index') }}" class="menu">
                            <div class="menu__icon"><i data-feather="activity"></i></div>
                            <div class="menu__title"> Danh sách bài viết</div>
                        </a>
                    </li>
                @endcan
                @can('create', App\Models\Post::class)
                    <li>
                        <a href="{{ route('post.create') }}" class="menu">
                            <div class="menu__icon"><i data-feather="activity"></i></div>
                            <div class="menu__title"> Thêm mới</div>
                        </a>
                    </li>
                @endcan
                @can('viewAnypost', App\Models\Category::class)
                    <li>
                        <a href="{{ route('categorypost.index') }}" class="menu">
                            <div class="menu__icon"><i data-feather="activity"></i></div>
                            <div class="menu__title"> Danh mục bài viết</div>
                        </a>
                    </li>
                @endcan
                @can('viewPost', App\Models\Vote::class)
                    <li>
                        <a href="{{ route('vote.indexPost') }}" class="menu">
                            <div class="menu__icon"><i data-feather="activity"></i></div>
                            <div class="menu__title"> Đánh giá</div>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
        <li>
            <a href="javascript:" class="menu {{ $module_active == 'category' ? 'menu--active' : '' }}">
                <div class="menu__icon"><i data-feather="edit"></i></div>
                <div class="menu__title">
                    Danh mục
                    <div class="menu__sub-icon "><i
                            data-feather="{{ $module_active == 'category' ? 'chevron-up' : 'chevron-down' }}"
                            class="{{ $module_active == 'category' ? 'menu__sub-icon transform rotate-180' : '' }}"></i>
                    </div>
                </div>
            </a>
            <ul class="{{ $module_active == 'category' ? 'menu__sub-open' : '' }}">
                @can('viewAny', App\Models\Category::class)
                    <li>
                        <a href="{{ route('category.index') }}" class="menu">
                            <div class="menu__icon"><i data-feather="activity"></i></div>
                            <div class="menu__title"> Danh mục</div>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
        <li>
            <a href="javascript:" class="menu {{ $module_active == 'slider' ? 'menu--active' : '' }}">
                <div class="menu__icon"><i data-feather="layout"></i></div>
                <div class="menu__title">
                    Slider
                    <div class="menu__sub-icon "><i
                            data-feather="{{ $module_active == 'slider' ? 'chevron-up' : 'chevron-down' }}"
                            class="{{ $module_active == 'slider' ? 'menu__sub-icon transform rotate-180' : '' }}"></i>
                    </div>
                </div>
            </a>
            <ul class="{{ $module_active == 'slider' ? 'menu__sub-open' : '' }}">
                @can('view', App\Models\Slider::class)
                    <li>
                        <a href="{{ route('slider.index') }}" class="menu">
                            <div class="menu__icon"><i data-feather="activity"></i></div>
                            <div class="menu__title"> Danh sách Slider</div>
                        </a>
                    </li>
                @endcan
                @can('create', App\Models\Slider::class)
                    <li>
                        <a href="{{ route('slider.create') }}" class="menu">
                            <div class="menu__icon"><i data-feather="activity"></i></div>
                            <div class="menu__title"> Thêm mới</div>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
        <li>
            <a href="javascript:" class="menu {{ $module_active == 'user' ? 'menu--active' : '' }}">
                <div class="menu__icon"><i data-feather="user"></i></div>
                <div class="menu__title">
                    Nhân viên
                    <div class="menu__sub-icon "><i
                            data-feather="{{ $module_active == 'user' ? 'chevron-up' : 'chevron-down' }}"
                            class="{{ $module_active == 'user' ? 'menu__sub-icon transform rotate-180' : '' }}"></i>
                    </div>
                </div>
            </a>
            <ul class="{{ $module_active == 'user' ? 'menu__sub-open' : '' }}">
                @can('view', App\Models\User::class)
                    <li>
                        <a href="{{ route('user.list') }}" class="menu">
                            <div class="menu__icon"><i data-feather="activity"></i></div>
                            <div class="menu__title"> Danh sách nhân viên</div>
                        </a>
                    </li>
                @endcan
                @can('create', App\Models\User::class)
                    <li>
                        <a href="{{ route('admin.create') }}" class="menu">
                            <div class="menu__icon"><i data-feather="activity"></i></div>
                            <div class="menu__title"> Thêm mới</div>
                        </a>
                    </li>
                @endcan
            </ul>

        </li>
        <li>
            <a href="javascript:" class="menu {{ $module_active == 'role' ? 'menu--active' : '' }}">
                <div class="menu__icon"><i data-feather="bookmark"></i></div>
                <div class="menu__title">
                    Quyền quản trị
                    <div class="menu__sub-icon "><i
                            data-feather="{{ $module_active == 'role' ? 'chevron-up' : 'chevron-down' }}"
                            class="{{ $module_active == 'role' ? 'menu__sub-icon transform rotate-180' : '' }}"></i>
                    </div>
                </div>
            </a>
            <ul class="{{ $module_active == 'role' ? 'menu__sub-open' : '' }}">
                @can('view', App\Models\Role::class)
                    <li>
                        <a href="{{ route('role.list') }}" class="menu">
                            <div class="menu__icon"><i data-feather="activity"></i></div>
                            <div class="menu__title"> Danh sách quyền</div>
                        </a>
                    </li>
                @endcan
                @can('create', App\Models\Role::class)
                    <li>
                        <a href="{{ route('role.create') }}" class="menu">
                            <div class="menu__icon"><i data-feather="activity"></i></div>
                            <div class="menu__title"> Thêm mới</div>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
        @can('view', App\Models\Customer::class)
            <li>
                <a href="{{ route('customer.list') }}"
                   class="menu {{ $module_active == 'customer' ? 'menu--active' : '' }}">
                    <div class="menu__icon"><i data-feather="users"></i></div>
                    <div class="menu__title">
                        Khách hàng
                        <div class="menu__sub-icon transform rotate-180"></div>
                    </div>
                </a>
            </li>
        @endcan
        @can('view', App\Models\Order::class)
            <li>
                <a href="{{ route('order.list') }}" class="menu {{ $module_active == 'order' ? 'menu--active' : '' }}">
                    <div class="menu__icon"><i data-feather="shopping-cart"></i></div>
                    <div class="menu__title">
                        Đơn hàng
                        <div class="menu__sub-icon transform rotate-180"></div>
                    </div>
                </a>
            </li>
        @endcan
        <li>
            <a href="javascript:" class="menu {{ $module_active == 'products' ? 'menu--active' : '' }}">
                <div class="menu__icon"><i data-feather="archive"></i></div>
                <div class="menu__title">
                    Sản phẩm
                    <div class="menu__sub-icon "><i
                            data-feather="{{ $module_active == 'products' ? 'chevron-up' : 'chevron-down' }}"
                            class="{{ $module_active == 'products' ? 'menu__sub-icon transform rotate-180' : '' }}"></i>
                    </div>
                </div>
            </a>
            <ul class="{{ $module_active == 'products' ? 'menu__sub-open' : '' }}">
                @can('viewAny', App\Models\Products::class)
                    <li>
                        <a href="{{ route('products.index') }}" class="menu">
                            <div class="menu__icon"><i data-feather="activity"></i></div>
                            <div class="menu__title"> Danh sách sản phẩm</div>
                        </a>
                    </li>
                @endcan
                @can('create', App\Models\Products::class)
                    <li>
                        <a href="{{ route('products.create') }}" class="menu">
                            <div class="menu__icon"><i data-feather="activity"></i></div>
                            <div class="menu__title"> Thêm mới</div>
                        </a>
                    </li>
                @endcan
                @can('create', App\Models\Products::class)
                    <li>
                        <a href="{{ route('products.list_attr') }}" class="menu">
                            <div class="menu__icon"><i data-feather="activity"></i></div>
                            <div class="menu__title"> Quản lý thuộc tính sản phẩm</div>
                        </a>
                    </li>
                @endcan
                @can('create', App\Models\Products::class)
                    <li>
                        <a href="{{ route('products.list_brand') }}" class="menu">
                            <div class="menu__icon"><i data-feather="activity"></i></div>
                            <div class="menu__title"> Danh sách thương hiệu</div>
                        </a>
                    </li>
                @endcan
                @can('create', App\Models\Products::class)
                    <li>
                        <a href="{{ route('products.list_tag-event') }}" class="menu">
                            <div class="menu__icon"><i data-feather="activity"></i></div>
                            <div class="menu__title"> Danh sách thẻ Tag ưu đãi</div>
                        </a>
                    </li>
                @endcan
                @can('viewAny', App\Models\Category::class)
                    <li>
                        <a href="{{ route('category.index') }}" class="menu">
                            <div class="menu__icon"><i data-feather="activity"></i></div>
                            <div class="menu__title"> Danh mục sản phẩm</div>
                        </a>
                    </li>
                @endcan
                @can('viewProduct', App\Models\Vote::class)
                    <li>
                        <a href="{{ route('vote.indexProduct') }}" class="menu">
                            <div class="menu__icon"><i data-feather="activity"></i></div>
                            <div class="menu__title"> Đánh giá</div>
                        </a>
                    </li>
                @endcan
                <li>
                    <a href="{{ route('category_property.index') }}" class="menu">
                        <div class="menu__icon"><i data-feather="activity"></i></div>
                        <div class="menu__title"> Thuộc tính sản phẩm</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('vouchers.index') }}" class="menu">
                        <div class="menu__icon"><i data-feather="activity"></i></div>
                        <div class="menu__title"> Vouchers</div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:" class="menu {{ $module_active == 'marketing' ? 'menu--active' : '' }}">
                <div class="menu__icon"><i data-feather="gift"></i></div>
                <div class="menu__title">
                    Marketing
                    <div class="menu__sub-icon "><i data-feather="{{ $module_active == 'marketing' ? 'chevron-up' : 'chevron-down' }}"
                            class="{{ $module_active == 'marketing' ? 'menu__sub-icon transform rotate-180' : '' }}"></i>
                    </div>
                </div>
            </a>
            <ul class="{{ $module_active == 'marketing' ? 'menu__sub-open' : '' }}">
                <li>
                    <a href="{{ route('deals.index') }}" class="menu">
                        <div class="menu__icon"><i data-feather="activity"></i></div>
                        <div class="menu__title">Deal/Giờ vàng</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('vouchers.index') }}" class="menu">
                        <div class="menu__icon"><i data-feather="activity"></i></div>
                        <div class="menu__title">Vouchers</div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:" class="menu {{ $module_active == 'recruit' ? 'menu--active' : '' }}">
                <div class="menu__icon"><i data-feather="clipboard"></i></div>
                <div class="menu__title">
                    Tuyển dụng
                    <div class="menu__sub-icon "><i
                            data-feather="{{ $module_active == 'recruit' ? 'chevron-up' : 'chevron-down' }}"
                            class="{{ $module_active == 'recruit' ? 'menu__sub-icon transform rotate-180' : '' }}"></i>
                    </div>
                </div>
            </a>
            <ul class="{{ $module_active == 'recruit' ? 'menu__sub-open' : '' }}">
                @can('view', App\Models\Recruit::class)
                    <li>
                        <a href="{{ route('recruit.index') }}" class="menu">
                            <div class="menu__icon"><i data-feather="activity"></i></div>
                            <div class="menu__title">Danh mục tuyển dụng</div>
                        </a>
                    </li>
                @endcan
                @can('view', App\Models\Recruit_register::class)
                    <li>
                        <a href="{{ route('recruit_register.index') }}" class="menu">
                            <div class="menu__icon"><i data-feather="activity"></i></div>
                            <div class="menu__title">Danh mục ứng tuyển</div>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>

        <li>
            <a href="{{route('recentactivity.index')}}" class="menu">
                <div class="menu__icon"><i data-feather="activity"></i></div>
                <div class="menu__title">
                    Hoạt động gần đây
                </div>
            </a>
        </li>

        <li>
            <a href="javascript:" class="menu {{ $module_active == 'setting' ? 'menu--active' : '' }}">
                <div class="menu__icon"><i data-feather="settings"></i></div>
                <div class="menu__title">
                    Cài đặt
                    <div class="menu__sub-icon "><i
                            data-feather="{{ $module_active == 'settings' ? 'chevron-up' : 'chevron-down' }}"
                            class="{{ $module_active == 'settings' ? 'menu__sub-icon transform rotate-180' : '' }}"></i>
                    </div>
                </div>
            </a>
            <ul class="{{ $module_active == 'menu' ? 'menu__sub-open' : '' }}">
                <li>
                    <a href="{{ route('menu.index') }}" class="menu">
                        <div class="menu__icon"><i data-feather="menu"></i></div>
                        <div class="menu__title">Menu</div>
                    </a>
                </li>
                @can('viewAny', App\Models\Locationmenu::class)
                    <li>
                        <a href="{{ route('locationmenu.edit') }}" class="menu">
                            <div class="menu__icon"><i data-feather="grid"></i></div>
                            <div class="menu__title">Vị trí menu</div>
                        </a>
                    </li>
                @endcan

            </ul>
        </li>
    </ul>
</div>
