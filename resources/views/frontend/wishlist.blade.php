@extends('frontend.master')
@section('content')

<!--== Page Title Area Start ==-->
<div id="page-title-area">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="page-title-content">
                    <h1>Wishlist</h1>
                    <ul class="breadcrumb">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('shop') }}">Shop</a></li>
                        <li><a href="{{ route('wishlist.index') }}" class="active">Wishlist</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--== Page Title Area End ==-->

<!--== Page Content Wrapper Start ==-->
<div id="page-content-wrapper" class="p-9">
    <div class="container">
        <!-- Wishlist Page Content Start -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Wishlist Table Area -->
                <div class="cart-table table-responsive">
                    @if($wishlistItems->isEmpty())
                        <div class="alert alert-info">Your wishlist is empty. <a href="{{ route('shop') }}">Start shopping!</a></div>
                    @else
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="pro-thumbnail">Thumbnail</th>
                            <th class="pro-title">Product</th>
                            <th class="pro-price">Price</th>
                            <th class="pro-quantity">Stock Status</th>
                            <th class="pro-subtotal">Add to Cart</th>
                            <th class="pro-remove">Remove</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($wishlistItems as $item)
                        <tr>
                            <td class="pro-thumbnail">
                                <a href="{{ route('product.show', $item->product->id) }}">
                                    @if($item->product->cover)
                                    <img class="img-fluid"
                                         src="{{ asset('storage/'.$item->product->cover->path) }}"
                                         alt="{{ $item->product->name }}">
                                    @else
                                    <div class="img-placeholder"></div>
                                    @endif
                                </a>
                            </td>
                            <td class="pro-title">
                                <a href="{{ route('product.show', $item->product->id) }}">
                                    {{ $item->product->name }}
                                </a>
                            </td>
                            <td class="pro-price">
                                <span>${{ number_format($item->product->base_price, 2) }}</span>
                            </td>
                            <td class="pro-quantity">
                                @if($item->product->stock > 0)
                                    <span class="text-success">In Stock</span>
                                @else
                                    <span class="text-danger">Out of Stock</span>
                                @endif
                            </td>
                            <td class="pro-subtotal">
                                @if($item->product->stock > 0)
                                <form action="{{ route('cart.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                    <button type="submit" class="btn-add-to-cart">
                                        Add to Cart
                                    </button>
                                </form>
                                @else
                                <button class="btn-add-to-cart disabled" disabled>
                                    Add to Cart
                                </button>
                                @endif
                            </td>
                            <td class="pro-remove">
                                <form action="{{ route('wishlist.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
        <!-- Wishlist Page Content End -->
    </div>
</div>
<!--== Page Content Wrapper End ==-->
@endsection
