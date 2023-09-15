<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'stock',
        'price',
        'discount',
        'discount_type',
        'category_id',
        'sub_category_id',
        'inner_category_id',
        'sort_description',
        'thumbnail',
        'full_description',
        'full_specfications',
        'status',
        'recomend',
        'hot',
        'brand_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
    public function innerCategory()
    {
        return $this->belongsTo(InnerCategory::class);
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }
    public function colors()
    {
        return $this->hasMany(ProductColor::class);
    }

    public function shipping()
    {
        return $this->hasMany(ProductShipping::class);
    }
}
