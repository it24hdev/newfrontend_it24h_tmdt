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
      foreach ($rows as $key => $col) {
        $exists = db::table('admin_menu_items')->where('ma',$col[1])->where('menu',$this->menu)->first();
        if(!empty($exists)){
            $MenuItems =  MenuItems::find($exists->id);
            $MenuItems->label    = $col[0];
            if(!empty($col[3]))
            {$MenuItems->depth    = $col[3];}
            else
            {$MenuItems->depth    = 0;}
            $cate_code = Category::where("ma" , $col[4])->first();
            if(!empty($cate_code)){
              $MenuItems->link           = $cate_code->slug;
              $MenuItems->category_code  = $cate_code->ma;
              $MenuItems->category_id    = $cate_code->id;
            }
           
            if($col[2] !== ""){
              $code  = $col[2];
              $cate  = MenuItems::where("ma" , $code)->first();
              if(!empty($cate)){
                $MenuItems->parent = $cate->id;
              }
            }

            if($col[5] == 1){
                $MenuItems->filter_by = 1;
                $MenuItems->filter_value=$col[6];
              }
              elseif ($col[5] == 2) {
                $MenuItems->filter_by = 2;
                $MenuItems->filter_value=$col[6];
              }
              elseif ($col[5] == 3) {
                $MenuItems->filter_by = 3;
              }
              else{
                $MenuItems->filter_by = 0;
              }
              if(!empty($col[7])){
                $MenuItems->sort = $col[7];
              }
              else {
                $MenuItems->sort = 0;
              }
                $MenuItems->save();
            }
        else{

            $MenuItems = new MenuItems();
            $MenuItems->label    = $col[0];
            $MenuItems->ma       = $col[1];
            $MenuItems->menu     = $this->menu;

            if(!empty($col[3]))
            {
              $MenuItems->depth    = $col[3];
            }
            else
            { 
              $MenuItems->depth    = 0;
            }
            // $cate_code = Category::where("ma" , $col[4])->first();
            // if(!empty($cate_code)){
            //   $MenuItems->link           = $cate_code->slug;
            //   $MenuItems->category_code  = $cate_code->ma;
            //   $MenuItems->category_id    = $cate_code->id;
            // }
              $cha ="";
            if($col[2] !== ""){
              $code  = $col[2];
              $cha = MenuItems::where('ma',$code)->first();
              if(!empty($cha)){
                $MenuItems->parent = $cha->id;
              }
              // else{
              //   $MenuItems->parent = null;
              // }
            }

              // if($col[5] == 1){
              //   $MenuItems->filter_by = 1;
              //   $MenuItems->filter_value=$col[6];
              // }
              // elseif ($col[5] == 2) {
              //   $MenuItems->filter_by = 2;
              //   $MenuItems->filter_value=$col[6];
              // }
              // elseif ($col[5] == 3) {
              //   $MenuItems->filter_by = 3;
              // }
              // else{
              //   $MenuItems->filter_by = 0;
              // }
              if($col[7]!= ""){
                $MenuItems->sort = $col[7];
              }
              else {
                $MenuItems->sort = 0;
              }
              

              if($MenuItems->link ==null){
                $MenuItems->link = "#";
              }

              // if($col[7] = '51'){
              //   dd($col,$MenuItems, $cha, $col[2] );
              // }
              
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
