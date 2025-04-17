<?php $__env->startSection('content'); ?>
    <!--== Page Title Area Start ==-->
    <div id="page-title-area">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="page-title-content">
                        <h1>Checkout</h1>
                        <ul class="breadcrumb">
                            <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                            <li><a href="<?php echo e(route('cart.index')); ?>">Cart</a></li>
                            <li><a href="<?php echo e(route('checkout')); ?>" class="active">Checkout</a></li>
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
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo e(session('error')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-lg-6">
                    <!-- Billing Details -->
                    <div class="billing-details-wrapper">
                        <h3>Billing Details</h3>
                        <form id="payment-form">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" value="<?php echo e(auth()->user()->name); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" value="<?php echo e(auth()->user()->email); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="card-element">Credit or Debit Card</label>
                                <div id="card-element" class="form-control"></div>
                                <div id="card-errors" role="alert" class="text-danger"></div>
                            </div>
                            <button type="submit" class="btn-add-to-cart mt-3">Pay $<?php echo e(number_format($total, 2)); ?></button>
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
                                    <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($item->product->name); ?> x <?php echo e($item->quantity); ?></td>
                                            <td>$<?php echo e(number_format($item->product->sale_price * $item->quantity, 2)); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>Sub Total</td>
                                        <td>$<?php echo e(number_format($total - $shipping, 2)); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td>$<?php echo e(number_format($shipping, 2)); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td>$<?php echo e(number_format($total, 2)); ?></td>
                                    </tr>
                                </table>
                            </div>
                            <!-- WhatsApp Button -->
                            <a href="#" id="whatsapp-button" class="btn btn-success btn-lg mt-5">
                                <i class="fab fa-whatsapp"></i> Chat with Seller on WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--== Page Content Wrapper End ==-->

    <!-- Stripe JavaScript -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            // Stripe Payment Logic
            const stripe = Stripe('<?php echo e(env('STRIPE_KEY')); ?>');
            const elements = stripe.elements();
            const cardElement = elements.create('card');
            cardElement.mount('#card-element');

            const paymentForm = document.getElementById('payment-form');
            const cardErrors = document.getElementById('card-errors');

            const response = await fetch('<?php echo e(route('checkout.payment.intent')); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                },
            });
            const { clientSecret, error } = await response.json();

            if (error) {
                cardErrors.textContent = error;
                return;
            }

            paymentForm.addEventListener('submit', async (event) => {
                event.preventDefault();

                const { paymentIntent, error } = await stripe.confirmCardPayment(clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: document.getElementById('name').value,
                            email: document.getElementById('email').value,
                        },
                    },
                });

                if (error) {
                    cardErrors.textContent = error.message;
                } else if (paymentIntent.status === 'succeeded') {
                    const formData = new FormData();
                    formData.append('payment_intent', paymentIntent.id);
                    formData.append('_token', '<?php echo e(csrf_token()); ?>');

                    await fetch('<?php echo e(route('checkout.process')); ?>', {
                        method: 'POST',
                        body: formData,
                    }).then(() => {
                        window.location.href = '<?php echo e(route('order.success')); ?>';
                    });
                }
            });

            // WhatsApp Button Logic
            const cartItems = <?php echo json_encode($cartItems, 15, 512) ?>;
            const total = <?php echo e($total); ?>;
            const shipping = <?php echo e($shipping); ?>;
            const whatsappButton = document.getElementById('whatsapp-button');
            const sellerPhone = 'YOUR_SELLER_PHONE_NUMBER'; // Replace with seller's WhatsApp number, e.g., +1234567890

            const message = `Hello, I'd like to discuss my order:\n\n` +
                cartItems.map(item => 
                    `${item.product.name} x ${item.quantity} - $${(item.product.sale_price * item.quantity).toFixed(2)}`
                ).join('\n') +
                `\n\nSubtotal: $${(total - shipping).toFixed(2)}` +
                `\nShipping: $${shipping.toFixed(2)}` +
                `\nTotal: $${total.toFixed(2)}` +
                `\n\nCan we discuss alternative payment options?`;

            const encodedMessage = encodeURIComponent(message);
            whatsappButton.href = `https://wa.me/${sellerPhone}?text=${encodedMessage}`;
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lola\resources\views/frontend/checkout.blade.php ENDPATH**/ ?>