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
                    <h1>Shop</h1>
                    <ul class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="index.html" class="active">Shop</a></li>
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
            <!-- Sidebar Area Start -->
            <div class="col-lg-3 mt-5 mt-lg-0">
                <div id="sidebar-area-wrap">
                    <!-- Single Sidebar Item Start -->
                    <div class="single-sidebar-wrap">
                        <h2 class="sidebar-title">Shop By</h2>
                        <div class="sidebar-body">
                            <div class="shopping-option">
                                <h3>Shopping Options</h3>
                                <!-- Category Filter -->
                                <div class="shopping-option-item">
                                    <h4>Categories</h4>
                                    <ul class="sidebar-list">
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <a href="<?php echo e(route('shop', array_merge(request()->query(), ['category' => $category->slug]))); ?>"
                                            class="<?php echo e(request('category') == $category->slug ? 'active' : ''); ?>">
                                                <?php echo e($category->name); ?> (<?php echo e($category->products_count); ?>)
                                            </a>
                                        </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>

                                <!-- Brand Filter -->
                                <div class="shopping-option-item">
                                    <h4>Brands</h4>
                                    <ul class="sidebar-list">
                                        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <a href="<?php echo e(route('shop', array_merge(request()->query(), ['brand' => $brand->slug]))); ?>"
                                            class="<?php echo e(request('brand') == $brand->slug ? 'active' : ''); ?>">
                                                <?php echo e($brand->name); ?> (<?php echo e($brand->products_count); ?>)
                                            </a>
                                        </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>

                                <!-- Price Filter -->
                                <div class="shopping-option-item">
                                    <h4>Price</h4>
                                    <ul class="sidebar-list">
                                        <li><a href="<?php echo e(route('shop', array_merge(request()->query(), ['price' => '0-50']))); ?>"
                                            class="<?php echo e(request('price') == '0-50' ? 'active' : ''); ?>">$0 - $50</a></li>
                                        <li><a href="<?php echo e(route('shop', array_merge(request()->query(), ['price' => '50-100']))); ?>"
                                            class="<?php echo e(request('price') == '50-100' ? 'active' : ''); ?>">$50 - $100</a></li>
                                        <li><a href="<?php echo e(route('shop', array_merge(request()->query(), ['price' => '100-200']))); ?>"
                                            class="<?php echo e(request('price') == '100-200' ? 'active' : ''); ?>">$100 - $200</a></li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Single Sidebar Item End -->

                    <!-- Single Sidebar Item Start -->
                    <!--  -->
                    <!-- Single Sidebar Item End -->

                    <!-- Single Sidebar Item Start -->
                    
                    <!-- Single Sidebar Item End -->
                </div>
            </div>
            <!-- Sidebar Area End -->



            <!-- Shop Page Content Start -->
            <div class="col-lg-9 order-first order-lg-last">
                <div class="shop-page-content-wrap">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <form action="<?php echo e(route('shop')); ?>" method="GET">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                           placeholder="Search products..." value="<?php echo e(request('search')); ?>">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="products-settings-option d-block d-md-flex">
                        <div class="product-cong-left d-flex align-items-center">
                            <ul class="product-view d-flex align-items-center">
                                <li class="current column-gird"><i class="fa fa-bars fa-rotate-90"></i></li>
                                <li class="box-gird"><i class="fa fa-th"></i></li>
                                <li class="list"><i class="fa fa-list-ul"></i></li>
                            </ul>
                            <span class="show-items">Items 1 - 9 of 17</span>
                        </div>

                        <div class="product-sort_by d-flex align-items-center mt-3 mt-md-0">
                            <label for="sort">Sort By:</label>
                            <select name="sort" id="sort" onchange="this.form.submit()">
                                <option value="relevance" <?php echo e(request('sort') == 'relevance' ? 'selected' : ''); ?>>Relevance</option>
                                <option value="name_asc" <?php echo e(request('sort') == 'name_asc' ? 'selected' : ''); ?>>Name, A to Z</option>
                                <option value="name_desc" <?php echo e(request('sort') == 'name_desc' ? 'selected' : ''); ?>>Name, Z to A</option>
                                <option value="price_asc" <?php echo e(request('sort') == 'price_asc' ? 'selected' : ''); ?>>Price low to high</option>
                                <option value="price_desc" <?php echo e(request('sort') == 'price_desc' ? 'selected' : ''); ?>>Price high to low</option>
                            </select>
                        </div>
                    </div>

                    <div class="shop-page-products-wrap">
                        <div class="products-wrapper">
                            

                            <div class="row">
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-4 col-sm-6 mb-4">
                                    <div class="single-product-item text-center">
                                        <!-- Product Image -->
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

                                        <!-- Product Details -->
                                        <div class="product-details">
                                            <h2>
                                                <a href="<?php echo e(route('shop.show', $product->id)); ?>">
                                                    <?php echo e($product->name); ?>

                                                </a>
                                            </h2>

                                            <!-- Rating -->
                                            <div class="rating">
                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                    <?php if($i <= optional($product->rating)->rating): ?>
                                                        <i class="fa fa-star"></i>
                                                    <?php else: ?>
                                                        <i class="fa fa-star-o"></i>
                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                            </div>

                                            <!-- Price -->
                                            <span class="price">
                                                <?php if($product->on_sale): ?>
                                                    <del>$<?php echo e(number_format($product->base_price, 2)); ?></del>
                                                    $<?php echo e(number_format($product->sale_price, 2)); ?>

                                                <?php else: ?>
                                                    $<?php echo e(number_format($product->base_price, 2)); ?>

                                                <?php endif; ?>
                                            </span>

                                            <!-- Description -->
                                            <p class="products-desc">
                                                <?php echo e(Str::limit($product->description, 120)); ?>

                                            </p>

                                            <!-- Action Buttons -->
                                            <div class="product-actions">
                                                <?php if(auth()->guard()->check()): ?>
                                                        <form action="<?php echo e(route('cart.store')); ?>" method="POST">
                                                            <?php echo csrf_field(); ?>
                                                            <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                                                            <button type="submit" class="btn btn-add-to-cart">+ Add to Cart</button>
                                                        </form>
                                                <?php else: ?>
                                                        <div class="guest-notice mt-2">
                                                            <a href="<?php echo e(route('login')); ?>" class="text-muted">
                                                                <i class="fas fa-lock me-1"></i>Login to purchase
                                                            </a>
                                                        </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <!-- Product Meta -->
                                        <div class="product-meta">
                                            <!-- Quick View -->
                                            <button type="button"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#quickView-<?php echo e($product->id); ?>">
                                                <i class="fa fa-compress"></i>
                                            </button>

                                            <!-- Wishlist -->
                                            <form action="<?php echo e(route('wishlist.store')); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                                                <button type="submit" class="btn-link">
                                                    <i class="fa fa-heart-o"></i>
                                                </button>
                                            </form>
                                        </div>

                                        <!-- Product Badges -->
                                        <?php if($product->is_new): ?>
                                            <span class="product-badge new">New</span>
                                        <?php endif; ?>

                                        <?php if($product->on_sale): ?>
                                            <span class="product-badge sale">Sale</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <!-- Pagination -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <?php echo e($products->appends(request()->query())->links()); ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="products-settings-option d-block d-md-flex">
                        <nav class="page-pagination">
                            <ul class="pagination">
                                <li><a href="#" aria-label="Previous">&laquo;</a></li>
                                <li><a class="current" href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#" aria-label="Next">&raquo;</a></li>
                            </ul>
                        </nav>

                        <div class="product-per-page d-flex align-items-center mt-3 mt-md-0">
                            <label for="show-per-page">Show Per Page</label>
                            <select name="sort" id="show-per-page">
                                <option value="9">9</option>
                                <option value="15">15</option>
                                <option value="21">21</option>
                                <option value="6">27</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Shop Page Content End -->
        </div>
    </div>
</div>
<!--== Page Content Wrapper End ==-->
<?php $__env->stopSection(); ?>


<!-- Quick View Modals -->
<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                            $<?php echo e(number_format($product->base_price, 2)); ?>

                            <?php if($product->on_sale): ?>
                                <span class="text-danger">$<?php echo e(number_format($product->sale_price, 2)); ?></span>
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

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lola\resources\views/frontend/shop.blade.php ENDPATH**/ ?>