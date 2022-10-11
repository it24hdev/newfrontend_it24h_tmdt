
<div class="submenu" style="float: left;">
    @foreach($Sidebars as $subsidebar)
    @if($subsidebar->parent == $Sidebarid)

    <div class="wp-menu-parent">
        @if(!empty($subsidebar->link))
            {{-- @if($subsidebar->form_filter == 0) --}}
            
            <a href="{!! route('product_cat',  ['slug' => $subsidebar->link]) !!}" class="title-cat">{{$subsidebar->label}}</a>
            {{-- @endif --}}
        @else
        <b style="color:black; font-size: 14px;"><p>{{$subsidebar->label}}</p></b>
        @endif
        @if(count($subsidebar->childs))
        <ul>
            @foreach($Sidebars as $subsidebar3)
            @if($subsidebar3->parent == $subsidebar->id)
            <li>
            {{-- @if($subsidebar3->form_filter == 0) --}}
            <a href="{!! route('product_cat', ['slug' => $subsidebar3->link]) !!}" class="cat-child">
                <span>{{$subsidebar3->label}}</span>
                @if(count($subsidebar3->childs))
                <span class="next-right"><i class="far fa-angle-right"></i></span>
                @endif
            </a>
            @endif
                @if(count($subsidebar3->childs))
                @include('frontend.subsidebar',['childs' => $subsidebar3->childs])
                @endif
            </li>
            {{-- @endif --}}
            @endforeach
        </ul>
        @endif
    </div>
    @endif
    @endforeach
</div>

<div class="wp-product-banner" style="float: left;">
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
 