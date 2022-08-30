<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'order_id', 'product_name', 'quantity', 'price',];

    public function order(){
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product(){
        return $this->belongsTo(Products::class, 'product_id');
    }
}
