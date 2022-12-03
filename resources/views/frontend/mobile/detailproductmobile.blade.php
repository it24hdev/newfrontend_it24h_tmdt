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
                                                    <img src="{{asset('upload/images/products/large/'.$product->thumb)}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="thumbnail-slide">
                                    @if (!empty($imgs))
                                        @foreach ($imgs as $img)
                                        <div class="slide-wrapper">
                                            <div class="img-wrp">
                                                <img src="{{asset('upload/images/products/thumb/'.$img)}}" width="58" height="58">
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif
                                    </div>
                                </div>
                            </div>
                            <div class="box-info-cnt">
                                <div class="box-header">
                                    <h1>{{$product->name}}</h1>
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
                                            <p>Khuyến mãi</p></div>
                                        <div class="box-product-promotion-content">
                                            {!! $product->gift !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="box-buy">
                                    <div class="box-order-button-container">
                                        <div class="box-between">
                                            <a href="javascript:;" class="order-button add-cart-now" data-id="{{$product->id}}">
                                                <strong>MUA NGAY</strong>
                                                <span>(Giao tận nơi hoặc lấy tại cửa hàng)</span>
                                            </a>
                                            <a href="javascript:;"  get-id="{{$product->id}}" class="button-add-to-cart add-cart">
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
                                <div class="box-warranty-info">
                                    <div class="box-title"><p>Thông tin sản phẩm</p></div>
                                    {!! $product->short_content !!}
                                </div>
                                <div class="technicalInfo">
                                    <h2 class="title">Thông số kỹ thuật</h2>
                                    <ul class="technical-content">
                                    @if($property !=null)
                                        @php
                                            $count_ = 0
                                        @endphp
                                        @foreach($property as $key => $val)
                                        <li class="technical-content-item item_list_attr" @if($count_%2) style="background-color: #fff" @endif>

                                            <p>{{ $key }}</p>
                                            <div class="lineproperty">{{ $val }}</div>
                                        </li>
                                        @php
                                            $count_ =  $count_ + 1
                                        @endphp
                                        @endforeach
                                    @endif
                                    </ul>
                                    <button class="button my-3 is-flex is-justify-content-center" data-v-4e304e03="">Xem
                                        cấu hình chi
                                        tiết
                                        <div data-v-4e304e03="">
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
