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
                <div class="cart-table table-responsive">
                    @if($wishlistItems->isEmpty())
                        <div class="alert alert-info text-center py-5">
                            Your wishlist is empty.
                            <a href="{{ route('shop') }}" class="alert-link">Start shopping now!</a>
                        </div>
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
                                    <td class="pro-thumbnail text-center">
                                        <a href="{{ route('shop.show', $item->product->id) }}">
                                            @if($item->product->thumbnail)
                                                <img class="img-fluid rounded"
                                                     src="{{ asset($item->product->thumbnail) }}"
                                                     alt="{{ $item->product->name }}"
                                                     style="max-height: 100px; object-fit: contain;">
                                            @else
                                                <img src="{{ asset('images/placeholder-product.jpg') }}"
                                                     alt="No image available"
                                                     class="img-fluid rounded"
                                                     style="max-height: 100px; object-fit: contain;">
                                            @endif
                                        </a>
                                    </td>

                                    <td class="pro-title align-middle">
                                        <a href="{{ route('shop.show', $item->product->id) }}"
                                           class="text-dark text-decoration-none hover-underline">
                                            {{ $item->product->name }}
                                        </a>
                                    </td>

                                    <td class="pro-price align-middle">
                                        <span>
                                            @if($item->product->on_sale && $item->product->sale_price)
                                                <del class="text-muted">RM {{ number_format($item->product->base_price, 2) }}</del>
                                                <br>
                                                <strong class="text-danger">RM {{ number_format($item->product->sale_price, 2) }}</strong>
                                            @else
                                                RM {{ number_format($item->product->base_price, 2) }}
                                            @endif
                                        </span>
                                    </td>

                                    <td class="pro-quantity align-middle">
                                        @if($item->product->stock > 0)
                                            <span class="badge bg-success">In Stock</span>
                                        @else
                                            <span class="badge bg-danger">Out of Stock</span>
                                        @endif
                                    </td>

                                    <td class="pro-subtotal align-middle">
                                        @if($item->product->stock > 0)
                                            <form action="{{ route('cart.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    Add to Cart
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-sm btn-secondary" disabled>
                                                Add to Cart
                                            </button>
                                        @endif
                                    </td>

                                    <td class="pro-remove align-middle">
                                        <form action="{{ route('wishlist.destroy', $item->id) }}" method="POST" class="delete-form">
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

                        <!-- Clear All Wishlist -->
                        <div class="mt-4 text-end">
                            <form action="{{ route('wishlist.destroy.all') }}" method="POST" class="delete-form">
                                @csrf
                                {{-- @method('DELETE') --}}
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="fa fa-trash"></i> Clear Wishlist
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Wishlist Page Content End -->
    </div>
</div>
<!--== Page Content Wrapper End ==-->




<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Handle all delete forms with SweetAlert
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const isClearAll = this.action.includes('clear-all');

            Swal.fire({
                title: isClearAll ? 'Clear Entire Wishlist?' : 'Remove Item?',
                text: isClearAll
                    ? "This will remove all items from your wishlist. You won't be able to undo this!"
                    : "This item will be removed from your wishlist.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: isClearAll ? 'Yes, Clear All' : 'Yes, Remove',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form
                    form.submit();
                }
            });
        });
    });

    // Show success/error messages from session (Laravel flash)
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false,
            position: 'top-end',
            toast: true
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('error') }}',
        });
    @endif
});
</script>
@endsection
