<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin_menus extends Model
{
    use HasFactory;
    protected $table =  "admin_menus";
    protected $fillable = [
        'id',
        'name'
    ];
}
