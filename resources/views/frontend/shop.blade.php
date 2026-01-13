@extends('frontend.master')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Whoops!</strong> There were some problems with your input.<br>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
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
                                                        {{ $category->name }} ({{ $category->products_count ?? 0 }})
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
                                                        {{ $brand->name }} ({{ $brand->products_count ?? 0 }})
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
                                <span class="show-items">Showing {{ $products->count() }} of {{ $products->total() }} items</span>
                            </div>

                            <div class="product-sort_by d-flex align-items-center mt-3 mt-md-0">
                                <label for="sort">Sort By:</label>
                                <form action="{{ route('shop') }}" method="GET" id="sort-form">
                                    <select name="sort" id="sort" onchange="this.form.submit()">
                                        <option value="relevance" {{ request('sort') == 'relevance' ? 'selected' : '' }}>Relevance</option>
                                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name, A to Z</option>
                                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name, Z to A</option>
                                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price low to high</option>
                                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price high to low</option>
                                    </select>
                                    @foreach(request()->query() as $key => $value)
                                        @if($key !== 'sort')
                                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                        @endif
                                    @endforeach
                                </form>
                            </div>
                        </div>

                        <div class="shop-page-products-wrap">
                            <div class="products-wrapper">
                                <div class="row">
                                    @forelse($products as $product)
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
                                                            <img src="{{ asset('images/placeholder.png') }}"
                                                                 alt="No image available"
                                                                 class="img-fluid">
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
                                                        @if($product->on_sale && $product->sale_price)
                                                            <del>RM {{ number_format($product->base_price, 2) }}</del>
                                                            RM {{ number_format($product->sale_price, 2) }}
                                                        @else
                                                            RM {{ number_format($product->base_price, 2) }}
                                                        @endif
                                                    </span>

                                                    <!-- Description -->
                                                    <p class="products-desc">
                                                        {{ Str::limit($product->description ?? 'No description available.', 120) }}
                                                    </p>

                                                    <!-- Action Buttons -->
                                                    <div class="product-actions">
                                                        <!-- Add to Cart (AJAX) -->
                                                        <form action="{{ route('cart.store') }}" method="POST" class="add-to-cart-form d-inline">
                                                            @csrf
                                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                            <button type="submit" class="btn btn-add-to-cart">
                                                                + Add to Cart
                                                            </button>
                                                        </form>

                                                        <!-- Wishlist Icon (AJAX - exactly as before) -->
                                                        <form action="{{ route('wishlist.store') }}" method="POST" class="add-to-wishlist-form d-inline ms-2">
                                                            @csrf
                                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                            <button type="submit" class="btn-link text-danger">
                                                                <i class="fa fa-heart-o"></i>
                                                            </button>
                                                        </form>
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
                                    @empty
                                        <div class="col-12 text-center py-5">
                                            <h4>No products found matching your criteria.</h4>
                                            <a href="{{ route('shop') }}" class="btn btn-primary mt-3">Browse All Products</a>
                                        </div>
                                    @endforelse
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
                                <select name="show-per-page" id="show-per-page" onchange="document.getElementById('sort-form').submit()">
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

    <!-- Quick View Modals -->
    @foreach($products as $product)
        <div class="modal fade" id="quickView-{{ $product->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        <div class="row">
                            <div class="col-md-6">
                                @if($product->thumbnail)
                                    <img src="{{ asset($product->thumbnail) }}"
                                         class="img-fluid"
                                         alt="{{ $product->name }}">
                                @else
                                    <img src="{{ asset('images/placeholder.png') }}"
                                         class="img-fluid"
                                         alt="No image available">
                                @endif
                            </div>
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


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Common AJAX handler for Add to Cart and Wishlist
    async function handleAjaxForm(form, successTitle, successMessage) {
        const button = form.querySelector('button');
        const originalHTML = button.innerHTML;
        button.disabled = true;
        button.innerHTML = 'Processing...';

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest' // Helps Laravel recognize AJAX
                }
            });

            let data;
            try {
                data = await response.json();
            } catch (jsonError) {
                console.error('Invalid JSON response:', await response.text());
                throw new Error('Server returned invalid response');
            }

            button.disabled = false;
            button.innerHTML = originalHTML;

            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: successTitle,
                    text: data.message || successMessage,
                    timer: 2000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });

                // Optional: Update cart count in header if you have a cart icon
                if (data.cart_count !== undefined && document.querySelector('.cart-count')) {
                    document.querySelector('.cart-count').textContent = data.cart_count;
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message || 'Failed to process request'
                });
            }
        } catch (error) {
            console.error('AJAX Error:', error);
            button.disabled = false;
            button.innerHTML = originalHTML;
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Something went wrong. Please try again or refresh the page.'
            });
        }
    }

    // AJAX Add to Cart
    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            handleAjaxForm(form, 'Added to Cart!', 'Item added successfully');
        });
    });

    // AJAX Add to Wishlist (heart icon stays exactly as before)
    document.querySelectorAll('.add-to-wishlist-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            handleAjaxForm(form, 'Added to Wishlist!', 'Item saved for later');
        });
    });
});
</script>
@endsection
