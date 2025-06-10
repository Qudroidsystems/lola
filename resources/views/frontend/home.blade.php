@extends('frontend.master')
@section('content')
@if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (\Session::has('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ \Session::get('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (\Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ \Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
@endif
<!--== Banner // Slider Area Start ==-->
<section id="banner-area" class="banner__2">
    <div class="ruby-container">
        <div class="row">
            <div class="col-lg-12">
                <div id="banner-carousel" class="owl-carousel">
                    <!-- Banner Single Carousel Start -->
                    <div class="single-carousel-wrap home_6_slide_1">
                        <div class="banner-caption text-center text-lg-start">
                            <p>  <h2>LorLahtate Store </h2></p>

                            <h3>Necklace  <br> for Princess</h3>
                            <p>Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>
                            <a href="#" class="btn-long-arrow">Learn More</a>
                        </div>
                    </div>
                    <!-- Banner Single Carousel End -->

                    <!-- Banner Single Carousel Start -->
                    <div class="single-carousel-wrap home_6_slide_2">
                        <div class="banner-caption text-center text-lg-start">
                        <p>  <h2>LorLahtate </h2></p>

                            <h3>Necklace  <br> for Princess</h3>
                            <p>Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>
                            <a href="#" class="btn-long-arrow">Learn More</a>
                        </div>
                    </div>
                    <!-- Banner Single Carousel End -->
                </div>
            </div>
        </div>
    </div>
</section>
<!--== Banner Slider End ==-->


<!--== Featured Products Area Start ==-->
<!-- <div id="category-feature-product" class="pt-9">
    <div class="ruby-container">
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    @foreach($featuredCategories->take(2) as $category)
                    <div class="col-lg-12 mb-4">
                        <div class="single-featured-product position-relative">
                            <a href="{{ route('shop', ['category' => $category->slug]) }}">
                                @if($category->cover)
                                <img src="{{ asset('storage/'.$category->cover->path) }}"
                                     alt="{{ $category->name }}"
                                     class="img-fluid rounded">
                                @else
                                <div class="category-placeholder bg-light rounded d-flex align-items-center justify-content-center">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                                @endif
                                <div class="category-overlay bg-dark bg-opacity-50 p-3 text-white">
                                    <h3 class="mb-0">{{ $category->name }}</h3>
                                    @if($category->description)
                                    <p class="mb-0 small">{{ Str::limit($category->description, 50) }}</p>
                                    @endif
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>


        </div>
    </div>
</div> -->
<!--== Featured Products Area End ==-->



<!--== New Products Area Start ==-->
<section id="new-products-area" class="p-9">
    <div class="ruby-container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="section-title">
                    <h2>New Products</h2>
                    <p>Trending stunning Unique </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="products-wrapper">
                    <div class="new-products-carousel owl-carousel">
                        @foreach($newProducts as $product)
                        <!-- Single Product Item -->
                        <div class="single-product-item text-center">
                            <figure class="product-thumb">
                                <a href="{{ route('shop.show', $product->id) }}">
                                    @if($product->thumbnail)
                                    <img src="{{ asset($product->thumbnail) }}"
                                         alt="{{ $product->name }}"
                                         class="img-fluid">
                                    @else
                                    <div class="img-placeholder"></div>
                                    @endif
                                </a>
                            </figure>

                            <div class="product-details">
                                <h2><a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a></h2>
                                <span class="rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $product->rating)
                                            <i class="fa fa-star"></i>
                                        @else
                                            <i class="fa fa-star-o"></i>
                                        @endif
                                    @endfor
                                </span>
                                <span class="price">
                                    @if($product->on_sale)
                                        <del>${{ number_format($product->base_price, 2) }}</del>
                                        ${{ number_format($product->sale_price, 2) }}
                                    @else
                                        ${{ number_format($product->base_price, 2) }}
                                    @endif
                                </span>
                                <form action="{{ route('cart.store', $product->id ) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-add-to-cart">+ Add to Cart</button>
                                </form>

                                @if($product->is_new)
                                    <span class="product-bedge">New</span>
                                @endif
                                @if($product->on_sale)
                                    <span class="product-bedge sale">Sale</span>
                                @endif
                            </div>

                            <div class="product-meta">
                                <button type="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#quickView-{{ $product->id }}">
                                    <span data-bs-toggle="tooltip" title="Quick View">
                                        <i class="fa fa-compress"></i>
                                    </span>
                                </button>
                                <form action="{{ route('wishlist.store', $product->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn-link" data-bs-toggle="tooltip" title="Add to Wishlist">
                                        <i class="fa fa-heart-o"></i>
                                    </button>
                                </form>
                                <a href="{{ route('compare.add', $product->id) }}"
                                   data-bs-toggle="tooltip"
                                   title="Compare"
                                   class="compare-btn">
                                    <i class="fa fa-tags"></i>
                                </a>
                            </div>
                        </div>
                        <!-- Single Product Item -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--== New Products Area End ==-->

<!-- Quick View Modals -->
@foreach($newProducts as $product)
<div class="modal fade" id="quickView-{{ $product->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Add quick view content here -->
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                <div class="row">

                    @if($product->thumbnail)
                    <img src="{{ asset($product->thumbnail) }}"
                         class="img-fluid"
                         alt="{{ $product->name }}">
                    @else
                        <!-- Show placeholder or nothing -->
                        <img src="{{ asset('images/placeholder.png') }}"
                            class="img-fluid"
                            alt="No image available">
                    @endif
                    <div class="col-md-6">
                        <h3>{{ $product->name }}</h3>
                        <div class="price">
                            ${{ number_format($product->base_price, 2) }}
                            @if($product->on_sale)
                                <span class="text-danger">${{ number_format($product->sale_price, 2) }}</span>
                            @endif
                        </div>
                        <p>{{ $product->description }}</p>
                        <!-- Add more product details as needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
<!--== New Products Area End ==-->



<!--== Testimonial Area Start ==-->

<!--== Testimonial Area End ==-->
@endSection
