@extends('frontend.layouts.base')

@section('title')
    <title>@lang('lang.IT24Haccount')</title> 
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('asset/css/user/register.css')}}">
    <link rel="stylesheet" href="asset/css/user/myaccount.css">
    <style>
        .breadcrumb-wrap {
            margin-top: 25px !important;
        }
    </style>
@endsection

@section('header')
    @include('frontend.layouts.header-page', [$Sidebars, $Menus])
@endsection

@section('menu-mobile')
    @include('frontend.layouts.menu-mobile', [$Sidebars, $Menus])
@endsection

@section('content')
    <div class="breadcrumb-wrap container-wp">
        <section class="breadcrumb">
            <div class="breadcrumb_default">
                <div class="breadcrumb_populated">
                    <div class="breadcrumb_title">@lang('lang.Myaccount')</div>
                    <nav class="breadcrumb_list">
                        <a href="{{route('user')}}">@lang('lang.Home')</a>
                        <i class="fas fa-angle-right"></i>
                        <a href="{{route('user_account')}}">@lang('lang.Myaccount')</a>
                        <i class="fas fa-angle-right"></i>
                        @lang('lang.Forgetpasswordd')
                    </nav>
                </div>
            </div>
        </section>
    </div>
    <div id="content">
        <div class="container-wp wp-my-account">
            @if ($message = Session::get('alert'))
            <div class="alert alert-success align-items-center" role="alert">
                <div><i class="fal fa-bell me-1"></i> {{ $message }}</div>
            </div>
            @endif
            @if ($message = Session::get('error'))
            <div class="alert alert-danger align-items-center" role="alert">
                <div><i class="fal fa-exclamation-triangle me-1"></i> {{ $message }}</div>
            </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <p style="color:#666666; font-size:14px;">@lang('lang.ForgetyourpasswordPleaseenteryourusername')</p>
                </div>
                <div class="col-12">
                    <div class="form-reset-pass mb-5">
                        @if (!empty(request()->input('reset_token')) && !empty($customer))
                        <form action="{{route('reset_password', $customer->id)}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="password">@lang('lang.NewPassword')</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" value="" name="password" id="password" autocomplete="current-password" placeholder="@lang('lang.Enternewpassword')" required>
                                @error('password')
                                <span role="alert">
                                    <p class="text-danger fst-italic mt-2" style="font-size: 14px;">{{ $message }}</p>
                                </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn-submit">@lang('lang.ResetPassword')</button>
                        </form>
                        @else
                        <form action="{{route('sendmail_pw')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="email">@lang('lang.Usernameoremailaddress')</label>
                                <input type="email" class="form-control @if (session('error')) is-invalid @endif"
                                name="email" id="email" autocomplete="email" value="{{old('email')}}" placeholder="@lang('lang.Enteremailaddress')" required>
                                @if (session('error'))
                                    <span role="alert">
                                        <p class="text-danger fst-italic mt-2" style="font-size: 14px;">{{ session('error') }}</p>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn-submit">@lang('lang.ResetPassword')</button>
                        </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('frontend.layouts.footer')
@endsection

