<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailproperties extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'ma',
        'stt',
        'explain',
        'categoryproperties_id',
    ];


    // public function get_list_product_by_filter($id, $ma_danhmuc ){
    //     $products = Products::where('status', 1)
    //     ->leftJoin('propertyproducts','propertyproducts.products_id','products.id')
    //     ->leftJoin('category_relationships','category_relationships.product_id','products.id')
    //     ->leftJoin('categories','categories.id','category_relationships.cat_id')
    //     ->where('propertyproducts.property',$id)
    //     ->where('categories.id',$ma_danhmuc)->get();
    //     return $products;
    // }
}