<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'slug',
        'category_id',
        'subcategory_id',
        'description',
        'client',
        'location',
        'start_date',
        'end_date',
        'main_image',
        'status',
    ];

    /**
     * Get the category that owns the project.
     * Assuming 'category_id' refers to 'product_categories' based on context.
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(ProductCategory::class, 'subcategory_id');
    }
}
