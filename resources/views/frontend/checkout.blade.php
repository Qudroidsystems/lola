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
                <!-- Billing Details Column -->
                <div class="col-lg-6">
                    <div class="billing-details-wrapper bg-white p-4 p-lg-5 rounded shadow-sm border">
                        <h3 class="mb-4">Billing Details</h3>

                        <!-- Simple Form (No Stripe) -->
                        <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
                            @csrf

                            <div class="mb-4">
                                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ auth()->check() ? auth()->user()->name : old('name') }}" required>
                                @error('name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email"
                                       value="{{ auth()->check() ? auth()->user()->email : old('email') }}" required>
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" id="phone" name="phone"
                                       value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Optional: Add address or note field -->
                            <div class="mb-4">
                                <label for="note" class="form-label">Order Notes (optional)</label>
                                <textarea class="form-control" id="note" name="note" rows="3">{{ old('note') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold py-3" id="submit-checkout">
                                Place Order & Chat with Seller
                            </button>
                        </form>

                        <div class="mt-4 text-center text-muted small">
                            <p>After submitting, you'll be redirected to WhatsApp to confirm payment & delivery.</p>
                        </div>
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
                                                RM {{ number_format(($item->product->sale_price ?? $item->product->base_price ?? 0) * ($item->quantity ?? 1), 2) }}
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

                        <!-- WhatsApp Button - Working & Reliable -->
                        <button type="button" id="whatsapp-button" class="btn btn-success btn-lg w-100 mt-4 d-flex align-items-center justify-content-center gap-3">
                            <i class="fab fa-whatsapp fa-2x"></i>
                            <span>Chat with Seller on WhatsApp</span>
                        </button>

                        <div class="text-center mt-3">
                            <small class="text-muted">
                                <strong>Note:</strong> A new tab will open → tap <strong>"Open in WhatsApp"</strong> or <strong>"Continue"</strong> to chat directly.
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        (function () {
            if (window.checkoutScriptInitialized) return;
            window.checkoutScriptInitialized = true;

            // ================================
            //     WhatsApp Button - FULLY WORKING
            // ================================
            const whatsappBtn = document.getElementById('whatsapp-button');
            if (!whatsappBtn) {
                console.warn('WhatsApp button not found');
                return;
            }

            const cartItems = @json($cartItems ?? []);
            const total = {{ $total ?? 0 }};
            const shipping = {{ $shipping ?? 0 }};
            const phone = '601136655467';

            let message = "Hello! 👋\nI'd like to place this order:\n\n";

            cartItems.forEach(item => {
                const price = Number(item?.product?.sale_price || item?.product?.base_price || 0);
                const qty = Number(item?.quantity || 1);
                message += `• ${item?.product?.name || 'Item'} × ${qty} = RM ${(price * qty).toFixed(2)}\n`;
            });

            message += `\nSubtotal: RM ${(total - shipping).toFixed(2)}`;
            message += `\nShipping: RM ${shipping.toFixed(2)}`;
            message += `\n─────────────────`;
            message += `\n*Total: RM ${total.toFixed(2)}*`;
            message += `\n\nPlease confirm availability, payment method, and delivery. Thank you! 😊`;

            const encodedMsg = encodeURIComponent(message);
            const waLink = `https://wa.me/${phone}?text=${encodedMsg}`;

            whatsappBtn.addEventListener('click', function () {
                const originalHTML = this.innerHTML;
                this.innerHTML = '<i class="fab fa-whatsapp fa-2x"></i> <span>Opening WhatsApp...</span>';

                // Open in new tab (required by modern browsers)
                window.open(waLink, '_blank');

                // Restore button
                setTimeout(() => {
                    this.innerHTML = originalHTML;
                }, 3000);

                // Clear instruction via SweetAlert
                Swal.fire({
                    icon: 'info',
                    title: 'Opening WhatsApp',
                    html: 'A new tab has opened.<br>Please tap <strong>"Open in WhatsApp"</strong> or <strong>"Continue to Chat"</strong> to start the conversation.<br><small>(Normal browser behavior on mobile)</small>',
                    timer: 7000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top'
                });
            });
        })();
    </script>
@endsection
