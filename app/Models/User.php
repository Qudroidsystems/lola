<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Models\Pictures\ImageModel;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\PermissionRegistrar;
use Laravel\Cashier\Billable;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    public function staffPicture(): HasOne
    {
        return $this->hasOne(ImageModel::class,'user_id');
    }

    /**
     * Get the user associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function staffemploymentDetails(): HasOne
    {
        return $this->hasOne(staffemploymentDetailsModel::class,'staff_');
    }




    public function roles_all(): BelongsToMany
    {
        return $this->morphToMany(
            config('permission.models.role'),
            'model',
            config('permission.table_names.model_has_roles'),
            config('permission.column_names.model_morph_key'),
            PermissionRegistrar::$pivotRole
        );
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function wishlistItems()
    {
        return $this->hasMany(WishlistItem::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function billingAddress()
    {
        return $this->hasOne(BillingAddress::class);
    }

    public function client()
    {
        return $this->hasOne(Client::class);
    }
}
