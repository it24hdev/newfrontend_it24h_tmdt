<?php

namespace App\Imports;

use App\Models\Brand;
use App\Models\Products;
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
class ProductImport implements ToCollection, SkipsEmptyRows, WithStartRow, WithValidation
{
    use Importable;

    public function __construct()
    {
        ini_set('max_execution_time', 1800);
    }
         public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
        $exists = db::table('products')->where('ma',$row[0])->first();
        if(!empty($exists)){
            $Products = Products::find($exists->id);
            // $Products->ma       = strtoupper(Str::random(6));
            $Products->name     = $row[1];
            
            if($row[3]!=""){
                $Products->price    = $row[3];
                $Products->price_onsale    = $row[2];
                $Products->onsale    = $row[4];
            }
            else{
                $Products->onsale    = $row[3];
                $Products->price_onsale    = 0;
                $Products->onsale    = 0;
            }
            $Products->quantity    = $row[5];
            if($row[6] !=""){
                $code_cat = explode(',',$row[6]);
                $json_cat_id=[];
                foreach ($code_cat as $key => $value) {
                    $cat = Category::where('ma',$value)->first();
                    if(!empty($cat)){
                        array_push($json_cat_id,$cat->id);
                    }    
                }
                $Products->cat_id = json_encode($json_cat_id);
            }
            if($row[7] != ""){
                $Brand = Brand::where('name', $row[7])->first();
                if(!empty($Brand)){
                    $Products->brand    = $Brand->id;
                }
            }
            $Products->short_content    = $row[8];
            $Products->gift    = $row[9];
            $Products->content    = $row[10];
            $Products->slug    = Str::slug( $row[1], '-');
            $Products->warranty    = $row[11];
            $Products->tax    = $row[12];
            $Products->deleted_at    = null;
            $Products->save();
        }
        else{ 
            if($row[1] != ""){
            $Products = new Products();
            $Products->ma       = strtoupper(Str::random(6));
            $Products->name     = $row[1];
            
            if($row[3]!=""){
                $Products->price    = $row[3];
                $Products->price_onsale    = $row[2];
                $Products->onsale    = $row[4];
            }
            else{
                $Products->price    = $row[2];
                $Products->price_onsale    = 0;
                $Products->onsale    = 0;
            }
            
           
            $Products->quantity    = $row[5];
            if($row[6] !=""){
                $code_cat = explode(',',$row[6]);
                $json_cat_id=[];
                foreach ($code_cat as $key => $value) {
                    $cat = Category::where('ma',$value)->first();
                    if(!empty($cat)){
                        array_push($json_cat_id,$cat->id);
                    }        
                }
                $Products->cat_id = json_encode($json_cat_id);
            }
            if($row[7] != ""){
                $Brand = Brand::where('name', $row[7])->first();
                if(!empty($Brand)){
                    $Products->brand    = $Brand->id;
                }
            }
            $Products->short_content    = $row[8];
            $Products->gift    = $row[9];
            $Products->content    = $row[10];
            $Products->slug    = Str::slug( $row[1], '-');
            $Products->warranty    = $row[11];
            $Products->tax    = $row[12];
            $Products->save();
            } 
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
          // '*.0' => 'unique:products,ma',
      ];
    }

}
