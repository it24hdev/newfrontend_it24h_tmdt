<?php

namespace App\Imports;

use App\Models\Products;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Str;

class ProductImport implements ToCollection, SkipsEmptyRows, WithStartRow, WithValidation
{
    use Importable;
  
     public function collection(Collection $rows)
    {
      // $data = $rows->toArray();
      //   $validate = Validator::make($data , [
      //        '*.0' => 'unique:categories,name|required',
      //    ],
      //    [
      //       '*.0.unique' => 'Tên danh mục đã tồn tại. ',
      //       '*.0.required' => 'Tên danh mục trống ',
      //    ]
      // )->validate();
        foreach ($rows as $row) {
            $data = [
              'name'      =>   $row[0],
              'price'     =>   $row[1],
              'quantity'  =>   $row[2],
              'unit'      =>   $row[3],
              'brand'     =>   $row[4],
              'property'  =>   $row[5],
              'still_stock'     =>   $row[6],
              'short_content'   =>   $row[7],
              'gift'      =>   $row[8],
              'content'   =>   $row[9],
              'slug'      =>   Str::slug( $row[0], '-'),
            ];
            // dd($data);
         Products::create($data);
         }
    }

    public function startRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
      return [
          '*.0' => 'unique:products,name',
      ];
    }

}
