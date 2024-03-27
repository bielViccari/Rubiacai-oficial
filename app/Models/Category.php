<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'image',
    ];
    use HasFactory;

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
