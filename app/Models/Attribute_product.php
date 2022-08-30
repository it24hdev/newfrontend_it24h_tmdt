<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute_product extends Model
{
    use HasFactory;

    protected $table = 'attribute_products';

    protected $fillable = ['name', 'attr', 'color',];
}
