<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'product_uploads';

    protected $fillable = [
        'product_id',
        'upload_id',
        'sort_order',
    ];

    /**
     * Get the product associated with this image.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the upload associated with this image.
     */
    public function upload()
    {
        return $this->belongsTo(Upload::class);
    }
}
