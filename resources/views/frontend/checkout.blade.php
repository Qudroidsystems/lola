@extends('frontend.master')

@section('content')
    <!-- Page Title Area -->
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

    <!-- Page Content Wrapper -->
    <div id="page-content-wrapper" class="p-9">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Whoops!</strong> There were some problems with your input.<br>
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
                <!-- Billing & Payment Column -->
                <div class="col-lg-6">
                    <div class="billing-details-wrapper bg-white p-4 p-lg-5 rounded shadow-sm border">
                        <h3 class="mb-4">Billing Details</h3>

                        <form id="payment-form">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name"
                                       value="{{ auth()->check() ? auth()->user()->name : old('name') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email"
                                       value="{{ auth()->check() ? auth()->user()->email : old('email') }}" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Credit or Debit Card</label>
                                <div id="card-element" class="form-control p-3 border rounded"></div>
                                <div id="card-errors" role="alert" class="text-danger mt-2 small"></div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold py-3" id="submit-payment">
                                Pay RM {{ number_format($total ?? 0, 2) }}
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Order Summary Column -->
                <div class="col-lg-6">
                    <div class="cart-calculator-wrapper bg-white p-4 p-lg-5 rounded shadow-sm border">
                        <h3 class="mb-4">Order Summary</h3>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    @forelse($cartItems ?? [] as $item)
                                        <tr>
                                            <td class="py-2 align-middle">
                                                {{ $item->product->name ?? 'Product' }} × {{ $item->quantity ?? 1 }}
                                            </td>
                                            <td class="text-end py-2 fw-medium">
                                                RM {{ number_format(($item->product->sale_price ?? 0) * ($item->quantity ?? 1), 2) }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center py-4 text-muted">
                                                Your cart is empty
                                            </td>
                                        </tr>
                                    @endforelse

                                    <tr class="border-top">
                                        <td class="py-3"><strong>Subtotal</strong></td>
                                        <td class="text-end py-3">
                                            RM {{ number_format(($total ?? 0) - ($shipping ?? 0), 2) }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="py-2">Shipping</td>
                                        <td class="text-end py-2">
                                            RM {{ number_format($shipping ?? 0, 2) }}
                                        </td>
                                    </tr>

                                    <tr class="border-top fw-bold fs-5">
                                        <td class="py-3">Total</td>
                                        <td class="text-end py-3 text-primary">
                                            RM {{ number_format($total ?? 0, 2) }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- WhatsApp Button -->
                        <a href="#"
                           id="whatsapp-button"
                           class="btn btn-success btn-lg w-100 mt-4 d-flex align-items-center justify-content-center gap-3"
                           target="_blank"
                           rel="noopener noreferrer">
                            <i class="fab fa-whatsapp fa-2x"></i>
                            <span>Chat with Seller on WhatsApp</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stripe.js -->
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        (function() {
            // Prevent multiple executions
            if (window.checkoutScriptInitialized) return;
            window.checkoutScriptInitialized = true;

            // ================================
            //         Stripe Payment
            // ================================
            const stripe = Stripe('{{ env('STRIPE_KEY') }}');
            const elements = stripe.elements();
            const card = elements.create('card', {
                style: { base: { fontSize: '16px', color: '#32325d' } }
            });
            card.mount('#card-element');

            const form = document.getElementById('payment-form');
            const errorsDiv = document.getElementById('card-errors');
            const submitBtn = document.getElementById('submit-payment');

            fetch('{{ route('checkout.payment.intent') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(r => r.json())
            .then(data => {
                if (data.error) {
                    errorsDiv.textContent = data.error;
                    return;
                }

                const clientSecret = data.clientSecret;

                form.addEventListener('submit', async e => {
                    e.preventDefault();
                    submitBtn.disabled = true;

                    const {error, paymentIntent} = await stripe.confirmCardPayment(clientSecret, {
                        payment_method: {
                            card: card,
                            billing_details: {
                                name: document.getElementById('name').value,
                                email: document.getElementById('email').value
                            }
                        }
                    });

                    if (error) {
                        errorsDiv.textContent = error.message;
                        submitBtn.disabled = false;
                    } else if (paymentIntent.status === 'succeeded') {
                        const fd = new FormData();
                        fd.append('payment_intent', paymentIntent.id);
                        fd.append('_token', '{{ csrf_token() }}');

                        await fetch('{{ route('checkout.process') }}', { method: 'POST', body: fd });
                        window.location.href = '{{ route('order.success') }}';
                    }
                });
            })
            .catch(() => {
                errorsDiv.textContent = 'Failed to initialize payment system';
            });

            // ================================
            //     WhatsApp Button - FINAL VERSION
            // ================================
            const btn = document.getElementById('whatsapp-button');
            if (!btn) return;

            const cartItems = @json($cartItems ?? []);
            const total = {{ $total ?? 0 }};
            const shipping = {{ $shipping ?? 0 }};
            const phone = '601136655467';

            let msg = "Hello! 👋\nReady to place this order:\n\n";

            cartItems.forEach(item => {
                const price = Number(item?.product?.sale_price || 0);
                const qty = Number(item?.quantity || 1);
                msg += `• ${item?.product?.name || 'Item'} × ${qty} = RM ${(price * qty).toFixed(2)}\n`;
            });

            msg += `\nSubtotal: RM ${(total - shipping).toFixed(2)}`;
            msg += `\nShipping:   RM ${shipping.toFixed(2)}`;
            msg += `\n───────────────`;
            msg += `\nTOTAL:      RM ${total.toFixed(2)}`;
            msg += `\n\nPlease confirm stock & payment. Thank you!`;

            const url = `https://wa.me/${phone}?text=${encodeURIComponent(msg)}`;

            // Force replace href immediately
            btn.href = url;

            // Visual feedback (one time)
            btn.addEventListener('click', function handler() {
                const original = btn.innerHTML;
                btn.innerHTML = '<i class="fab fa-whatsapp fa-2x"></i> <span>Opening...</span>';
                setTimeout(() => btn.innerHTML = original, 1400);
                this.removeEventListener('click', handler);
            }, { once: true });
        })();
    </script>
@endsection
