<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Products;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Products::select("ma", "name", "price", "quantity", "unit", "brand", "property", "still_stock", "short_content", "gift", "content")->where('status',1)->whereNull('deleted_at')->get();
    }

    public function headings(): array
    {
        return ["Mã", "Tên sản phẩm", "Giá bán", "Số lượng", "Đơn vị tính", "Thương hiệu", "Thuộc tính sản phẩm", "Tình trạng sản phẩm", "Mô tả ngắn", "Nội dung quà tặng ưu đãi", "Nội dung"];
    }
}
