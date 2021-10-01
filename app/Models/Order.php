<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $fillable = [
        'email',
        'nickname',
        'comment',
        'name_surname',
        'place',
        'psc',
        'uuid',
    ];
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
