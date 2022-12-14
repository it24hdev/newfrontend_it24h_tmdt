<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategoryExport implements FromCollection, WithHeadings
{  
    public function __construct()
    {
        ini_set('max_execution_time', 1800);
    }

    public function collection() 
    {
        // return

        $categories = Category::select("name","ma","parent_id",)->where('taxonomy',0)->whereNull('deleted_at')->get();

        foreach($categories as $category){

            if($category->parent_id != null){
                 $category_code  = Category::where('taxonomy',0)->where('id',$category->parent_id)->first();
                 $category->parent_id = $category_code->ma;
            }
        }
        return $categories;
    }

    public function headings(): array
    {
        return ["Tên danh mục" ,"Mã", "Danh mục cha"];
    }
}
