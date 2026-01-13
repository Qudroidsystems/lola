@extends('frontend.master')

@section('content')
    <!-- Page Title -->
    <div id="page-title-area">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="page-title-content">
                        <h1>Order Placed!</h1>
                        <ul class="breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('cart.index') }}">Cart</a></li>
                            <li class="active">Success</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Content -->
    <div id="page-content-wrapper" class="p-9">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="success-wrapper bg-white p-5 rounded shadow-sm border">
                        @if (session('success'))
                            <div class="alert alert-success mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        <h2 class="mb-4 text-success">Thank You for Your Order! 🎉</h2>
                        <p class="lead mb-5">
                            Your order has been placed successfully.<br>
                            Please chat with the seller on WhatsApp to confirm payment and delivery details.
                        </p>

                        <!-- Auto-redirect WhatsApp button -->
                        <a href="{{ session('whatsapp_url') }}" id="whatsapp-redirect-btn" class="btn btn-success btn-lg d-flex align-items-center justify-content-center gap-3 mx-auto" target="_blank">
                            <i class="fab fa-whatsapp fa-2x"></i>
                            <span>Open WhatsApp Chat Now</span>
                        </a>

                        <div class="mt-4">
                            <small class="text-muted">
                                Redirecting in <span id="countdown">5</span> seconds...
                            </small>
                        </div>

                        <p class="mt-5">
                            <a href="{{ route('shop') }}" class="text-primary">Continue Shopping</a> |
                            <a href="{{ route('user.dashboard') }}" class="text-primary">View Orders</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-redirect to WhatsApp after 5 seconds
        let seconds = 5;
        const countdownEl = document.getElementById('countdown');
        const whatsappBtn = document.getElementById('whatsapp-redirect-btn');

        const timer = setInterval(() => {
            seconds--;
            countdownEl.textContent = seconds;

            if (seconds <= 0) {
                clearInterval(timer);
                window.open(whatsappBtn.href, '_blank');
            }
        }, 1000);
    </script>
@endsection
