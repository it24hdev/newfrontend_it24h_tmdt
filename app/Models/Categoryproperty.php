<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoryproperty extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'ma',
        'stt',
        'category_id',
        'explain',
        'image',
        'status',
    ];
    const IMAGE = 'no-images.jpg';
}
