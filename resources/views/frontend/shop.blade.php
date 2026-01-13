@extends('frontend.master')

@section('content')
<style>
    .product-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .product-image-wrapper {
        position: relative;
        overflow: hidden;
        padding-top: 100%;
        background: #f8f9fa;
    }

    .product-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .product-card:hover .product-image {
        transform: scale(1.05);
    }

    .product-badges {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 2;
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .badge {
        padding: 4px 12px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        width: fit-content;
    }

    .badge-new {
        background: #28a745;
        color: white;
    }

    .badge-sale {
        background: #dc3545;
        color: white;
    }

    .product-actions {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 2;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .wishlist-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .wishlist-btn:hover {
        background: #dc3545;
        color: white;
        transform: scale(1.1);
    }

    .wishlist-btn i {
        font-size: 18px;
    }

    .product-info {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .product-name {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 8px;
        min-height: 48px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-rating {
        margin-bottom: 10px;
    }

    .star {
        color: #ffc107;
        font-size: 14px;
    }

    .star.empty {
        color: #ddd;
    }

    .product-price {
        margin-bottom: 12px;
        font-size: 20px;
        font-weight: 700;
        color: #333;
    }

    .price-original {
        text-decoration: line-through;
        color: #999;
        font-size: 16px;
        margin-right: 8px;
    }

    .price-sale {
        color: #dc3545;
    }

    .product-description {
        color: #666;
        font-size: 14px;
        margin-bottom: 15px;
        flex-grow: 1;
    }

    .add-to-cart-btn {
        width: 100%;
        padding: 12px;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .add-to-cart-btn:hover {
        background: #0056b3;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,123,255,0.3);
    }

    .filter-sidebar {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .filter-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #dee2e6;
    }

    .filter-section {
        margin-bottom: 25px;
    }

    .filter-section h6 {
        font-weight: 600;
        margin-bottom: 12px;
        color: #333;
    }

    .filter-list {
        list-style: none;
        padding: 0;
    }

    .filter-list li {
        padding: 8px 0;
    }

    .filter-list a {
        color: #666;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .filter-list a:hover {
        color: #007bff;
    }

    .toolbar {
        background: white;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .alert {
        border-radius: 8px;
        padding: 15px 20px;
        margin-bottom: 20px;
    }
</style>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops! There were some problems with your input.</strong>
    <ul class="mb-0 mt-2">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session('status'))
<div class="alert alert-info">
    {{ session('status') }}
</div>
@endif

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="container-fluid py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Shop</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Sidebar Filters -->
        <div class="col-lg-3 col-md-4">
            <div class="filter-sidebar">
                <h4 class="filter-title">Shop By</h4>

                <!-- Categories -->
                <div class="filter-section">
                    <h6>Categories</h6>
                    <ul class="filter-list">
                        @foreach($categories as $category)
                        <li>
                            <a href="?category={{ $category->id }}">
                                {{ $category->name }}
                                <span class="badge bg-secondary">{{ $category->products_count ?? 0 }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Brands -->
                <div class="filter-section">
                    <h6>Brands</h6>
                    <ul class="filter-list">
                        @foreach($brands as $brand)
                        <li>
                            <a href="?brand={{ $brand->id }}">
                                {{ $brand->name }}
                                <span class="badge bg-secondary">{{ $brand->products_count ?? 0 }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Price Range -->
                <div class="filter-section">
                    <h6>Price</h6>
                    <ul class="filter-list">
                        <li><a href="?price=0-210">RM 0 - RM 210</a></li>
                        <li><a href="?price=210-420">RM 210 - RM 420</a></li>
                        <li><a href="?price=420-840">RM 420 - RM 840</a></li>
                    </ul>
                </div>

                <!-- Search -->
                <div class="filter-section">
                    <h6>Search</h6>
                    <input type="text" class="form-control" placeholder="Search products...">
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="col-lg-9 col-md-8">
            <!-- Toolbar -->
            <div class="toolbar">
                <div class="toolbar-left">
                    <span class="text-muted">
                        Showing {{ $products->count() }} of {{ $products->total() }} items
                    </span>
                </div>

                <div class="toolbar-right d-flex gap-3">
                    <form method="GET" class="d-flex align-items-center gap-2">
                        <label class="mb-0 text-muted">Sort By:</label>
                        <select name="sort" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="">Relevance</option>
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

                    <form method="GET" class="d-flex align-items-center gap-2">
                        <label class="mb-0 text-muted">Show:</label>
                        <select name="per_page" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="9">9</option>
                            <option value="15">15</option>
                            <option value="21">21</option>
                            <option value="27">27</option>
                        </select>
                    </form>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="row g-4">
                @forelse($products as $product)
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card product-card border-0 shadow-sm">
                        <div class="product-image-wrapper">
                            @if($product->thumbnail)
                                <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                     alt="{{ $product->name }}"
                                     class="product-image">
                            @else
                                <img src="{{ asset('images/placeholder.jpg') }}"
                                     alt="No image"
                                     class="product-image">
                            @endif

                            <!-- Badges -->
                            <div class="product-badges">
                                @if($product->is_new)
                                    <span class="badge badge-new">New</span>
                                @endif
                                @if($product->on_sale)
                                    <span class="badge badge-sale">Sale</span>
                                @endif
                            </div>

                            <!-- Wishlist Button -->
                            <div class="product-actions">
                                <form action="{{ route('wishlist.store', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="wishlist-btn" title="Add to Wishlist">
                                        <i class="far fa-heart"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="product-info">
                            <h5 class="product-name">
                                <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none text-dark">
                                    {{ $product->name }}
                                </a>
                            </h5>

                            <div class="product-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= optional($product->rating)->rating)
                                        <i class="fas fa-star star"></i>
                                    @else
                                        <i class="far fa-star star empty"></i>
                                    @endif
                                @endfor
                            </div>

                            <div class="product-price">
                                @if($product->on_sale && $product->sale_price)
                                    <span class="price-original">RM {{ number_format($product->base_price, 2) }}</span>
                                    <span class="price-sale">RM {{ number_format($product->sale_price, 2) }}</span>
                                @else
                                    RM {{ number_format($product->base_price, 2) }}
                                @endif
                            </div>

                            <p class="product-description">
                                {{ Str::limit($product->description ?? 'No description available.', 120) }}
                            </p>

                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="add-to-cart-btn">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <h5>No products found matching your criteria.</h5>
                        <a href="{{ route('shop') }}" class="btn btn-primary mt-3">Browse All Products</a>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>



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
