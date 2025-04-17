<?php $__env->startSection('content'); ?>
    <!--== Page Title Area Start ==-->
    <div id="page-title-area">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="page-title-content">
                        <h1>Order Successful</h1>
                        <ul class="breadcrumb">
                            <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                            <li><a href="<?php echo e(route('cart.index')); ?>">Cart</a></li>
                            <li><a href="#" class="active">Order Success</a></li>
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
            <div class="alert alert-success text-center">
                <h3>Thank You for Your Purchase!</h3>
                <p>Your order has been successfully placed. You'll receive a confirmation email soon.</p>
                <a href="<?php echo e(route('home')); ?>" class="btn-add-to-cart">Continue Shopping</a>
            </div>
        </div>
    </div>
    <!--== Page Content Wrapper End ==-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lola\resources\views/frontend/order-success.blade.php ENDPATH**/ ?>