<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = ['name', 'index_id', 'en_name'];


    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public static function findByEnName($enName)
    {
        return self::where('en_name', '=', $enName)->first();
    }
}
