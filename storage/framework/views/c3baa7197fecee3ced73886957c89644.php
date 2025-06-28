<?php $__env->startSection('content'); ?>
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

        <?php if(\Session::has('status')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(\Session::get('status')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if(\Session::has('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(\Session::get('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
<?php endif; ?>
<!--== Page Title Area Start ==-->
<div id="page-title-area">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="page-title-content">
                    <h1>Shopping Cart</h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                        <li><a href="<?php echo e(route('shop')); ?>">Shop</a></li>
                        <li><a href="<?php echo e(route('cart.index')); ?>" class="active">Cart</a></li>
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
        <!-- Cart Page Content Start -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Cart Table Area -->
                <div class="cart-table table-responsive">
                    <?php if($cartItems->isEmpty()): ?>
                        <div class="alert alert-info">Your cart is empty</div>
                    <?php else: ?>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="pro-thumbnail">Thumbnail</th>
                            <th class="pro-title">Product</th>
                            <th class="pro-price">Price</th>
                            <th class="pro-quantity">Quantity</th>
                            <th class="pro-subtotal">Total</th>
                            <th class="pro-remove">Remove</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="pro-thumbnail">
                                <a href="<?php echo e(route('product.show', $item->product->id)); ?>">
                                    <?php if($item->product->thumbnail): ?>
                                    <img class="img-fluid"
                                         src="<?php echo e(asset($item->product->thumbnail)); ?>"
                                         alt="<?php echo e($item->product->name); ?>"/>
                                    <?php else: ?>
                                    <div class="img-placeholder"></div>
                                    <?php endif; ?>
                                </a>
                            </td>
                            <td class="pro-title">
                                <a href="<?php echo e(route('product.show', $item->product->id)); ?>">
                                    <?php echo e($item->product->name); ?>

                                </a>
                            </td>
                            <td class="pro-price">
                                <span>RM <?php echo e(number_format($item->product->sale_price, 2)); ?></span>
                            </td>
                            <td class="pro-quantity">
                                <form action="<?php echo e(route('cart.update', $item->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <div class="pro-qty">
                                        <input type="number"
                                               name="quantity"
                                               value="<?php echo e($item->quantity); ?>"
                                               min="1">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary mt-2">Update</button>
                                </form>
                            </td>
                            <td class="pro-subtotal">
                                <span>RM <?php echo e(number_format($item->product->sale_price * $item->quantity, 2)); ?></span>
                            </td>
                            <td class="pro-remove">
                                <form action="<?php echo e(route('cart.destroy', $item->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-link text-danger">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php endif; ?>
                </div>

                <?php if(!$cartItems->isEmpty()): ?>
                <!-- Cart Update Option -->
                <div class="cart-update-option d-block d-lg-flex">
                    <div class="apply-coupon-wrapper">
                        <form action="#" method="post" class="d-block d-md-flex">
                            <input type="text" placeholder="Enter Your Coupon Code" name="coupon"/>
                            <button type="submit" class="btn-add-to-cart">Apply Coupon</button>
                        </form>
                    </div>
                    <div class="cart-update">
                        <a href="<?php echo e(route('shop')); ?>" class="btn-add-to-cart">Continue Shopping</a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if(!$cartItems->isEmpty()): ?>
        <div class="row mt-5">
            <div class="col-lg-6 ms-auto">
                <!-- Cart Calculation Area -->
                <div class="cart-calculator-wrapper">
                    <h3>Cart Totals</h3>
                    <div class="cart-calculate-items">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <td>Sub Total</td>
                                    <td>RM <?php echo e(number_format($total, 2)); ?></td>
                                </tr>
                                <tr>
                                    <td>Shipping</td>
                                    <td>
                                        <?php if($total > 500): ?>
                                            FREE
                                        <?php else: ?>
                                            RM <?php echo e(number_format(50, 2)); ?> 
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td class="total-amount">
                                        <?php if($total > 500): ?>
                                            RM <?php echo e(number_format($total, 2)); ?>

                                        <?php else: ?>
                                            RM <?php echo e(number_format($total + 50, 2)); ?>

                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <a href="<?php echo e(route('checkout')); ?>" class="btn-add-to-cart">Proceed To Checkout</a>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <!-- Cart Page Content End -->
    </div>
</div>
<!--== Page Content Wrapper End ==-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lola\resources\views/frontend/cart.blade.php ENDPATH**/ ?>