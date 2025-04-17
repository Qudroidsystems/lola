<?php $__env->startSection('content'); ?>

<!--== Page Title Area Start ==-->
<div id="page-title-area">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="page-title-content">
                    <h1>Wishlist</h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                        <li><a href="<?php echo e(route('shop')); ?>">Shop</a></li>
                        <li><a href="<?php echo e(route('wishlist.index')); ?>" class="active">Wishlist</a></li>
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
        <!-- Wishlist Page Content Start -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Wishlist Table Area -->
                <div class="cart-table table-responsive">
                    <?php if($wishlistItems->isEmpty()): ?>
                        <div class="alert alert-info">Your wishlist is empty. <a href="<?php echo e(route('shop')); ?>">Start shopping!</a></div>
                    <?php else: ?>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="pro-thumbnail">Thumbnail</th>
                            <th class="pro-title">Product</th>
                            <th class="pro-price">Price</th>
                            <th class="pro-quantity">Stock Status</th>
                            <th class="pro-subtotal">Add to Cart</th>
                            <th class="pro-remove">Remove</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $wishlistItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="pro-thumbnail">
                                <a href="<?php echo e(route('product.show', $item->product->id)); ?>">
                                    <?php if($item->product->cover): ?>
                                    <img class="img-fluid"
                                         src="<?php echo e(asset('storage/'.$item->product->cover->path)); ?>"
                                         alt="<?php echo e($item->product->name); ?>">
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
                                <span>$<?php echo e(number_format($item->product->base_price, 2)); ?></span>
                            </td>
                            <td class="pro-quantity">
                                <?php if($item->product->stock > 0): ?>
                                    <span class="text-success">In Stock</span>
                                <?php else: ?>
                                    <span class="text-danger">Out of Stock</span>
                                <?php endif; ?>
                            </td>
                            <td class="pro-subtotal">
                                <?php if($item->product->stock > 0): ?>
                                <form action="<?php echo e(route('cart.store')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="product_id" value="<?php echo e($item->product->id); ?>">
                                    <button type="submit" class="btn-add-to-cart">
                                        Add to Cart
                                    </button>
                                </form>
                                <?php else: ?>
                                <button class="btn-add-to-cart disabled" disabled>
                                    Add to Cart
                                </button>
                                <?php endif; ?>
                            </td>
                            <td class="pro-remove">
                                <form action="<?php echo e(route('wishlist.destroy', $item->id)); ?>" method="POST">
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
            </div>
        </div>
        <!-- Wishlist Page Content End -->
    </div>
</div>
<!--== Page Content Wrapper End ==-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lola\resources\views/frontend/wishlist.blade.php ENDPATH**/ ?>