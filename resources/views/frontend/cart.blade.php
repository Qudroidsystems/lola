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
                        <h1>Shopping Cart</h1>
                        <ul class="breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('shop') }}">Shop</a></li>
                            <li><a href="{{ route('cart.index') }}" class="active">Cart</a></li>
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
            <!-- Cart Page Content Start -->
            <div class="row">
                <div class="col-lg-12">
                    <!-- Cart Table Area -->
                    <div class="cart-table table-responsive">
                        @if($cartItems->isEmpty())
                            <div class="alert alert-info text-center py-5">
                                Your cart is empty.
                                <a href="{{ route('shop') }}" class="alert-link">Start shopping now!</a>
                            </div>
                        @else
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="pro-thumbnail">Thumbnail</th>
                                        <th class="pro-title">Product</th>
                                        <th class="pro-price">Price</th>
                                        <th class="pro-quantity">Quantity</th>
                                        <th class="pro-subtotal">Total</th>
                                        <th class="pro-remove">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($cartItems as $item)
                                    <tr data-cart-item-id="{{ $item->id }}">
                                        <td class="pro-thumbnail">
                                            <a href="{{ route('product.show', $item->product->id) }}">
                                                @if($item->product->thumbnail)
                                                    <img class="img-fluid"
                                                         src="{{ asset($item->product->thumbnail) }}"
                                                         alt="{{ $item->product->name }}"/>
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
                                            <span>RM {{ number_format($item->product->sale_price ?? $item->product->base_price, 2) }}</span>
                                        </td>
                                        <td class="pro-quantity">
                                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="update-cart-form">
                                                @csrf
                                                @method('PUT')
                                                <div class="pro-qty">
                                                    <input type="number"
                                                           name="quantity"
                                                           value="{{ $item->quantity }}"
                                                           min="1"
                                                           class="form-control text-center">
                                                </div>
                                                <button type="submit" class="btn btn-sm btn-primary mt-2 update-btn">
                                                    Update
                                                </button>
                                            </form>
                                        </td>
                                        <td class="pro-subtotal">
                                            <span class="subtotal-amount">
                                                RM {{ number_format(($item->product->sale_price ?? $item->product->base_price) * $item->quantity, 2) }}
                                            </span>
                                        </td>
                                        <td class="pro-remove">
                                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST" class="delete-cart-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger p-0 border-0 bg-transparent">
                                                    <i class="fa fa-trash-o fa-lg"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>

                    @if(!$cartItems->isEmpty())
                    <!-- Cart Update Option -->
                    <div class="cart-update-option d-block d-lg-flex">
                        <div class="apply-coupon-wrapper">
                            <form action="#" method="post" class="d-block d-md-flex">
                                <input type="text" placeholder="Enter Your Coupon Code" name="coupon"/>
                                <button type="submit" class="btn-add-to-cart">Apply Coupon</button>
                            </form>
                        </div>
                        <div class="cart-update">
                            <a href="{{ route('shop') }}" class="btn-add-to-cart">Continue Shopping</a>
                        </div>
                    </div>

                    <!-- Clear Cart Button -->
                    <div class="mt-4 text-end">
                        <form action="{{ route('cart.clear') }}" method="POST" class="delete-cart-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="fa fa-trash"></i> Clear Cart
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>

            @if(!$cartItems->isEmpty())
            <div class="row mt-5">
                <div class="col-lg-6 ms-auto">
                    <!-- Cart Calculation Area -->
                    <div class="cart-calculator-wrapper">
                        <h3>Cart Totals</h3>
                        <div class="cart-calculate-items">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Sub Total</td>
                                        <td>RM <span id="subtotal">{{ number_format($total, 2) }}</span></td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td>Contact The Seller</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td class="total-amount">
                                            RM <span id="grand-total">{{ number_format($total, 2) }}</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <a href="{{ route('checkout') }}" class="btn-add-to-cart">Proceed To Checkout</a>
                    </div>
                </div>
            </div>
            @endif
            <!-- Cart Page Content End -->
        </div>
    </div>
    <!--== Page Content Wrapper End ==-->



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = '{{ csrf_token() }}';

    // Common AJAX handler for cart actions
    async function handleCartAction(url, method = 'POST', body = null, successMessage = 'Action completed!') {
        try {
            const response = await fetch(url, {
                method: method,
                body: body,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: data.message || successMessage,
                    timer: 2000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });

                // Optional: Reload page or update UI dynamically
                setTimeout(() => location.reload(), 1500);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message || 'Failed to perform action'
                });
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Something went wrong. Please try again.'
            });
        }
    }

    // Update Quantity (AJAX)
    document.querySelectorAll('.update-cart-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(form);
            handleCartAction(form.action, 'POST', formData, 'Cart updated!');
        });
    });

    // Remove Item (AJAX with confirmation)
    document.querySelectorAll('.delete-cart-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Remove Item?',
                text: "This item will be removed from your cart.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Remove',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    handleCartAction(form.action, 'DELETE', null, 'Item removed!');
                }
            });
        });
    });

    // Clear Entire Cart (AJAX with confirmation)
    document.querySelectorAll('form[action*="clear"]').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Clear Entire Cart?',
                text: "All items will be removed. This cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Clear All'
            }).then((result) => {
                if (result.isConfirmed) {
                    handleCartAction(form.action, 'POST', null, 'Cart cleared!');
                }
            });
        });
    });

    // Session flash messages
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('error') }}'
        });
    @endif
});
</script>
@endsection
