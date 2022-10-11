<?php

namespace App\Imports;

use App\Http\Controllers\laravelmenu\src\Models\MenuItems;
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
use App\Models\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class MenuImport implements ToCollection, SkipsEmptyRows, WithStartRow, WithValidation
{
    use Importable;

    protected $menu;
    public function __construct($menu)
    {
        ini_set('max_execution_time', 1800);
        $this->menu = $menu;
    }
    

    public function collection(Collection $rows)
    {
      foreach ($rows as $key => $row) {
        $exists = db::table('admin_menu_items')->where('ma',$row[1])->where('menu',$this->menu)->first();
        if(!empty($exists)){
            $MenuItems =  MenuItems::find($exists->id);
            $MenuItems->label    = $row[0];
            if(!empty($row[3]))
            {$MenuItems->depth    = $row[3];}
            else
            {$MenuItems->depth    = 0;}
            $cate_code = Category::where("ma" , $row[4])->first();
            if(!empty($cate_code)){
              $MenuItems->link           = $cate_code->slug;
              $MenuItems->category_code  = $cate_code->ma;
              $MenuItems->category_id    = $cate_code->id;
            }
            if($row[2] !== ""){
              $code  = $row[2];
              $cate  = MenuItems::where("ma" , $code)->first();
              if(!empty($cate)){
                $MenuItems->parent = $cate->id;
              }
            }

            if($row[5] == 1){
                $MenuItems->filter_by = 1;
                $MenuItems->filter_value=$row[6];
              }
              elseif ($row[5] == 2) {
                $MenuItems->filter_by = 2;
                $MenuItems->filter_value=$row[6];
              }
              elseif ($row[5] == 3) {
                $MenuItems->filter_by = 3;
              }
              else{
                $MenuItems->filter_by = 0;
              }
                $MenuItems->save();
            }
        else {
            $MenuItems = new MenuItems();
            $MenuItems->ma       = $row[1];
            $MenuItems->menu     = $this->menu;
            $MenuItems->label    = $row[0];
            if(!empty($row[3]))
            {
              $MenuItems->depth    = $row[3];
            }
            else
            { 
              $MenuItems->depth    = 0;
            }
            $cate_code = Category::where("ma" , $row[4])->first();
            if(!empty($cate_code)){
              $MenuItems->link           = $cate_code->slug;
              $MenuItems->category_code  = $cate_code->ma;
              $MenuItems->category_id    = $cate_code->id;
            }
            
            if($row[2] !== ""){
              $code  = $row[2];
              $cate  = MenuItems::where("ma" , $code)->first();
              if(!empty($cate)){
                $MenuItems->parent = $cate->id;
              }
            }

            if($row[5] == 1){
                $MenuItems->filter_by = 1;
                $MenuItems->filter_value=$row[6];
              }
              elseif ($row[5] == 2) {
                $MenuItems->filter_by = 2;
                $MenuItems->filter_value=$row[6];
              }
              elseif ($row[5] == 3) {
                $MenuItems->filter_by = 3;
              }
              else{
                $MenuItems->filter_by = 0;
              }
              $MenuItems->save();
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
