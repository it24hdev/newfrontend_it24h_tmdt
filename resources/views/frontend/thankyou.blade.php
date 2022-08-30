@extends('frontend.layouts.base')

@section('title')
    <title>@lang('lang.IT24Hthankyou')</title>
@endsection

@section('css')
    <link rel="stylesheet" href="asset/css/order-success.css">
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
                <a>@lang('lang.Orderreceived')</a>
            </div>
        </div>
    </div>
    <div class="container-page">
        <div class="container-wp">
            <div class="wp-order-detail">
                <p class="alert-order-success">@lang('lang.Thankyoureceived')</p>
                <ul class="order-detail">
                    <li class="code-order">@lang('lang.Ordernumber'): <strong>IT24H{{$order->id}}</strong></li>
                    <li class="date">@lang('lang.Date'): <strong>{{ \App\Helpers\CommonHelper::convertDateToDMY($order->created_at) }}</strong></li>
                    <li class="email">@lang('lang.Email'): <strong>{{$order->email}}</strong></li>
                    <li class="total">@lang('lang.Total'): <strong>{{ number_format($order->total, 0, '', '.') }} @lang('lang.Currencyunit')</strong></li>
                    <li class="payment-method">@lang('lang.Paymentmethod'): <strong>{{ $order->payment_method }}</strong></li>
                </ul>
                <div class="order-product">
                <h2>@lang('lang.ORDERDETAILS')</h2>
                <table class="table-order-detail">
                    <thead>
                    <tr>
                        <th class="product-name">@lang('lang.Product')</th>
                        <th class="product-total">@lang('lang.Total')</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->order_item as $item)
                            <tr class="order_item">
                                <td class="product-name">
                                <a href="">{{$item->product_name}}</a> <strong class="product-quantity">× {{$item->quantity}}</strong>
                                </td>
                                <td class="product-total">
                                <span class="amount"><bdi>{{ number_format((($item->price)*($item->quantity)), 0, '', '.') }}<span> @lang('lang.Currencyunit')</span></bdi></span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>@lang('lang.Total'):</th>
                        <td><span class="amount">{{ number_format($order->total, 0, '', '.') }}<span> @lang('lang.Currencyunit')</span></span></td>
                    </tr>
                    <tr>
                        <th>@lang('lang.Paymentmethod'):</th>
                        <td>{{$order->payment_method}}</td>
                    </tr>
                    <tr>
                        <th>@lang('lang.Total'):</th>
                        <td><span class="amount-total">{{ number_format($order->total, 0, '', '.') }}<span> @lang('lang.Currencyunit')</span></td>
                    </tr>
                    </tfoot>
                </table>
                </div>
                <div class="card customer-info">
                <div class="card-body" style="overflow-y: auto;">
                    <h5 class="d-block ml-2">@lang('lang.Customerinformation') :</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">@lang('lang.Fullname')</th>
                                <th scope="col">@lang('lang.Phone')</th>
                                <th scope="col">@lang('lang.Address')</th>
                                <th scope="col">@lang('lang.Email')</th>
                                <th scope="col">@lang('lang.Notes')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$order->customer_name}}</td>
                                <td>{{$order->phone_number}}</td>
                                <td>{{$order->address}}</td>
                                <td>{{$order->email}}</td>
                                <td>{{$order->note}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('frontend.layouts.footer')
@endsection
