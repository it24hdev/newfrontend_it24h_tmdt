<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategorypostExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Category::select("name","name2")->where('taxonomy',1)->whereNull('deleted_at')->get();
    }

    public function headings(): array
    {
        return ["Tên danh mục", "Tên danh mục (ngoại ngữ)"];
    }
}
