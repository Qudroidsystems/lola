<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingAddress extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'type', 'street', 'city', 'state', 'zip', 'phone'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
