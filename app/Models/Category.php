<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'id',
        'name',
        'name2',
        'slug',
        'taxonomy',
        'parent_id',
        'user_id',
        'icon',
        'status',
        'thumb',
        'banner',
        'show_push_product',
    ];
    const SAN_PHAM = 0;
    const BAI_VIET = 1;
    const IMAGE = 'no-image-product.jpg';

    public static function recursive($data, $parents = 0, $level = 1, &$listcategory)
    {
        if (count($data)>0) {
            foreach ($data as $key => $value) {
                // code...
                if ($value->parent_id==$parents) {
                    // code...
                    $value->level=$level;
                    $listcategory[]=$value;
                    unset($data[$key]);
                    $parent = $value->id;
                    self::recursive($data, $parent, $level + 1, $listcategory);

                }
            }
        }

    }

    public function childs() {
        return $this->hasMany('App\Models\Category','parent_id','id') ;
    }

    public function product(){
        return $this->belongsToMany(Products::class, 'category_relationships', 'cat_id', 'product_id')->where('status', 1);
    }

    public function cat_child(){
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function cat_parent(){
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function get_product_by_cat(){
        $db = \collect();
        $list_id = \collect();
        $db[] = $this->product;
        $this->get_product_recursive($this, $db);
        $products = $db->collapse()->unique('id');
        foreach($products as $item){
            $list_id[]=$item->id;
        }
        return $list_id;
    }
    public function get_list_product_by_cat(){
        $db = \collect();
        $list_id = \collect();
        $db[] = $this->product;
        $this->get_product_recursive($this, $db);
        $products = $db->collapse()->unique('id');
        return $products;
    }

    public function get_product_recursive($cat, $list_product){
        foreach ($cat->cat_child as $cat){
                $list_product[] = $cat->product;
                self::get_product_recursive($cat, $list_product);
        }
    }
}
