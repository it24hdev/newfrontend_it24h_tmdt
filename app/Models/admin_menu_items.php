<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin_menu_items extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'link',
        'parent',
        'sort',
        'class',
        'menu',
        'depth',
        'role_id',
        'filter_value',
        'filter_value',
        'category_id',
        'category_code',
        'ma',
        'stt',
        'type_menu'
    ];

//    public function childs()
//    {
//        return $this->hasMany('App\Models\menu', 'parent_id', 'category_id');
//    }


    public static function recursive($menu, $parents, &$listmenuitem)
    {
        if (count($menu)>0) {
            foreach ($menu as $key => $value) {
                if ($value->parent==$parents) {
                    $value->level=$level;
                    $listmenuitem[]=$value;
                    unset($menu[$key]);
                    $parent = $value->id;
                    self::recursive($menu, $parent, $listmenuitem);
                }
            }
        }
    }
}
