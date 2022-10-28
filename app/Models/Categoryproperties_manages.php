<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoryproperties_manages extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'ma',
        'name',
        'stt',
        'category_id',
        'categoryproperties_id',
    ];
}