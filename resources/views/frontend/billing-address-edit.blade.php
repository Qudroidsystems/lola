@extends('frontend.master')
@section('content')
    <!--== Page Title Area Start ==-->
    <div id="page-title-area">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="page-title-content">
                        <h1>{{ $address->exists ? 'Edit' : 'Add' }} Address</h1>
                        <ul class="breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                            <li><a href="#" class="active">{{ $address->exists ? 'Edit' : 'Add' }} Address</a></li>
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

            <div class="row">
                <div class="col-lg-6">
                    <h3>{{ $address->exists ? 'Edit' : 'Add' }} Billing Address</h3>
                    <form action="{{ route('user.address.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="street">Street</label>
                            <input type="text" class="form-control" name="street" value="{{ old('street', $address->street ?? '') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" name="city" value="{{ old('city', $address->city ?? '') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" class="form-control" name="state" value="{{ old('state', $address->state ?? '') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="zip">Zip Code</label>
                            <input type="text" class="form-control" name="zip" value="{{ old('zip', $address->zip ?? '') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{ old('phone', $address->phone ?? '') }}">
                        </div>
                        <button type="submit" class="btn-add-to-cart">Save Address</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--== Page Content Wrapper End ==-->
@endsection