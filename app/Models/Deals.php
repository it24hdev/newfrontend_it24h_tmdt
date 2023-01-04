<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deals extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_deal',
        'product_id',
        'price_deal',
        'quantity_deal',
        'minimum_quantity',
        'maximum_quantity',
        'start_time',
        'end_time',
        'order_display',
        'describe',
        'status_deal'
    ];
}
