@extends('frontend.mobile.basemobile')

@section('title')
    <title>IT24H - Thông tin đặt hàng</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('asset/css/mobile/successorder_mobile.css')}}">
@endsection
@section('content')
    <div class="component-orderinfo-container">
        <div class="header_cart d-flex align-items-center justify-content-center">
            <div class="back">
                <a href="/" class="d-flex align-items-center">
                    <i class="far fa-times"></i>
                    <p>Đóng</p>
                </a>
            </div>
            <p class="title_cart title m-auto">Hoàn thành</p>
        </div>
        @if($active==1)
        <section class="block-info">
            <div class="container">
                <p class="mx-2 mb-2">
                    <span class="strong_text">Cảm ơn Quý khách hàng đã chọn mua hàng tại IT24H. Trong 15 phút, IT24H sẽ SMS hoặc gọi để xác nhận đơn hàng.</span><br>
                    <em>* Các đơn hàng từ 21h30 tối tới 8h sáng hôm sau. IT24H sẽ liên hệ với Quý khách trước 10h trưa cùng ngày</em>
                </p>
                <div class="block-box info alert-success">
                    <div>
                    <h4 class="text-center text-uppercase">Đặt hàng thành công</h4>
                    <div><p class="my-0"><span>Mã đơn hàng: </span><span class="bold_text">{{$customer_order->id}}</span></p></div>
                    <div><p class="my-0"><span>Người đặt: </span><span class="bold_text">{{$customer_order->customer_name}}</span></p></div>
                    @if($customer_order->name_company)
                        <div><p class="my-0"><span>Tên công ty: </span><span class="bold_text">{{$customer_order->name_company}}</span></p></div>
                    @endif
                    <div><p class="my-0"><span>Số điện thoại: </span><span class="bold_text">{{$customer_order->phone_number}}</span></p></div>
                    <div><p class="my-0"><span>Nhận sản phẩm tại: </span><span class="bold_text">{{$customer_order->address}}</span></p></div>
                    <div><p class="my-0"><span>Hình thức thanh toán: </span><span class="bold_text">{{$customer_order->payment_method}}</span></p></div>
                    <div><p class="my-0"><span>Tổng tiền: </span><span class="bold_text">{{$customer_order->total}}</span></p></div>

                    </div>
                    <div>
                        <div class="QRcode_payment">
                            <p>Vui lòng quét mã bên dưới để thanh toán chuyển khoản</p>
                            <div class="qr_img">
                                <img src="{{asset('asset/images/qrcode_banking.png')}}">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="QRcode_payment">
                            <span class="bold_text">Thông tin chuyển khoản:</span>
                            <div class="mx-3">
                                <span>Công ty Cổ phần Công nghệ và Truyền thông IT24H</span><br>
                                <span>Ngân hàng Techcombank - Chi nhánh Lê Chân - Hải Phòng</span><br>
                                <span>Số tài khoản:</span> <span class="bold_text">19036993513011</span><br>
                                <span class="bold_text">Hotline hỗ trợ: 0886776286</span><br>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="bottom-button-success">
                    <div class="my-3 d-flex">
                        <a href="#" class="btn btn-primary mr-2">Kiểm tra đơn hàng <br>
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check-circle"
                                 role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                 class="svg-inline--fa fa-check-circle" data-v-38fb1f2c="">
                                <path fill="currentColor"
                                      d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"
                                      data-v-38fb1f2c="" class=""></path>
                            </svg>
                        </a>
                        <a href="/" class="btn btn-danger ml-2">Tiếp tục mua hàng <br>
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cart-plus" role="img"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                 class="svg-inline--fa fa-cart-plus" data-v-38fb1f2c="">
                                <path fill="currentColor"
                                      d="M504.717 320H211.572l6.545 32h268.418c15.401 0 26.816 14.301 23.403 29.319l-5.517 24.276C523.112 414.668 536 433.828 536 456c0 31.202-25.519 56.444-56.824 55.994-29.823-.429-54.35-24.631-55.155-54.447-.44-16.287 6.085-31.049 16.803-41.548H231.176C241.553 426.165 248 440.326 248 456c0 31.813-26.528 57.431-58.67 55.938-28.54-1.325-51.751-24.385-53.251-52.917-1.158-22.034 10.436-41.455 28.051-51.586L93.883 64H24C10.745 64 0 53.255 0 40V24C0 10.745 10.745 0 24 0h102.529c11.401 0 21.228 8.021 23.513 19.19L159.208 64H551.99c15.401 0 26.816 14.301 23.403 29.319l-47.273 208C525.637 312.246 515.923 320 504.717 320zM408 168h-48v-40c0-8.837-7.163-16-16-16h-16c-8.837 0-16 7.163-16 16v40h-48c-8.837 0-16 7.163-16 16v16c0 8.837 7.163 16 16 16h48v40c0 8.837 7.163 16 16 16h16c8.837 0 16-7.163 16-16v-40h48c8.837 0 16-7.163 16-16v-16c0-8.837-7.163-16-16-16z"
                                      data-v-38fb1f2c="" class=""></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        @endif
    </div>
@endsection

