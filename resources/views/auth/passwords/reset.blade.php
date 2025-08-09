@extends('frontend.master')

@section('content')

<!--== Page Title Area Start ==-->
<div id="page-title-area">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="page-title-content">
                    <h1>Reset Password</h1>
                    <ul class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('password.request') }}" class="active">Reset Password</a></li>
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
            <div class="col-lg-7 m-auto">
                <!-- Password Reset Content Start -->
                <div class="login-register-wrapper">
                    <div class="login-reg-form-wrap">
                        <h3>Reset Your Password</h3>
                        <p>Enter your email address to receive a password reset link.</p>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="single-input-item">
                                <input type="email" placeholder="Email" name="email" class="form-control bg-transparent @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus/>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="single-input-item">
                                <button class="btn-login">Send Password Reset Link</button>
                            </div>
                        </form>
                        <div class="single-input-item">
                            <a href="{{ route('login') }}">Back to Login</a>
                        </div>
                    </div>
                </div>
                <!-- Password Reset Content End -->
            </div>
        </div>
    </div>
</div>
<!--== Page Content Wrapper End ==-->

@endsection
