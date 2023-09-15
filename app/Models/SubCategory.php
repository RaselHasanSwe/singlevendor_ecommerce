<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug','category_id', 'image'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function innerCategory()
    {
        return $this->hasMany(InnerCategory::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
