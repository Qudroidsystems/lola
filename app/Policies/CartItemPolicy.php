<?php

namespace App\Policies;

use App\Models\CartItem;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CartItemPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Allow authenticated users to view their cart
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CartItem $cartItem): bool
    {
        return $user->id === $cartItem->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // Allow authenticated users to create cart items
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CartItem $cartItem)
    {
        return $user->id === $cartItem->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CartItem $cartItem): bool
    {
        return $user->id === $cartItem->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CartItem $cartItem): bool
    {
        return $user->id === $cartItem->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CartItem $cartItem): bool
    {
        return $user->id === $cartItem->user_id;
    }
}