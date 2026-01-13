<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
        'shipping',
        'status',
        'name',
        'email',
        'phone',
        'notes',
        'payment_intent',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending'     => 'warning',
            'processing'  => 'info',
            'completed'   => 'success',
            'cancelled'   => 'danger',
            'failed'      => 'danger',
        ];

        $color = $badges[$this->status] ?? 'secondary';
        return "<span class=\"badge badge-light-$color\">" . ucfirst($this->status) . "</span>";
    }
}
