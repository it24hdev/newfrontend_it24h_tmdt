<div style="width:800px;margin:0px auto;padding:15px;background-color:#ffffff">
    <div style="width:100%;clear:both">
        <p style="display:block;font-size:14px;color:#333333;margin:0px 0px 15px;line-height:20px"><strong>Cảm ơn Quý khách đã đặt hàng tại IT24H.</strong></p>
        <p style="display:block;font-size:14px;color:#333333;margin:0px 0px 10px;line-height:20px">IT24H rất vui được thông báo đơn hàng&nbsp;
            <strong style="font-family:Arial,sans-serif;text-transform:uppercase">
                                #{{$info_cus['id']}}
            </strong> của Quý khách đã được tiếp nhận và đang trong quá trình xử lý. IT24H sẽ thông báo cho Quý khách khi đơn hàng chuẩn bị giao hàng.</p>
        <p style="margin:10px 0px;font-size:14px;font-weight:700;text-transform:uppercase">Thông tin đơn hàng:
            <strong>
                <span style="font-size:14px;font-style:normal;font-weight:700;letter-spacing:normal;text-transform:uppercase;white-space:normal">
                    #{{$info_cus['id']}}
                </span>
            </strong>
        </p>
    </div>
    <div style="margin:15px 0px 25px;clear:both;display:block;width:100%;overflow:hidden;border:1px solid #cccccc">
        <div style="width:100%;float:left;display:inline-block;min-height:160px">
            <h2 style="width:100%;color:#ffffff;font-size:14px;padding:10px;margin:0px;font-weight:500;text-transform:uppercase;background:none 0% 0% repeat scroll #1d94ff">
                <span>THÔNG TIN GIAO HÀNG</span>
            </h2>
            <p style="text-indent:15px;margin-top:10px">Người nhận hàng: {{$info_cus['customer_name']}}</p>
            <p style="text-indent:15px">Địa chỉ: {{$info_cus['address']}}</p>
            <p style="text-indent:15px">Điện thoại: {{$info_cus['phone_number']}}</p>
            <p style="text-indent:15px">Email: <a href="mailto{{$info_cus['email']}}" target="_blank">{{$info_cus['email']}}</a></p>
            @if($info_cus['tax_code'])
                <p style="text-indent:15px">Tên công ty: {{$info_cus['name_company']}}</p>
                <p style="text-indent:15px">Địa chỉ công ty: {{$info_cus['address_company']}}</p>
                <p style="text-indent:15px">Mã số thuế: {{$info_cus['tax_code']}}</p>
                <p style="text-indent:15px">Email công ty: {{$info_cus['email_company']}}</p>
            @endif
        </div>
    </div>
    <div style="width:100%;float:left;display:block">
        <h3 style="display:block;font-size:16px;margin:0px;line-height:24px">Thông tin ghi chú: </h3>
        <p style="margin:0px"><span style="line-height:1.42857">Phương thức thanh toán:&nbsp;</span>
            <strong
                style="font-size:12px">  {{$info_cus['payment_method']}}&nbsp;
            </strong>
        </p>
        @if ($info_cus['payment_method'] == 'Chuyển khoản')
            <p style="margin:0px 0px 30px">Quý khách vui lòng thanh toán theo số tài khoản hướng dẫn dưới đây để hoàn tất việc đặt hàng.</p>
            <div style="width:100%;float:left;display:inline-block;min-height:160px; margin-bottom: 30px;">
                <h2 style="width:100%;color:#ffffff;font-size:14px;padding:10px;margin:0px;font-weight:500;text-transform:uppercase;background:none 0% 0% repeat scroll #1d94ff">
                    <span>Thông tin chuyển khoản</span>
                </h2>
                <p style="text-indent:15px;margin-top:10px">Ngân hàng techcombank - chi nhánh Lê Chân - Hải Phòng</p>
                <p style="text-indent:15px">Số tài khoản: 19036993513011</p>
                <p style="text-indent:15px">Người nhận: PHAM THI THU CUC</p>
                <p style="text-indent:15px">Nội dung chuyển khoản: <span>{{$info_cus['customer_name']}} thanh toán đơn hàng #{{$info_cus['id']}}</span></p>
            </div>
        @endif

    </div>
    <table style="width:100%;border-collapse:collapse;border-spacing:0px">
        <thead>
        <tr style="border:1px solid #001530;background:#001530">
            <th
                style="border:1px solid #e6e6e6;text-align:center;color:#ffffff;font-size:14px;font-weight:500;text-transform:uppercase;height:32px;width:40%;background:none 0% 0% repeat scroll #1d94ff">
                Tên sản phẩm
            </th>
            <th
                style="border:1px solid #e6e6e6;text-align:center;color:#ffffff;font-size:14px;font-weight:500;text-transform:uppercase;height:32px;width:20%;background:none 0% 0% repeat scroll #1d94ff">
                Giá bán
            </th>
            <th
                style="border:1px solid #e6e6e6;text-align:center;color:#ffffff;font-size:14px;font-weight:500;text-transform:uppercase;height:32px;width:20%;background:none 0% 0% repeat scroll #1d94ff">
                Số lượng
            </th>
            <th
                style="border:1px solid #e6e6e6;text-align:center;color:#ffffff;font-size:14px;font-weight:500;text-transform:uppercase;height:32px;width:20%;background:none 0% 0% repeat scroll #1d94ff">
                Tổng
            </th>
        </tr>
        </thead>
        <tbody>
            @foreach ($info_cart as $item)
            <tr>
                <td style="text-align:left;background:#fff;padding:5px;font-weight:700;border: 1px solid #ebebeb;">{{$item->product_name}}</td>
                <td style="text-align:center;background:#fff;padding:5px;border: 1px solid #ebebeb;">{{number_format($item->price, 0, '', '.')}} VNĐ</td>
                <td style="text-align:center;background:#fff;padding:5px;border: 1px solid #ebebeb;">{{$item->quantity}}</td>
                <td style="text-align:right;background:#fff;padding:5px 10px 0 0;border: 1px solid #ebebeb;">{{number_format((($item->price) * ($item->quantity)), 0, '', '.')}} VNĐ</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="5" style="width:100%;text-align:right;background-color:#fff;padding:5px 0;border: 1px solid #ebebeb;">
                <span style="line-height:1.42857;width:200px;display:inline-block">Phí vận chuyển: </span>
                <span style="line-height:1.42857;width:150px;display:inline-block;margin-right:10px">0 VNĐ</span>
            </td>
        </tr>
        <tr>
            <td colspan="5" style="width:100%;text-align:right;background-color:#fff;padding:5px 0;border: 1px solid #ebebeb;">
                <span style="line-height:1.42857;width:200px;display:inline-block">Giảm giá: </span>
                <span style="line-height:1.42857;width:150px;display:inline-block;margin-right:10px">0 VNĐ</span>
            </td>
        </tr>
        <tr>
            <td colspan="5"
                style="width:100%;font-weight:bold;text-align:right;background-color:#ededed;padding:10px 0;border: 1px solid #ebebeb;">
                <span style="line-height:1.42857;width:200px;display:inline-block">Thành tiền: </span>
                <span style="line-height:1.42857;width:150px;display:inline-block;margin-right:10px">{{number_format($info_cus['total'], 0, '', '.')}} VNĐ</span>
            </td>
        </tr>
        </tfoot>
    </table>
    <div style="width:100%;clear:both;display:block;overflow:hidden;margin:30px 0px 0px">
        <p style="display:block;font-size:14px;color:#333333;margin:0px 0px 5px;line-height:20px">
            <span style="font-family:Arial,sans-serif">Nếu cần hỗ trợ, Quý khách chỉ cần gửi email đến
                <a href="mailto:contact@it24h.vn" target="_blank">contact@it24h.vn</a> hoặc gọi số <strong> <tel>0886.776.286</tel></strong>.</span></p>
        <p style="display:block;font-size:14px;color:#333333;margin:0px 0px 5px;line-height:20px">Cảm ơn Quý Khách!&nbsp;</p>
    </div>
</div>
