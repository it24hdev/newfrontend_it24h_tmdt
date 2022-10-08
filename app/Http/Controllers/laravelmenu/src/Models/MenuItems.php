<?php

namespace App\Http\Controllers\laravelmenu\src\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItems extends Model
{

    protected $table = null;

    protected $fillable = ['label', 'link', 'parent', 'sort', 'class', 'menu', 'depth', 'role_id', 'categoryselect', 'property', 'form_filter', 'name_categoryproperty','min_price', 'max_price', 'category_id', 'category_code','ma'];

    public function __construct(array $attributes = [])
    {
        //parent::construct( $attributes );
        $this->table = config('menu.table_prefix') . config('menu.table_name_items');
    }

    public function getsons($id)
    {
        return $this->where("parent", $id)->get();
    }
    public function getall($id)
    {
        return $this->where("menu", $id)->orderBy("sort", "asc")->get();
    }

    public static function getNextSortRoot($menu)
    {
        return self::where('menu', $menu)->max('sort') + 1;
    }

    public function parent_menu()
    {
        return $this->belongsTo('App\Http\Controllers\laravelmenu\src\Models\Menus', 'menu');
    }

    public function childs()
    {
        return $this->hasMany('App\Http\Controllers\laravelmenu\src\Models\MenuItems', 'parent', 'id')->orderBy('sort', 'ASC');
    }
}
