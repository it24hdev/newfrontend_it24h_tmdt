@extends('frontend.layouts.base')

@section('title')
    <title>@lang('lang.IT24Hcheckout')</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('asset/css/checkout.css')}}">
@endsection

@section('header-home')
    @include('frontend.layouts.header-page', [$Sidebars, $Menus])
@endsection

@section('header-mobile')
    @include('frontend.layouts.menu-mobile', [$Sidebars, $Menus])
@endsection

@section('content')
    <div class="wp-breadcrumb-page">
        <div class="container-page">
            <div class="breadcrumb-page">
                <a href="{{route('user')}}">@lang('lang.Home') <i class="fas fa-angle-right mx-1"></i></a>
                <a>@lang('lang.Checkout')</a>
            </div>
        </div>
    </div>
    <div id="content" class="container-page">
        <div class="wp-my-account" style="color: #222">
            <div class="row">
                <div class="col-12">
                    <form action="{{route('sendmail')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-7" style="padding-right: 5%;">
                                <h3 class="d-block mb-4">@lang('lang.Billingdetails')</h3>
                                <div class="wp-form pb-5">
                                    <div class="form-group mb-3">
                                        <label for="fullname">@lang('lang.Fullname') <span class="text-danger">*</span></label>
                                        <input type="text" name="name" value="{{(old('name')) ?? (!empty($customer) ? $customer->name : '')}}"
                                        id="fullname" class="form-control @error('name') is-invalid @enderror" placeholder="@lang('lang.Enteryourfullname')" required>
                                        @error('name')
                                            <span role="alert">
                                                <p class="text-danger fst-italic mt-2" style="font-size: 14px;">{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="phone">@lang('lang.Phone') <span class="text-danger">*</span></label>
                                        <input type="text" name="phone_number" value="{{(old('phone_number')) ?? (!empty($customer) ? $customer->phone_number : '')}}"
                                        id="phone" class="form-control @error('phone_number') is-invalid @enderror" placeholder="@lang('lang.Enteryourphone')" required>
                                        @error('phone_number')
                                            <span role="alert">
                                                <p class="text-danger fst-italic mt-2" style="font-size: 14px;">{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="address">@lang('lang.Address') <span class="text-danger">*</span></label>
                                        <input type="text" name="address" value="{{(old('address')) ?? (!empty($customer) ? $customer->address : '')}}"
                                        id="address" class="form-control @error('address') is-invalid @enderror" placeholder="@lang('lang.Enteryouraddress')" required>
                                        @error('address')
                                            <span role="alert">
                                                <p class="text-danger fst-italic mt-2" style="font-size: 14px;">{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="email">@lang('lang.Email')</label>
                                        <input type="email" name="email" value="{{(old('email')) ?? (!empty($customer) ? $customer->email : '')}}"
                                        id="email" class="form-control @error('email') is-invalid @enderror" placeholder="@lang('lang.Enteryouremail')">
                                        @error('email')
                                            <span role="alert">
                                                <p class="text-danger fst-italic mt-2" style="font-size: 14px;">{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                            <label for="note">@lang('lang.Ordernotes')</label>
                                        <textarea name="note" id="note" cols="30" rows="5" class="form-control" placeholder="@lang('lang.Enterordernotes')">{{old('note')}}</textarea>
                                        @error('note')
                                            <span role="alert">
                                                <p class="text-danger fst-italic mt-2" style="font-size: 14px;">{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-5">
                                <div class="order-review mb-5">
                                    <h3>@lang('lang.Yourorder')</h3>
                                    <div class="checkout-review-order">
                                        <table class="checkout-review-order-table">
                                            <thead>
                                                <tr>
                                                    <th class="product-name">@lang('lang.Product')</th>
                                                    <th class="product-total">@lang('lang.Subtotal')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach (Cart::content() as $item)
                                                <tr class="cart_item">
                                                    <td class="product-name">
                                                        {{$item->name}}<strong class="product-quantity"> × {{$item->qty}}</strong>
                                                    </td>
                                                    <td class="product-total">
                                                        <span class="amount"><bdi>{{ number_format($item->subtotal, 0, '', '.')}}<span> @lang('lang.Currencyunit')</span></bdi></span>
                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                            <tfoot>
                                                <tr class="cart-subtotal">
                                                    <th>@lang('lang.Subtotal')</th>
                                                    <td>
                                                        <span class="amount"><bdi>{{ Cart::subtotal(0, '', '.') }}<span> @lang('lang.Currencyunit')</span></bdi></span>
                                                    </td>
                                                </tr>
                                                <tr class="order-total">
                                                    <th>@lang('lang.Total')</th>
                                                    <td>
                                                        <strong>
                                                            <span class="amount"><bdi>{{ Cart::subtotal(0, '', '.') }}<span> @lang('lang.Currencyunit')</span></bdi></span>
                                                        </strong>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <div class="payment mt-2">
                                            <div class="form-group pt-3">
                                                <input type="radio" value="@lang('lang.Transfer')" name="payment_method" id="payment_method_bacs" class="form-check-input me-2 payment-check" checked>
                                                <label for="payment_method_bacs" class="payment-check"><strong>@lang('lang.Directbanktransfer')</strong></label>
                                                <div class="payment-box">
                                                    <p>@lang('lang.Makeyourpayment')
                                                    .</p>
                                                </div>
                                            </div>
                                            <div class="form-group pt-3">
                                                <input type="radio" value="@lang('lang.Paydirectlyatthestore')" name="payment_method" id="payment_method_cheque" class="form-check-input me-2 payment-check">
                                                <label for="payment_method_cheque" class="payment-check"><strong>@lang('lang.Checkpayments')</strong></label>
                                                <div class="payment-box payment-box-none">
                                                    <p>@lang('lang.checktoStore').</p>
                                                </div>
                                            </div>
                                            <div class="form-group pt-3">
                                                <input type="radio" value="@lang('lang.Paymentondelivery')" name="payment_method" id="payment_method_cod" class="form-check-input me-2 payment-check">
                                                <label for="payment_method_cod" class="payment-check"><strong>@lang('lang.Cashondelivery')</strong></label>
                                                <div class="payment-box payment-box-none">
                                                    <p>@lang('lang.Paywithcashupondelivery').</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="place-order mt-4">
                                            <p>@lang('lang.Yourpersonaldata').</p>
                                            <button type="submit" class="btn-order">@lang('lang.PlaceOrder')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('frontend.layouts.footer')
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $('.payment-check').click(function(){
                $('.payment-box').not($(this).parent('.form-group').children('.payment-box')).slideUp( 300 );
                $(this).parent('.form-group').children('.payment-box').slideDown( 300 );
            });
        });
    </script>
@endsection
