<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'category_id', // Assuming category relationship is based on the category ID
        'sku',
        'barcode',
        'stock',
        'stock_alert',
        'base_price',
        'tax',
        'vat_amount',
        'manufacture',
        'expiry',
        'meta_tag_title',
        'meta_tag_description',
        'meta_tag_keywords',
        'thumbnail',
        'unit_id', // Assuming unit relationship is based on unit ID
        'brand_id', // Assuming brand relationship is based on brand ID
        'warehouse_id', // Assuming warehouse relationship is based on warehouse ID
    ];

    protected $with = ['cover', 'tags', 'brands'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag');
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'product_brand');
    }

    public function units()
    {
        return $this->belongsToMany(Unit::class, 'product_unit')->withTimeStamps();
    }

    public function warehouses()
    {
        return $this->belongsToMany(Warehouse::class, 'warehouse_product')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    // public function variants()
    // {
    //     return $this->belongsToMany(VariantValue::class, 'product_variant')
    //                 ->withPivot('sku', 'price', 'stock')
    //                 ->withTimestamps();
    // }

    public function cover()
    {
        return $this->belongsTo(Upload::class, 'cover_id');
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
