<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Products;
use App\Models\Brand;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithHeadings
{
    public function __construct()
    {
        ini_set('max_execution_time', 1800);
    }
    public function collection()
    {
        $Products = Products::select("ma", "name","price", "price_onsale", "onsale", "quantity", "cat_id", "brand", "short_content", "gift", "content", "warranty", "tax")->where('status',1)->whereNull('deleted_at')->get();
        foreach($Products as $items){
           $brand = Brand::where('id',$items->brand)->first();
           if(!empty($brand)){
            $items->brand = $brand->name;
           }
           $cat_ma ="";
           if(!empty($items->cat_id)){
                $cats = json_decode($items->cat_id);
                foreach($cats as $cat){
                $categories = Category::where('id',$cat)->first();
                if(!empty($categories)){
                    $cat_ma =  $cat_ma.",".$categories->ma;
                }
               }
               $items->cat_id = trim($cat_ma,',');
            }
        }

        return $Products;
    }

    public function headings(): array
    {
        return ["Mã sản phẩm", "Tên sản phẩm", "Giá bán","Giá tham khảo","Giảm giá %", "Số lượng", "Danh mục", "Thương hiệu", "Mô tả ngắn", "Nội dung quà tặng ưu đãi", "Nội dung", "Bảo hành", "Thuế"];
    }
}


