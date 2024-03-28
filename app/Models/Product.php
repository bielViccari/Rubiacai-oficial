<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'category_id',
        'image'
    ];
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
