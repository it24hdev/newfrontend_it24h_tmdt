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
      // Schema::table('admin_menu_items', function (Blueprint $table) {
      //   $table->dropForeign('admin_menu_items_menu_foreign');
      // });
      foreach ($rows as $row) {
        // $exists = db::table('admin_menu_items')->where('ma',$row[0])->where('menu',$this->menu)->first();
        // if(!empty($exists)){
        //   $parent = "";
        //   if($row[1] !== ""){
        //     $code  = $row[1];
        //     $cate  = MenuItems::where("ma" , $code)->first();
        //     if(!empty($cate)){
        //       $parent = $cate->id;
        //     }
        //   }
        //   $category_id ="";
        //   if($row[0] !== ""){
        //     $code2  = $row[0];
        //     $cate2  = Category::where("ma" , $code2)->first();
        //     if(!empty($cate2)){
        //       $category_id = $cate2->id;
        //     }
        //   }
        //   $depth ="";
        //   if(!empty($row[3]))
        //   {$depth    = $row[3];}
        //   else
        //   {$depth    = 0;}
        //   DB::table('admin_menu_items')->where('id', $exists->id)
        //   ->update([
        //     'label' => $row[2],
        //     'link' => Str::slug( $row[2], '-'),
        //     'parent' => $parent,
        //     'category_id' => $category_id,
        //     'depth'  => $row[3],
        //   ]);
        // }
        
        // else{
        $MenuItems = new MenuItems();
        $MenuItems->ma       = $row[0];
        $MenuItems->menu     = $this->menu;
        $MenuItems->label    = $row[2];
        if(!empty($row[3]))
        {$MenuItems->depth    = $row[3];}
        else
        {$MenuItems->depth    = 0;}
        $MenuItems->link     = Str::slug( $row[2], '-');
        if($row[1] !== ""){
          $code  = $row[1];
          $cate  = Category::where("ma" , $code)->first();
          if(!empty($cate)){
            $MenuItems->parent = $cate->id;
          }
        }

        if($row[0] !== ""){
          $code2  = $row[0];
          $cate2  = Category::where("ma" , $code2)->first();
          if(!empty($cate2)){
            $MenuItems->category_id = $cate2->id;
          }
        }
        $MenuItems->save();
        }  
      // }
      // Schema::table('admin_menu_items', function (Blueprint $table) {
      //   $table->foreign('menu')->references('id')->on(config('menu.table_prefix') . config('menu.table_name_menus'))
      //     ->onDelete('cascade')
      //     ->onUpdate('cascade');
      // });
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
