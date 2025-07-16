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

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!--== Page Title Area Start ==-->
    <div id="page-title-area">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="page-title-content">
                        <h1>Dashboard</h1>
                        <ul class="breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('user.dashboard') }}" class="active">Dashboard</a></li>
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
            <div class="row">
                <div class="col-lg-12">
                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <div class="row">
                            <!-- Sidebar Navigation -->
                            <div class="col-lg-3">
                                <div class="myaccount-tab-menu nav" role="tablist">
                                    <a href="#dashboard" class="active" data-bs-toggle="tab"><i class="fa fa-dashboard"></i> Dashboard</a>
                                    <a href="#orders" data-bs-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Orders</a>
                                    <a href="#address" data-bs-toggle="tab"><i class="fa fa-map-marker"></i> Address</a>
                                    <a href="#account-info" data-bs-toggle="tab"><i class="fa fa-user"></i> Account Details</a>
                                    {{-- <a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> Logout</a> --}}
                                     <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); this.closest('form').submit();"><i class="fa fa-sign-out"></i>
                                                    Logout
                                                </a>
                                            </form>
                                </div>
                            </div>

                            <!-- Content Area -->
                            <div class="col-lg-9 mt-5 mt-lg-0">
                                <div class="tab-content" id="myaccountContent">
                                    <!-- Dashboard -->
                                    <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Dashboard</h3>
                                            <div class="welcome">
                                                <p>Hello, <strong>{{ $user->name }}</strong> (Not <strong>{{ $user->name }}?</strong> )
                                                    <form method="POST" action="{{ route('logout') }}">
                                                        @csrf
                                                        <a href="{{ route('logout') }}"
                                                        onclick="event.preventDefault(); this.closest('form').submit();"><i class="fa fa-sign-out"></i>
                                                            Logout
                                                        </a>
                                                    </form>
                                                </p>
                                            </div>
                                            <p>From your dashboard, you can check your orders, manage your address, and edit account details.</p>
                                        </div>
                                    </div>

                                    <!-- Orders Section -->
                                    <div class="tab-pane fade" id="orders" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Orders</h3>
                                            <div class="myaccount-table table-responsive text-center">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Order</th>
                                                            <th>Date</th>
                                                            <th>Status</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($orders as $order)
                                                            <tr>
                                                                <td>{{ $order->id }}</td>
                                                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                                                <td>{{ ucfirst($order->status) }}</td>
                                                                <td>RM {{ number_format($order->total, 2) }}</td>
                                                            </tr>
                                                        @empty
                                                            <tr><td colspan="4">No orders found.</td></tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Address -->
                                    <div class="tab-pane fade" id="address" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Billing Address</h3>
                                            @if($billingAddress)
                                                <address>
                                                    <p><strong>{{ $user->name }}</strong></p>
                                                    <p>{{ $billingAddress->street }}, {{ $billingAddress->city }}<br>
                                                        {{ $billingAddress->state }}, {{ $billingAddress->zip }}</p>
                                                    <p>Phone: {{ $billingAddress->phone ?? 'N/A' }}</p>
                                                </address>
                                                <a href="{{ route('user.address.edit') }}" class="btn-add-to-cart"><i class="fa fa-edit"></i> Edit Address</a>
                                            @else
                                                <p>No billing address added.</p>
                                                <a href="{{ route('user.address.edit') }}" class="btn-add-to-cart"><i class="fa fa-plus"></i> Add Address</a>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Account Details -->
                                    <div class="tab-pane fade" id="account-info" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Account Details</h3>
                                            <form action="{{ route('user.update') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label class="required">Full Name</label>
                                                            <input type="text" name="name" value="{{ $user->name }}" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label class="required">Email</label>
                                                            <input type="email" name="email" value="{{ $user->email }}" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn-add-to-cart" type="submit">Save Changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Content End -->
                        </div>
                    </div>
                    <!-- My Account Page End -->
                </div>
            </div>
        </div>
    </div>
    <!--== Page Content Wrapper End ==-->
@endsection