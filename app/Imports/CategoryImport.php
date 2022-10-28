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

class CategoryImport implements ToCollection, SkipsEmptyRows, WithStartRow, WithValidation
{
    use Importable;

    public function __construct()
    {
      ini_set('max_execution_time', 1800);
    }
  
    public function collection(Collection $rows)
    {
      foreach ($rows as $row) {
        $exists = db::table('categories')->where('ma',$row[1])->where('taxonomy',0)->first();

        $cate_slug = Str::slug( $row[0], '-');
        
        if(!empty($exists)){
          $exists_slug = db::table('categories')->where('slug',$cate_slug)->where('id','<>',$exists->id)->where('taxonomy',0)->first();
          $parent_id = "";
          if($row[2] !== ""){
            $code  = $row[2];
            $cate  = Category::where("ma" , $code)->where('taxonomy',0)->first();
            if(!empty($cate)){
              $parent_id = $cate->id;
            }
          }
          $slug ="";
          if(!empty($exists_slug)){
          $slug   = Str::slug( $row[0], '-').'-'.Str::random(3);
          }
          else{
            $slug     = Str::slug( $row[0], '-');
          }
          DB::table('categories')->where('id', $exists->id)
          ->update([
            'name' => $row[0],
            'slug' => $slug,
            'taxonomy' => 0,
            'deleted_at' => null,
            'parent_id' => $parent_id,
          ]);
        }
        else{
        $exists_slug = db::table('categories')->where('slug',$cate_slug)->where('taxonomy',0)->first();
        $Category = new Category();
        $Category->ma       = $row[1];
        $Category->name     = $row[0];

        if(!empty($exists_slug)){
          $Category->slug   = Str::slug( $row[0], '-').'-'.Str::random(3);
        }
        else{
          $Category->slug     = Str::slug( $row[0], '-');
        }
        $Category->taxonomy = 0;
        if($row[2] !== ""){
          $code  = $row[2];
          $cate  = Category::where("ma" , $code)->where('taxonomy',0)->first();
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
