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
        'categoryproperties_code',
        'image',
    ];
    const IMAGE = 'no-images.jpg';
}
