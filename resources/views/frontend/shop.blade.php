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
<!--== Page Title Area Start ==-->
<div id="page-title-area">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="page-title-content">
                    <h1>Shop</h1>
                    <ul class="breadcrumb">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('shop') }}" class="active">Shop</a></li>
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
            <!-- Sidebar Area Start -->
            <div class="col-lg-3 mt-5 mt-lg-0">
                <div id="sidebar-area-wrap">
                    <!-- Single Sidebar Item Start -->
                    <div class="single-sidebar-wrap">
                        <h2 class="sidebar-title">Shop By</h2>
                        <div class="sidebar-body">
                            <div class="shopping-option">
                                <h3>Shopping Options</h3>
                                <!-- Category Filter -->
                                <div class="shopping-option-item">
                                    <h4>Categories</h4>
                                    <ul class="sidebar-list">
                                        @foreach($categories as $category)
                                        <li>
                                            <a href="{{ route('shop', array_merge(request()->query(), ['category' => $category->slug])) }}"
                                            class="{{ request('category') == $category->slug ? 'active' : '' }}">
                                                {{ $category->name }} ({{ $category->products_count }})
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <!-- Brand Filter -->
                                <div class="shopping-option-item">
                                    <h4>Brands</h4>
                                    <ul class="sidebar-list">
                                        @foreach($brands as $brand)
                                        <li>
                                            <a href="{{ route('shop', array_merge(request()->query(), ['brand' => $brand->slug])) }}"
                                            class="{{ request('brand') == $brand->slug ? 'active' : '' }}">
                                                {{ $brand->name }} ({{ $brand->products_count }})
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <!-- Price Filter -->
                                <div class="shopping-option-item">
                                    <h4>Price</h4>
                                    <ul class="sidebar-list">
                                        <li><a href="{{ route('shop', array_merge(request()->query(), ['price' => '0-210'])) }}"
                                            class="{{ request('price') == '0-210' ? 'active' : '' }}">RM 0 - RM 210</a></li>
                                        <li><a href="{{ route('shop', array_merge(request()->query(), ['price' => '210-420'])) }}"
                                            class="{{ request('price') == '210-420' ? 'active' : '' }}">RM 210 - RM 420</a></li>
                                        <li><a href="{{ route('shop', array_merge(request()->query(), ['price' => '420-840'])) }}"
                                            class="{{ request('price') == '420-840' ? 'active' : '' }}">RM 420 - RM 840</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Single Sidebar Item End -->
                </div>
            </div>
            <!-- Sidebar Area End -->

            <!-- Shop Page Content Start -->
            <div class="col-lg-9 order-first order-lg-last">
                <div class="shop-page-content-wrap">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <form action="{{ route('shop') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                           placeholder="Search products..." value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="products-settings-option d-block d-md-flex">
                        <div class="product-cong-left d-flex align-items-center">
                            <ul class="product-view d-flex align-items-center">
                                <li class="current column-gird"><i class="fa fa-bars fa-rotate-90"></i></li>
                                <li class="box-gird"><i class="fa fa-th"></i></li>
                                <li class="list"><i class="fa fa-list-ul"></i></li>
                            </ul>
                            <span class="show-items">Items 1 - 9 of {{ $products->total() }}</span>
                        </div>

                        <div class="product-sort_by d-flex align-items-center mt-3 mt-md-0">
                            <label for="sort">Sort By:</label>
                            <select name="sort" id="sort" onchange="this.form.submit()">
                                <option value="relevance" {{ request('sort') == 'relevance' ? 'selected' : '' }}>Relevance</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name, A to Z</option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name, Z to A</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price low to high</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price high to low</option>
                            </select>
                        </div>
                    </div>

                    <div class="shop-page-products-wrap">
                        <div class="products-wrapper">
                            <div class="row">
                                @foreach($products as $product)
                                <div class="col-lg-4 col-sm-6 mb-4">
                                    <div class="single-product-item text-center">
                                        <!-- Product Image -->
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

                                        <!-- Product Details -->
                                        <div class="product-details">
                                            <h2>
                                                <a href="{{ route('shop.show', $product->id) }}">
                                                    {{ $product->name }}
                                                </a>
                                            </h2>

                                            <!-- Rating -->
                                            <div class="rating">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= optional($product->rating)->rating)
                                                        <i class="fa fa-star"></i>
                                                    @else
                                                        <i class="fa fa-star-o"></i>
                                                    @endif
                                                @endfor
                                            </div>

                                            <!-- Price -->
                                            <span class="price">
                                                @if($product->on_sale)
                                                    <del>RM {{ number_format($product->base_price, 2) }}</del>
                                                    RM {{ number_format($product->sale_price, 2) }}
                                                @else
                                                    RM {{ number_format($product->base_price, 2) }}
                                                @endif
                                            </span>

                                            <!-- Description -->
                                            <p class="products-desc">
                                                {{ Str::limit($product->description, 120) }}
                                            </p>

                                            <!-- Action Buttons -->
                                            <div class="product-actions">
                                                @auth
                                                        <form action="{{ route('cart.store') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                            <button type="submit" class="btn btn-add-to-cart">+ Add to Cart</button>
                                                        </form>
                                                @else
                                                        <div class="guest-notice mt-2">
                                                            <a href="{{ route('login') }}" class="text-muted">
                                                                <i class="fas fa-lock me-1"></i>Login to purchase
                                                            </a>
                                                        </div>
                                                @endauth
                                            </div>
                                        </div>

                                        <!-- Product Meta -->
                                        <div class="product-meta">
                                            <!-- Quick View -->
                                            <button type="button"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#quickView-{{ $product->id }}">
                                                <i class="fa fa-compress"></i>
                                            </button>

                                            <!-- Wishlist -->
                                            <form action="{{ route('wishlist.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="btn-link">
                                                    <i class="fa fa-heart-o"></i>
                                                </button>
                                            </form>
                                        </div>

                                        <!-- Product Badges -->
                                        @if($product->is_new)
                                            <span class="product-badge new">New</span>
                                        @endif

                                        @if($product->on_sale)
                                            <span class="product-badge sale">Sale</span>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    {{ $products->appends(request()->query())->links() }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="products-settings-option d-block d-md-flex">
                        <nav class="page-pagination">
                            {{ $products->appends(request()->query())->links() }}
                        </nav>

                        <div class="product-per-page d-flex align-items-center mt-3 mt-md-0">
                            <label for="show-per-page">Show Per Page</label>
                            <select name="show-per-page" id="show-per-page">
                                <option value="9" {{ request('show-per-page') == '9' ? 'selected' : '' }}>9</option>
                                <option value="15" {{ request('show-per-page') == '15' ? 'selected' : '' }}>15</option>
                                <option value="21" {{ request('show-per-page') == '21' ? 'selected' : '' }}>21</option>
                                <option value="27" {{ request('show-per-page') == '27' ? 'selected' : '' }}>27</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Shop Page Content End -->
        </div>
    </div>
</div>
<!--== Page Content Wrapper End ==-->
@endSection

<!-- Quick View Modals -->
@foreach($products as $product)
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
                            RM {{ number_format($product->base_price, 2) }}
                            @if($product->on_sale)
                                <span class="text-danger">RM {{ number_format($product->sale_price, 2) }}</span>
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
@endsection