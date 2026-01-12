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

            <div class="row">
                <div class="col-lg-6">
                    <!-- Billing Details & Payment -->
                    <div class="billing-details-wrapper">
                        <h3>Billing Details</h3>
                        <form id="payment-form">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">Full Name</label>
                                <input type="text" class="form-control" id="name"
                                       value="{{ auth()->user()->name ?? old('name') }}" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="email"
                                       value="{{ auth()->user()->email ?? old('email') }}" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="card-element">Credit or Debit Card</label>
                                <div id="card-element" class="form-control p-3"></div>
                                <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3 w-100 py-3 fw-bold">
                                Pay RM {{ number_format($total, 2) }}
                            </button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-6">
                    <!-- Order Summary -->
                    <div class="cart-calculator-wrapper">
                        <h3>Order Summary</h3>
                        <div class="cart-calculate-items">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        @foreach ($cartItems as $item)
                                            <tr>
                                                <td class="fw-medium">
                                                    {{ $item->product->name }} × {{ $item->quantity }}
                                                </td>
                                                <td class="text-end">
                                                    RM {{ number_format($item->product->sale_price * $item->quantity, 2) }}
                                                </td>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            <td><strong>Subtotal</strong></td>
                                            <td class="text-end">
                                                RM {{ number_format($total - $shipping, 2) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Shipping</td>
                                            <td class="text-end">
                                                RM {{ number_format($shipping, 2) }}
                                            </td>
                                        </tr>
                                        <tr class="table-active">
                                            <td><strong>Total</strong></td>
                                            <td class="text-end fw-bold">
                                                RM {{ number_format($total, 2) }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- WhatsApp Chat Button - FIXED & RELIABLE -->
                            <a href="#" id="whatsapp-button"
                               class="btn btn-success btn-lg w-100 mt-4 d-flex align-items-center justify-content-center gap-3"
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

    <!-- Stripe.js -->
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // === Stripe Payment Logic (unchanged) ===
            const stripe = Stripe('{{ env('STRIPE_KEY') }}');
            const elements = stripe.elements();
            const cardElement = elements.create('card', {
                style: {
                    base: {
                        fontSize: '16px',
                        color: '#424770',
                        '::placeholder': { color: '#aab7c4' },
                    },
                },
            });
            cardElement.mount('#card-element');

            const paymentForm = document.getElementById('payment-form');
            const cardErrors = document.getElementById('card-errors');

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

                    const result = await stripe.confirmCardPayment(clientSecret, {
                        payment_method: {
                            card: cardElement,
                            billing_details: {
                                name: document.getElementById('name').value,
                                email: document.getElementById('email').value,
                            },
                        },
                    });

                    if (result.error) {
                        cardErrors.textContent = result.error.message;
                    } else if (result.paymentIntent.status === 'succeeded') {
                        const formData = new FormData();
                        formData.append('payment_intent', result.paymentIntent.id);
                        formData.append('_token', '{{ csrf_token() }}');

                        await fetch('{{ route('checkout.process') }}', {
                            method: 'POST',
                            body: formData,
                        });

                        window.location.href = '{{ route('order.success') }}';
                    }
                });
            }).catch(err => {
                cardErrors.textContent = 'Failed to create payment intent. Please try again.';
            });

            // === WhatsApp Button - Modern & Reliable (2025–2026) ===
            const cartItems = @json($cartItems);
            const total = {{ $total }};
            const shipping = {{ $shipping }};
            const sellerPhone = '601136655467'; // International format, no + or spaces

            let message = "Hello! 👋\n";
            message += "I'd like to place an order from your website:\n\n";

            cartItems.forEach(item => {
                const itemTotal = (item.product.sale_price * item.quantity).toFixed(2);
                message += `• ${item.product.name} × ${item.quantity} = RM ${itemTotal}\n`;
            });

            message += `\nSubtotal: RM ${(total - shipping).toFixed(2)}`;
            message += `\nShipping: RM ${shipping.toFixed(2)}`;
            message += `\n─────────────────`;
            message += `\n*Total: RM ${total.toFixed(2)}*`;
            message += `\n\nPlease confirm availability and let me know how to proceed with payment. Thank you! 😊`;

            const encodedMessage = encodeURIComponent(message);
            const whatsappUrl = `https://wa.me/${sellerPhone}?text=${encodedMessage}`;

            const whatsappButton = document.getElementById('whatsapp-button');
            whatsappButton.href = whatsappUrl;

            // Visual feedback when clicked
            whatsappButton.addEventListener('click', () => {
                const originalText = whatsappButton.innerHTML;
                whatsappButton.innerHTML = '<i class="fab fa-whatsapp fa-2x"></i> <span>Opening WhatsApp...</span>';
                setTimeout(() => {
                    whatsappButton.innerHTML = originalText;
                }, 2000);
            });
        });
    </script>
@endsection
