<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'variant_value_id',
        'sku',
        'vat_amount',
        'stock',
        'stock_alert',
        'barcode',
        'thumbnail',
        'base_price',
        'discounted_price',
        'discount_type',
        'discount_value',
        'tax',
        'tax_value',
        'manufured',
        'expiry',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variantValues()
    {
        return $this->hasMany(VariantValue::class, 'variant_id');
    }

    
}
