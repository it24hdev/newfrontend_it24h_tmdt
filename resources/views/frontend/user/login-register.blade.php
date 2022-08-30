@extends('frontend.layouts.base')

@section('title')
    <title>@lang('lang.IT24Haccount')</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('asset/css/user/myaccount.css')}}">
    <style>
        input::placeholder{
            font-size: 14px;
        }
    </style>
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
                <a>@lang('lang.Myaccount')</a>
            </div>
        </div>
    </div>
    <div class="container-page" style="color: #222">
        <div class="wp-my-account">
            @if ($message = Session::get('error'))
            <div class="alert alert-danger align-items-center" role="alert">
                <div><i class="fal fa-exclamation-triangle me-1"></i> {{ $message }}</div>
            </div>
            @endif
            <div class="row">
                <div class="col-12 col-md-6" style="padding-right: 5%;">
                    <div class="form-login mb-5">
                        <form action="{{route('user_login')}}" method="POST">
                            @csrf
                        <div class="title-form-login">
                            <h2>@lang('lang.Login')</h2>
                        </div>
                        <div class="mb-3">
                            <label for="email">@lang('lang.Usernameoremailaddress') <span class="required">*</span></label>
                            <input type="email" class="form-control" name="email" id="email" autocomplete="email" value="" placeholder="@lang('lang.Enteryourusernameoremailaddress')" required>
                            @error('email')
                            <span role="alert">
                                <p class="text-danger fst-italic mt-2" style="font-size: 14px;">{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_login">@lang('lang.Password') <span class="required">*</span></label>
                            <input type="password" class="form-control" value="" name="password_login" id="password_login" autocomplete="current-password" placeholder="@lang('lang.Enteryourpassword')" required>
                            @error('password_login')
                            <span role="alert">
                                <p class="text-danger fst-italic mt-2" style="font-size: 14px;">{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <label for="remember" class="form-remember">
                            <input type="checkbox" value="1" id="remember" name="remember_me" class="me-1">
                            <span class="remember">@lang('lang.Rememberme')</span>
                        </label>
                        <a href="{{route('forgot_password')}}" class="lost-pass">@lang('lang.Lostyourpassword')</a>
                        <button type="submit" class="btn-submit btn btn-primary px-2">@lang('lang.Login')</button>
                    </form>
                    <hr>
                    <a href="{{route('login-facebook')}}" class="btn-login-facebook btn btn-primary w-100 mt-2"><i class="fab fa-facebook-square me-2"></i>@lang('lang.loginwithfb')</a>
                    <a href="{{route('login-google')}}" class="btn-login-google btn btn-danger w-100 mt-2"><i class="fab fa-google me-2"></i>@lang('lang.loginwithgg')</a>
                    </div>
                </div>
                <div class="col-12 col-md-6" style="padding-right: 5%;">
                    <div class="form-login mb-5">
                        <form action="{{route('user_register')}}" method="POST">
                        @csrf
                        <div class="title-form-login">
                            <h2>@lang('lang.Register')</h2>
                        </div>
                        <div class="mb-3">
                            <label for="name">@lang('lang.Fullname') <span class="required">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" autocomplete="name"
                            value="{{ old('name') }}" placeholder="@lang('lang.Enteryourfullname')" required>
                            @error('name')
                            <span role="alert">
                                <p class="text-danger fst-italic mt-2" style="font-size: 14px;">{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="new-email">@lang('lang.Emailaddress') <span class="required">*</span></label>
                            <input type="email" class="form-control @error('new_email') is-invalid @enderror" name="new_email" id="new-email" autocomplete="email"
                            value="{{old('new_email') }}" placeholder="@lang('lang.Enteryouraddress')" required>
                            @error('new_email')
                            <span role="alert">
                                <p class="text-danger fst-italic mt-2" style="font-size: 14px;">{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password">@lang('lang.Password') <span class="required">*</span></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" autocomplete="current-password" placeholder="@lang('lang.Enteryourpassword')" required>
                            @error('password')
                            <span role="alert">
                                <p class="text-danger fst-italic mt-2" style="font-size: 14px;">{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password-confirm">@lang('lang.PasswordConfirm')  <span class="required">*</span></label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password-confirm" autocomplete="current-password" placeholder="@lang('lang.Enterconfirmpassword')" required>
                            @error('password_confirmation')
                            <span role="alert">
                                <p class="text-danger fst-italic mt-2" style="font-size: 14px;">{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <button class="btn-submit btn btn-primary px-2" type="submit">@lang('lang.Register') </button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('frontend.layouts.footer')
@endsection
