<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategoryExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Category::select("name", "name2", "slug", "taxonomy", "parent_id", "user_id", "icon", "status", "thumb", "banner", "show_push_product")->get();
    }

    public function headings(): array
    {
        return ["name", "name2", "slug", "taxonomy", "parent_id", "user_id", "icon", "status", "thumb", "banner", "show_push_product"];
    }
}
