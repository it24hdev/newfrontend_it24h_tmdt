<!DOCTYPE html>
<html lang="vi" class="light">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="{{asset('upload/images/common_img/logo.svg')}}" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="It24h, công ty cung cấp giải pháp CNTT">
        <meta name="keywords" content="Thiết kế website, website doanh nghiệp, seo web, website bán hàng">
        <title>Admin</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
        <link rel="stylesheet" href="{{asset('lib/tailwind227.min.css')}}">
        <link rel="stylesheet" href="{{asset('lib/fontawesome/css/all.min.css')}}">
        @yield('css')

        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    @yield('body')
</html>
