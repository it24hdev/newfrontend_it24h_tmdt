@extends('frontend.mobile.basemobile')

@section('title')
    <title>IT24H - Thông tin đặt hàng</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('asset/css/mobile/orderinfo_mobile.css')}}">
@endsection

@section('content')
    <div class="component-orderinfo-container">
        <div class="header_cart d-flex align-items-center justify-content-center">
            <div class="back">
                <a href="{{ url()->previous() }}" class="d-flex align-items-center">
                    <i class="fal fa-angle-left"></i>
                    <p> Trở về</p>
                </a>
            </div>
            <p class="title_cart title m-auto">Thông tin đặt hàng</p>
        </div>
        @if($active==1)
        <section class="block-info">
            <div class="box-info-customer">
                <div class="block-customer">
                    <p>Thông tin khách hàng</p>
                    <div class="mt-2">
                        <input type="text" name="customer_name" placeholder="Họ và tên (bắt buộc)" maxlength="50" autocomplete="off">
                        <span class="requite_name text-danger mx-2"><i></i></span>
                        <input type="number" name="phone_number" placeholder="Số điện thoại (bắt buộc)"  autocomplete="off" class="mt-2">
                        <span class="requite_numberphone text-danger mx-2"><i></i></span>
                        <input type="email" placeholder="Email" name="email" maxlength="100" autocomplete="off" class="mt-2">
                        <span class="requite_email text-danger mx-2"><i></i></span>
                    </div>
                </div>
                <div class="address-box">
                    <div class="d-flex">
                        <select name="city" class="form-select col-sm-1 mx-1 w-50">
                            @foreach($city as $key => $item)
                                <option value="{{$item->matp}}" @if($item->matp == 31) selected @endif>{{$item->name}}</option>
                            @endforeach
                        </select>
                        <select name="district" class="form-select form-select-sm mx-1 w-50">
                            @foreach($district as $key => $item)
                                @if($item->matp == 31)
                                <option value="{{$item->name}}">{{$item->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <input id="address" name="street" type="text" placeholder="Số nhà, tên đường" class="mt-2" autocomplete="off">
                </div>
                <div class="mt-3 note_c"><input name="note" type="text" placeholder="Ghi chú"></div>
                <div class="mt-3">
                    <p class="payments_title">Chọn hình thức thanh toán</p>
                    <div class="payment-group d-flex flex-wrap justify-content-between">
                        <input type="radio" id="cash_on_shop" name="payment_method" value="Thanh toán tại cửa hàng" class="d-none" checked="checked">
                        <label for="cash_on_shop"
                               class="payment-item block-box flex-column d-flex align-items-center justify-content-center">
                            <span class="text-center"> Thanh toán tại cửa hàng </span>
                            <i class="fal fa-store"></i>
                        </label>
                        <input type="radio" id="transfer" name="payment_method" value="Chuyển khoản" class="d-none">
                        <label for="transfer"
                               class="payment-item block-box flex-column d-flex align-items-center justify-content-center">
                            <span class="text-center"> Chuyển khoản </span>
                            <i class="fal fa-money-check-alt"></i>
                        </label>
                    </div>
                </div>
                <div class="mt-3 d-flex flex-column">
                    <div class="receipt">
                        <label for="VAT">
                            <input type="checkbox" name="VAT" id="VAT">
                            <span>Yêu cầu xuất hóa đơn công ty (Vui lòng điền email để nhận hoá đơn VAT)</span>
                        </label><br>
                        <a href="#" target="_blank">
                            <i class="text-danger">(Với đơn hàng trên 20 triệu vui lòng thanh toán chuyển khoản từ tài
                                khoản công ty khi cần xuất VAT cho công ty)</i>
                        </a>
                    </div>
                    <div class="mb-3 receipt_ip d-none">
                        <input name="name_company" type="text" placeholder="Tên công ty (*)" autocomplete="off" class="my-2">
                        <span class="requite_name_company text-danger mx-2"><i></i></span>
                        <input name="address_company" type="text" placeholder="Địa chỉ công ty (*)" autocomplete="off" class="my-2">
                        <span class="requite_address_company text-danger mx-2"><i></i></span>
                        <input name="tax_code" type="text" placeholder="Mã số thuế (*)" autocomplete="off" class="my-2">
                        <span class="requite_tax_code text-danger mx-2"><i></i></span>
                        <input name="email_company" type="text" placeholder="Email công ty (*)" autocomplete="off" class="my-2">
                        <span class="requite_email_company text-danger mx-2"><i></i></span>
                    </div>
                </div>
                <i>
                    <input type="checkbox" class="check_rules" checked="checked">
                    <a href="" target="_blank" class="text-danger font-rules">Bằng cách đặt hàng, bạn đồng ý với Điều khoản sử dụng của IT24H.</a>
                </i>
                <div class="container-total-box">
                    <div class="bottom-bar">
                        <div class="total-box">
                            <p class="title-temp">Tổng tiền tạm tính:</p>
                            <div class="price-tt">
                                <span class="total_cart_success">{{ number_format($total_money, 0, '', '.') }} đ</span>
                            </div>
                        </div>
                        <div class="sm_cart">
                            <a class="btn-complte-payment"> Đặt Hàng </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
    </div>
@endsection
@section('js')

@endsection
