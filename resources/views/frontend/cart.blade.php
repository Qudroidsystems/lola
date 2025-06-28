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
                        <div class="alert alert-info">Your cart is empty</div>
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
                        <tr>
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
                                <span>RM {{ number_format($item->product->sale_price, 2) }}</span>
                            </td>
                            <td class="pro-quantity">
                                <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="pro-qty">
                                        <input type="number"
                                               name="quantity"
                                               value="{{ $item->quantity }}"
                                               min="1">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary mt-2">Update</button>
                                </form>
                            </td>
                            <td class="pro-subtotal">
                                <span>RM {{ number_format($item->product->sale_price * $item->quantity, 2) }}</span>
                            </td>
                            <td class="pro-remove">
                                <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
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
                                    <td>RM {{ number_format($total, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Shipping</td>
                                    <td>
                                        @if($total > 500)
                                            FREE
                                        @else
                                            RM {{ number_format(50, 2) }} {{-- Example shipping calculation --}}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td class="total-amount">
                                        @if($total > 500)
                                            RM {{ number_format($total, 2) }}
                                        @else
                                            RM {{ number_format($total + 50, 2) }}
                                        @endif
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
@endsection