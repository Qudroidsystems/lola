<?php $__env->startSection('content'); ?>

<!--== Page Title Area Start ==-->
<div id="page-title-area">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="page-title-content">
                    <ul class="breadcrumb">
                        <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                        <li><a href="<?php echo e(route('shop')); ?>">Shop</a></li>
                        <li class="active"><?php echo e($product->name); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--== Page Title Area End ==-->

<!--== Page Content Wrapper Start ==-->
<div id="page-content-wrapper" class="p-9">
    <div class="ruby-container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-product-page-content">
                    <div class="row">
                        <!-- Product Thumbnail Start -->
                        <div class="col-lg-5">
                            <div class="product-thumbnail-wrap">
                                <div class="product-thumb-carousel owl-carousel">
                                    <?php $__empty_1 = true; $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="single-thumb-item">
                                        <a href="#">
                                            <img class="img-fluid"
                                                 src="<?php echo e(asset($image->path)); ?>"
                                                 alt="<?php echo e($product->name); ?>"/>
                                        </a>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="single-thumb-item">
                                        <img class="img-fluid"
                                             src="<?php echo e(asset('images/placeholder.jpg')); ?>"
                                             alt="No image available"/>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!-- Product Thumbnail End -->

                        <!-- Product Details Start -->
                        <div class="col-lg-7 mt-5 mt-lg-0">
                            <div class="product-details">
                                <h2><?php echo e($product->name); ?></h2>

                                <div class="rating">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <?php if($i <= $product->averageRating()): ?>
                                            <i class="fa fa-star"></i>
                                        <?php else: ?>
                                            <i class="fa fa-star-o"></i>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>

                                <span class="price"><?php echo e(number_format($product->sale_price, 2)); ?></span>

                                <div class="product-info-stock-sku">
                                    <span class="product-stock-status <?php echo e($product->stock ? 'text-success' : 'text-danger'); ?>">
                                        <?php echo e($product->stock ? 'In Stock' : 'Out of Stock'); ?>

                                    </span>
                                    <span class="product-sku-status ms-5">
                                        <strong>SKU</strong> <?php echo e($product->sku); ?>

                                    </span>
                                </div>

                                <p class="products-desc"><?php echo $product->description; ?></p>

                                <?php if($product->in_stock): ?>
                                <form action="<?php echo e(route('cart.store')); ?>" method="POST" class="product-quantity mt-5 d-flex align-items-center">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">

                                    <div class="quantity-field">
                                        <label for="qty">Qty</label>
                                        <input type="number" id="qty" name="quantity"
                                               min="1" max="<?php echo e($product->stock); ?>" value="1"/>
                                    </div>

                                    <button type="submit" class="btn btn-add-to-cart">
                                        Add to Cart
                                    </button>
                                </form>
                                <?php endif; ?>

                                <div class="product-btn-group d-none d-sm-block">
                                    <form action="<?php echo e(route('wishlist.store')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                                        <button type="submit" class="btn btn-add-to-cart btn-whislist">
                                            + Add to Wishlist
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Product Details End -->
                    </div>

                     <div class="row">
                        <div class="col-lg-12">
                            <div class="product-full-info-reviews">
                                <nav class="nav" id="nav-tab">
                                    <a class="active" id="description-tab" data-bs-toggle="tab" href="#description">Description</a>
                                    <a id="reviews-tab" data-bs-toggle="tab" href="#reviews">Reviews (<?php echo e($product->reviews->count()); ?>)</a>
                                </nav>

                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="description">
                                        <?php echo $product->description; ?>

                                    </div>

                                    <div class="tab-pane fade" id="reviews">
                                        <div class="row">
                                            <div class="col-lg-7">
                                                <div class="product-ratting-wrap">
                                                    <div class="pro-avg-ratting">
                                                        <h4><?php echo e(number_format($product->averageRating(), 1)); ?> <span>(Overall)</span></h4>
                                                        <span>Based on <?php echo e($product->reviews->count()); ?> Comments</span>
                                                    </div>

                                                    <?php $__currentLoopData = $product->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="sin-rattings">
                                                        <div class="ratting-author">
                                                            <h3><?php echo e($review->user->name); ?></h3>
                                                            <div class="ratting-star">
                                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                                    <?php if($i <= $review->rating): ?>
                                                                        <i class="fa fa-star"></i>
                                                                    <?php else: ?>
                                                                        <i class="fa fa-star-o"></i>
                                                                    <?php endif; ?>
                                                                <?php endfor; ?>
                                                            </div>
                                                        </div>
                                                        <p><?php echo e($review->comment); ?></p>
                                                    </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    <?php if(auth()->guard()->check()): ?>
                                                    <div class="ratting-form-wrapper fix">
                                                        <h3>Add your Review</h3>
                                                        <form action="<?php echo e(route('reviews.store', $product->id)); ?>" method="POST">
                                                            <?php echo csrf_field(); ?>
                                                            <div class="ratting-form row">
                                                                <div class="col-12 mb-4">
                                                                    <h5>Rating:</h5>
                                                                    <div class="ratting-star fix" id="ratingStars">
                                                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                                                            <i class="fa fa-star-o" data-rating="<?php echo e($i); ?>"></i>
                                                                        <?php endfor; ?>
                                                                    </div>
                                                                    <input type="hidden" name="rating" id="selectedRating" required>
                                                                </div>

                                                                <div class="col-12 mb-4">
                                                                    <label for="your-review">Your Review:</label>
                                                                    <textarea name="comment" id="your-review"
                                                                              class="form-control"
                                                                              placeholder="Write a review"
                                                                              required></textarea>
                                                                </div>

                                                                <div class="col-12">
                                                                    <button type="submit" class="btn-add-to-cart" >
                                                                        Submit Review
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <?php else: ?>
                                                    <p class="text-muted">Please <a href="<?php echo e(route('login')); ?>">login</a> to leave a review.</p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--== Page Content Wrapper End ==-->

<?php $__env->stopSection(); ?>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('#ratingStars .fa');
    const ratingInput = document.getElementById('selectedRating');

    stars.forEach(star => {
        star.addEventListener('click', function() {
            const rating = parseInt(this.dataset.rating);

            // Update stars display
            stars.forEach((s, index) => {
                s.classList.toggle('fa-star-o', index >= rating);
                s.classList.toggle('fa-star', index < rating);
            });

            // Set hidden input value
            ratingInput.value = rating;

            // Clear validation state
            ratingInput.classList.remove('is-invalid');
        });
    });

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        if (!ratingInput.value) {
            e.preventDefault();
            ratingInput.classList.add('is-invalid');
            alert('Please select a rating!');
        }
    });
});
</script>



<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lola\resources\views/frontend/singleProduct.blade.php ENDPATH**/ ?>