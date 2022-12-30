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
        'filter_by',
        'filter_value',
        'category_id',
        'category_code',
        'ma',
        'stt',
        'type_menu',
        'img_caption',
    ];

    public function childs(){
        return $this->hasMany(admin_menu_items::class, 'parent');
    }

    public static function recursive($menu, $parents = 0, $level = 1, &$listmenuitem)
    {
        if (count($menu)>0) {
            foreach ($menu as $key => $value) {
                if ($value->parent==$parents) {
                    $value->level=$level;
                    $listmenuitem[]=$value;
                    unset($menu[$key]);
                    $parent = $value->id;
                    self::recursive($menu, $parent, $level+1,$listmenuitem);
                }
            }
        }
    }

    public static function recursive_child($menu, $parents, $level, &$list_menu)
    {
        if (count($menu)>0) {
            foreach ($menu as $key => $value) {
                if ($value->parent==$parents) {
                    $value->level=$level;
                    $list_menu[]=$value;
                    unset($menu[$key]);
                    $parent = $value->id;
                    self::recursive($menu, $parent, $level+1,$list_menu);
                }
            }
        }
    }
}
