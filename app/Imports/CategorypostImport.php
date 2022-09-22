<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategorypostImport implements ToCollection, SkipsEmptyRows, WithStartRow, WithValidation
{
    use Importable;

    public function __construct()
    {
        ini_set('max_execution_time', 1800);
    }
  
    public function collection(Collection $rows)
    {
      foreach ($rows as $row) {
        $exists = db::table('categories')->where('ma',$row[0])->where('taxonomy',1)->first();
        if(!empty($exists)){
          $parent_id = "";
          if($row[1] !== ""){
            $code  = $row[1];
            $cate  = Category::where("ma" , $code)->where('taxonomy',1)->first();
            if(!empty($cate)){
              $parent_id = $cate->id;
            }
          }
          DB::table('categories')->where('id', $exists->id)
          ->update([
            'name' => $row[2],
            'name2'=> $row[3],
            'slug' => Str::slug( $row[2], '-'),
            'taxonomy' => 1,
            'deleted_at' => null,
            'parent_id' => $parent_id,
          ]);
        }
        else{
        $Category = new Category();
        $Category->ma       = $row[0];
        $Category->name     = $row[2];
        $Category->name2    = $row[3];
        $Category->slug     = Str::slug( $row[2], '-');
        $Category->taxonomy = 1;
        if($row[1] !== ""){
          $code  = $row[1];
          $cate  = Category::where("ma" , $code)->where('taxonomy',1)->first();
          if(!empty($cate)){
            $Category->parent_id = $cate->id;
          }
        }
        $Category->save();
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
           // '*.0' => 'unique:categories,ma,NULL, deleted_at',
      ];
    }

}
