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

        $exists = db::table('categories')->where('ma',$row[0])->first();
        if(!empty($exists)){
          $parent_id = "";
          if($row[3] !== ""){
            $code  = $row[3];
            $cate  = Category::where("ma" , $code)->first();
            if(!empty($cate)){
              $parent_id = $cate->id;
            }
          }
          DB::table('categories')->where('id', $exists->id)
          ->update([
            'name' => $row[1],
            'name2'=> $row[2],
            'slug' => Str::slug( $row[1], '-'),
            'taxonomy' => 1,
            'deleted_at' => null,
            'parent_id' => $parent_id,
          ]);
        }
        else{
        $Category = new Category();
        $Category->ma       = $row[0];
        $Category->name     = $row[1];
        $Category->name2    = $row[2];
        $Category->slug     = Str::slug( $row[1], '-');
        $Category->taxonomy = 1;
        if($row[3] !== ""){
          $code  = $row[3];
          $cate  = Category::where("ma" , $code)->first();
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
