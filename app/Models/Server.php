<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    public $timestamps = false;

    public $fillable = [
        'name',
        'sanitized_name',
        'ip_address',
        'port'
    ];

    use HasFactory;
}
