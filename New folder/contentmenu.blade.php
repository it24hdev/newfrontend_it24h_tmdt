
<div class="submenu" style="float: left;">
    @foreach($Sidebars as $subsidebar)
    @if($subsidebar->parent_id == $Sidebarid)

    <div class="wp-menu-parent">
        <a href="{!! route('product_cat',  $subsidebar->slug) !!}" class="title-cat">{{$subsidebar->name}}</a>
        @if(count($subsidebar->childs))
        <ul>
            @foreach($Sidebars as $subsidebar3)
            @if($subsidebar3->parent_id == $subsidebar->id)
            <li>
                <a href="{!! route('product_cat',  $subsidebar3->slug) !!}" class="cat-child">
                    <span>{{$subsidebar3->name}}</span>
                    @if(count($subsidebar3->childs))
                    <span class="next-right">
                        <i class="far fa-angle-right"></i>
                    </span>
                    @endif
                </a>
                @if(count($subsidebar3->childs))
                @include('frontend.subsidebar',['childs' => $subsidebar3->childs])
                @endif
            </li>
            @endif
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
 