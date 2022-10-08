<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Brand;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BrandExport implements FromCollection, WithHeadings
{
    public function __construct()
    {
        ini_set('max_execution_time', 1800);
    }
    public function collection()
    {
        return Brand::select("ma", "name")->get();
    }

    public function headings(): array
    {
        return ["Mã thương hiệu", "Tên thương hiệu"];
    }
}
