<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'ma',
        'name',
        'image',
    ];

    public function product(){
        return $this->hasMany(Products::class, 'brand');
    }
}
