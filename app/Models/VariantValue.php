<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantValue extends Model
{
    use HasFactory;

    protected $fillable = ['variant_id', 'value'];

    public function variant()
    {
        return $this->belongsTo(Variation::class, 'variant_id');
    }

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

}
