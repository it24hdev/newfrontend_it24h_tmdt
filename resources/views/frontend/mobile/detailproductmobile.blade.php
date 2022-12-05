@extends('frontend.mobile.basemobile')

@section('title')
    <title>IT24H - Chi tiết sản phẩm</title>
@endsection

@section('header_mobile')
    @include('frontend.mobile.headermobile')
@endsection
@section('content')
    <div class="component-dt-container">
        <div data-fetch-key="product-detail:0">
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
                                <p>
                                    {{$product->name}}
                                </p>
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
                                        @if (!empty($imgs))
                                            @foreach ($imgs as $img)
                                                <div class="slide-wrapper">
                                                    <div class="img-wrp">
                                                        <img src="{{asset('upload/images/products/thumb/'.$img)}}"
                                                             width="58" height="58">
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
                                    {{--                                    <div class="box-rating">--}}
                                    {{--                                        <div icon="star" class="icon is-active">--}}
                                    {{--                                            <svg style="fill: #f59e0b;" height="15" xmlns="http://www.w3.org/2000/svg"--}}
                                    {{--                                                 viewBox="0 0 576 512">--}}
                                    {{--                                                <path--}}
                                    {{--                                                    d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>--}}
                                    {{--                                            </svg>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div icon="star" class="icon is-active">--}}
                                    {{--                                            <svg style="fill: #f59e0b;" height="15" xmlns="http://www.w3.org/2000/svg"--}}
                                    {{--                                                 viewBox="0 0 576 512">--}}
                                    {{--                                                <path--}}
                                    {{--                                                    d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>--}}
                                    {{--                                            </svg>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div icon="star" class="icon is-active">--}}
                                    {{--                                            <svg style="fill: #f59e0b;" height="15" xmlns="http://www.w3.org/2000/svg"--}}
                                    {{--                                                 viewBox="0 0 576 512">--}}
                                    {{--                                                <path--}}
                                    {{--                                                    d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>--}}
                                    {{--                                            </svg>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div icon="star" class="icon is-active">--}}
                                    {{--                                            <svg style="fill: #f59e0b;" height="15" xmlns="http://www.w3.org/2000/svg"--}}
                                    {{--                                                 viewBox="0 0 576 512">--}}
                                    {{--                                                <path--}}
                                    {{--                                                    d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>--}}
                                    {{--                                            </svg>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div icon="star" class="icon is-active">--}}
                                    {{--                                            <svg style="fill: #f59e0b;" height="15" xmlns="http://www.w3.org/2000/svg"--}}
                                    {{--                                                 viewBox="0 0 576 512">--}}
                                    {{--                                                <path--}}
                                    {{--                                                    d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>--}}
                                    {{--                                            </svg>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        &nbsp;1 đánh giá--}}
                                    {{--                                    </div>--}}
                                    <div class="review d-flex">
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
                                    </div>
                                </div>
                                <div class="block-box-price">
                                    <div class="box-info-price">
                                        @if ($product->price_onsale != 0 && $product->price_onsale !=null)
                                            <p class="price_show">
                                                {{number_format($product->price_onsale,0,',','.')}} đ
                                            </p>
                                            <p class="price_through">
                                                {{number_format($product->price,0,',','.')}} đ
                                            </p>
                                        @else
                                            <p class="price_show">
                                                {{number_format($product->price,0,',','.')}} đ
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                @if(!empty($product->gift))
                                    <div class="box-promotion">
                                        <div class="box-product-promotion">
                                            <div
                                                class="box-product-promotion-header">
                                                <div class="icon">
                                                    <svg height="15" xmlns="http://www.w3.org/2000/svg"
                                                         viewBox="0 0 512 512">
                                                        <path
                                                            d="M152 0H154.2C186.1 0 215.7 16.91 231.9 44.45L256 85.46L280.1 44.45C296.3 16.91 325.9 0 357.8 0H360C408.6 0 448 39.4 448 88C448 102.4 444.5 115.1 438.4 128H480C497.7 128 512 142.3 512 160V224C512 241.7 497.7 256 480 256H32C14.33 256 0 241.7 0 224V160C0 142.3 14.33 128 32 128H73.6C67.46 115.1 64 102.4 64 88C64 39.4 103.4 0 152 0zM190.5 68.78C182.9 55.91 169.1 48 154.2 48H152C129.9 48 112 65.91 112 88C112 110.1 129.9 128 152 128H225.3L190.5 68.78zM360 48H357.8C342.9 48 329.1 55.91 321.5 68.78L286.7 128H360C382.1 128 400 110.1 400 88C400 65.91 382.1 48 360 48V48zM32 288H224V512H80C53.49 512 32 490.5 32 464V288zM288 512V288H480V464C480 490.5 458.5 512 432 512H288z"></path>
                                                    </svg>
                                                </div>
                                                <p>Khuyến mãi</p>
                                            </div>
                                            <div class="box-product-promotion-content">
                                                {!! $product->gift !!}
                                            </div>
                                        </div>
                                    </div>
                                @endif
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
                        @if(!empty($product->short_content))
                            <div class="box-warranty-info">
                                <div class="box-title"><p>Thông tin sản phẩm</p></div>
                                {!! $product->short_content !!}
                            </div>
                        @endif
                        @if($property !=null)
                            <div class="technicalInfo">
                                <h2 class="title">Thông số kỹ thuật</h2>
                                <ul class="technical-content">
                                    @php
                                        $count_ = 0
                                    @endphp
                                    @foreach($property as $key => $val)
                                        <li class="technical-content-item item_list_attr"
                                            @if($count_%2) style="background-color: #fff" @endif>

                                            <p>{{ $key }}</p>
                                            <div class="lineproperty">{{ $val }}</div>
                                        </li>
                                        @php
                                            $count_ =  $count_ + 1
                                        @endphp
                                    @endforeach

                                </ul>
                                <button class="btn_view_detail_p">Xem
                                    cấu hình chi
                                    tiết
                                    <div class="d-flex">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="10"
                                             height="10">
                                            <path
                                                d="M224 416c-8.188 0-16.38-3.125-22.62-9.375l-192-192c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L224 338.8l169.4-169.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-192 192C240.4 412.9 232.2 416 224 416z"></path>
                                        </svg>
                                    </div>
                                </button>
                                <div class="modal" data-v-4e304e03="">
                                    <div class="modal-background" data-v-4e304e03=""></div>
                                    <div class="modal-card" data-v-4e304e03="">
                                        <header
                                            class="modal-card-head technical-title-modal is-flex is-justify-content-space-between is-align-items-center px-4"
                                            data-v-4e304e03=""><p
                                                class="modal-card-title title is-5 p-0 m-0 has-text-white"
                                                data-v-4e304e03="">Thông số kỹ thuật</p>
                                            <button aria-label="close" class="delete" data-v-4e304e03=""></button>
                                        </header>
                                        <section class="modal-card-body" data-v-4e304e03="">
                                            <div class="modal-content" data-v-4e304e03="">
                                                <ul class="technical-content-modal" data-v-4e304e03="">
                                                    <li class="technical-content-modal-item m-3" data-v-4e304e03="">
                                                        <p class="title is-6 m-2" data-v-4e304e03="">Màn hình</p>
                                                        <div class="modal-item-description mx-2" data-v-4e304e03="">
                                                            <div
                                                                class="px-3 py-2 is-flex is-align-items-center is-justify-content-space-between"
                                                                data-v-4e304e03=""><p data-v-4e304e03="">Kích thước
                                                                    màn hình</p>
                                                                <div data-v-4e304e03="">6.5 inches</div>
                                                            </div>
                                                            <div
                                                                class="px-3 py-2 is-flex is-align-items-center is-justify-content-space-between"
                                                                data-v-4e304e03=""><p data-v-4e304e03="">Công nghệ
                                                                    màn hình</p>
                                                                <div data-v-4e304e03="">Super AMOLED</div>
                                                            </div>
                                                            <div
                                                                class="px-3 py-2 is-flex is-align-items-center is-justify-content-space-between"
                                                                data-v-4e304e03=""><p data-v-4e304e03="">Độ phân
                                                                    giải màn hình</p>
                                                                <div data-v-4e304e03="">1080 x 2400 pixels
                                                                    (FullHD+)
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="px-3 py-2 is-flex is-align-items-center is-justify-content-space-between"
                                                                data-v-4e304e03=""><p data-v-4e304e03="">Tính năng
                                                                    màn hình</p>
                                                                <div data-v-4e304e03="">120Hz, HDR10+, 800 nits,
                                                                    Always-on display
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="px-3 py-2 is-flex is-align-items-center is-justify-content-space-between"
                                                                data-v-4e304e03=""><p data-v-4e304e03="">Tần số
                                                                    quét </p>
                                                                <div data-v-4e304e03="">120Hz</div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="technical-content-modal-item m-3" data-v-4e304e03="">
                                                        <p class="title is-6 m-2" data-v-4e304e03="">Camera sau</p>
                                                        <div class="modal-item-description mx-2" data-v-4e304e03="">
                                                            <div
                                                                class="px-3 py-2 is-flex is-align-items-center is-justify-content-space-between"
                                                                data-v-4e304e03=""><p data-v-4e304e03="">Camera
                                                                    sau</p>
                                                                <div data-v-4e304e03="">Camera chính góc rộng: 64
                                                                    MP, f/1.8, PDAF, OIS <br> Camera góc siêu rộng:
                                                                    12 MP, f/2.2, 123˚ <br>Camera macro: 5 MP, f/2.4
                                                                    <br> Cảm biến độ sâu: 5 MP, f/2.4
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="px-3 py-2 is-flex is-align-items-center is-justify-content-space-between"
                                                                data-v-4e304e03=""><p data-v-4e304e03="">Quay
                                                                    video</p>
                                                                <div data-v-4e304e03="">4K@30fps, 1080p@30/60fps;
                                                                    gyro-EIS
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="px-3 py-2 is-flex is-align-items-center is-justify-content-space-between"
                                                                data-v-4e304e03=""><p data-v-4e304e03="">Tính năng
                                                                    camera</p>
                                                                <div data-v-4e304e03="">Chống rung quang học
                                                                    (OIS)<br>Góc rộng (Wide) <br> Góc siêu rộng
                                                                    (Ultrawide) <br> HDR <br> Siêu cận (Macro)<br>
                                                                    Toàn cảnh (Panorama)
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="technical-content-modal-item m-3" data-v-4e304e03="">
                                                        <p class="title is-6 m-2" data-v-4e304e03="">Camera
                                                            trước</p>
                                                        <div class="modal-item-description mx-2" data-v-4e304e03="">
                                                            <div
                                                                class="px-3 py-2 is-flex is-align-items-center is-justify-content-space-between"
                                                                data-v-4e304e03=""><p data-v-4e304e03="">Camera
                                                                    trước</p>
                                                                <div data-v-4e304e03="">32 MP, f/2.2</div>
                                                            </div>
                                                            <div
                                                                class="px-3 py-2 is-flex is-align-items-center is-justify-content-space-between"
                                                                data-v-4e304e03=""><p data-v-4e304e03="">Quay video
                                                                    trước</p>
                                                                <div data-v-4e304e03="">4K@30fps, 1080p@30fps</div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="technical-content-modal-item m-3" data-v-4e304e03="">
                                                        <p class="title is-6 m-2" data-v-4e304e03="">Vi xử lý &amp;
                                                            đồ họa</p>
                                                        <div class="modal-item-description mx-2" data-v-4e304e03="">
                                                            <div
                                                                class="px-3 py-2 is-flex is-align-items-center is-justify-content-space-between"
                                                                data-v-4e304e03=""><p data-v-4e304e03="">Chipset</p>
                                                                <div data-v-4e304e03="">Exynos 1280 8 nhân</div>
                                                            </div>
                                                            <div
                                                                class="px-3 py-2 is-flex is-align-items-center is-justify-content-space-between"
                                                                data-v-4e304e03=""><p data-v-4e304e03="">Loại
                                                                    CPU</p>
                                                                <div data-v-4e304e03="">Octa-core (2x2.4 GHz &amp;
                                                                    6x2.0 GHz)
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="px-3 py-2 is-flex is-align-items-center is-justify-content-space-between"
                                                                data-v-4e304e03=""><p data-v-4e304e03="">GPU</p>
                                                                <div data-v-4e304e03="">Mali-G68</div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="technical-content-modal-item m-3" data-v-4e304e03="">
                                                        <p class="title is-6 m-2" data-v-4e304e03="">RAM &amp; lưu
                                                            trữ</p>
                                                        <div class="modal-item-description mx-2" data-v-4e304e03="">
                                                            <div
                                                                class="px-3 py-2 is-flex is-align-items-center is-justify-content-space-between"
                                                                data-v-4e304e03=""><p data-v-4e304e03="">Dung lượng
                                                                    RAM</p>
                                                                <div data-v-4e304e03="">8 GB</div>
                                                            </div>
                                                            <div
                                                                class="px-3 py-2 is-flex is-align-items-center is-justify-content-space-between"
                                                                data-v-4e304e03=""><p data-v-4e304e03="">Bộ nhớ
                                                                    trong</p>
                                                                <div data-v-4e304e03="">128 GB</div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="technical-content-modal-item m-3" data-v-4e304e03="">
                                                        <p class="title is-6 m-2" data-v-4e304e03="">Pin &amp; công
                                                            nghệ sạc</p>
                                                        <div class="modal-item-description mx-2" data-v-4e304e03="">
                                                            <div
                                                                class="px-3 py-2 is-flex is-align-items-center is-justify-content-space-between"
                                                                data-v-4e304e03=""><p data-v-4e304e03="">Pin</p>
                                                                <div data-v-4e304e03="">Li-Po 5000 mAh</div>
                                                            </div>
                                                            <div
                                                                class="px-3 py-2 is-flex is-align-items-center is-justify-content-space-between"
                                                                data-v-4e304e03=""><p data-v-4e304e03="">Công nghệ
                                                                    sạc</p>
                                                                <div data-v-4e304e03="">Sạc nhanh 25W</div>
                                                            </div>
                                                            <div
                                                                class="px-3 py-2 is-flex is-align-items-center is-justify-content-space-between"
                                                                data-v-4e304e03=""><p data-v-4e304e03="">Cổng
                                                                    sạc</p>
                                                                <div data-v-4e304e03="">USB Type-C</div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="technical-content-modal-item m-3" data-v-4e304e03="">
                                                        <p class="title is-6 m-2" data-v-4e304e03="">Giao tiếp &amp;
                                                            kết nối</p>
                                                        <div class="modal-item-description mx-2" data-v-4e304e03="">
                                                            <div
                                                                class="px-3 py-2 is-flex is-align-items-center is-justify-content-space-between"
                                                                data-v-4e304e03=""><p data-v-4e304e03="">Thẻ SIM</p>
                                                                <div data-v-4e304e03="">2 SIM (Nano-SIM)</div>
                                                            </div>
                                                            <div
                                                                class="px-3 py-2 is-flex is-align-items-center is-justify-content-space-between"
                                                                data-v-4e304e03=""><p data-v-4e304e03="">Hệ điều
                                                                    hành</p>
                                                                <div data-v-4e304e03="">Android 12, One UI 4</div>
                                                            </div>
                                                            <div
                                                                class="px-3 py-2 is-flex is-align-items-center is-justify-content-space-between"
                                                                data-v-4e304e03=""><p data-v-4e304e03="">Hỗ trợ
                                                                    mạng</p>
                                                                <div data-v-4e304e03="">5G</div>
                                                            </div>
                                                            <div
                                                                class="px-3 py-2 is-flex is-align-items-center is-justify-content-space-between"
                                                                data-v-4e304e03=""><p data-v-4e304e03="">Wi-Fi</p>
                                                                <div data-v-4e304e03="">Wi-Fi 802.11 a/b/g/n/ac,
                                                                    dual-band, Wi-Fi Direct, hotspot
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="px-3 py-2 is-flex is-align-items-center is-justify-content-space-between"
                                                                data-v-4e304e03=""><p data-v-4e304e03="">
                                                                    Bluetooth</p>
                                                                <div data-v-4e304e03="">5.2, A2DP, LE</div>
                                                            </div>
                                                            <div
                                                                class="px-3 py-2 is-flex is-align-items-center is-justify-content-space-between"
                                                                data-v-4e304e03=""><p data-v-4e304e03="">GPS</p>
                                                                <div data-v-4e304e03="">A-GPS, GLONASS, GALILEO,
                                                                    BDS
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="technical-content-modal-item m-3" data-v-4e304e03="">
                                                        <p class="title is-6 m-2" data-v-4e304e03="">Thiết kế &amp;
                                                            Trọng lượng</p>
                                                        <div class="modal-item-description mx-2" data-v-4e304e03="">
                                                            <div
                                                                class="px-3 py-2 is-flex is-align-items-center is-justify-content-space-between"
                                                                data-v-4e304e03=""><p data-v-4e304e03="">Trọng
                                                                    lượng</p>
                                                                <div data-v-4e304e03="">190 g</div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="technical-content-modal-item m-3" data-v-4e304e03="">
                                                        <p class="title is-6 m-2" data-v-4e304e03="">Thông số
                                                            khác</p>
                                                        <div class="modal-item-description mx-2" data-v-4e304e03="">
                                                            <div
                                                                class="px-3 py-2 is-flex is-align-items-center is-justify-content-space-between"
                                                                data-v-4e304e03=""><p data-v-4e304e03="">Chỉ số
                                                                    kháng nước, bụi</p>
                                                                <div data-v-4e304e03="">IP67</div>
                                                            </div>
                                                            <div
                                                                class="px-3 py-2 is-flex is-align-items-center is-justify-content-space-between"
                                                                data-v-4e304e03=""><p data-v-4e304e03="">Kiểu màn
                                                                    hình</p>
                                                                <div data-v-4e304e03="">Đục lỗ (Nốt ruồi)</div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="technical-content-modal-item m-3" data-v-4e304e03="">
                                                        <p class="title is-6 m-2" data-v-4e304e03="">Tiện ích
                                                            khác</p>
                                                        <div class="modal-item-description mx-2" data-v-4e304e03="">
                                                            <div
                                                                class="px-3 py-2 is-flex is-align-items-center is-justify-content-space-between"
                                                                data-v-4e304e03=""><p data-v-4e304e03="">Cảm biến
                                                                    vân tay</p>
                                                                <div data-v-4e304e03="">Cảm biến vân tay trong màn
                                                                    hình
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="px-3 py-2 is-flex is-align-items-center is-justify-content-space-between"
                                                                data-v-4e304e03=""><p data-v-4e304e03="">Các loại
                                                                    cảm biến</p>
                                                                <div data-v-4e304e03="">Cảm biến gia tốc, La bàn,
                                                                    Con quay hồi chuyển
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="px-3 py-2 is-flex is-align-items-center is-justify-content-space-between"
                                                                data-v-4e304e03=""><p data-v-4e304e03="">Tính năng
                                                                    đặc biệt</p>
                                                                <div data-v-4e304e03="">Hỗ trợ 5G, Bảo mật vân tay,
                                                                    Nhận diện khuôn mặt, Kháng nước, kháng bụi
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </section>
                                        <footer class="modal-card-foot" data-v-4e304e03="">
                                            <button class="button close-button-modal is-flex is-align-items-center"
                                                    data-v-4e304e03="">
                                                ×
                                                Đóng
                                            </button>
                                        </footer>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(!empty($product->content))
                            <div class="dt_description">
                                <div class="ctn_des" id="des_show"> {!! $product->content !!} </div>
                                <button class="btn_view_content_all">Xem thêm

                                    <div class="d-flex">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="10"
                                             height="10">
                                            <path
                                                d="M224 416c-8.188 0-16.38-3.125-22.62-9.375l-192-192c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L224 338.8l169.4-169.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-192 192C240.4 412.9 232.2 416 224 416z"></path>
                                        </svg>
                                    </div>
                                </button>
                            </div>
                        @endif
                        <div class="category-container p-0">
                            <div class="cat_box_sale">
                                <div class="cat_box_s_h">
                                    <div class="title_s">
                                        <div class="b_title tt_center bg_tt" id="load_p_similar"
                                             data-target="{{$product->slug}}">
                                            <h2>Sản phẩm tương tự</h2>
                                        </div>
                                        <div class="b_title tt_center bg_tt" id="load_p_watched"
                                             data-target="{{$product->id}}">
                                            <h2>Sản phẩm đã xem</h2>
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
                                            <div class="rating-upper" style="width: {{$product->trungbinhsao()/5*100}}%">
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

                                    <p class="size_p"><strong>{{$product->votes->count()}}</strong> đánh giá và nhận xét</p></div>
                                <div class="boxReview-star">
                                    <div  class="rating-level">
                                        <div class="star-count">
                                            <span>5</span>
                                            <div class="ac_start">
                                                <svg height="15" xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 576 512">
                                                    <path
                                                        d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <progress max="89" value="{{($product->vote_5->count()/(($product->votes->count() == 0) ? 5 : $product->votes->count()))*89}}" class="progress_s"></progress>
                                        <span class="number_ev">{{$product->vote_5->count()}} đánh giá</span>
                                    </div>
                                    <div  class="rating-level">
                                        <div class="star-count">
                                            <span>4</span>
                                            <div class="ac_start">
                                                <svg height="15" xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 576 512">
                                                    <path
                                                        d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <progress max="89" value="{{($product->vote_4->count()/(($product->votes->count() == 0) ? 5 : $product->votes->count()))*89}}" class="progress_s"></progress>
                                        <span class="number_ev">{{$product->vote_4->count()}} đánh giá</span>
                                    </div>
                                    <div  class="rating-level">
                                        <div class="star-count">
                                            <span>3</span>
                                            <div class="ac_start">
                                                <svg height="15" xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 576 512">
                                                    <path
                                                        d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <progress max="89" value="{{($product->vote_3->count()/(($product->votes->count() == 0) ? 5 : $product->votes->count()))*89}}" class="progress_s"></progress>
                                        <span class="number_ev">{{$product->vote_3->count()}} đánh giá</span>
                                    </div>
                                    <div  class="rating-level">
                                        <div class="star-count">
                                            <span>2</span>
                                            <div class="ac_start">
                                                <svg height="15" xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 576 512">
                                                    <path
                                                        d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <progress max="89" value="{{($product->vote_2->count()/(($product->votes->count() == 0) ? 5 : $product->votes->count()))*89}}" class="progress_s"></progress>
                                        <span class="number_ev">{{$product->vote_2->count()}} đánh giá</span>
                                    </div>
                                    <div  class="rating-level">
                                        <div class="star-count">
                                            <span>5</span>
                                            <div class="ac_start">
                                                <svg height="15" xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 576 512">
                                                    <path
                                                        d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <progress max="89" value="{{($product->vote_1->count()/(($product->votes->count() == 0) ? 5 : $product->votes->count()))*89}}" class="progress_s"></progress>
                                        <span class="number_ev">{{$product->vote_1->count()}} đánh giá</span>
                                    </div>
                                </div>
                            </div>

{{--                            button danh gia--}}
                            <p class="text-ev">Bạn đánh giá sao sản phẩm này</p>
                            <div class="flex-b-ev">
                                <button>Đánh giá ngay</button>
                            </div>
{{--                            model viet danh gia--}}
                            <div class="modal modal-review">
                                <div class="modal-background"></div>
                                <div class="modal-content">
                                    <div class="modal-review-title is-flex is-align-items-center px-4">
                                        <div>
                                            <svg width="138" height="138" viewBox="0 0 138 138" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <rect width="138" height="138" fill="url(#reviewIcon)"></rect>
                                                <defs>
                                                    <pattern id="reviewIcon" patternContentUnits="objectBoundingBox"
                                                             width="1" height="1">
                                                        <use xlink:href="#image0_34_138"
                                                             transform="scale(0.000925926)"></use>
                                                    </pattern>
                                                    <image id="image0_34_138" width="1080" height="1080"
                                                           xlink:href="data:image/png;base64,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"></image>
                                                </defs>
                                            </svg>
                                        </div>
                                        <p class="title-logged"> Đánh giá &amp; nhận xét iPhone 11 64GB I Chính hãng
                                            VN/A </p></div>
                                    <form enctype="multipart/form-data" class="modal-review-content p-4">
                                        <div></div>
                                        <div class="group-input is-flex">
                                            <input id="image-text" type="text"
                                                                                placeholder="Hình ảnh thực tế"
                                                                                class="input input__file my-2"> <input
                                                id="image" accept="image/x-png,image/gif,image/jpeg" multiple="multiple"
                                                type="file" class="is-hidden"> <label for="image"
                                                                                      class="btn-add my-2 is-flex is-align-items-center ml-auto">
                                                <div class="input-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                                        <path
                                                            d="M147.8 192H480V144C480 117.5 458.5 96 432 96h-160l-64-64h-160C21.49 32 0 53.49 0 80v328.4l90.54-181.1C101.4 205.6 123.4 192 147.8 192zM543.1 224H147.8C135.7 224 124.6 230.8 119.2 241.7L0 480h447.1c12.12 0 23.2-6.852 28.62-17.69l96-192C583.2 249 567.7 224 543.1 224z"></path>
                                                    </svg>
                                                </div>
                                                Thêm ảnh
                                            </label></div>
                                        <textarea placeholder="Xin mời chia sẻ một số cảm nhận về sản phẩm"
                                                  class="textarea"></textarea>
                                        <div class="modal-review-star my-3 p-2"><p class="my-2 title is-6">Bạn thấy sản
                                                phẩm này như thế nào?</p>
                                            <div class="is-flex is-justify-content-space-evenly">
                                                <div class="has-text-centered">
                                                    <div icon="star" class="icon" style="cursor: pointer;">
                                                        <svg height="15" xmlns="http://www.w3.org/2000/svg"
                                                             viewBox="0 0 576 512">
                                                            <path
                                                                d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>
                                                        </svg>
                                                    </div>
                                                    <p>Rất tệ</p></div>
                                                <div class="has-text-centered">
                                                    <div icon="star" class="icon" style="cursor: pointer;">
                                                        <svg height="15" xmlns="http://www.w3.org/2000/svg"
                                                             viewBox="0 0 576 512">
                                                            <path
                                                                d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>
                                                        </svg>
                                                    </div>
                                                    <p>Tệ</p></div>
                                                <div class="has-text-centered">
                                                    <div icon="star" class="icon" style="cursor: pointer;">
                                                        <svg height="15" xmlns="http://www.w3.org/2000/svg"
                                                             viewBox="0 0 576 512">
                                                            <path
                                                                d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>
                                                        </svg>
                                                    </div>
                                                    <p>Bình thường</p></div>
                                                <div class="has-text-centered">
                                                    <div icon="star" class="icon" style="cursor: pointer;">
                                                        <svg height="15" xmlns="http://www.w3.org/2000/svg"
                                                             viewBox="0 0 576 512">
                                                            <path
                                                                d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>
                                                        </svg>
                                                    </div>
                                                    <p>Tốt</p></div>
                                                <div class="has-text-centered">
                                                    <div icon="star" class="icon" style="cursor: pointer;">
                                                        <svg height="15" xmlns="http://www.w3.org/2000/svg"
                                                             viewBox="0 0 576 512">
                                                            <path
                                                                d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>
                                                        </svg>
                                                    </div>
                                                    <p>Rất tốt</p></div>
                                            </div>
                                        </div> <!---->
                                        <button type="submit" class="button has-text-white">GỬI ĐÁNH GIÁ</button>
                                        <!----></form>
                                </div>
                            </div>
{{--                            danh sach danh gia--}}
                            <div class="boxReview-comment">
                                <div class="list_cm">
                                    <div class="boxReview-comment-item">
                                        <div
                                            class="boxReview-comment-item-title">
                                            <div class="flex_name">
                                                <p class="first_k">H</p> <span class="name_c">Hoàng trọng tín</span></div>
                                            <p class="time_comment">3/12/2022 20:32</p></div>
                                        <div class="boxReview-comment-item-review">
                                            <div class="item-review-rating"><strong>Đánh
                                                    giá: </strong>
                                                <div class="d-flex mx-2">
                                                    <div class="rating2">
                                                        <div class="rating-upper" style="width: 100%">
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
                                                    <p><strong>Nhận xét : </strong> Cho mình hỏi xem lịch sử mua hàng tại cell phone s được không</p>
                                                </div>
                                                <div class="comment-image is-flex"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="boxReview-comment-item">
                                        <div
                                            class="boxReview-comment-item-title">
                                            <div class="flex_name">
                                                <p class="first_k">H</p> <span class="name_c">Hoàng trọng tín</span></div>
                                            <p class="time_comment">3/12/2022 20:32</p></div>
                                        <div class="boxReview-comment-item-review">
                                            <div class="item-review-rating"><strong>Đánh
                                                    giá: </strong>
                                                <div class="d-flex mx-2">
                                                    <div class="rating2">
                                                        <div class="rating-upper" style="width: 100%">
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
                                                    <p><strong>Nhận xét : </strong> Cho mình hỏi xem lịch sử mua hàng tại cell phone s được không</p>
                                                </div>
                                                <div class="comment-image is-flex"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="boxReview-comment-item">
                                        <div
                                            class="boxReview-comment-item-title">
                                            <div class="flex_name">
                                                <p class="first_k">H</p> <span class="name_c">Hoàng trọng tín</span></div>
                                            <p class="time_comment">3/12/2022 20:32</p></div>
                                        <div class="boxReview-comment-item-review">
                                            <div class="item-review-rating"><strong>Đánh
                                                    giá: </strong>
                                                <div class="d-flex mx-2">
                                                    <div class="rating2">
                                                        <div class="rating-upper" style="width: 100%">
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
                                                    <p><strong>Nhận xét : </strong> Cho mình hỏi xem lịch sử mua hàng tại cell phone s được không</p>
                                                </div>
                                                <div class="comment-image is-flex"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="boxReview-comment-item">
                                        <div
                                            class="boxReview-comment-item-title">
                                            <div class="flex_name">
                                                <p class="first_k">H</p> <span class="name_c">Hoàng trọng tín</span></div>
                                            <p class="time_comment">3/12/2022 20:32</p></div>
                                        <div class="boxReview-comment-item-review">
                                            <div class="item-review-rating"><strong>Đánh
                                                    giá: </strong>
                                                <div class="d-flex mx-2">
                                                    <div class="rating2">
                                                        <div class="rating-upper" style="width: 100%">
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
                                                    <p><strong>Nhận xét : </strong> Cho mình hỏi xem lịch sử mua hàng tại cell phone s được không</p>
                                                </div>
                                                <div class="comment-image is-flex"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="boxReview-comment-item">
                                        <div
                                            class="boxReview-comment-item-title">
                                            <div class="flex_name">
                                                <p class="first_k">H</p> <span class="name_c">Hoàng trọng tín</span></div>
                                            <p class="time_comment">3/12/2022 20:32</p></div>
                                        <div class="boxReview-comment-item-review">
                                            <div class="item-review-rating"><strong>Đánh
                                                    giá: </strong>
                                                <div class="d-flex mx-2">
                                                    <div class="rating2">
                                                        <div class="rating-upper" style="width: 100%">
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
                                                    <p><strong>Nhận xét : </strong> Cho mình hỏi xem lịch sử mua hàng tại cell phone s được không</p>
                                                </div>
                                                <div class="comment-image is-flex"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="boxReview-comment-item">
                                        <div
                                            class="boxReview-comment-item-title">
                                            <div class="flex_name">
                                                <p class="first_k">H</p> <span class="name_c">Hoàng trọng tín</span></div>
                                            <p class="time_comment">3/12/2022 20:32</p></div>
                                        <div class="boxReview-comment-item-review">
                                            <div class="item-review-rating"><strong>Đánh
                                                    giá: </strong>
                                                <div class="d-flex mx-2">
                                                    <div class="rating2">
                                                        <div class="rating-upper" style="width: 100%">
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
                                                    <p><strong>Nhận xét : </strong> Cho mình hỏi xem lịch sử mua hàng tại cell phone s được không</p>
                                                </div>
                                                <div class="comment-image is-flex"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="boxReview-comment-item">
                                        <div
                                            class="boxReview-comment-item-title">
                                            <div class="flex_name">
                                                <p class="first_k">H</p> <span class="name_c">Hoàng trọng tín</span></div>
                                            <p class="time_comment">3/12/2022 20:32</p></div>
                                        <div class="boxReview-comment-item-review">
                                            <div class="item-review-rating"><strong>Đánh
                                                    giá: </strong>
                                                <div class="d-flex mx-2">
                                                    <div class="rating2">
                                                        <div class="rating-upper" style="width: 100%">
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
                                                    <p><strong>Nhận xét : </strong> Cho mình hỏi xem lịch sử mua hàng tại cell phone s được không</p>
                                                </div>
                                                <div class="comment-image is-flex"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn-show-more-review">
                                    Xem thêm
                                    <div class="inline-block-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="10" height="10">
                                            <path
                                                d="M224 416c-8.188 0-16.38-3.125-22.62-9.375l-192-192c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L224 338.8l169.4-169.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-192 192C240.4 412.9 232.2 416 224 416z"></path>
                                        </svg>
                                    </div>
                                </button>
                            </div>
                        </div>
                        {{--                            comment hoi dap--}}
                        <div class="comment-container mx-0">
                            <div class="comment-form">
                                <p class="comment-form-title">Hỏi và đáp</p>
                                <div class="comment-form-content">
                                    <div class="textarea-comment">
                                        <textarea placeholder="Xin mời để lại câu hỏi, IT24H sẽ trả lời lại trong 1h, các câu hỏi sau 22h - 8h sẽ được trả lời vào sáng hôm sau" class="textarea"></textarea>
                                        <button class="button">
                                            <div class="icon-paper-plane">
                                                <svg height="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
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
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
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
                                                    <div>Con này khi nào có thì liên hệ em qua ZAlo *****239 nha ạ, em cám ơn nhiều</div>
                                                </div>
                                                <button class="btn-rep-cmt">
                                                    <div>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="12"
                                                             viewBox="0 0 12 10.8">
                                                            <path d="M3.48,8.32V4.6H1.2A1.2,1.2,0,0,0,0,5.8V9.4a1.2,1.2,0,0,0,1.2,1.2h.6v1.8l1.8-1.8h3A1.2,1.2,0,0,0,7.8,9.4V8.308a.574.574,0,0,1-.12.013H3.48ZM10.8,1.6H5.4A1.2,1.2,0,0,0,4.2,2.8V7.6H8.4l1.8,1.8V7.6h.6A1.2,1.2,0,0,0,12,6.4V2.8a1.2,1.2,0,0,0-1.2-1.2Z"
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
                                                        <svg viewBox="0 0 40 40" fill="#fff" xmlns="http://www.w3.org/2000/svg">
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
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
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
                                                                <div>dạ em rất tiếc, CellphoneS chưa hỗ trợ thông báo khi hàng về qua zalo,
                                                                    Chị đăng ký thông tin chờ hàng ở phía trên hoặc mình thường xuyên theo
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
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="12"
                                                                         viewBox="0 0 12 10.8">
                                                                        <path id="chat"
                                                                              d="M3.48,8.32V4.6H1.2A1.2,1.2,0,0,0,0,5.8V9.4a1.2,1.2,0,0,0,1.2,1.2h.6v1.8l1.8-1.8h3A1.2,1.2,0,0,0,7.8,9.4V8.308a.574.574,0,0,1-.12.013H3.48ZM10.8,1.6H5.4A1.2,1.2,0,0,0,4.2,2.8V7.6H8.4l1.8,1.8V7.6h.6A1.2,1.2,0,0,0,12,6.4V2.8a1.2,1.2,0,0,0-1.2-1.2Z"
                                                                              transform="translate(0 -1.6)" fill="#2490ff">

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
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="10" height="10">
                                            <path
                                                d="M224 416c-8.188 0-16.38-3.125-22.62-9.375l-192-192c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L224 338.8l169.4-169.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-192 192C240.4 412.9 232.2 416 224 416z"></path>
                                        </svg>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            function runOnScroll() {
                if (jQuery(window).scrollTop() > 30) {
                    document.getElementById("affix_h").style.top = "60px";
                } else {
                    document.getElementById("affix_h").style.top = "115px";
                }
            }

            $(window).scroll(runOnScroll);
        })
    </script>
@endsection
@section('footer')
    @include('frontend.mobile.footermobile')
@endsection
