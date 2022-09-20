<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategoryExport implements FromCollection, WithHeadings
{
    public function collection() 
    {
        return Category::select("ma","name","name2")->where('taxonomy',0)->whereNull('deleted_at')->get();
    }

    public function headings(): array
    {
        return ["Mã" , "Tên danh mục", "Tên danh mục (ngoại ngữ)"];
    }
}
