<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'description',
        'price',
        'stock',
        'size',
        'image',
        'image_2',
        'image_3',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
