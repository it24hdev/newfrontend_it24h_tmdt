@extends('frontend.layouts.base')

@section('title')
    <title>{{$product->name}}</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('asset/css/detail-product.css')}}">
@endsection

@section('header-home')
    @include('frontend.layouts.header-page', [$Sidebars, $Menus])
@endsection


@section('header-mobile')
    @include('frontend.layouts.menu-mobile')
@endsection

@section('content')
    <div class="wp-content">
        <div class="wp-breadcrumb-page">
            <div class="container-page">
                <div class="breadcrumb-page">
                    <a href="{{route('user')}}">Trang chủ <i class="fas fa-angle-right mx-1"></i></a>
                    <a href="{{route('list_product')}}">Sản phẩm <i class="fas fa-angle-right mx-1"></i></a>
                    <a>{{$product->name}}</a>
                </div>
            </div>
        </div>

        <div class="container-page">
            <div class="content-product-detail">
                <div class="product-title">
                    <h3>{{$product->name}}</h3>
                </div>
                <div class="wp-product-detail">
                    <div class="product-detail-left">
                        <div class="product-detail-img">
                            <div class="product-thumb">
                                <div class="image">
                                    <img src="{{asset('upload/images/products/large/'.$product->thumb)}}" alt="">
                                </div>
                                @if (!empty($product->brand))
                                    <div class="product-brand">
                                        <img src="{{asset('upload/images/products/medium/'.$product->brands->image)}}" alt="">
                                    </div>
                                @endif
                                <span class="prev"><i class="fas fa-chevron-left"></i></span>
                                <span class="next"><i class="fas fa-chevron-right"></i></span>
                            </div>
                            <ul class="list-thumb-detail">
                                <li class="">
                                    <a href="javascript:;" class="thumb-small active">
                                        <img src="{{asset('upload/images/products/thumb/'.$product->thumb)}}" alt="">
                                    </a>
                                </li>
                                @if (!empty($imgs))
                                    @foreach ($imgs as $img)
                                        <li class="">
                                            <a href="javascript:;" class="thumb-small">
                                                <img src="{{asset('upload/images/products/thumb/'.$img)}}" alt="">
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="product-detail-info">
                            <div class="product-detail-meta">
                                <div class="code">Mã: {{$product->id}}</div> <span class="icon-meta">|</span>
                                <div class="review">
                                    <div class="rating2">
                                        <div class="rating-upper" style="width: {{$product->count_vote()}}%">
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
                                    <div class="count-review">({{$product->votes->count()}})</div> <span class="icon-meta">|</span>
                                    @if (!empty($product->sold))
                                        <div class="sold">Đã bán: {{$product->sold}}</div>
                                    @else
                                        <div class="sold">Đã bán: Đang cập nhật!</div>
                                    @endif
                                </div>
                            </div>
                            <div class="product-sumary">
                                <div class="sumary-title">Thông số sản phẩm</div>
                                {!! $product->short_content !!}
                            </div>
                            <div class="product-price">
                                @if (!empty($product->onsale))
                                    <div class="price-old">
                                        <div class="text">Giá bán:</div>
                                        <div class="number">{{number_format($product->price,0,',','.')}} đ</div>
                                    </div>
                                    <div class="price-new">
                                        <div class="text">Giá khuyến mãi:</div>
                                        <div class="number">{{number_format($product->price_onsale,0,',','.')}} đ <span class="save">(Tiết kiệm {{$product->onsale}}%)</span></div>
                                    </div>
                                @else
                                    <div class="price-new">
                                        <div class="text">Giá bán:</div>
                                        <div class="number">{{number_format($product->price,0,',','.')}} đ</div>
                                    </div>
                                @endif

                            </div>
                            @if (!empty($product->gift))
                                <div class="product-gift">
                                    <div class="product-gift-head"><i class="fas fa-gift me-2"></i> Quà tặng ưu đãi</div>
                                    <div class="product-gift-body">
                                        {!! $product->gift !!}
                                    </div>
                                </div>
                            @endif
                            <div class="product-order">
                                <span class="text">Số lượng:</span>
                                <div class="quantity_wrap">
                                    <div class="quantity buttons_added">
                                        <button class="minus" type="button"><i class="fal fa-minus"></i></button>
                                        <input class="input-text qty text qty-order" max="999" min="1" name="quantity" placeholder="" step="1" title="Qty" type="number" value="1">
                                        <button class="plus"  type="button"><i class="fal fa-plus"></i></button>
                                    </div>
                                </div>
                                <a href="javascript:;" class="addcart add-to-cart" data-id="{{$product->id}}"><i class="fas fa-cart-arrow-down"></i> Thêm vào giỏ hàng</a>
                                <a href="javascript:;" class="addwish add-wish" onclick="add_wish({{$product->id}})"><i class="fal fa-heart"></i></a>
                            </div>
                            <div class="action-addcart">
                                <div class="add-cart">
                                    <a href="javascript:;" class="add-cart-now" data-id="{{$product->id}}">Mua ngay</a>
                                    <a href="">Mua trả góp</a>
                                </div>
                                <div class="affiliate">
                                    <a href="" class="shopee">Shopee</a>
                                    <a href="" class="tiki">Tiki</a>
                                    <a href="" class="lazada">Lazada</a>
                                </div>
                            </div>
                    </div>
                    <div class="product-detail-service">
                            <div class="detail-service">
                                <div class="header-service">
                                    Showroom bán hàng
                                </div>
                                <div class="content-service">
                                    <a href="https://goo.gl/maps/fqjBabTHfA4AJLiz5"><i class="fas fa-map-marker-alt me-1"></i>
                                        81C Mê Linh - Lê Chân - Hải Phòng
                                    </a>
                                    <a href="https://goo.gl/maps/fqjBabTHfA4AJLiz5"><i class="fas fa-map-marker-alt me-1"></i>
                                        81C Mê Linh - Lê Chân - Hải Phòng
                                    </a>
                                    <a href="https://goo.gl/maps/fqjBabTHfA4AJLiz5"><i class="fas fa-map-marker-alt me-1"></i>
                                        81C Mê Linh - Lê Chân - Hải Phòng
                                    </a>
                                </div>
                            </div>
                            <div class="detail-service">
                                <div class="header-service">
                                    Chính sách bán hàng
                                </div>
                                <div class="content-service">
                                    <ul>
                                        <li>Uy tín 10 năm xây dựng và phát triển</li>
                                        <li>Sản phẩm chính hãng 100%</li>
                                        <li>Trả góp lãi suất 0% toàn bộ giỏ hàng</li>
                                        <li>Trả bảo hành tận nơi sử dụng</li>
                                        <li>Bảo hành tận nơi cho doanh nghiệp</li>
                                        <li>Vệ sinh miễn phí trọn đời PC, Laptop</li>
                                        <li>Miễn phí quẹt thẻ</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="detail-service">
                                <div class="header-service">
                                    Liên hệ
                                </div>
                                <div class="content-service">
                                    <a class="phone" href="tel:0886776268">
                                        <i class="fas fa-phone-alt me-1"></i>
                                        Hotline: 0886776286
                                    </a>
                                    <a class="phone" href="">
                                        <i class="fas fa-phone-alt me-1"></i>
                                        Kinh doanh 1: 0886776286
                                    </a>
                                    <a class="phone" href="">
                                        <i class="fas fa-phone-alt me-1"></i>
                                        Kinh doanh 2: 0886776286
                                    </a>
                                    <a class="phone" href="">
                                        <i class="fas fa-phone-alt me-1"></i>
                                        Kinh doanh 3: 0886776286
                                    </a>
                                    <a class="phone" href="">
                                        <i class="fas fa-envelope me-1"></i>
                                       Email: contact@it24h.vn
                                    </a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="product-content-bottom">
                <div class="content-left">
                    <div class="wp-content-detail" style="overflow: hidden;">
                        <div class="header-content">Chi tiết sản phẩm</div>
                        <div class="content-detail">
                            {!! $product->content !!}
                        </div>
                    </div>
                    @if (!empty($product->youtube))
                        <div class="media-product">
                            <div class="header-content">Video</div>
                            <div class="ratio ratio-16x9">
                                <iframe src="{{$product->youtube}}" title="" allowfullscreen></iframe>
                            </div>
                        </div>
                    @endif
                    <div class="product-specifications-mobile">
                        <div class="header-content">Thông số kỹ thuật</div>
                        <div class="specifications-info">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td style="text-align: center;"><strong>Sản phẩm</strong></td>
                                        <td style="text-align: center;"><strong>Chi tiết</strong></td>
                                        <td style="text-align: center;"><strong>Bảo hành</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">CPU</td>
                                        <td style="text-align: center;">CPU Intel Core i3-10100F (3.6GHz up to 4.3GHz, 4 Cores 8 Threads, 6MB Cache, Socket Intel LGA 1200)</td>
                                        <td style="text-align: center;">36T</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">Mainboard</td>
                                        <td style="text-align: center;">Mainboard H510M</td>
                                        <td style="text-align: center;">36T</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">RAM</td>
                                        <td style="text-align: center;">8GB</td>
                                        <td style="text-align: center;">36T</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">SSD</td>
                                        <td style="text-align: center;">240GB</td>
                                        <td style="text-align: center;">36T</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">VGA</td>
                                        <td style="text-align: center;">GeForce GTX 1650 4G GDDR6</td>
                                        <td style="text-align: center;">36T</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">PSU</td>
                                        <td style="text-align: center;">Cooler Master PC400</td>
                                        <td style="text-align: center;">36T</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">CASE</td>
                                        <td style="text-align: center;">Vỏ Case Gaming</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="comment-vote">
                        <div class="header-content">Bình luận và đánh giá sản phẩm</div>
                        <div class="content-detail">
                            <div class="wrap-review">
                                <div class="review-left">
                                    <div class="review-left-poit">{{$product->trungbinhsao()}}/5 <span class="icon-star2"><i class="fa fa-star" aria-hidden="true"></i></span></div>
                                </div>
                                <div class="review-center">
                                    <div class="review-center-item">
                                        <div class="item-left">5 sao</div>
                                        <div class="item-center"><span style="width:{{($product->vote_5->count()/(($product->votes->count() == 0) ? 5 : $product->votes->count()))*100}}%"></span></div>
                                        <div class="item-right">{{$product->vote_5->count()}}</div>
                                    </div>
                                    <div class="review-center-item">
                                        <div class="item-left">4 sao</div>
                                        <div class="item-center"><span style="width:{{($product->vote_4->count()/(($product->votes->count() == 0) ? 5 : $product->votes->count()))*100}}%"></span></div>
                                        <div class="item-right">{{$product->vote_4->count()}}</div>
                                    </div>
                                    <div class="review-center-item">
                                        <div class="item-left">3 sao</div>
                                        <div class="item-center"><span style="width:{{($product->vote_3->count()/(($product->votes->count() == 0) ? 5 : $product->votes->count()))*100}}%"></span></div>
                                        <div class="item-right">{{$product->vote_3->count()}}</div>
                                    </div>
                                    <div class="review-center-item">
                                        <div class="item-left">2 sao</div>
                                        <div class="item-center"><span style="width:{{($product->vote_2->count()/(($product->votes->count() == 0) ? 5 : $product->votes->count()))*100}}%"></span></div>
                                        <div class="item-right">{{$product->vote_2->count()}}</div>
                                    </div>
                                    <div class="review-center-item">
                                        <div class="item-left">1 sao</div>
                                        <div class="item-center"><span style="width:{{($product->vote_1->count()/(($product->votes->count() == 0) ? 5 : $product->votes->count()))*100}}%"></span></div>
                                        <div class="item-right">{{$product->vote_1->count()}}</div>
                                    </div>
                                </div>
                                <div class="review-right">
                                    <div class="title">Để lại nhận xét và đánh giá của bạn</div>
                                    <a class="show-form js-toggle-form-rv" onclick="$('#review_form_wrapper').slideToggle()" href="javascript:void(0)">Viết đánh giá</a>
                                </div>
                            </div>
                            <div id="review_form_wrapper" style="display: none;">
                                <div class="title">Để lại đánh giá của bạn</div>
                                <div id="review_form">
                                    <div class="comment-respond" id="respond">
                                        <form class="comment-form" id="commentform" method="post">
                                            <div class="comment-form-rating">
                                                <label for="rating">
                                                    Đánh giá của bạn
                                                    <span class="required">
                                                        *
                                                    </span>
                                                </label>
                                                <div id="rating">
                                                    <input id="star1" name="rating" class="check-rate" type="radio" value="5" checked>
                                                    <label class="full" for="star1">
                                                    </label>
                                                    <input id="star2" name="rating" class="check-rate" type="radio" value="4">
                                                    <label class="full" for="star2">
                                                    </label>
                                                    <input id="star3" name="rating" class="check-rate" type="radio" value="3">
                                                    <label class="full" for="star3">
                                                    </label>
                                                    <input id="star4" name="rating" class="check-rate" type="radio" value="2">
                                                    <label class="full" for="star4">
                                                    </label>
                                                    <input id="star5" name="rating" class="check-rate" type="radio" value="1">
                                                    <label class="full" for="star5">
                                                    </label>
                                                </div>
                                            </div>

                                            <div style="display: flex; flex-wrap: wrap; justify-content: space-between;">
                                                <p class="comment-form-author">
                                                    <input id="author" name="author" placeholder="Nhập họ tên *" size="30" type="text" value="" required>
                                                </p>
                                                <p class="comment-form-email">
                                                    <input id="email" name="email" placeholder="Nhập email *" size="30" type="email" value="" required>
                                                </p>
                                            </div>
                                            <p class="comment-form-comment">
                                                <textarea cols="45" id="comment" name="comment" placeholder="Nhập nội dung đánh giá *" rows="8" required></textarea>
                                            </p>
                                            <p class="form-submit">
                                                <input type="hidden" name="comment_product" id="comment_product" value="{{$product->id}}">
                                                <input  id="comment_parent" name="comment_parent" type="hidden" value="0">
                                                <a href="javascript:;" id="submit-comment">Gửi đánh giá</a>
                                            </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-comment">
                                @foreach ($product->votes as $comment)
                                    <li class="detail-comment">
                                        <div class="avatar">
                                            <img src="{{asset('asset/images/avatar-comment.png')}}" alt="">
                                        </div>
                                        <div class="wp-content-comment">
                                            <div class="rating2">
                                                <div class="rating-upper" style="width: {{$comment->level * 20}}%">
                                                    <span>
                                                        <i class="fas fa-star">
                                                        </i>
                                                    </span>
                                                    <span>
                                                        <i class="fas fa-star">
                                                        </i>
                                                    </span>
                                                    <span>
                                                        <i class="fas fa-star">
                                                        </i>
                                                    </span>
                                                    <span>
                                                        <i class="fas fa-star">
                                                        </i>
                                                    </span>
                                                    <span>
                                                        <i class="fas fa-star">
                                                        </i>
                                                    </span>
                                                </div>
                                                <div class="rating-lower">
                                                    <span>
                                                        <i class="fal fa-star">
                                                        </i>
                                                    </span>
                                                    <span>
                                                        <i class="fal fa-star">
                                                        </i>
                                                    </span>
                                                    <span>
                                                        <i class="fal fa-star">
                                                        </i>
                                                    </span>
                                                    <span>
                                                        <i class="fal fa-star">
                                                        </i>
                                                    </span>
                                                    <span>
                                                        <i class="fal fa-star">
                                                        </i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="author">
                                                <span class="name">{{$comment->name_user}}</span>
                                                <span class="date">{{\App\Helpers\CommonHelper::convertDateToDMY($comment->created_at)}}</span>
                                            </div>
                                            <div class="content-comment">
                                                {{$comment->comment}}
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                                <div id="comment-ajax"></div>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="content-right">
                    <div class="product-specifications">
                        <div class="header-content">Thông số kỹ thuật</div>
                        <div class="specifications-info">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td style="text-align: center;"><strong>Sản phẩm</strong></td>
                                        <td style="text-align: center;"><strong>Chi tiết</strong></td>
                                        <td style="text-align: center;"><strong>Bảo hành</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">CPU</td>
                                        <td style="text-align: center;">CPU Intel Core i3-10100F (3.6GHz up to 4.3GHz, 4 Cores 8 Threads, 6MB Cache, Socket Intel LGA 1200)</td>
                                        <td style="text-align: center;">36T</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">Mainboard</td>
                                        <td style="text-align: center;">Mainboard H510M</td>
                                        <td style="text-align: center;">36T</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">RAM</td>
                                        <td style="text-align: center;">8GB</td>
                                        <td style="text-align: center;">36T</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">SSD</td>
                                        <td style="text-align: center;">240GB</td>
                                        <td style="text-align: center;">36T</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">VGA</td>
                                        <td style="text-align: center;">GeForce GTX 1650 4G GDDR6</td>
                                        <td style="text-align: center;">36T</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">PSU</td>
                                        <td style="text-align: center;">Cooler Master PC400</td>
                                        <td style="text-align: center;">36T</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">CASE</td>
                                        <td style="text-align: center;">Vỏ Case Gaming</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="wp-list-post">
                        <div class="header-content">Tin tức mới nhất</div>
                        <ul class="list-post">
                            @foreach ($posts as $post)
                                <li>
                                    <a href="">
                                        <div class="thumb"><img src="{{asset('upload/images/post/medium/'.$post->thumb)}}" alt=""></div>
                                        <div class="detail-post">
                                            <h3 class="title">{{$post->title}}</h3>
                                            <div class="desc">
                                                {{$post->excerpt}}
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
            <div class="list-product-bottom">
                <div class="product-content" style="margin-bottom: 40px;">
                    <div class="block-title">
                        <ul class="nav nav-pills list-product-recommend owl-carousel owl-theme owl-loaded owl-drag" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-cat1-tab" data-bs-toggle="pill" data-bs-target="#pills-cat1" type="button" role="tab" aria-controls="pills-cat1" aria-selected="true">Sản phẩm liên quan</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-cat2-tab" data-bs-toggle="pill" data-bs-target="#pills-cat2" type="button" role="tab" aria-controls="pills-cat2" aria-selected="false">Sản phẩm đã xem</button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content container-home" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-cat1" role="tabpanel" aria-labelledby="pills-cat1-tab">
                            <div class="list-product owl-carousel owl-theme owl-loaded owl-drag list-product-recommend-slider" id="list-product-group">
                                @foreach ($product_related as $item)
                                    <!-- product -->
                                    <div class="product-item mb-3">
                                        <div class="thumb">
                                            <a href="{{ route('detailproduct', $item->slug)}}">
                                                <img class="owl-lazy" data-src="{{asset('upload/images/products/medium/'.$item->thumb)}}" alt="">
                                                @if (!empty($item->brand))
                                                    <span class="brand" style="background-image: url('{{asset("upload/images/products/thumb/".$item->brands->image)}}');"></span>
                                                @endif
                                                <div class="wp-tag">
                                                    @if (!empty($item->year))
                                                        <span class="years">{{$item->year}}</span>
                                                    @endif
                                                    @if (!empty($item->installment))
                                                        <span class="payment">Trả góp 0%</span>
                                                    @endif
                                                </div>
                                            </a>
                                        </div>
                                        <div class="detail">
                                            <div class="wp-event">
                                                @if (!empty($item->event))
                                                    <p class="event" style="background: linear-gradient(to right,{{$item->events->color_left}},{{$item->events->color_right}});">
                                                        <img src="{{asset('upload/images/products/thumb/'.$item->events->icon)}}" alt="">
                                                        <span>{{$item->events->name}}</span>
                                                    </p>
                                                @else
                                                    <p class="event" style="min-height: 20px;"></p>
                                                @endif
                                                <p class="code">Mã: {{$item->id}}</p>
                                            </div>
                                            <div class="name">
                                                <a href="{{ route('detailproduct', $item->slug)}}">{{$item->name}}</a>
                                            </div>
                                            @if (!empty($item->specifications))
                                                <ul class="product-attributes">
                                                    @foreach ($item->get_specifications() as $k)
                                                        <li>{{$k}}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                            <div class="price-review clearfix">
                                                <div class="price">
                                                    @if (!empty($item->onsale))
                                                        <span class="onsale">- {{$item->onsale}}%</span>
                                                        <div class="price-old">{{number_format($item->price,0,',','.')}} đ</div>
                                                        <div class="price-new">{{number_format($item->price_onsale,0,',','.')}} đ</div>
                                                    @else
                                                        <div class="price-new">{{number_format($item->price,0,',','.')}} đ</div>
                                                    @endif
                                                </div>
                                                <div class="review">
                                                    <div class="rating2">
                                                        <div class="rating-upper" style="width: {{$item->count_vote()}}%">
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
                                                    <div class="count-review">({{$item->votes->count()}})</div>
                                                    @if (!empty($item->sold))
                                                        <div class="sold"><i class="fas fa-badge-check"></i>Đã bán {{$item->sold}}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="detail-bottom">
                                                @if (!empty($item->still_stock))
                                                    <div class="qty" style="color: #01aa42;
                                                    background-color: #dbf8e1;">{{$item->still_stock}}</div>
                                                @endif
                                                <div class="action">
                                                    <a href="javascript:;" class="repeat" title="So sánh"><i class="far fa-repeat"></i></a>
                                                    <a href="javascript:;" class="heart add-wish" title="Lưu sản phẩm" onclick="add_wish({{$item->id}})"><i class="far fa-heart"></i></a>
                                                    <a href="javascript:;" title="Thêm vào giỏ hàng" class="add-cart" onclick="add_cart({{$item->id}})"><i class="far fa-shopping-cart"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="tab-pane fade" id="pills-cat2" role="tabpanel" aria-labelledby="pills-cat2-tab">
                            <div class="list-product owl-carousel owl-theme owl-loaded owl-drag list-product-recommend-slider" id="list-product-group">
                                @foreach ($product_watched as $item)
                                    <!-- product -->
                                    <div class="product-item mb-3">
                                        <div class="thumb">
                                            <a href="{{ route('detailproduct', $item->slug)}}">
                                                <img class="owl-lazy" data-src="{{asset('upload/images/products/medium/'.$item->thumb)}}" alt="">
                                                @if (!empty($item->brand))
                                                    <span class="brand" style="background-image: url('{{asset("upload/images/products/thumb/".$item->brands->image)}}');"></span>
                                                @endif
                                                <div class="wp-tag">
                                                    @if (!empty($item->year))
                                                        <span class="years">{{$item->year}}</span>
                                                    @endif
                                                    @if (!empty($item->installment))
                                                        <span class="payment">Trả góp 0%</span>
                                                    @endif
                                                </div>
                                            </a>
                                        </div>
                                        <div class="detail">
                                            <div class="wp-event">
                                                @if (!empty($item->event))
                                                    <p class="event" style="background: linear-gradient(to right,{{$item->events->color_left}},{{$item->events->color_right}});">
                                                        <img src="{{asset('upload/images/products/thumb/'.$item->events->icon)}}" alt="">
                                                        <span>{{$item->events->name}}</span>
                                                    </p>
                                                @else
                                                    <p class="event" style="min-height: 20px;"></p>
                                                @endif
                                                <p class="code">Mã: {{$item->id}}</p>
                                            </div>
                                            <div class="name">
                                                <a href="{{ route('detailproduct', $item->slug)}}">{{$item->name}}</a>
                                            </div>
                                            @if (!empty($item->specifications))
                                                <ul class="product-attributes">
                                                    @foreach ($item->get_specifications() as $k)
                                                        <li>{{$k}}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                            <div class="price-review clearfix">
                                                <div class="price">
                                                    @if (!empty($item->onsale))
                                                        <span class="onsale">- {{$item->onsale}}%</span>
                                                        <div class="price-old">{{number_format($item->price,0,',','.')}} đ</div>
                                                        <div class="price-new">{{number_format($item->price_onsale,0,',','.')}} đ</div>
                                                    @else
                                                        <div class="price-new">{{number_format($item->price,0,',','.')}} đ</div>
                                                    @endif
                                                </div>
                                                <div class="review">
                                                    <div class="rating2">
                                                        <div class="rating-upper" style="width: {{$item->count_vote()}}%">
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
                                                    <div class="count-review">({{$item->votes->count()}})</div>
                                                    @if (!empty($item->sold))
                                                        <div class="sold"><i class="fas fa-badge-check"></i>Đã bán {{$item->sold}}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="detail-bottom">
                                                @if (!empty($item->still_stock))
                                                    <div class="qty" style="color: #01aa42;
                                                    background-color: #dbf8e1;">{{$item->still_stock}}</div>
                                                @endif
                                                <div class="action">
                                                    <a href="javascript:;" class="repeat" title="So sánh"><i class="far fa-repeat"></i></a>
                                                    <a href="javascript:;" class="heart add-wish" title="Lưu sản phẩm" onclick="add_wish({{$item->id}})"><i class="far fa-heart"></i></a>
                                                    <a href="javascript:;" title="Thêm vào giỏ hàng" class="add-cart" onclick="add_cart({{$item->id}})"><i class="far fa-shopping-cart"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p id="message_add_cart" style="display:none;">@lang('lang.Productaddedtocartsuccessfully')</p>
    <p id="Youhavenotfilledinthecommentsreviews" style="display:none;">@lang('lang.Youhavenotfilledinthecommentsreviews')</p>
    <p id="Younotyetrating" style="display:none;">@lang('lang.Younotyetrating')</p>
    <p id="Nameisempty" style="display:none;">@lang('lang.Nameisempty')</p>
    <p id="Emailisempty" style="display:none;">@lang('lang.Emailisempty')</p>
@endsection

@section('footer')
    @include('frontend.layouts.footer')
@endsection

@section('js')
    <script>
        $(document).ready(function(){
        $('.thumb-small').click(function(){
            let src = $(this).find('img').attr('src');
            let picture_src = src.replace('{{asset("upload/images/products/thumb/")}}', '');
            // alert(picture_src);
            $('.product-thumb .image img').attr('src', '{{asset("upload/images/products/large/")}}' + picture_src);
            $('.thumb-small').removeClass('active');
            $(this).addClass('active');

            return false;
        });
        $('span.next').click(function(){
            // alert('ok')
            if($('ul.list-thumb-detail li:last-child').children('.thumb-small').hasClass('active')){
                $('ul.list-thumb-detail li:first-child').children('.thumb-small').click();
            } else {
                $('ul.list-thumb-detail li .thumb-small.active').parent('li').next().children('.thumb-small').click();
            }
        });
        $('span.prev').click(function(){
            if($('ul.list-thumb-detail li:first-child').children('.thumb-small').hasClass('active')){
                $('ul.list-thumb-detail li:last-child').children('.thumb-small').click();
            } else {
                $('ul.list-thumb-detail li .thumb-small.active').parent('li').prev().children('.thumb-small').click();
            }
        });

        $('ul.list-thumb-detail li:first-child').children('.thumb-small').click();

            //Cong so luong san pham
        $(".plus").on("click",function(){
            $(this).prev().val(+$(this).prev().val() + 1);
        });

        //tru sl san pham
        $(".minus").on("click",function(){
            if ($(this).next().val() > 0)
                $(this).next().val(+$(this).next().val() - 1);
        });


    });

            $(document).ready(function(){
                var mess = document.getElementById('message_add_cart').innerHTML;
                var mess2 = document.getElementById('Youhavenotfilledinthecommentsreviews').innerHTML;
                var mess3 = document.getElementById('Younotyetrating').innerHTML;
                var mess4 = document.getElementById('Nameisempty').innerHTML;
                var mess5 = document.getElementById('Emailisempty').innerHTML;
                //Add to Cart
                $('.add-to-cart').click(function(){
                    var id = $(this).data('id');
                    var qty = $('.qty-order').val();
                    var _token = $('meta[name="csrf-token"]').attr('content');
                            var data = {
                                id: id,
                                qty: qty,
                                _token: _token
                            };
                            $.ajax({
                                url: "{{ route('add_cart_ajax') }}",
                                method: 'POST',
                                data: data,
                                dataType: "json",
                                success: function(data) {
                                    alert(mess);
                                    $('#count-cart').text(data.count);
                                },
                            });
                });
                add_wish = function(id){
                    var _token = $('meta[name="csrf-token"]').attr('content');
                    var data = {id:id, _token:_token};
                    $.ajax({
                        url: "{{route('add_wish')}}",
                        method: 'POST',
                        data: data,
                        dataType: 'json',
                        success: function(data) {
                            alert('Thêm thành công sản phẩm vào danh sách yêu thích!');
                            $('#count-wish').text(data.count_wish);
                        },
                    });
                }
                add_cart = function(id){
                    var _token = $('meta[name="csrf-token"]').attr('content');
                    var data = {
                        id: id,
                        _token: _token
                    };

                    $.ajax({
                        url: "{{ route('add_cart_ajax') }}",
                        method: 'POST',
                        data: data,
                        dataType: "json",
                        success: function(data) {
                            alert('Thêm thành công sản phẩm vào giỏi hàng!');
                            $('#count-cart').text(data.count);
                        },
                    });
                }

                $('.add-cart-now').click(function(){
                    var id = $(this).data('id');
                    var _token = $('meta[name="csrf-token"]').attr('content');
                    var data = {
                        id: id,
                        _token: _token
                    };
                    $.ajax({
                        url: "{{ route('add_cart_ajax') }}",
                        method: 'POST',
                        data: data,
                        dataType: "json",
                        success: function(data) {
                            $('#count-cart').text(data.count);
                            location.href = '{{route('list_cart')}}';
                        },
                    });
                });

                //Comment
                $('#submit-comment').click(function(){
                    var rating = $(".check-rate:checked").val();
                    var author = $("#author").val();
                    var email = $("#email").val();
                    var comment = $("#comment").val();
                    var id = $("#comment_product").val();
                    var _token = $('meta[name="csrf-token"]').attr('content');
                    var data = {rating: rating, author: author, email:email, comment:comment, id:id, _token:_token};
                    if ($.trim(rating) == ''){
                        alert(mess3);
                        return false;
                    }
                    if ($.trim(author) == ''){
                        alert(mess4);
                        return false;
                    }
                    if ($.trim(email) == ''){
                        alert(mess5);
                        return false;
                    }
                    if ($.trim(comment) == ''){
                        alert(mess2);
                        return false;
                    }
                    $.ajax({
                        url: "{{route('commentProduct')}}",
                        method: 'POST',
                        data: data,
                        dataType: "json",
                        success: function(data) {
                            $("#comment-ajax").append(data);
                            $("#commentform")[0].reset();
                            $('#review_form_wrapper').css('display', 'none');
                            alert('Để lại bình luận, đánh giá thành công!');
                        },
                    });
                });

        });
    </script>
@endsection


