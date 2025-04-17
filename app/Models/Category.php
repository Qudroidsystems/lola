<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $with = ['cover'];

    protected $fillable = [
        'name',
        'description',
        'status',
        'cover_id',
        'meta_tag_title',
        'meta_tag_description',
        'meta_tag_keywords',
        'publishingDate',
        'parent_id',
        'is_featured'
    ];

     /**
     * Get the parent category (if this is a subcategory).
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Get the subcategories for this category.
     */
    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

     /**
     * Scope to get only published categories.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope to get only root categories (categories without a parent).
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_category');
    }

    public function cover()
    {
        return $this->belongsTo(Upload::class, 'cover_id');
    }

    // Add featured scope
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

}
