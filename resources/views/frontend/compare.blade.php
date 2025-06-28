@extends('frontend.master')
@section('content')

<!--== Page Title Area Start ==-->
<div id="page-title-area">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="page-title-content">
                    <h1>Compare Products</h1>
                    <ul class="breadcrumb">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('shop') }}">Shop</a></li>
                        <li><a href="{{ route('compare.index') }}" class="active">Compare</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--== Page Title Area End ==-->

<!--== Page Content Wrapper Start ==-->
<div id="page-content-wrapper" class="p-9">
    <div class="ruby-container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Compare Page Content Start -->
                <div class="compare-page-content-wrap">
                    @if(count($products) < 2)
                        <div class="alert alert-info text-center">
                            <h4>Add at least 2 products to compare</h4>
                            <a href="{{ route('shop') }}" class="btn btn-add-to-cart mt-3">Continue Shopping</a>
                        </div>
                    @else
                        <div class="compare-table table-responsive">
                            <table class="table table-bordered mb-0">
                                <tbody>
                                    <!-- Product Row -->
                                    <tr>
                                        <td class="first-column">Product</td>
                                        @foreach($products as $product)
                                        <td class="product-image-title">
                                            <a href="{{ route('products.show', $product->slug) }}" class="image">
                                                @if($product->cover)
                                                <img class="img-fluid"
                                                     src="{{ asset('storage/'.$product->cover->path) }}"
                                                     alt="{{ $product->name }}">
                                                @else
                                                <div class="img-placeholder"></div>
                                                @endif
                                            </a>
                                            <a href="#" class="category">
                                                @if($product->categories->isNotEmpty())
                                                    {{ $product->categories->first()->name }}
                                                @else
                                                    Uncategorized
                                                @endif
                                            </a>
                                            <a href="{{ route('products.show', $product->slug) }}" class="title">
                                                {{ $product->name }}
                                            </a>
                                        </td>
                                        @endforeach
                                    </tr>

                                    <!-- Description Row -->
                                    <tr>
                                        <td class="first-column">Description</td>
                                        @foreach($products as $product)
                                        <td class="pro-desc">
                                            <p>{{ Str::limit($product->description, 150) }}</p>
                                        </td>
                                        @endforeach
                                    </tr>

                                    <!-- Price Row -->
                                    <tr>
                                        <td class="first-column">Price</td>
                                        @foreach($products as $product)
                                        <td class="pro-price">
                                            @if($product->on_sale)
                                                <del>RM {{ number_format($product->base_price, 2) }}</del>
                                                RM {{ number_format($product->sale_price, 2) }}
                                            @else
                                                RM {{ number_format($product->base_price, 2) }}
                                            @endif
                                        </td>
                                        @endforeach
                                    </tr>

                                    <!-- Color Row -->
                                    <tr>
                                        <td class="first-column">Color</td>
                                        @foreach($products as $product)
                                        <td class="pro-color">
                                            {{ $product->color ?? 'N/A' }}
                                        </td>
                                        @endforeach
                                    </tr>

                                    <!-- Stock Row -->
                                    <tr>
                                        <td class="first-column">Stock</td>
                                        @foreach($products as $product)
                                        <td class="pro-stock">
                                            @if($product->stock > 0)
                                                <span class="text-success">In Stock</span>
                                            @else
                                                <span class="text-danger">Out of Stock</span>
                                            @endif
                                        </td>
                                        @endforeach
                                    </tr>

                                    <!-- Add to Cart Row -->
                                    <tr>
                                        <td class="first-column">Add to cart</td>
                                        @foreach($products as $product)
                                        <td>
                                            <form action="{{ route('cart.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="btn btn-add-to-cart">
                                                    + Add to Cart
                                                </button>
                                            </form>
                                        </td>
                                        @endforeach
                                    </tr>

                                    <!-- Delete Row -->
                                    <tr>
                                        <td class="first-column">Delete</td>
                                        @foreach($products as $product)
                                        <td class="pro-remove">
                                            <form action="{{ route('compare.remove', $product->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </form>
                                        </td>
                                        @endforeach
                                    </tr>

                                    <!-- Rating Row -->
                                    <tr>
                                        <td class="first-column">Rating</td>
                                        @foreach($products as $product)
                                        <td class="pro-ratting">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fa fa-star{{ $i <= $product->rating ? '' : '-o' }}"></i>
                                            @endfor
                                        </td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                <!-- Compare Page Content End -->
            </div>
        </div>
    </div>
</div>
<!--== Page Content Wrapper End ==-->
@endsection