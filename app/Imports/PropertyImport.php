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
        if($row[0] != ""){
            $Categoryproperty = Categoryproperty::where('ma',$row[0])->first();

            $exists = db::table('detailproperties')->where('ma',$row[1])->first();

            if(!empty($exists)){

                $Detailproperties = Detailproperties::find($exists->id);
                $Detailproperties->name     = $row[1];
                $Detailproperties->categoryproperties_id  = $Categoryproperty->id;
                $Detailproperties->categoryproperties_code  = $row[0];
                $Detailproperties->save();
            }
            else{ 

                $Detailproperties = new Detailproperties();
                $Detailproperties->ma       = $row[1];
                $Detailproperties->name     = $row[2];
                $Detailproperties->categoryproperties_id  = $Categoryproperty->id;
                $Detailproperties->categoryproperties_code  = $row[0];
                $Detailproperties->save();
            }
        }
        else{
            $exists = db::table('categoryproperties')->where('ma',$row[1])->first();
            if(!empty($exists)){
                $Categoryproperty = Categoryproperty::find($exists->id);
                $Categoryproperty->name     = $row[2];
                $Categoryproperty->save();
            }
            else{
                $Categoryproperty = new Categoryproperty();
                $Categoryproperty->ma       = $row[1];
                $Categoryproperty->name     = $row[2];
                $Categoryproperty->save();
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
