<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag_event extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'icon',
        'color_left',
        'color_right',
    ];

    public function product(){
        return $this->hasMany(Products::class, 'event');
    }
}
