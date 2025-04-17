@extends('frontend.master')

@section('content')

<!--== Page Title Area Start ==-->
<div id="page-title-area">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="page-title-content">
                    <h1>Member Area</h1>
                    <ul class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="login-register.html" class="active">Login & Register</a></li>
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
                <!-- Login & Register Content Start -->
                <div class="login-register-wrapper">
                    <!-- Login & Register tab Menu -->
                    <nav class="nav login-reg-tab-menu">
                        <a class="active" id="login-tab" data-bs-toggle="tab" href="#login">Login</a>
                        <a id="register-tab" data-bs-toggle="tab" href="#register">Register</a>
                    </nav>
                    <!-- Login & Register tab Menu -->

                    <div class="tab-content" id="login-reg-tabcontent">
                        <div class="tab-pane fade show active" id="login" role="tabpanel">
                            <div class="login-reg-form-wrap">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                    <div class="single-input-item">
                                        <input type="text"  placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus/>
                                    </div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    <div class="single-input-item">
                                         <!--begin::Password-->
                                            <input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent"  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"/>
                                        <!--end::Password-->
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                    </div>

                                    <div class="single-input-item">
                                        <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                            <div class="remember-meta">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="rememberMe">
                                                    <label class="form-check-label" for="rememberMe">Remember Me</label>
                                                </div>
                                            </div>

                                            <a href="#" class="forget-pwd">Forget Password?</a>
                                        </div>
                                    </div>

                                    <div class="single-input-item">
                                        <button class="btn-login">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="register" role="tabpanel">
                            <div class="login-reg-form-wrap">
                            <form class="form w-100" method="POST" action="{{ route('register') }}" novalidate="novalidate" id="kt_sign_up_form" >
                            @csrf
                                    <div class="single-input-item">
                                        <!--begin::Email-->
                                            <input type="text" placeholder="Full Name"   class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus/>
                                            <!--end::Email-->

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="single-input-item">
                                        <input type="email" placeholder="Enter your Email" required/>
                                    </div>
<!--begin::Email-->
<input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus/>
        <!--end::Email-->
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
       @enderror
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="single-input-item">
                                                <input type="password" placeholder="Enter your Password" required/>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="single-input-item">
                                                <input type="password" placeholder="Repeat your Password" required/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="single-input-item">
                                        <div class="login-reg-form-meta">
                                            <div class="remember-meta">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="subnewsletter">
                                                    <label class="form-check-label" for="subnewsletter">Subscribe Our
                                                        Newsletter</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="single-input-item">
                                        <button class="btn-login">Register</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Login & Register Content End -->
            </div>
        </div>
    </div>
</div>
<!--== Page Content Wrapper End ==-->

@endsection
