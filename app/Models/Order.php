<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $fillable = [
        'email',
        'nickname',
        'discord_tag',
        'comment',
        'name_surname',
        'place',
        'psc',
        'uuid',
        'package_id',
        'state'
    ];
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->hasOne(Package::class);
    }
}
