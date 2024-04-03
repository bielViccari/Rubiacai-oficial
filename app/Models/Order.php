<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'name',
        'payment',
        'phone',
        'address',
        'delivery',
        'precoTotal',
        'itens',
    ];

    protected $casts = [
        'itens' => 'array',
    ];
    use HasFactory;
}
