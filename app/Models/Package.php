<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public $timestamps = false;

    public $fillable = [
        'name',
        'comment',
        'price',
        'is_one_time'
    ];

    use HasFactory;
}
