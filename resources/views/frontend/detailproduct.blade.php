@php use App\Helpers\CommonHelper; @endphp
@extends('frontend.layouts.base')

@section('title')
    <title>{{$product->name}}</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('asset/css/detail-product.css')}}">
@endsection

@section('header-home')
    @include('frontend.layouts.header-page', [$Sidebars, $active_menu])
@endsection

@section('content')
    <div class="wp-content">
        <div class="wp-breadcrumb-page">
            <div class="container-page">
                <div class="breadcrumb-page">
                    <a href="/">Trang chủ <i class="fas fa-angle-right mx-1"></i></a>
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
                                @if ($product->brand)
                                    <div class="product-brand">
                                        @if($product->img_brands !="no-images.jpg")
                                            <img src="{{asset('upload/images/products/medium/'.$product->img_brands)}}"
                                                 alt="">
                                        @endif
                                    </div>
                                @endif
                                <span class="prev"><i class="fas fa-chevron-left"></i></span>
                                <span class="next"><i class="fas fa-chevron-right"></i></span>
                            </div>
                            <ul class="list-thumb-detail">
                                <li>
                                    <a href="javascript:" class="thumb-small active">
                                        @if($product->thumb !="no-images.jpg")
                                            <img src="{{asset('upload/images/products/thumb/'.$product->thumb)}}"
                                                 alt="">
                                        @else
                                            <img src="{{asset('upload/images/common_img/no-images.jpg')}}" alt="">
                                        @endif
                                    </a>
                                </li>
                                @if ($imgs)
                                    @foreach ($imgs as $img)
                                        <li>
                                            <a href="javascript:" class="thumb-small">
                                                @if($img !="no-images.jpg")
                                                    <img src="{{asset('upload/images/products/thumb/'.$img)}}" alt="">
                                                @else
                                                    <img src="{{asset('upload/images/common_img/no-images.jpg')}}"
                                                         alt="">
                                                @endif
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="product-detail-info">
                        <div class="product-detail-meta">
                            <div class="code">Mã: {{$product->ma}}</div>
                            <span class="icon-meta">|</span>
                            <div class="review">
                                <div class="rating2">
                                    <div class="rating-upper"
                                         style="width: @if($product->votes_count>0){{$product->votes_sum/$product->votes_count*20}}% @else 0% @endif">
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
                                <div class="count-review">({{$product->votes_count}})</div>
                                @if ($product->sold>0)
                                    <span class="icon-meta">|</span>
                                    <div class="sold">Đã bán: {{$product->sold}}</div>
                                @endif
                                @if ($product->view>0)
                                    <span class="icon-meta">|</span>
                                    <div class="sold">Lượt xem: {{$product->view}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="product-sumary">
                            @if($product->short_content)
                                <div class="sumary-title">Thông số sản phẩm</div>
                                {!! $product->short_content !!}
                            @endif
                        </div>
                        <div class="product-price">
                            @if ($product->price_onsale>0)
                                <div class="price-old">
                                    <div class="text">Giá bán:</div>
                                    <div class="number">{{number_format($product->price,0,',','.')}} đ</div>
                                </div>
                                <div class="price-new">
                                    <div class="text"> Giá khuyến mãi:</div>
                                    <div class="number">{{number_format($product->price_onsale,0,',','.')}} đ <span
                                            class="save">(Tiết kiệm {{$product->onsale}}%)</span></div>
                                </div>
                            @else
                                <div class="price-new">
                                    <div class="text">Giá bán:</div>
                                    <div class="number">{{number_format($product->price,0,',','.')}} đ</div>
                                </div>
                            @endif
                        </div>
                        <div class="warranty_flex">
                            @if($product->tax==1)
                                <div class="warranty">Giá đã có VAT</div>
                            @endif
                            @if($product->warranty)
                                <div class="warranty">Bảo hành {{$product->warranty}}</div>
                            @endif
                        </div>
                        @if ($product->gift)
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
                                    <input class="input-text qty text qty-order" max="999" min="1" name="quantity"
                                           placeholder="" step="1" title="Qty" type="number" value="1">
                                    <button class="plus" type="button"><i class="fal fa-plus"></i></button>
                                </div>
                            </div>
                            <a href="javascript:" class="addcart add-cart-mutiple" get-id="{{$product->id}}"><i
                                    class="fas fa-cart-arrow-down"></i> Thêm vào giỏ hàng</a>
                            <a href="javascript:" class="addwish add-wish"><i class="fal fa-heart"></i></a>
                        </div>
                        <div class="action-addcart">
                            <div class="add-cart">
                                <a href="javascript:" class="add-cart" get-id="{{$product->id}}">Mua ngay</a>
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
                                <a href="https://goo.gl/maps/fqjBabTHfA4AJLiz5"><i
                                        class="fas fa-map-marker-alt me-1"></i>
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
                    @if($product->content)
                        <div class="wp-content-detail">
                            <div class="header-content">Chi tiết sản phẩm</div>
                            <div class="detail_info_p">
                                <div class="content-detail box_content">
                                    {!! $product->content !!}
                                </div>
                                <div class="viewmore"><a href="javascript:void(0)" class="viewmore">Xem thêm <i
                                            class="far fa-angle-down"></i></a></div>
                            </div>
                        </div>
                    @endif
                    @if ($product->youtube)
                        <div class="media-product">
                            <div class="header-content">Video</div>
                            <div class="ratio ratio-16x9">
                                {!! $product->youtube !!}
                            </div>
                        </div>
                    @endif
                    <div class="product-specifications-mobile">
                        @if($product->property)
                            <div class="header-content">Thông số kỹ thuật</div>
                            <div class="specifications-info">
                                {!! $product->property !!}
                            </div>
                        @endif
                    </div>
                    <div class="comment-vote">
                        <div class="header-content">Bình luận và đánh giá sản phẩm</div>
                        <div class="content-detail">
                            <div class="wrap-review">
                                <div class="review-left">
                                    <div class="review-left-poit">{{$product->trungbinhsao()}}/5 <span
                                            class="icon-star2"><i class="fa fa-star" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                                <div class="review-center">
                                    <div class="review-center-item">
                                        <div class="item-left">5 sao</div>
                                        <div class="item-center"><span
                                                style="width:{{($product->vote_5->count()/(($product->votes->count() == 0) ? 5 : $product->votes->count()))*100}}%"></span>
                                        </div>
                                        <div class="item-right">{{$product->vote_5->count()}}</div>
                                    </div>
                                    <div class="review-center-item">
                                        <div class="item-left">4 sao</div>
                                        <div class="item-center"><span
                                                style="width:{{($product->vote_4->count()/(($product->votes->count() == 0) ? 5 : $product->votes->count()))*100}}%"></span>
                                        </div>
                                        <div class="item-right">{{$product->vote_4->count()}}</div>
                                    </div>
                                    <div class="review-center-item">
                                        <div class="item-left">3 sao</div>
                                        <div class="item-center"><span
                                                style="width:{{($product->vote_3->count()/(($product->votes->count() == 0) ? 5 : $product->votes->count()))*100}}%"></span>
                                        </div>
                                        <div class="item-right">{{$product->vote_3->count()}}</div>
                                    </div>
                                    <div class="review-center-item">
                                        <div class="item-left">2 sao</div>
                                        <div class="item-center"><span
                                                style="width:{{($product->vote_2->count()/(($product->votes->count() == 0) ? 5 : $product->votes->count()))*100}}%"></span>
                                        </div>
                                        <div class="item-right">{{$product->vote_2->count()}}</div>
                                    </div>
                                    <div class="review-center-item">
                                        <div class="item-left">1 sao</div>
                                        <div class="item-center"><span
                                                style="width:{{($product->vote_1->count()/(($product->votes->count() == 0) ? 5 : $product->votes->count()))*100}}%"></span>
                                        </div>
                                        <div class="item-right">{{$product->vote_1->count()}}</div>
                                    </div>
                                </div>
                                <div class="review-right">
                                    <div class="title">Để lại nhận xét và đánh giá của bạn</div>
                                    <a class="show-form js-toggle-form-rv"
                                       onclick="$('#review_form_wrapper').slideToggle()" href="javascript:void(0)">Viết
                                        đánh giá</a>
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
                                                    <input id="star1" name="rating" class="check-rate" type="radio"
                                                           value="5" checked>
                                                    <label class="full" for="star1">
                                                    </label>
                                                    <input id="star2" name="rating" class="check-rate" type="radio"
                                                           value="4">
                                                    <label class="full" for="star2">
                                                    </label>
                                                    <input id="star3" name="rating" class="check-rate" type="radio"
                                                           value="3">
                                                    <label class="full" for="star3">
                                                    </label>
                                                    <input id="star4" name="rating" class="check-rate" type="radio"
                                                           value="2">
                                                    <label class="full" for="star4">
                                                    </label>
                                                    <input id="star5" name="rating" class="check-rate" type="radio"
                                                           value="1">
                                                    <label class="full" for="star5">
                                                    </label>
                                                </div>
                                            </div>

                                            <div
                                                style="display: flex; flex-wrap: wrap; justify-content: space-between;">
                                                <p class="comment-form-author">
                                                    <input id="author" name="author" placeholder="Nhập họ tên *"
                                                           size="30" type="text" value="" required>
                                                </p>
                                                <p class="comment-form-email">
                                                    <input id="email" name="email" placeholder="Nhập email *" size="30"
                                                           type="email" value="" required>
                                                </p>
                                            </div>
                                            <p class="comment-form-comment">
                                                <textarea cols="45" id="comment" name="comment"
                                                          placeholder="Nhập nội dung đánh giá *" rows="8"
                                                          required></textarea>
                                            </p>
                                            <p class="form-submit">
                                                <input type="hidden" name="comment_product" id="comment_product"
                                                       value="{{$product->id}}">
                                                <input id="comment_parent" name="comment_parent" type="hidden"
                                                       value="0">
                                                <a href="javascript:" id="submit-comment">Gửi đánh giá</a>
                                            </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="detail_info_p px-0">
                                <ul class="list-comment box_content box_content2">
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
                                                    <span
                                                        class="date">{{CommonHelper::convertDateToDMY($comment->created_at)}}</span>
                                                </div>
                                                <div class="content-comment">
                                                    {{$comment->comment}}
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                    <div id="comment-ajax"></div>
                                </ul>
                                <div class="viewmore"><a href="javascript:void(0)" class="viewmore">Xem thêm <i class="far fa-angle-down"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-right">
                    <div class="product-specifications">
                        @if($product->property)
                            <div class="header-content">Thông số kỹ thuật</div>
                            <div class="specifications-info">
                                {!! $product->property !!}
                            </div>
                        @endif
                    </div>
                    <div class="wp-list-post">
                        @if($posts->count()>0)
                            <div class="header-content">Tin tức mới nhất</div>
                            <ul class="list-post">
                                @foreach ($posts as $post)
                                    <li>
                                        <a href="">
                                            <div class="thumb"><img
                                                    src="{{asset('upload/images/post/medium/'.$post->thumb)}}" alt="">
                                            </div>
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
                        @endif
                    </div>
                </div>
            </div>
            <div class="list-product-bottom">
                <div class="product-content" style="margin-bottom: 40px;">
                    <div class="block-title">
                        <ul class="nav nav-pills list-product-recommend owl-carousel owl-theme owl-loaded owl-drag"
                            id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-cat1-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-cat1" type="button" role="tab" aria-controls="pills-cat1"
                                        aria-selected="true">Sản phẩm liên quan
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-cat2-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-cat2" type="button" role="tab" aria-controls="pills-cat2"
                                        aria-selected="false">Sản phẩm đã xem
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content container-home" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-cat1" role="tabpanel"
                             aria-labelledby="pills-cat1-tab">
                            <div
                                class="list-product owl-carousel owl-theme owl-loaded owl-drag list-product-recommend-slider"
                                id="list-product-group">
                                @foreach ($product_related as $item)
                                    <!-- product -->
                                    <div class="product-item mb-3">
                                        <div class="thumb">
                                            <a href="{{ route('detailproduct', $item->slug)}}">
                                                @if($item->thumb!="no-images.jpg")
                                                <img class="owl-lazy"
                                                     data-src="{{asset('upload/images/products/medium/'.$item->thumb)}}"
                                                     alt="">
                                                @else
                                                    <img class="owl-lazy"
                                                         data-src="{{asset('upload/images/common_img/no-images.jpg')}}"
                                                         alt="">
                                                @endif
                                                @if (!empty($item->brands->image))
                                                    <span class="brand"
                                                          style="background-image: url('{{asset("upload/images/products/thumb/".$item->brands->image)}}');"></span>
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
                                                    <p class="event"
                                                       style="background: linear-gradient(to right,{{$item->events->color_left}},{{$item->events->color_right}});">
                                                        <img
                                                            src="{{asset('upload/images/products/thumb/'.$item->events->icon)}}"
                                                            alt="">
                                                        <span>{{$item->events->name}}</span>
                                                    </p>
                                                @else
                                                    <p class="event" style="min-height: 20px;"></p>
                                                @endif
                                                <p class="code">Mã: {{$item->ma}}</p>
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
                                                        <div class="price-old">{{number_format($item->price,0,',','.')}}
                                                            đ
                                                        </div>
                                                        <div
                                                            class="price-new">{{number_format($item->price_onsale,0,',','.')}}
                                                            đ
                                                        </div>
                                                    @else
                                                        <div class="price-new">{{number_format($item->price,0,',','.')}}
                                                            đ
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="review">
                                                    <div class="rating2">
                                                        <div class="rating-upper"
                                                             style="width: {{$item->count_vote()}}%">
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
                                                        <div class="sold"><i class="fas fa-badge-check"></i>Đã
                                                            bán {{$item->sold}}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="detail-bottom">
                                                @if (($item->quantity > 0))
                                                    <div class="qty" style="color: #01aa42; background-color: #dbf8e1;">
                                                        Còn hàng
                                                    </div>
                                                @else
                                                    <div class="qty" style="color: #ffffff; background-color: #fb0000;">
                                                        Liên hệ
                                                    </div>
                                                @endif
                                                <div class="action">
                                                    <a href="javascript:" class="repeat" title="So sánh"><i
                                                            class="far fa-repeat"></i></a>
                                                    <a href="javascript:" class="heart add-wish" title="Lưu sản phẩm"
                                                       onclick="add_wish({{$item->id}})"><i
                                                            class="far fa-heart"></i></a>
                                                    <a href="javascript:" title="Thêm vào giỏ hàng" class="add-cart"
                                                       onclick="add_cart({{$item->id}})"><i
                                                            class="far fa-shopping-cart"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-cat2" role="tabpanel" aria-labelledby="pills-cat2-tab">
                            <div
                                class="list-product owl-carousel owl-theme owl-loaded owl-drag list-product-recommend-slider"
                                id="list-product-group">
                                @foreach ($product_watched as $item)
                                    <!-- product -->
                                    <div class="product-item mb-3">
                                        <div class="thumb">
                                            <a href="{{ route('detailproduct', $item->slug)}}">
                                                <img class="owl-lazy"
                                                     data-src="{{asset('upload/images/products/medium/'.$item->thumb)}}"
                                                     alt="">
                                                @if (!empty($item->brand))
                                                    <span class="brand"
                                                          style="background-image: url('{{asset("upload/images/products/thumb/".$item->brands->image)}}');"></span>
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
                                                    <p class="event"
                                                       style="background: linear-gradient(to right,{{$item->events->color_left}},{{$item->events->color_right}});">
                                                        <img
                                                            src="{{asset('upload/images/products/thumb/'.$item->events->icon)}}"
                                                            alt="">
                                                        <span>{{$item->events->name}}</span>
                                                    </p>
                                                @else
                                                    <p class="event" style="min-height: 20px;"></p>
                                                @endif
                                                <p class="code">Mã: {{$item->ma}}</p>
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
                                                        <div class="price-old">{{number_format($item->price,0,',','.')}}
                                                            đ
                                                        </div>
                                                        <div
                                                            class="price-new">{{number_format($item->price_onsale,0,',','.')}}
                                                            đ
                                                        </div>
                                                    @else
                                                        <div class="price-new">{{number_format($item->price,0,',','.')}}
                                                            đ
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="review">
                                                    <div class="rating2">
                                                        <div class="rating-upper"
                                                             style="width: {{$item->count_vote()}}%">
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
                                                        <div class="sold"><i class="fas fa-badge-check"></i>Đã
                                                            bán {{$item->sold}}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="detail-bottom">
                                                @if (($item->quantity - $item->sold > 0))
                                                    <div class="qty" style="color: #01aa42; background-color: #dbf8e1;">
                                                        Còn hàng
                                                    </div>
                                                @else
                                                    <div class="qty" style="color: #ffffff; background-color: #fb0000;">
                                                        Hết hàng
                                                    </div>
                                                @endif
                                                <div class="action">
                                                    <a href="javascript:" class="repeat" title="So sánh"><i
                                                            class="far fa-repeat"></i></a>
                                                    <a href="javascript:" class="heart add-wish" title="Lưu sản phẩm"
                                                       onclick="add_wish({{$item->id}})"><i
                                                            class="far fa-heart"></i></a>
                                                    <a href="javascript:" title="Thêm vào giỏ hàng" class="add-cart"
                                                       onclick="add_cart({{$item->id}})"><i
                                                            class="far fa-shopping-cart"></i></a>
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
    <p id="Youhavenotfilledinthecommentsreviews"
       style="display:none;">@lang('lang.Youhavenotfilledinthecommentsreviews')</p>
    <p id="Younotyetrating" style="display:none;">@lang('lang.Younotyetrating')</p>
    <p id="Nameisempty" style="display:none;">@lang('lang.Nameisempty')</p>
    <p id="Emailisempty" style="display:none;">@lang('lang.Emailisempty')</p>
@endsection

@section('footer')
    @include('frontend.layouts.footer')
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            var _token = $('meta[name="csrf-token"]').attr('content');
            $("table").addClass('table table-bordered table-striped table_boder');
            $(document).on('click', '.thumb-small', function () {
                let src = $(this).find('img').attr('src');
                let picture_src = src.replace('{{asset("upload/images/products/thumb/")}}', '');
                $('.product-thumb .image img').attr('src', '{{asset("upload/images/products/large/")}}' + picture_src);
                $('.thumb-small').removeClass('active');
                $(this).addClass('active');
                return false;
            });
            $(document).on('click', 'span.next', function () {
                if ($('ul.list-thumb-detail li:last-child').children('.thumb-small').hasClass('active')) {
                    $('ul.list-thumb-detail li:first-child').children('.thumb-small').click();
                } else {
                    $('ul.list-thumb-detail li .thumb-small.active').parent('li').next().children('.thumb-small').click();
                }
            });
            $(document).on('click', 'span.prev', function () {
                if ($('ul.list-thumb-detail li:first-child').children('.thumb-small').hasClass('active')) {
                    $('ul.list-thumb-detail li:last-child').children('.thumb-small').click();
                } else {
                    $('ul.list-thumb-detail li .thumb-small.active').parent('li').prev().children('.thumb-small').click();
                }
            });
            $('ul.list-thumb-detail li:first-child').children('.thumb-small').click();
            //Cong so luong san pham
            $(document).on("click", ".plus", function () {
                $(this).prev().val(+$(this).prev().val() + 1);
            });
            //tru sl san pham
            $(document).on("click", ".minus", function () {
                if ($(this).next().val() > 0) {
                    $(this).next().val(+$(this).next().val() - 1);
                }
            });

            //them nhieu san pham vao gio hang
            $(document).on("click", ".add-cart-mutiple", function () {
                var quantity = $('input[name="quantity"]').val();
                var product_id = $(this).attr('get-id');
                var data = {
                    product_id: product_id,
                    quantitys: quantity,
                    status: "plus",
                    _token: _token
                };
                $.ajax({
                    url: '{{route('update_shopping_cart')}}',
                    method: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function (data) {
                        if (data.success) {
                            $('#count-cart').text(data.count);
                        } else {

                        }
                    }
                })
            });


            $('.box_content').each(function (index){
                var height = $(this).height();
                if(height<500){
                    $(this).next().css({'visibility': 'hidden', 'opacity': '0'});
                }
            })
            //xem them
            $(document).on("click", ".viewmore", function () {
                $(this).css({'visibility': 'hidden', 'opacity': '0'});
                $(this).prev().css({'max-height': '100%'});
            });

            //====================================================//
            var mess2 = document.getElementById('Youhavenotfilledinthecommentsreviews').innerHTML;
            var mess3 = document.getElementById('Younotyetrating').innerHTML;
            var mess4 = document.getElementById('Nameisempty').innerHTML;
            var mess5 = document.getElementById('Emailisempty').innerHTML;
            add_wish = function (id) {
                var data = {id: id, _token: _token};
                $.ajax({
                    url: "{{route('add_wish')}}",
                    method: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function (data) {
                        alert('Thêm thành công sản phẩm vào danh sách yêu thích!');
                        $('#count-wish').text(data.count_wish);
                    },
                });
            }
            //Comment
            $('#submit-comment').click(function () {
                var rating = $(".check-rate:checked").val();
                var author = $("#author").val();
                var email = $("#email").val();
                var comment = $("#comment").val();
                var id = $("#comment_product").val();
                var _token = $('meta[name="csrf-token"]').attr('content');
                var data = {rating: rating, author: author, email: email, comment: comment, id: id, _token: _token};
                if ($.trim(rating) == '') {
                    alert(mess3);
                    return false;
                }
                if ($.trim(author) == '') {
                    alert(mess4);
                    return false;
                }
                if ($.trim(email) == '') {
                    alert(mess5);
                    return false;
                }
                if ($.trim(comment) == '') {
                    alert(mess2);
                    return false;
                }
                $.ajax({
                    url: "{{route('commentProduct')}}",
                    method: 'POST',
                    data: data,
                    dataType: "json",
                    success: function (data) {
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


