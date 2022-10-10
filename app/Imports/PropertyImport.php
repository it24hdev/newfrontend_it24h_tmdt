<?php

namespace App\Imports;

use App\Models\Detailproperties;
use App\Models\Categoryproperty;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class PropertyImport implements ToCollection, SkipsEmptyRows, WithStartRow, WithValidation
{
    use Importable;

    public function __construct()
    {
        ini_set('max_execution_time', 1800);
    }
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
        if($row[0] == 1){
            $exists = db::table('brands')->where('ma',$row[0])->first();
            if(!empty($exists)){
                $Products = Brands::find($exists->id);
                $Products->name     = $row[1];
                $Products->save();
            }
            else{
                $Brands = new Brand();
                $Brands->ma       = $row[0];
                $Brands->name     = $row[1];
                $Brands->save();
            }
        }

        else{
            $exists = db::table('brands')->where('ma',$row[0])->first();
            if(!empty($exists)){
                $Products = Brands::find($exists->id);
                $Products->name     = $row[1];
                $Products->save();
            }
            else{
                $Brands = new Brand();
                $Brands->ma       = $row[0];
                $Brands->name     = $row[1];
                $Brands->save();
            }

        } 
      }
    }

    public function startRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
      return [
          // '*.0' => 'unique:products,ma',
      ];
    }

}
