<?php

namespace App\Http\Controllers\laravelmenu\src\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class MenuItems extends Model
{

    protected $table = null;

    protected $fillable = ['label', 'link', 'parent', 'sort', 'class', 'menu', 'depth', 'role_id', 'filter_value','filter_value','category_id', 'category_code','ma'];

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
       $get = $this->hasMany('App\Http\Controllers\laravelmenu\src\Models\MenuItems', 'parent', 'id')
       ->leftjoin('categories','categories.id','admin_menu_items.category_id')
       ->leftjoin('detailproperties','admin_menu_items.filter_value','detailproperties.ma')
       ->select('admin_menu_items.*','detailproperties.categoryproperties_code as filter_name','categories.slug as slug')
       ->orderBy('sort', 'ASC');
        return $get;
    }
}
