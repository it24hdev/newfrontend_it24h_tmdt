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

    public function __construct()
    {
        ini_set('max_execution_time', 1800);
    }
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
              'ma'      =>   $row[0],
              'name'      =>   $row[1],
              'price'     =>   $row[2],
              'quantity'  =>   $row[3],
              'unit'      =>   $row[4],
              'brand'     =>   $row[5],
              'property'  =>   $row[6],
              'still_stock'     =>   $row[7],
              'short_content'   =>   $row[8],
              'gift'      =>   $row[9],
              'content'   =>   $row[10],
              'slug'      =>   Str::slug( $row[1], '-'),
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
          '*.0' => 'unique:products,ma',
      ];
    }

}
