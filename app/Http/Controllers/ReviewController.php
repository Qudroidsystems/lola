<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class ReviewController extends Controller
{
    /**
     * Display a listing of the reviews for a specific product.
     */
    public function index($productId)
    {
        $product = Product::findOrFail($productId);
        $reviews = $product->reviews()->with('user')->latest()->get();

        return view('reviews.index', compact('product', 'reviews'));
    }

    /**
     * Show the form for creating a new review.
     */
    public function create($productId)
    {
        $product = Product::findOrFail($productId);
        return view('reviews.create', compact('product'));
    }

    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request, $productId)
    {


        $validatedData = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        $review = new Review();
        $review->user_id = Auth::id();
        $review->product_id = $productId;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();

        return redirect()->route('shop.show', $productId)->with('success', 'Review added successfully.');
    }

    /**
     * Show the form for editing a review.
     */
    public function edit($id)
    {
        $review = Review::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('reviews.edit', compact('review'));
    }

    /**
     * Update the specified review in storage.
     */
    public function update(Request $request, $id)
    {
        $review = Review::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('products.show', $review->product_id)->with('success', 'Review updated successfully.');
    }

    /**
     * Remove the specified review from storage.
     */
    public function destroy($id)
    {
        $review = Review::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $review->delete();

        return redirect()->route('products.show', $review->product_id)->with('success', 'Review deleted successfully.');
    }
}
