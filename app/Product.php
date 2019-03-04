<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'description', 'image', 'category_id', 'index_id', 'en_name', 'is_hot'];
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
}
