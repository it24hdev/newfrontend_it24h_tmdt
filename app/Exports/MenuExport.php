<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Http\Controllers\laravelmenu\src\Models\MenuItems;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MenuExport implements FromCollection, WithHeadings
{  
    protected $menu;
    public function __construct($menu)
    {
        ini_set('max_execution_time', 1800);
        $this->menu = $menu;
    }

    public function collection() 
    {
        // return

        $MenuItems = MenuItems::select("ma","parent","label","depth")->where('menu',$this->menu)->get();

        foreach($MenuItems as $items){

            if($items->parent_id != null){
                 $MenuItems_code  = MenuItems::where('id',$items->parent_id)->where('menu',$this->menu)->first();
                 $items->parent_id = $items->ma;
            }
        }
        return $MenuItems;
    }

    public function headings(): array
    {
        return ["Mã" ,"Danh mục cha", "Tên danh mục", "Cấp"];
    }
}
