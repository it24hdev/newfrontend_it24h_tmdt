<?php

namespace App\Exports;

use App\Models\Detailproperties;
use App\Models\Categoryproperty;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PropertyExport implements FromCollection, WithHeadings
{
    public function __construct()
    {
        ini_set('max_execution_time', 1800);
    }
    public function collection()
    {

        $Detailproperties =  Detailproperties::select(DB::raw('categoryproperties_code as type'),"ma", "name");
        $Categoryproperty = Categoryproperty::select( DB::raw('"" as type'),"ma", "name")
        
        ->unionall($Detailproperties)
        ->get();
        return $Categoryproperty;
    }

    public function headings(): array
    {
        return ["Thuộc tính","Mã", "Tên"];
    }
}
