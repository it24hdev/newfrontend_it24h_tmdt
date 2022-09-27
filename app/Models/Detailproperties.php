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
        'stt',
        'explain',
        'categoryproperties_id',
    ];
}