<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registerservice extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'phone',
        'email',
        'request',
        'respond',
        'images',
        'describe',
        'status'
    ];
}
