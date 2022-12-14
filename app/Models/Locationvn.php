<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locationvn extends Model
{
    protected $table = 'Locationvn';
    use HasFactory;
    protected $fillable = [
        'id',
        'city',
        'district',
        'parent',
        'acronym',
    ];
}
