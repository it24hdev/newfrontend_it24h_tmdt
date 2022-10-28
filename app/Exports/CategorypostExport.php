<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategorypostExport implements FromCollection, WithHeadings
{
    public function __construct()
    {
        ini_set('max_execution_time', 1800);
    }
    public function collection()
    {
         $categories = Category::select("ma","parent_id","name","name2")->where('taxonomy',1)->whereNull('deleted_at')->get();

        foreach($categories as $category){

            if($category->parent_id != null){
                 $category_code  = Category::where('taxonomy',1)->where('id',$category->parent_id)->first();
                 $category->parent_id = $category_code->ma;
            }
        }
        return $categories;
    }

    public function headings(): array
    {
        return ["Mã","Danh mục cha", "Tên danh mục", "Tên danh mục (ngoại ngữ)"];
    }
}
