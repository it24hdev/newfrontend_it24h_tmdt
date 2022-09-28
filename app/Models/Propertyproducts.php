<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propertyproducts extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'ma',
        'products_id',
        'detailproperties_id',
    ];
}
