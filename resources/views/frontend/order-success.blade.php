@extends('frontend.master')
@section('content')
    <!--== Page Title Area Start ==-->
    <div id="page-title-area">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="page-title-content">
                        <h1>Order Successful</h1>
                        <ul class="breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('cart.index') }}">Cart</a></li>
                            <li><a href="#" class="active">Order Success</a></li>
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
            <div class="alert alert-success text-center">
                <h3>Thank You for Your Purchase!</h3>
                <p>Your order has been successfully placed. You'll receive a confirmation email soon.</p>
                <a href="{{ route('home') }}" class="btn-add-to-cart">Continue Shopping</a>
            </div>
        </div>
    </div>
    <!--== Page Content Wrapper End ==-->
@endsection