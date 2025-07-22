<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductCategory extends Model
{
    protected $fillable = [
        'category_name',
        'category_slug',
        'category_image',
        'category_desc',
    ];


    public function products() : HasMany
    {
        return $this->hasMany(Product::class);
    }
}
