<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $table = 'sliders';

    protected $fillable = [
        'name',
        'location',
        'link_target',
        'image', 'user_id','position','status',
        'subtitle','description'
    ];

    const IMAGE = 'no-images.jpg';
    const ACTIVE = 1;
    const DISABLE = 0;

    public static $arr_location = [
        1 => 'Banner_1',
        2 => 'Banner_2',
        3 => 'Banner_3',
        4 => 'Banner_4',
        9 => 'Slider_Home',
    ];

    public function getUser(){
        return $this->belongsTo(User::class,'user_id');
    }
}
