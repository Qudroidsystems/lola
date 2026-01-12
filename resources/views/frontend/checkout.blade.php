@extends('frontend.master')

@section('content')
    <!--== Page Title Area Start ==-->
    <div id="page-title-area">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="page-title-content">
                        <h1>Checkout</h1>
                        <ul class="breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('cart.index') }}">Cart</a></li>
                            <li><a href="{{ route('checkout') }}" class="active">Checkout</a></li>
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
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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

            <div class="row g-5">
                <!-- Left Column - Billing & Payment -->
                <div class="col-lg-6">
                    <div class="billing-details-wrapper bg-light p-4 p-lg-5 rounded shadow-sm">
                        <h3 class="mb-4">Billing Details</h3>

                        <form id="payment-form">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name"
                                       value="{{ auth()->user()?->name ?? old('name') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email"
                                       value="{{ auth()->user()?->email ?? old('email') }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="card-element" class="form-label">Credit or Debit Card</label>
                                <div id="card-element" class="form-control p-3 border"></div>
                                <div id="card-errors" role="alert" class="text-danger mt-2 small"></div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold py-3" id="pay-button">
                                Pay RM {{ number_format($total, 2) }}
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Right Column - Order Summary -->
                <div class="col-lg-6">
                    <div class="cart-calculator-wrapper bg-light p-4 p-lg-5 rounded shadow-sm">
                        <h3 class="mb-4">Order Summary</h3>

                        <div class="cart-calculate-items">
                            <div class="table-responsive">
                                <table class="table table-borderless table-sm">
                                    <tbody>
                                        @foreach ($cartItems as $item)
                                            <tr>
                                                <td class="py-2">
                                                    {{ $item->product->name }} × {{ $item->quantity }}
                                                </td>
                                                <td class="text-end py-2 fw-medium">
                                                    RM {{ number_format($item->product->sale_price * $item->quantity, 2) }}
                                                </td>
                                            </tr>
                                        @endforeach

                                        <tr class="border-top">
                                            <td class="py-3"><strong>Subtotal</strong></td>
                                            <td class="text-end py-3">
                                                RM {{ number_format($total - $shipping, 2) }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="py-2">Shipping</td>
                                            <td class="text-end py-2">
                                                RM {{ number_format($shipping, 2) }}
                                            </td>
                                        </tr>

                                        <tr class="border-top fw-bold fs-5">
                                            <td class="py-3">Total</td>
                                            <td class="text-end py-3 text-primary">
                                                RM {{ number_format($total, 2) }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- WhatsApp Button - Modern & Reliable -->
                            <a href="#" id="whatsapp-button"
                               class="btn btn-success btn-lg w-100 mt-4 d-flex align-items-center justify-content-center gap-3 shadow"
                               target="_blank" rel="noopener noreferrer">
                                <i class="fab fa-whatsapp fa-2x"></i>
                                <span>Chat with Seller on WhatsApp</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--== Page Content Wrapper End ==-->

    <!-- Stripe.js v3 -->
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // =============================================
            // Stripe Payment Integration
            // =============================================
            const stripe = Stripe('{{ env('STRIPE_KEY') }}');
            const elements = stripe.elements();
            const cardElement = elements.create('card', {
                style: {
                    base: {
                        fontSize: '16px',
                        color: '#32325d',
                        '::placeholder': { color: '#aab7c4' },
                    },
                }
            });
            cardElement.mount('#card-element');

            const paymentForm = document.getElementById('payment-form');
            const cardErrors = document.getElementById('card-errors');

            // Create Payment Intent
            fetch('{{ route('checkout.payment.intent') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    cardErrors.textContent = data.error;
                    return;
                }

                const clientSecret = data.clientSecret;

                paymentForm.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    paymentForm.querySelector('#pay-button').disabled = true;

                    const { error, paymentIntent } = await stripe.confirmCardPayment(clientSecret, {
                        payment_method: {
                            card: cardElement,
                            billing_details: {
                                name: document.getElementById('name').value,
                                email: document.getElementById('email').value,
                            },
                        }
                    });

                    if (error) {
                        cardErrors.textContent = error.message;
                        paymentForm.querySelector('#pay-button').disabled = false;
                    } else if (paymentIntent.status === 'succeeded') {
                        const formData = new FormData();
                        formData.append('payment_intent', paymentIntent.id);
                        formData.append('_token', '{{ csrf_token() }}');

                        await fetch('{{ route('checkout.process') }}', {
                            method: 'POST',
                            body: formData,
                        });

                        window.location.href = '{{ route('order.success') }}';
                    }
                });
            })
            .catch(() => {
                cardErrors.textContent = 'Failed to initialize payment. Please try again.';
            });

            // =============================================
            // WhatsApp Button - FIXED & MOST RELIABLE 2026
            // =============================================
            const cartItems = @json($cartItems);
            const total = {{ $total }};
            const shipping = {{ $shipping }};
            const sellerPhone = '601136655467'; // International format - no + sign

            let message = "Hello! 👋\n";
            message += "I'm interested in placing this order from your website:\n\n";

            cartItems.forEach(item => {
                const itemTotal = (item.product.sale_price * item.quantity).toFixed(2);
                message += `• ${item.product.name} × ${item.quantity} = RM ${itemTotal}\n`;
            });

            message += `\nSubtotal: RM ${(total - shipping).toFixed(2)}`;
            message += `\nShipping: RM ${shipping.toFixed(2)}`;
            message += `\n───────────────────────`;
            message += `\nTotal: RM ${total.toFixed(2)}`;
            message += `\n\nKindly confirm availability and guide me on next steps/payment. Thank you! 🙏`;

            const encodedMessage = encodeURIComponent(message);
            const whatsappUrl = `https://wa.me/${sellerPhone}?text=${encodedMessage}`;

            const whatsappBtn = document.getElementById('whatsapp-button');
            if (whatsappBtn) {
                whatsappBtn.href = whatsappUrl;

                // Optional: Nice visual feedback
                whatsappBtn.addEventListener('click', function() {
                    const original = whatsappBtn.innerHTML;
                    whatsappBtn.innerHTML = '<i class="fab fa-whatsapp fa-2x"></i> <span>Opening WhatsApp...</span>';
                    setTimeout(() => {
                        whatsappBtn.innerHTML = original;
                    }, 1800);
                });
            }
        });
    </script>
@endsection
