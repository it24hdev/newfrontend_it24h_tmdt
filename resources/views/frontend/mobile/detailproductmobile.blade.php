@extends('frontend.mobile.basemobile')

@section('title')
    <title>IT24H - Chi tiết sản phẩm</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('asset/css/mobile/detailproduct_mobile.css')}}">
@endsection
@section('header_mobile')
    @include('frontend.mobile.headermobile')
@endsection
@section('content')
    <div class="component-dt-container">
        <div>
            <div id="breadcrumbs">
                <div class="block-breadcrumbs affix" id="affix_h">
                    <div class="cps-container">
                        <ul>
                            <li>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10.633"
                                         viewBox="0 0 12 10.633">
                                        <path
                                            d="M13.2,9.061H12.1v3.965a.6.6,0,0,1-.661.661H8.793V9.721H6.15v3.965H3.507a.6.6,0,0,1-.661-.661V9.061h-1.1c-.4,0-.311-.214-.04-.494L7,3.259a.634.634,0,0,1,.936,0l5.3,5.307c.272.281.356.495-.039.495Z"
                                            transform="translate(-1.471 -3.053)" fill="#3991ff"></path>
                                    </svg>
                                </div>
                                <a href="/">Trang chủ</a></li>
                            <li>
                                <div>
                                    <svg height="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                        <path
                                            d="M96 480c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L242.8 256L73.38 86.63c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l192 192c12.5 12.5 12.5 32.75 0 45.25l-192 192C112.4 476.9 104.2 480 96 480z"></path>
                                    </svg>
                                </div>
                                <a href="{{route('list_product')}}">
                                    Sản phẩm
                                </a>
                            </li>
                            <li>
                                <div>
                                    <svg height="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                        <path
                                            d="M96 480c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L242.8 256L73.38 86.63c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l192 192c12.5 12.5 12.5 32.75 0 45.25l-192 192C112.4 476.9 104.2 480 96 480z"></path>
                                    </svg>
                                </div>
                                <p> {{$product->name}} </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <section class="block-detail-product">
                <div class="cps-container">
                    <div class="box-detail-product">
                        <div class="box-detail-product-ctn">
                            <div class="box-gallery">
                                <div class="gallery-product-detail">
                                    <div class="gallery-slide">
                                        <div class="swiper-wrapper">
                                            <div class="ksp-gallery">
                                                <div class="box-ksp">
                                                    @if(!empty($product->thumb))
                                                        <img
                                                            src="{{asset('upload/images/products/large/'.$product->thumb)}}">
                                                    @else
                                                        <img
                                                            src="{{asset('upload/images/products/large/no-images.png')}}">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="thumbnail-slide">
                                        <div class="slide-wrapper">
                                            <div class="img-wrp">
                                                <a href="javascript:;" class="ac_img_p active">
                                                    <img
                                                        src="{{asset('upload/images/products/thumb/'.$product->thumb)}}"
                                                        width="58" height="58">
                                                </a>
                                            </div>
                                        </div>
                                        @if (!empty($imgs))
                                            @foreach ($imgs as $img)
                                                <div class="slide-wrapper">
                                                    <div class="img-wrp">
                                                        <a href="javascript:;" class="ac_img_p">
                                                            <img src="{{asset('upload/images/products/thumb/'.$img)}}"
                                                                 width="58" height="58">
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="box-info-cnt">
                                <div class="box-header">
                                    @if(!empty($product->name))
                                        <h1>{{$product->name}}</h1>
                                    @endif
                                    <div class="review d-flex">
                                        <span>Mã SP:&nbsp;</span><span class="code_p"><strong>{{$product->ma}}</strong></span>
                                        <p class="mx-2 my-0">|</p>
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
                                        <div class="count-review">{{$product->votes->count()}} đánh giá</div>
                                        <p class="mx-2 my-0">|</p>
                                        @if(!empty($product->sold))
                                            <div class=""><i class="fas fa-badge-check mx-1"></i>Đã
                                                bán {{$product->sold}}</div>
                                        @endif
                                    </div>
                                    <div class="review d-flex">
                                        <span>Bình luận: 11</span>
                                        <p class="mx-2 my-0">|</p><span>Lượt xem: {{$product->view}}</span>
                                        <p class="mx-2 my-0">|</p><span class="mx-2">like</span><span>Share</span>
                                    </div>
                                </div>
                                @if(!empty($product->short_content))
                                    <div class="box-warranty-info">
                                        <div class="ttsp_cnt">{!! $product->short_content !!}</div>
                                    </div>
                                @endif
                                <div class="status_warranty">
                                    <span class="status_warranty_item item_status">
                                        Tình trạng:
                                         @if($product->quantity > 0)
                                            <span class="green">Còn hàng</span>
                                        @else
                                            <span class="blue">Liên hệ</span>
                                        @endif
                                    </span>
                                    @if($product->warranty)
                                        <span class="pro-warrantry status_warranty_item">
                                        Bảo hành: <span class="red">{{$product->warranty}} </span>
                                    </span>
                                    @endif
                                </div>
                                <div class="detail-price-all">
                                    @if ($product->price_onsale != 0 && $product->price_onsale !=null)
                                        <div class="detail-old-price">
                                            <span class="txt">Giá bán:</span>
                                            <span class="price">{{number_format($product->price,0,',','.')}} đ</span>
                                        </div>
                                        <div class="detail-price">
                                            <span class="txt">Giá khuyến mại:</span>
                                            <span
                                                class="price">  {{number_format($product->price_onsale,0,',','.')}} đ</span>
                                            <span class="detail-discount">(Tiết kiệm {{number_format($product->price - $product->price_onsale,0,',','.')}})</span>
                                        </div>
                                    @else
                                        <div class="detail-price">
                                            <span class="txt">Giá khuyến mại:</span>
                                            <span class="price">  {{number_format($product->price,0,',','.')}} đ</span>
                                        </div>
                                    @endif
                                </div>
                                @if(!empty($product->gift))
                                    <div class="detail-offer">
                                        <div class="title"><i class="fa fa-gift" aria-hidden="true"></i> Khuyến mại
                                        </div>
                                        <div class="list">

                                            <span>{!! $product->gift !!}</span>
                                        </div>
                                    </div>
                                @endif
                                <div class="float-start d-block w-100">
                                    <div class="box-buy">
                                        <div class="box-order-button-container">
                                            <div class="box-between">
                                                <a href="javascript:;" class="order-button add-cart-now"
                                                   data-id="{{$product->id}}">
                                                    <strong>MUA NGAY</strong>
                                                    <span>(Giao tận nơi hoặc lấy tại cửa hàng)</span>
                                                </a>
                                                <a href="javascript:;" get-id="{{$product->id}}"
                                                   class="button-add-to-cart add-cart">
                                                    <img
                                                        src="https://static-product.cellphones.com.vn/img/add-to-cart.97145ab.png"
                                                        alt="cart-icon">
                                                    <span>Thêm vào giỏ</span>
                                                </a>
                                            </div>
                                            <div class="box-between">
                                                <button class="installment-button">
                                                    <strong>TRẢ GÓP 0%</strong><br>
                                                    <span>(Xét duyệt qua điện thoại)</span>
                                                </button>
                                                <button class="installment-button">
                                                    <strong>TRẢ GÓP QUA THẺ</strong><br>
                                                    <span>(Visa, Mastercard, JCB)</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-baseline justify-content-center call">
                            <i class="fas fa-phone-alt mx-2 red"></i><span>Gọi mua hàng: <tel class="red"><strong>0886776286</strong></tel></span>
                        </div>
                        <p class="fw-bold">Sản phẩm có sẵn tại:</p>
                        <div class="location_store">
                            <table class="table">
                                <tr>
                                    <td>
                                        <i class="fas fa-phone-alt mx-2 red"></i><strong class="red">0886776286</strong>
                                        &nbsp;-&nbsp;
                                        <i class="fas fa-map-marker-alt location_color"></i>
                                        <a href="https://www.google.com/maps/place/C%E1%BB%ADa+H%C3%A0ng+M%C3%A1y+T%C3%ADnh+IT24H/@20.8528405,106.6782152,17z/data=!3m1!4b1!4m5!3m4!1s0x314a7b21e08e9cc3:0x601afb677eb0524e!8m2!3d20.8528416!4d106.68045">Số
                                            81C Mê Linh - An Biên - Lê Chân - Hải Phòng</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        @if(!empty($product->property))
                            <div class="technicalInfo">
                                <h2 class="title">Thông số kỹ thuật</h2>
                                <div class="tskt_cnt">{!! $product->property !!}</div>
                                <button class="btn_view_detail_p">Xem
                                    cấu hình chi
                                    tiết
                                    <div class="d-flex">
                                        <i class="far fa-angle-down"></i>
                                    </div>
                                </button>
                                <div class="modal modal-tskt d-none">
                                    <div class="modal-background"></div>
                                    <div class="modal-content-tskt">
                                        <div>
                                            <div class="header_tskt">
                                                <p class="title_tskt">Thông số kỹ thuật</p>
                                                <button class="bnt-close-tskt"><i class="fas fa-times-circle"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="modal-tskt-content px-2 pt-2 pb-0">
                                            {!! $product->property !!}
                                        </div>
                                        <div class="close_tskt">
                                            <button class="bnt-close-tskt">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(!empty($product->content))
                            <div class="dt_description">
                                <div class="ctn_des" id="des_show"> {!! $product->content !!} </div>
                                <button class="btn_view_content_all">Xem thêm
                                    <div class="d-flex">
                                        <i class="far fa-angle-down"></i>
                                    </div>
                                </button>
                            </div>
                        @endif
                        @if($product->youtube)
                        <div class="link_youtube">
                            <h2>Video sản phẩm</h2>
                            {!! $product->youtube !!}
                        </div>
                        @endif
                        <div class="category-container p-0">
                            <div class="cat_box_sale box_sale">
                                <div class="cat_box_s_h">
                                    <div class="title_s">
                                        <div class="p_similar_tt" id="load_p_similar"
                                             data-target="{{$product->slug}}">
                                            <h2>Sản phẩm tương tự</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="featured-product-list" id="load_p_detail"></div>
                            </div>
                        </div>
                        <div class="evaluation">
                            <h2 class="title"> Đánh giá &amp; nhận xét {{$product->name}} </h2>
                            <div class="boxreview_dt">
                                <div class="boxReview-score"><p class="calc_rate">{{$product->trungbinhsao()}}/5</p>
                                    <div class="d-flex">
                                        <div class="rating2">
                                            <div class="rating-upper"
                                                 style="width: {{$product->trungbinhsao()/5*100}}%">
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
                                    </div>
                                    <p class="size_p"><strong>{{$product->votes->count()}}</strong> đánh giá và nhận xét
                                    </p></div>
                                <div class="boxReview-star">
                                    <div class="rating-level">
                                        <div class="star-count">
                                            <strong><span>5</span></strong>
                                            <div class="start_co w-100"><span><i class="fas fa-star"></i></span></div>
                                        </div>
                                        <progress max="89"
                                                  value="{{($product->vote_5->count()/(($product->votes->count() == 0) ? 5 : $product->votes->count()))*89}}"
                                                  class="progress_s"></progress>
                                        <span class="number_ev">{{$product->vote_5->count()}} đánh giá</span>
                                    </div>
                                    <div class="rating-level">
                                        <div class="star-count">
                                            <strong><span>4</span></strong>
                                            <div class="start_co w-100"><span><i class="fas fa-star"></i></span></div>
                                        </div>
                                        <progress max="89"
                                                  value="{{($product->vote_4->count()/(($product->votes->count() == 0) ? 5 : $product->votes->count()))*89}}"
                                                  class="progress_s"></progress>
                                        <span class="number_ev">{{$product->vote_4->count()}} đánh giá</span>
                                    </div>
                                    <div class="rating-level">
                                        <div class="star-count">
                                            <strong><span>3</span></strong>
                                            <div class="start_co w-100"><span><i class="fas fa-star"></i></span></div>
                                        </div>
                                        <progress max="89"
                                                  value="{{($product->vote_3->count()/(($product->votes->count() == 0) ? 5 : $product->votes->count()))*89}}"
                                                  class="progress_s"></progress>
                                        <span class="number_ev">{{$product->vote_3->count()}} đánh giá</span>
                                    </div>
                                    <div class="rating-level">
                                        <div class="star-count">
                                            <strong><span>2</span></strong>
                                            <div class="start_co w-100"><span><i class="fas fa-star"></i></span></div>
                                        </div>
                                        <progress max="89"
                                                  value="{{($product->vote_2->count()/(($product->votes->count() == 0) ? 5 : $product->votes->count()))*89}}"
                                                  class="progress_s"></progress>
                                        <span class="number_ev">{{$product->vote_2->count()}} đánh giá</span>
                                    </div>
                                    <div class="rating-level">
                                        <div class="star-count">
                                            <strong><span>1</span></strong>
                                            <div class="start_co w-100"><span><i class="fas fa-star"></i></span></div>
                                        </div>
                                        <progress max="89"
                                                  value="{{($product->vote_1->count()/(($product->votes->count() == 0) ? 5 : $product->votes->count()))*89}}"
                                                  class="progress_s"></progress>
                                        <span class="number_ev">{{$product->vote_1->count()}} đánh giá</span>
                                    </div>
                                </div>
                            </div>

                            {{--                            button danh gia--}}
                            <p class="text-ev">Bạn đánh giá sao sản phẩm này</p>
                            <div class="flex-b-ev">
                                <button class="btn_review">Đánh giá ngay</button>
                            </div>
                            <div class="modal modal-review d-none">
                                <div class="modal-background"></div>
                                <div class="modal-content">
                                    <div class="close-review"><i class="fas fa-times" id="close-review"></i></div>
                                    <div class="modal-review-title">
                                        <p class="m-0"> Đánh giá &amp; nhận xét {{$product->name}}</p>
                                    </div>
                                    <div class="modal-review-content p-4">
                                        <div>
                                            <input type="text" id="author_customer_review" placeholder="Họ và tên"
                                                   class="input input__file my-2">
                                            <label class="rp_review rv_name d-none"><i>Bạn vui lòng nhập họ
                                                    tên.</i></label>
                                        </div>
                                        <div>
                                            <input type="text" id="contact_customer_review" placeholder="Email/Sđt"
                                                   class="input input__file my-2">
                                            <label class="rp_review rv_contact d-none"><i>Bạn vui lòng nhập thông tin
                                                    liên hệ</i></label>
                                        </div>
                                        <textarea id="comment_customer_review"
                                                  placeholder="Xin mời chia sẻ một số cảm nhận về sản phẩm"
                                                  class="textarea-review"></textarea>
                                        <label class="rp_review rv_comment d-none"><i>Bạn vui lòng nhập nhận
                                                xét</i></label>
                                        <div class="modal-review-star my-3 p-2">
                                            <p class="my-2 title-review">Bạn thấy sản phẩm này như thế nào?</p>
                                            <div class="comment-form-rating">
                                                <label for="rating"></label>
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
                                            <span id="lb_star" class="d-flex justify-content-center">Tuyệt vời</span>
                                        </div>
                                        <button type="button" id="submit_review" class="submit-review"
                                                data-target="{{$product->id}}">GỬI ĐÁNH GIÁ
                                        </button>
                                    </div>
                                </div>
                            </div>
                            {{--                            danh sach danh gia--}}
                            <div class="boxReview-comment">
                                <div class="list_cm max_list_cm">
                                    @foreach ($comments as $comment)
                                        <div class="boxReview-comment-item">
                                            <div
                                                class="boxReview-comment-item-title">
                                                <div class="flex_name">
                                                    <p class="first_k">{{substr($comment->name_user, 0, 1)}}</p> <span
                                                        class="name_c">{{$comment->name_user}}</span></div>
                                                <p class="time_comment">{{\App\Helpers\CommonHelper::convertDateToDMY($comment->created_at)}}</p>
                                            </div>
                                            <div class="boxReview-comment-item-review">
                                                <div class="item-review-rating"><strong>Đánh giá: </strong>
                                                    <div class="d-flex mx-2">
                                                        <div class="rating2">
                                                            <div class="rating-upper"
                                                                 style="width: {{$comment->level * 20}}%">
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
                                                    </div>
                                                </div>
                                                <div class="item-review-comment">
                                                    <div class="comment-content">
                                                        <p><strong>Nhận xét : </strong> {{$comment->comment}}</p>
                                                    </div>
                                                    <div class="comment-image is-flex"></div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button class="btn-show-more-review" data-target="{{$comments->currentPage()}}"
                                        data-id="{{$product->id}}">
                                    Xem thêm
                                    <div class="inline-block-icon">
                                        <i class="far fa-angle-down"></i>
                                    </div>
                                </button>
                            </div>
                        </div>
                        {{--                            comment hoi dap--}}
                        <div class="comment-container mx-0">
                            <div class="comment-form">
                                <p class="comment-form-title">Bình Luận</p>
                                <div class="comment-form-content">
                                    <div class="textarea-comment">
                                        <textarea
                                            placeholder="Xin mời để lại câu hỏi, IT24H sẽ trả lời lại trong 1h, các câu hỏi sau 22h - 8h sẽ được trả lời vào sáng hôm sau"
                                            class="textarea"></textarea>
                                        <button class="button">
                                            <div class="icon-paper-plane">
                                                <svg height="15" xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 512 512">
                                                    <path
                                                        d="M511.6 36.86l-64 415.1c-1.5 9.734-7.375 18.22-15.97 23.05c-4.844 2.719-10.27 4.097-15.68 4.097c-4.188 0-8.319-.8154-12.29-2.472l-122.6-51.1l-50.86 76.29C226.3 508.5 219.8 512 212.8 512C201.3 512 192 502.7 192 491.2v-96.18c0-7.115 2.372-14.03 6.742-19.64L416 96l-293.7 264.3L19.69 317.5C8.438 312.8 .8125 302.2 .0625 289.1s5.469-23.72 16.06-29.77l448-255.1c10.69-6.109 23.88-5.547 34 1.406S513.5 24.72 511.6 36.86z"></path>
                                                </svg>
                                            </div>
                                            Gửi
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="block-comment__box-list-comment">
                                <div class="list-comment">
                                    <div class="item-comment">
                                        <div class="item-comment__box-cmt">
                                            <div class="box-cmt__box-info">
                                                <div class="box-info">
                                                    <div class="box-info__avatar">
                                                        <span>N</span>
                                                    </div>
                                                    <p class="box-info__name">
                                                        Nguyễn Thị Thúy Quyên
                                                    </p> <!----></div>
                                                <div class="box-time-cmt">
                                                    <div>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                             viewBox="0 0 12 12">
                                                            <path id="clock"
                                                                  d="M7.72,8.78,5.25,6.31V3h1.5v2.69L8.78,7.72ZM6,0a6,6,0,1,0,6,6A6,6,0,0,0,6,0ZM6,10.5A4.5,4.5,0,1,1,10.5,6,4.5,4.5,0,0,1,6,10.5Z"
                                                                  fill="#707070">
                                                            </path>
                                                        </svg>
                                                    </div>&nbsp;1 tuần trước
                                                </div>
                                            </div>
                                            <div class="box-cmt__box-question">
                                                <div class="content">
                                                    <div>Con này khi nào có thì liên hệ em qua ZAlo *****239 nha ạ, em
                                                        cám ơn nhiều
                                                    </div>
                                                </div>
                                                <button class="btn-rep-cmt">
                                                    <div>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="12"
                                                             viewBox="0 0 12 10.8">
                                                            <path
                                                                d="M3.48,8.32V4.6H1.2A1.2,1.2,0,0,0,0,5.8V9.4a1.2,1.2,0,0,0,1.2,1.2h.6v1.8l1.8-1.8h3A1.2,1.2,0,0,0,7.8,9.4V8.308a.574.574,0,0,1-.12.013H3.48ZM10.8,1.6H5.4A1.2,1.2,0,0,0,4.2,2.8V7.6H8.4l1.8,1.8V7.6h.6A1.2,1.2,0,0,0,12,6.4V2.8a1.2,1.2,0,0,0-1.2-1.2Z"
                                                                transform="translate(0 -1.6)" fill="#2490ff">
                                                            </path>
                                                        </svg>
                                                    </div>&nbsp;Trả lời
                                                </button>
                                            </div>
                                            <div class="item-comment__box-rep-comment">
                                                <div class="list-rep-comment">
                                                    <div class="item-rep-comment">
                                                        <div class="box-cmt__box-info">
                                                            <div class="box-info">
                                                                <div class="box-info__avatar">
                                                <span class="icon-cps">
                                                    <div>
                                                        <svg viewBox="0 0 40 40" fill="#fff"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                        </svg>
                                                    </div>
                                                </span>
                                                                </div>
                                                                <p class="box-info__name">
                                                                    Quản trị viên
                                                                </p> <span class="box-info__tag">QTV</span>
                                                            </div>
                                                            <div class="box-time-cmt">
                                                                <div>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12"
                                                                         height="12"
                                                                         viewBox="0 0 12 12">
                                                                        <path id="clock"
                                                                              d="M7.72,8.78,5.25,6.31V3h1.5v2.69L8.78,7.72ZM6,0a6,6,0,1,0,6,6A6,6,0,0,0,6,0ZM6,10.5A4.5,4.5,0,1,1,10.5,6,4.5,4.5,0,0,1,6,10.5Z"
                                                                              fill="#707070"></path>
                                                                    </svg>
                                                                </div>&nbsp;1 tuần trước
                                                            </div>
                                                        </div>
                                                        <div class="box-cmt__box-question">
                                                            <div class="content">
                                                                <div>CellphoneS xin chào Chị Quyên</div>
                                                            </div>
                                                            <div class="content">
                                                                <div>dạ em rất tiếc, CellphoneS chưa hỗ trợ thông báo
                                                                    khi hàng về qua zalo,
                                                                    Chị đăng ký thông tin chờ hàng ở phía trên hoặc mình
                                                                    thường xuyên theo
                                                                    dõi sản phẩm giúp em ạ
                                                                </div>
                                                            </div>
                                                            <div class="content">
                                                                <div>Thân mến!</div>
                                                            </div>
                                                            <div class="content">
                                                                <div></div>
                                                            </div>
                                                            <button class="btn-rep-cmt respondent">
                                                                <div>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="13"
                                                                         height="12"
                                                                         viewBox="0 0 12 10.8">
                                                                        <path id="chat"
                                                                              d="M3.48,8.32V4.6H1.2A1.2,1.2,0,0,0,0,5.8V9.4a1.2,1.2,0,0,0,1.2,1.2h.6v1.8l1.8-1.8h3A1.2,1.2,0,0,0,7.8,9.4V8.308a.574.574,0,0,1-.12.013H3.48ZM10.8,1.6H5.4A1.2,1.2,0,0,0,4.2,2.8V7.6H8.4l1.8,1.8V7.6h.6A1.2,1.2,0,0,0,12,6.4V2.8a1.2,1.2,0,0,0-1.2-1.2Z"
                                                                              transform="translate(0 -1.6)"
                                                                              fill="#2490ff">

                                                                        </path>
                                                                    </svg>
                                                                </div>&nbsp;Trả lời
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!----></div>
                                    </div>
                                </div>
                                <button class="btn-show-more">
                                    Xem thêm 66 bình luận
                                    <div class="inline-block-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="10"
                                             height="10">
                                            <path
                                                d="M224 416c-8.188 0-16.38-3.125-22.62-9.375l-192-192c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L224 338.8l169.4-169.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-192 192C240.4 412.9 232.2 416 224 416z"></path>
                                        </svg>
                                    </div>
                                </button>
                            </div>
                        </div>
                        <div class="category-container p-0">
                            <div class="cat_box_sale box_watched">
                                <div class="cat_box_s_h">
                                    <div class="title_s">
                                        <div class="p_similar_tt" id="load_p_watched"
                                             data-target="{{$product->id}}">
                                            <h2>Sản phẩm đã xem</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="featured-product-list" id="load_p_detail2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="product-bottom-panel">
        <div class="product-bottom-panel__chat-now">
            <svg enable-background="new 0 0 15 15" viewBox="0 0 15 15" role="img"
                 class="stardust-icon stardust-icon-web-chat product-bottom-panel__chat-now-icon">
                <g stroke="none">
                    <path
                        d="m11.2 4.1c-1.1-1.3-3-2.2-5-2.2-3.4 0-6.2 2.3-6.2 5.2 0 1.7.9 3.2 2.4 4.2l-.7 1.4s-.2.4.1.6c.3.3 1.1-.1 1.1-.1l2.4-.9c.3.1.6.1.9.1.7 0 1.5-.1 2.1-.3.5.2 1 .2 1.6.2h.6l2.1 1.5c.6.4.8.1.8-.4v-2.2c.9-.8 1.5-1.8 1.5-3 0-2-1.6-3.6-3.7-4.1zm-5.6 7.3h-.5-.2l-1.8.7.5-1.1-.7-.5c-1.3-.8-2-2-2-3.4 0-2.3 2.3-4.2 5.2-4.2 2.8 0 5.2 1.9 5.2 4.2s-2.4 4.3-5.2 4.3c-.2 0-.4 0-.5 0zm6.8-.8v1.2c0 .6-.1.4-.4.2l-1-.8c-.4.1-.8.1-1.2.1 1.5-1 2.5-2.5 2.5-4.2 0-.6-.1-1.1-.3-1.7 1.2.6 1.9 1.6 1.9 2.7 0 1-.5 1.9-1.5 2.5z"></path>
                    <circle cx="3.1" cy="7.1" r=".8"></circle>
                    <circle cx="9.1" cy="7.1" r=".8"></circle>
                    <circle cx="6.1" cy="7.1" r=".8"></circle>
                </g>
            </svg>
            <div class="product-bottom-panel__chat-now-text"><a href="http://zalo.me/365142974135838194">Chat ngay</a></div>
        </div>
        <div class="product-cart-and-buy-buttons">
            <div class="product-bottom-panel__add-to-cart">
                <svg enable-background="new 0 0 15 15" viewBox="0 0 15 15" role="img"
                     class="stardust-icon stardust-icon-add-to-cart product-bottom-panel__add-to-cart-icon">
                    <path d="m .5.5h2.2l2.5 10.5h7.2l2.1-7.5h-10.8" fill="none" stroke-linecap="round"
                          stroke-linejoin="round" stroke-miterlimit="10"></path>
                    <circle cx="6" cy="13.5" r="1"></circle>
                    <circle cx="11.5" cy="13.5" r="1"></circle>
                    <path d="m7.5 7h3" fill="none" stroke-linecap="round" stroke-miterlimit="10"></path>
                    <path d="m9 8.5v-3" fill="none" stroke-linecap="round" stroke-miterlimit="10"></path>
                </svg>
                <div class="product-bottom-panel__add-to-cart-text">
                    <span class=""><a href="javascript:;" get-id="{{$product->id}}" class="add-cart">Thêm vào Giỏ hàng</a></span></div>
            </div>
            <div class="product-bottom-panel__buy-now">
                <span class=""><a href="javascript:;" class="add-cart-now" data-id="{{$product->id}}">Mua ngay</a></span></div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            var view = parseInt('{{$product->view}}') + 1;
            var id = '{{$product->id}}';
            var _token = $('meta[name="csrf-token"]').attr('content');
            var data = {
                view: view,
                id: id,
                _token: _token
            };
            $.ajax({
                url: product_views,
                type: "post",
                data: data,
                success: function (data) {
                }
            });
        })
    </script>
@endsection
