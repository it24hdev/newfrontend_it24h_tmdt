<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Http\Controllers\laravelmenu\src\Models\MenuItems;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

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
        $MenuItems = MenuItems::select("label" ,"ma", "parent", "depth", "category_code", "filter_by","filter_value" , "sort")->where('menu',$this->menu)->get();

        foreach($MenuItems as $items){

            if(($items->parent !=0)){
                $MenuItems_code  = MenuItems::where('id',$items->parent)->where('menu',$this->menu)->first();
                $items->parent = $MenuItems_code->ma;
            }
            // if(!empty($items->form_filter)){

            //     $MenuItems2  = MenuItems::where('ma',$items->ma)->where('menu',$this->menu)->first();
            //     if($items->form_filter == 1){
            //         $items->form_filter = "Thuộc tính";
            //         $items->filter_by  = $MenuItems2->property;
            //         dd( $MenuItems2 );
            //     }
            //     elseif ($items->form_filter == 2) {
            //         $items->form_filter  = "Giá";
            //         $items->filter_by = $MenuItems2->min_price.';'.$MenuItems2->max_price;
            //     }
            //     elseif ($items->form_filter == 3) {
            //         $items->form_filter = "Thương hiệu";
            //     }
            //     else{
            //         $items->form_filter = "";
            //     }

            // }
        }

        return $MenuItems;
    }

    public function headings(): array
    {
        return ["Tên", "Mã" , "Mã cha", "Cấp", "Mã DM", "Filter by", "Filter value", "sort"];
    }
}
