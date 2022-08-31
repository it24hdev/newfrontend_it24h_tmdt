@extends('frontend.layouts.base')

@section('title')
    <title>Giới Thiệu Về IT24H</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('asset/css/page/about-us.css')}}">
@endsection

@section('header-home')
    @include('frontend.layouts.header-page', [$Sidebars, $Menus ,$active_menu])
@endsection

@section('header-mobile')
    @include('frontend.layouts.menu-mobile', [$Sidebars, $Menus])
@endsection

@section('content')
    <div class="container-page">
        <div class="wp-content">
            <h2 class="title">Giới thiệu về IT24H</h2>
            <div class="box-content">
                <h4 class="header-title">Giới thiệu chung</h4>
                <div class="detail gioi-thieu-chung">
                    <div class="content-left">
                        <p class="name"><strong>Công ty cổ phần công nghệ và truyền thông IT24H</strong></p>
                        <p style="font-size: 20px; text-align:justify">IT24H là công ty hoạt động trong lĩnh vực CNTT, với trọng tâm chính là cung cấp các giải pháp và dịch vụ CNTT cho doanh nghiệp vừa và nhỏ.</p>
                        <p style="font-size: 20px; text-align:justify">Chúng tôi mong muốn mang lại những giá trị đích thực, những giải pháp và dịch vụ có chất lượng tốt nhất cho khách hàng.</p>
                    </div>
                    <div class="content-right">
                        <div class="middle-image">
                            <img src="{{asset('asset/images/round.png')}}" alt="">
                        </div>
                        <div class="pattern">
                            <img class="scale" src="{{asset('asset/images/about1.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-content">
                <h4 class="header-title">Sứ mệnh</h4>
                <div class="detail su-menh">
                    <div class="box-detail">
                        <p class="header-detail">Đối với khách hàng</p>
                        <p>Luôn đặt lợi ích khách hàng lên hàng đầu. Mỗi giải pháp, dịch vụ đều đáp ứng tối đa nhu cầu của khách hàng.</p>
                    </div>
                    <div class="box-detail">
                        <p class="header-detail">Đối với đối tác</p>
                        <p>Đề cao tinh thần hợp tác cùng nhau phát triển, cam kết trở thành “Người đồng hành số 1” của các đối tác.</p>
                    </div>
                    <div class="box-detail">
                        <p class="header-detail">Đối với nhân viên</p>
                        <p>Tạo dựng một môi trường làm việc chuyên nghiệp, năng động, sáng tạo và cơ hội phát triển cho tất cả nhân viên.</p>
                    </div>
                    <div class="box-detail">
                        <p class="header-detail">Đối với xã hội</p>
                        <p>Hài hòa lợi ích doanh nghiệp với lợi ích xã hội; đóng góp tích cực vào các hoạt động hướng về cộng đồng.</p>
                    </div>
                </div>
            </div>
            <div class="box-content">
                <h4 class="header-title">Các lĩnh vực kinh doanh</h4>
                <div class="detail linh-vuc-kinh-doanh">
                    <div class="box-detail">
                        <p class="header-detail">Giải pháp CNTT dành cho doanh nghiệp</p>
                        <p>Triển khai hạ tầng, camera, wifi diện rộng, hệ thống máy chủ, sao lưu và phục hồi dữ liệu, cung cấp máy tính cho doanh nghiệp.</p>
                    </div>
                    <div class="box-detail">
                        <p class="header-detail">Bán buôn bán lẻ thiết bị điện tử</p>
                        <p>Cung cấp các thiết bị điện tử, máy tính, laptop, PC, các linh kiện điện tử tới người tiêu dùng</p>
                    </div>
                    <div class="box-detail">
                        <p class="header-detail">Sửa chữa máy tính, laptop</p>
                        <p>Sửa chữa, khắc phục phần cứng, phần mền thiết bị máy tính, laptop. Vệ sinh bảo dưỡng định kì, thay thế linh kiện</p>
                    </div>
                    <div class="box-detail">
                        <p class="header-detail">Tư vấn lắp đặt, bảo trì hệ thống camera</p>
                        <p>Tư vấn và lắp đặt hệ thống camera cho gia đình và doanh nghiệp.</p>
                    </div>
                    <div class="box-detail">
                        <p class="header-detail">Sửa chữa đổ mực máy in</p>
                        <p>Cung cấp, thay mực cho máy in các loại</p>
                    </div>
                    <div class="box-detail">
                        <p class="header-detail">Cung cấp nhân sự IT</p>
                        <p>Cung cấp, cho thuê nhân sự hỗ trợ giải quyết vấn đề hệ thống IT doanh nghiệp.</p>
                    </div>
                </div>
            </div>
            <div class="box-content">
                <h4 class="header-title">Đối tác của IT24H</h4>
                <div class="detail su-menh">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('frontend.layouts.footer', [$posts_footer])
@endsection
