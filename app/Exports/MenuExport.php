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
        $MenuItems = MenuItems::select("label" ,"ma", "parent","depth", "category_code", "form_filter", "property" ,"min_price", "max_price")->where('menu',$this->menu)->get();

        foreach($MenuItems as $items){
            if(!empty($items->parent_id)){
                $MenuItems_code  = MenuItems::where('id',$items->parent_id)->where('menu',$this->menu)->first();
                $items->parent_id = $items->ma;
            }
            if(!empty($items->form_filter)){
                $MenuItems  = MenuItems::where('ma',$items->ma)->where('menu',$this->menu)->first();
                if($MenuItems->form_filter == 1){
                    $items->form_filter = "Thuộc tính";
                }
                elseif ($MenuItems->form_filter == 2) {
                    $items->form_filter = "Giá";
                }
                elseif ($MenuItems->form_filter == 3) {
                    $items->form_filter = "Nhãn";
                }
                else{
                    $items->form_filter = "";
                }
            }
        }
        return $MenuItems;
    }

    public function headings(): array
    {
        return ["Tên danh mục", "Mã" ,"Danh mục cha", "Cấp", "Mã DM", "Lọc Theo","Mã Thuộc tính", "Giá thấp nhất", "Giá cao nhất"];
    }
}
