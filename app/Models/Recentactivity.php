<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recentactivity extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'activities',
        'attr',
        'status'
    ];
}
