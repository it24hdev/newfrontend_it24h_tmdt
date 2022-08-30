<div style="width:600px;margin:0px auto;padding:15px;background-color:#ffffff">
    <div style="width:100%;clear:both">
        <p style="display:block;font-size:14px;color:#333333;margin:0px 0px 15px;line-height:20px"><strong>Cảm ơn Quý
                khách {{$info_order['customer_name']}} đã đặt hàng tại IT24H.</strong></p>
        <p style="display:block;font-size:14px;color:#333333;margin:0px 0px 10px;line-height:20px">IT24H rất vui
            được thông báo đơn hàng&nbsp;<strong
                style="font-family:Arial,sans-serif;text-transform:uppercase">#IT24H{{$orders['code_order']}}</strong> của Quý khách đã được
            tiếp nhận và đang trong quá trình xử lý. IT24H sẽ thông báo cho Quý khách khi đơn hàng chuẩn bị giao
            hàng.</p>
        <p style="margin:10px 0px;font-size:14px;font-weight:700;text-transform:uppercase">Thông tin đơn hàng:
            <strong><span
                    style="font-size:14px;font-style:normal;font-weight:700;letter-spacing:normal;text-transform:uppercase;white-space:normal">#IT24H{{$orders['code_order']}}</span></strong>
        </p>
    </div>
    <div style="margin:15px 0px 25px;clear:both;display:block;width:100%;overflow:hidden;border:1px solid #cccccc">
        <div style="width:100%;float:left;display:inline-block;min-height:160px">
            <h2
                style="width:100%;color:#ffffff;font-size:14px;padding:10px;margin:0px;font-weight:500;text-transform:uppercase;background:none 0% 0% repeat scroll #ed1c24">
                <span>THÔNG TIN GIAO HÀNG</span>
            </h2>
            <p style="text-indent:15px;margin-top:10px">Người nhận hàng: {{$info_order['customer_name']}}</p>
            <p style="text-indent:15px">Địa chỉ: {{$info_order['address']}}</p>
            <p style="text-indent:15px">Điện thoại: {{$info_order['phone_number']}}</p>
            <p style="text-indent:15px">Email: <a href="mailto{{$info_order['email']}}"
                    target="_blank">{{$info_order['email']}}</a></p>
        </div>
    </div>
    <div style="width:100%;float:left;display:block">
        <h3 style="display:block;font-size:16px;margin:0px;line-height:24px">Thông tin ghi chú: </h3>
        <p style="margin:0px 0px 30px"><span style="line-height:1.42857">Phương thức thanh toán:&nbsp;</span><strong
                style="font-size:12px">{{$info_order['payment_method']}}&nbsp;</strong></p>
    </div>
    <table style="width:100%;border-collapse:collapse;border-spacing:0px">
        <thead>
            <tr style="border:1px solid #001530;background:#001530">
                <th
                    style="border:1px solid #e6e6e6;text-align:center;color:#ffffff;font-size:14px;font-weight:500;text-transform:uppercase;height:32px;width:40%;background:none 0% 0% repeat scroll #ff0000">
                    Sản phẩm</th>
                <th
                    style="border:1px solid #e6e6e6;text-align:center;color:#ffffff;font-size:14px;font-weight:500;text-transform:uppercase;height:32px;width:20%;background:none 0% 0% repeat scroll #ff0000">
                    Giá sản phẩm</th>
                <th
                    style="border:1px solid #e6e6e6;text-align:center;color:#ffffff;font-size:14px;font-weight:500;text-transform:uppercase;height:32px;width:20%;background:none 0% 0% repeat scroll #ff0000">
                    Số lượng</th>
                <th
                    style="border:1px solid #e6e6e6;text-align:center;color:#ffffff;font-size:14px;font-weight:500;text-transform:uppercase;height:32px;width:20%;background:none 0% 0% repeat scroll #ff0000">
                    Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders['products'] as $product)
            <tr>
                <td style="text-align:left;background:#e5e5e5;padding:5px;font-weight:700">{{$product->product_name}}</td>
                <td style="text-align:center;background:#e5e5e5;padding:5px">{{number_format($product->price, 0, '', '.')}}đ</td>
                <td style="text-align:center;background:#e5e5e5;padding:5px">{{$product->quantity}}</td>
                <td style="text-align:right;background:#e5e5e5;padding:5px 10px 0 0">{{number_format((($product->price) * ($product->quantity)), 0, '', '.')}}đ</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" style="width:100%;text-align:right;background-color:#e5e5e5;padding:5px 0">
                    <span style="line-height:1.42857;width:200px;display:inline-block">Tổng giá trị sản phẩm: </span>
                    <span style="line-height:1.42857;width:150px;display:inline-block;margin-right:10px">{{number_format($info_order['total'], 0, '', '.')}}đ</span>
                </td>
            </tr>
            <tr>
                <td colspan="5" style="width:100%;text-align:right;background-color:#e5e5e5;padding:5px 0">
                    <span style="line-height:1.42857;width:200px;display:inline-block">Phí vận chuyển: </span>
                    <span style="line-height:1.42857;width:150px;display:inline-block;margin-right:10px">0 ₫</span>
                </td>
            </tr>
            <tr>
                <td colspan="5" style="width:100%;text-align:right;background-color:#e5e5e5;padding:5px 0">
                    <span style="line-height:1.42857;width:200px;display:inline-block">Phí dịch vụ: </span>
                    <span style="line-height:1.42857;width:150px;display:inline-block;margin-right:10px">0 ₫</span>
                </td>
            </tr>
            <tr>
                <td colspan="5" style="width:100%;text-align:right;background-color:#e5e5e5;padding:5px 0">
                    <span style="line-height:1.42857;width:200px;display:inline-block">Giảm giá: </span>
                    <span style="line-height:1.42857;width:150px;display:inline-block;margin-right:10px">0 ₫</span>
                </td>
            </tr>
            <tr>
                <td colspan="5"
                    style="width:100%;font-weight:bold;text-align:right;background-color:#c9c4cc;padding:10px 0">
                    <span style="line-height:1.42857;width:200px;display:inline-block">Tổng giá trị đơn hàng: </span>
                    <span style="line-height:1.42857;width:150px;display:inline-block;margin-right:10px">{{number_format($info_order['total'], 0, '', '.')}}đ</span>
                </td>
            </tr>
        </tfoot>
    </table>
    <div style="width:100%;clear:both;display:block;overflow:hidden;margin:30px 0px 0px">
        <p style="display:block;font-size:14px;color:#333333;margin:0px 0px 5px;line-height:20px"><span
                style="font-family:Arial,sans-serif">Nếu cần hỗ trợ, Quý khách chỉ cần gửi email đến <a
                    href="mailto:ismart.project.trungdung@gmail.com" target="_blank">ismart.project.trungdung@gmail.com</a> hoặc gọi số <strong>0982659446</strong>.</span></p>
        <p style="display:block;font-size:14px;color:#333333;margin:0px 0px 5px;line-height:20px">Cảm ơn Quý
            Khách!&nbsp;</p>
    </div>
</div>
