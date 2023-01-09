@extends('frontend.layouts.base')

@section('title')
    <title>Gửi đơn hàng</title>
@endsection

@section('css')
    <link rel="stylesheet" href="asset/css/order-success.css">
@endsection

@section('header-home')
    @include('frontend.layouts.header-page', [$Sidebars, $active_menu])
@endsection


@section('content')
    <div class="wp-breadcrumb-page">
        <div class="container-page">
            <div class="breadcrumb-page">
                <a href="{{route('user')}}">@lang('lang.Home') <i class="fas fa-angle-right mx-1"></i></a>
                <a>Hoàn thành thanh toán</a>
            </div>
        </div>
    </div>
    <div class="container-page">
        <div class="container-order">
            @if($active==1)
            <div class="order-detail">
                <div class="col-12 box_order">
                    <div class="img_order col-4 img_shopping_cart_success">
                        <img src="{{asset('upload/images/common_img/shopping_cart.png')}}">
                    </div>
                    <div class="title_order col-8">
                        <div><span class="title_thanks">Cảm ơn quý khách đã mua hàng tại IT24h</span></div>
                        <div class="code_order">
                            <p>Mã đơn hàng của quý khách là:</p>
                            <p class="cpn_code">#{{$customer_order->id}}</p>
                        </div>
                        <div>
                            <p>Trong 15 phút, IT24H sẽ SMS hoặc gọi để xác nhận đơn hàng</p>
                            <p><em>* Các đơn hàng từ 21h30 tối tới 8h sáng hôm sau. IT24H sẽ liên hệ với Quý khách trước 10h trưa cùng ngày</em></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 box_order">
                    <div class="img_order col-4">
                        <div>
                            <p class="text-center">Vui lòng quét mã bên dưới để thanh toán chuyển khoản</p>
                            <img src="{{asset('asset/images/qrcode_banking.png')}}">
                        </div>
                    </div>
                    <div class="info_cus col-8">
                         <table>
                                <tbody>
                                <tr>
                                    <th>Khách hàng: </th>
                                    <td>{{$customer_order->customer_name}}</td>
                                </tr>
                                <tr>
                                    <th>Địa chỉ nhận hàng: </th>
                                    <td>{{$customer_order->address}}</td>
                                </tr>
                                <tr>
                                    <th>Số điện thoại: </th>
                                    <td>{{$customer_order->phone_number}}</td>
                                </tr>
                                </tbody>
                            </table>
                        <div class="item_order">
                            <div><p class="item_title">Sản phẩm đã đặt</p></div>
                            <div class="item_products">
                                @foreach($info_order as $item)
                                <div class="box_item_product">
                                    <div class="img_product">
                                        @if($item->thumb!="no-images.jpg")
                                            <img src="{{asset('upload/images/products/thumb/'.$item->thumb)}}">
                                        @else
                                            <img src="{{asset('upload/images/common_img/no-images.jpg')}}">
                                        @endif
                                    </div>
                                    <div class="name_product">{{$item->product_name}}</div>
                                    <div class="subtotal">
                                        <p class="price_p">{{$item->price}} VNĐ</p>
                                        <p class="quantity_p">x{{$item->quantity}}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="total_price">
                                <div><p class="title_total">Tổng cộng</p></div>
                                <div><p class="total">{{$customer_order->total}} VNĐ</p></div>
                            </div>
                            <div class="vat_order">
                                <p class="my-0">(Đã bao gồm VAT nếu có)</p>
                            </div>
                        </div>
                        <div class="another_by">
                            <a href="/">Tiếp tục mua hàng</a>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="order-detail">
                <div class="col-12 box_order">
                    <div class="img_order col-4 img_shopping_cart_error">
                        <img src="{{asset('upload/images/common_img/shopping_cart.png')}}">
                    </div>
                    <div class="title_order col-8">
                        <div><span class="title_error">Có lỗi xảy ra!</span></div>
                        <div class="mb-5">
                            <p>Quý khách vui lòng quay lại vào thời điểm khác. Nếu Quí khách có nhu cầu liên lạc ngay với chúng tôi, xin gọi Đường dây nóng
                                <br>Hỗ trợ Khách hàng: <b>0886.776.286</b> hoặc truy cập <b>info@it24h.vn</b> . Xin cảm ơn!</p>
                        </div>
                        <div class="mb-3">
                            <p>Các câu hỏi thường gặp</p>
                        </div>
                        <div class="list_q">
                            <a>Xác nhận đơn hàng như thế nào?</a>
                            <a>Thời gian giao hàng</a>
                            <a>Chính sách đổi trả hàng</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection

@section('footer')
    @include('frontend.layouts.footer')
@endsection
