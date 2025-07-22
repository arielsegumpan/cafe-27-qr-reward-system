<?php

namespace App\Models;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'prod_name',
        'prod_slug',
        'prod__desc',
        'prod_price',
        'prod_image',
        'prod_points',
        'prod_quantity',
        'is_active',
        'product_category_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'prod_price' => 'decimal:2',
        'prod_points' => 'integer',
        'prod_quantity' => 'integer',
    ];

    public function product_category() : BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    
}
