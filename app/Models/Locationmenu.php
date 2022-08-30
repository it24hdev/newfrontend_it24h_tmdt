<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locationmenu extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'name2',
        'category_id',
        'parent_id',
        'sidebar',
        'footer',
        'menu',
        'rightmenu', 
        'slug', 
    ];
     public function childs() {
        return $this->hasMany('App\Models\Locationmenu','parent_id','category_id') ;
    }
}
