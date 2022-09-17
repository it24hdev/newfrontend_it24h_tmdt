<?php

namespace App\Imports;
use App\Models\Category;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Hash;
class CategoryImport implements ToCollection, ToModel, WithHeadingRow
{
   public function model(array $row){
        return new Category([
        'name'      =>   $row['name'],
        'name2'     =>   $row['name2'],
        'slug'      =>   $row['slug'],
        'taxonomy'  =>   $row['taxonomy'],
        'parent_id' =>   $row['parent_id'],
        'user_id'   =>   $row['user_id'],
        'icon'      =>   $row['icon'],
        'status'    =>   $row['status'],
        'thumb'     =>   $row['thumb'],
        'banner'    =>   $row['banner'],
        'show_push_product' =>   $row['show_push_product'],
        ]);
   }
}
