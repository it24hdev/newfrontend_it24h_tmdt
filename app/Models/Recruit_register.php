<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruit_register extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'first_name',
        'phone_number',
        'email',
        'vitriungtuyen',
        'fileupload',
        'status',
    ];
}
