
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
<!--== Banner // Slider Area Start ==-->
<section id="banner-area" class="banner__2">
    <div class="ruby-container">
        <div class="row">
            <div class="col-lg-12">
                <div id="banner-carousel" class="owl-carousel">
                    <!-- Banner Single Carousel Start -->
                    <div class="single-carousel-wrap home_6_slide_1">
                        <div class="banner-caption text-center text-lg-start">
                            <p><h2>LorlahTate</h2></p>
                            <h3>Necklace <br> for Princess</h3>
                            <p>Elevate your elegance with our exquisite LorlahTate necklace, crafted with precision to enhance your royal charm.</p>
                            <a href="#" class="btn-long-arrow">Learn More</a>
                        </div>
                    </div>
                    <!-- Banner Single Carousel End -->

                    <!-- Banner Single Carousel Start -->
                    <div class="single-carousel-wrap home_6_slide_2">
                        <div class="banner-caption text-center text-lg-start">
                            <p><h2>LorlahTate</h2></p>
                            <h3>Necklace <br> for Princess</h3>
                            <p>Discover timeless beauty with the LorlahTate necklace, designed to make every moment sparkle with sophistication.</p>
                            <a href="#" class="btn-long-arrow">Learn More</a>
                        </div>
                    </div>
                    <!-- Banner Single Carousel End -->
                </div>
            </div>
        </div>
    </div>
</section>
<!--== Banner Slider End ==-->

<!--== New Products Area Start ==-->
<section id="new-products-area" class="p-9">
    <div class="ruby-container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="section-title">
                    <h2>New Products</h2>
                    <p>Discover our latest collection of stunning and unique jewelry pieces.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="products-wrapper">
                    <div class="new-products-carousel owl-carousel">
                        <?php $__currentLoopData = $newProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <!-- Single Product Item -->
                        <div class="single-product-item text-center">
                            <figure class="product-thumb">
                                <a href="<?php echo e(route('shop.show', $product->id)); ?>">
                                    <?php if($product->thumbnail): ?>
                                    <img src="<?php echo e(asset($product->thumbnail)); ?>"
                                         alt="<?php echo e($product->name); ?>"
                                         class="img-fluid">
                                    <?php else: ?>
                                    <div class="img-placeholder"></div>
                                    <?php endif; ?>
                                </a>
                            </figure>

                            <div class="product-details">
                                <h2><a href="<?php echo e(route('product.show', $product->id)); ?>"><?php echo e($product->name); ?></a></h2>
                                <span class="rating">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <?php if($i <= $product->rating): ?>
                                            <i class="fa fa-star"></i>
                                        <?php else: ?>
                                            <i class="fa fa-star-o"></i>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </span>
                                <span class="price">
                                    <?php if($product->on_sale): ?>
                                        <del>RM <?php echo e(number_format($product->base_price, 2)); ?></del>
                                        RM <?php echo e(number_format($product->sale_price, 2)); ?>

                                    <?php else: ?>
                                        RM <?php echo e(number_format($product->base_price, 2)); ?>

                                    <?php endif; ?>
                                </span>
                                <form action="<?php echo e(route('cart.store', $product->id )); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                                    <button type="submit" class="btn btn-add-to-cart">+ Add to Cart</button>
                                </form>

                                <?php if($product->is_new): ?>
                                    <span class="product-bedge">New</span>
                                <?php endif; ?>
                                <?php if($product->on_sale): ?>
                                    <span class="product-bedge sale">Sale</span>
                                <?php endif; ?>
                            </div>

                            <div class="product-meta">
                                <button type="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#quickView-<?php echo e($product->id); ?>">
                                    <span data-bs-toggle="tooltip" title="Quick View">
                                        <i class="fa fa-compress"></i>
                                    </span>
                                </button>
                                <form action="<?php echo e(route('wishlist.store', $product->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                                    <button type="submit" class="btn-link" data-bs-toggle="tooltip" title="Add to Wishlist">
                                        <i class="fa fa-heart-o"></i>
                                    </button>
                                </form>
                                <a href="<?php echo e(route('compare.add', $product->id)); ?>"
                                   data-bs-toggle="tooltip"
                                   title="Compare"
                                   class="compare-btn">
                                    <i class="fa fa-tags"></i>
                                </a>
                            </div>
                        </div>
                        <!-- Single Product Item -->
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--== New Products Area End ==-->

<!-- Quick View Modals -->
<?php $__currentLoopData = $newProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="quickView-<?php echo e($product->id); ?>" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Add quick view content here -->
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                <div class="row">
                    <?php if($product->thumbnail): ?>
                    <img src="<?php echo e(asset($product->thumbnail)); ?>"
                         class="img-fluid"
                         alt="<?php echo e($product->name); ?>">
                    <?php else: ?>
                        <!-- Show placeholder or nothing -->
                        <img src="<?php echo e(asset('images/placeholder.png')); ?>"
                            class="img-fluid"
                            alt="No image available">
                    <?php endif; ?>
                    <div class="col-md-6">
                        <h3><?php echo e($product->name); ?></h3>
                        <div class="price">
                            RM <?php echo e(number_format($product->base_price, 2)); ?>

                            <?php if($product->on_sale): ?>
                                <span class="text-danger">RM <?php echo e(number_format($product->sale_price, 2)); ?></span>
                            <?php endif; ?>
                        </div>
                        <p><?php echo e($product->description); ?></p>
                        <!-- Add more product details as needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!--== New Products Area End ==-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lola\resources\views/frontend/home.blade.php ENDPATH**/ ?>