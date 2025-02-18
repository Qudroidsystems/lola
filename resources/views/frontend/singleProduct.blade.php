@extends('frontend.master')
@section('content')

<!--== Page Title Area Start ==-->
<div id="page-title-area">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="page-title-content">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('shop') }}">Shop</a></li>
                        <li class="active">{{ $product->name }}</li>
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
                <div class="single-product-page-content">
                    <div class="row">
                        <!-- Product Thumbnail Start -->
                        <div class="col-lg-5">
                            <div class="product-thumbnail-wrap">
                                <div class="product-thumb-carousel owl-carousel">
                                    @forelse($product->images as $image)
                                    <div class="single-thumb-item">
                                        <a href="#">
                                            <img class="img-fluid"
                                                 src="{{ asset($image->path) }}"
                                                 alt="{{ $product->name }}"/>
                                        </a>
                                    </div>
                                    @empty
                                    <div class="single-thumb-item">
                                        <img class="img-fluid"
                                             src="{{ asset('images/placeholder.jpg') }}"
                                             alt="No image available"/>
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <!-- Product Thumbnail End -->

                        <!-- Product Details Start -->
                        <div class="col-lg-7 mt-5 mt-lg-0">
                            <div class="product-details">
                                <h2>{{ $product->name }}</h2>

                                <div class="rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $product->averageRating())
                                            <i class="fa fa-star"></i>
                                        @else
                                            <i class="fa fa-star-o"></i>
                                        @endif
                                    @endfor
                                </div>

                                <span class="price">{{ number_format($product->sale_price, 2) }}</span>

                                <div class="product-info-stock-sku">
                                    <span class="product-stock-status {{ $product->stock ? 'text-success' : 'text-danger' }}">
                                        {{ $product->stock ? 'In Stock' : 'Out of Stock' }}
                                    </span>
                                    <span class="product-sku-status ms-5">
                                        <strong>SKU</strong> {{ $product->sku }}
                                    </span>
                                </div>

                                <p class="products-desc">{!! $product->description !!}</p>

                                @if($product->in_stock)
                                <form action="{{ route('cart.store') }}" method="POST" class="product-quantity mt-5 d-flex align-items-center">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                    <div class="quantity-field">
                                        <label for="qty">Qty</label>
                                        <input type="number" id="qty" name="quantity"
                                               min="1" max="{{ $product->stock }}" value="1"/>
                                    </div>

                                    <button type="submit" class="btn btn-add-to-cart">
                                        Add to Cart
                                    </button>
                                </form>
                                @endif

                                <div class="product-btn-group d-none d-sm-block">
                                    <form action="{{ route('wishlist.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="btn btn-add-to-cart btn-whislist">
                                            + Add to Wishlist
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Product Details End -->
                    </div>

                     <div class="row">
                        <div class="col-lg-12">
                            <div class="product-full-info-reviews">
                                <nav class="nav" id="nav-tab">
                                    <a class="active" id="description-tab" data-bs-toggle="tab" href="#description">Description</a>
                                    <a id="reviews-tab" data-bs-toggle="tab" href="#reviews">Reviews ({{ $product->reviews->count() }})</a>
                                </nav>

                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="description">
                                        {!! $product->description !!}
                                    </div>

                                    <div class="tab-pane fade" id="reviews">
                                        <div class="row">
                                            <div class="col-lg-7">
                                                <div class="product-ratting-wrap">
                                                    <div class="pro-avg-ratting">
                                                        <h4>{{ number_format($product->averageRating(), 1) }} <span>(Overall)</span></h4>
                                                        <span>Based on {{ $product->reviews->count() }} Comments</span>
                                                    </div>

                                                    @foreach($product->reviews as $review)
                                                    <div class="sin-rattings">
                                                        <div class="ratting-author">
                                                            <h3>{{ $review->user->name }}</h3>
                                                            <div class="ratting-star">
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    @if($i <= $review->rating)
                                                                        <i class="fa fa-star"></i>
                                                                    @else
                                                                        <i class="fa fa-star-o"></i>
                                                                    @endif
                                                                @endfor
                                                            </div>
                                                        </div>
                                                        <p>{{ $review->comment }}</p>
                                                    </div>
                                                    @endforeach

                                                    @auth
                                                    <div class="ratting-form-wrapper fix">
                                                        <h3>Add your Review</h3>
                                                        <form action="{{ route('reviews.store', $product->id) }}" method="POST">
                                                            @csrf
                                                            <div class="ratting-form row">
                                                                <div class="col-12 mb-4">
                                                                    <h5>Rating:</h5>
                                                                    <div class="ratting-star fix" id="ratingStars">
                                                                        @for($i = 1; $i <= 5; $i++)
                                                                            <i class="fa fa-star-o" data-rating="{{ $i }}"></i>
                                                                        @endfor
                                                                    </div>
                                                                    <input type="hidden" name="rating" id="selectedRating" required>
                                                                </div>

                                                                <div class="col-12 mb-4">
                                                                    <label for="your-review">Your Review:</label>
                                                                    <textarea name="comment" id="your-review"
                                                                              class="form-control"
                                                                              placeholder="Write a review"
                                                                              required></textarea>
                                                                </div>

                                                                <div class="col-12">
                                                                    <button type="submit" class="btn-add-to-cart" >
                                                                        Submit Review
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    @else
                                                    <p class="text-muted">Please <a href="{{ route('login') }}">login</a> to leave a review.</p>
                                                    @endauth
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--== Page Content Wrapper End ==-->

@endsection


<script>
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('#ratingStars .fa');
    const ratingInput = document.getElementById('selectedRating');

    stars.forEach(star => {
        star.addEventListener('click', function() {
            const rating = parseInt(this.dataset.rating);

            // Update stars display
            stars.forEach((s, index) => {
                s.classList.toggle('fa-star-o', index >= rating);
                s.classList.toggle('fa-star', index < rating);
            });

            // Set hidden input value
            ratingInput.value = rating;

            // Clear validation state
            ratingInput.classList.remove('is-invalid');
        });
    });

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        if (!ratingInput.value) {
            e.preventDefault();
            ratingInput.classList.add('is-invalid');
            alert('Please select a rating!');
        }
    });
});
</script>


