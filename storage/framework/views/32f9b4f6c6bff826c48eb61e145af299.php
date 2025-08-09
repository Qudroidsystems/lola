<?php $__env->startSection('content'); ?>

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Edit Product
                    </h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="<?php echo e(route('home')); ?>" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
                        <li class="breadcrumb-item text-muted">eCommerce</li>
                        <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
                        <li class="breadcrumb-item text-muted">Catalog</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="<?php echo e(route('product.index')); ?>" class="btn btn-sm fw-bold btn-primary">Product Listings</a>
                </div>
            </div>
        </div>

        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
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

                <form action="<?php echo e(route('product.update', $product->id)); ?>" method="POST" id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                        <!-- Thumbnail -->
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Thumbnail</h2>
                                </div>
                            </div>
                            <div class="card-body text-center pt-0">
                                <style>
                                    .image-input-placeholder {
                                        background-image: url("../../../assets/media/svg/files/blank-image.svg");
                                    }
                                    [data-bs-theme="dark"] .image-input-placeholder {
                                        background-image: url("../../../assets/media/svg/files/blank-image-dark.svg");
                                    }
                                </style>
                                <div class="image-input image-input-outline <?php echo e($product->thumbnail ? '' : 'image-input-empty'); ?> image-input-placeholder mb-3" data-kt-image-input="true">
                                    <div class="image-input-wrapper w-150px h-150px" style="<?php echo e($product->thumbnail ? 'background-image: url(' . asset($product->thumbnail) . ')' : ''); ?>"></div>
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change thumbnail">
                                        <i class="ki-duotone ki-pencil fs-7"><span class="path1"></span><span class="path2"></span></i>
                                        <input type="file" name="thumbnail" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="avatar_remove" />
                                    </label>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel thumbnail">
                                        <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>
                                    </span>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove thumbnail">
                                        <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>
                                    </span>
                                </div>
                                <div class="text-muted fs-7">Set the product thumbnail image. Only *.png, *.jpg and *.jpeg image files are accepted</div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Status</h2>
                                </div>
                                <div class="card-toolbar">
                                    <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_product_status"></div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <select name="status" class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add_product_status_select" required>
                                    <option value="published" <?php echo e($product->status == 'published' ? 'selected' : ''); ?>>Published</option>
                                    <option value="draft" <?php echo e($product->status == 'draft' ? 'selected' : ''); ?>>Draft</option>
                                </select>
                                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <div class="text-muted fs-7">Set the product status.</div>
                            </div>
                        </div>

                        <!-- Category, Tags & Unit -->
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Category, Tag & Unit</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <!-- Categories -->
                                <label class="form-label">Categories</label>
                                <select name="category[]" id="category" class="form-select mb-2" data-control="select2" multiple required>
                                    <option value="" disabled>Select a category</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>" <?php echo e($product->categories->contains($category->id) ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <div class="text-muted fs-7 mb-7">Add product to a category.</div>
                                <a href="<?php echo e(route('category.create')); ?>" class="btn btn-light-primary btn-sm mb-10">
                                    <i class="ki-duotone ki-plus fs-2"></i> Create new category
                                </a>

                                <!-- Tags -->
                                <label class="form-label d-block">Tags</label>
                                <select name="selected_tag_ids[]" id="kt_ecommerce_add_product_tags" class="form-select mb-2" data-control="select2" multiple>
                                    <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($tag->id); ?>" <?php echo e($product->tags->contains($tag->id) ? 'selected' : ''); ?>><?php echo e($tag->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['selected_tag_ids'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <div class="text-muted fs-7">Add tags to a product.</div>
                                <a href="<?php echo e(route('tag.create')); ?>" class="btn btn-light-primary btn-sm mb-10">
                                    <i class="ki-duotone ki-plus fs-2"></i> Create new tag
                                </a>

                                <!-- Unit -->
                                <label class="form-label">Unit</label>
                                <select name="unit[]" id="unit" class="form-select mb-2" data-control="select2" multiple required>
                                    <option value="" disabled>Select a Unit</option>
                                    <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($unit->id); ?>" <?php echo e($product->units->contains($unit->id) ? 'selected' : ''); ?>><?php echo e($unit->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['unit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <div class="text-muted fs-7 mb-7">Add Unit to Product.</div>
                                <a href="<?php echo e(route('unit.create')); ?>" class="btn btn-light-primary btn-sm mb-10">
                                    <i class="ki-duotone ki-plus fs-2"></i> Create new Unit
                                </a>
                            </div>
                        </div>

                        <!-- Brand -->
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Product Brand</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <label for="brand" class="form-label">Select a product Brand</label>
                                <select name="brand[]" id="brand" class="form-select mb-2" data-control="select2" multiple required>
                                    <option value="" disabled>Select a Brand</option>
                                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($brand->id); ?>" <?php echo e($product->brands->contains($brand->id) ? 'selected' : ''); ?>><?php echo e($brand->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['brand'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <div class="text-muted fs-7">Assign Product brand.</div>
                            </div>
                        </div>

                        <!-- Store -->
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Store</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <label for="warehouses" class="form-label">Select a product store</label>
                                <select name="warehouses[]" id="warehouses" class="form-select mb-2" data-control="select2" multiple required>
                                    <option value="" disabled>Select a Store</option>
                                    <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($store->id); ?>" <?php echo e($product->warehouses->contains($store->id) ? 'selected' : ''); ?>><?php echo e($store->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['warehouses'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <div class="text-muted fs-7">Assign a store from which this product is found.</div>
                                <a href="<?php echo e(route('store.create')); ?>" class="btn btn-light-primary btn-sm mb-10">
                                    <i class="ki-duotone ki-plus fs-2"></i> Create new Store
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2">
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_add_product_general">Product Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_ecommerce_add_product_advanced">Pricing & Stocks</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <!-- General Tab -->
                            <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                    <div class="card card-flush py-4">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Product Information</h2>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="mb-10 fv-row">
                                                <label class="required form-label">Product Name</label>
                                                <input type="text" name="product_name" class="form-control mb-2" placeholder="Product name" value="<?php echo e(old('product_name', $product->name)); ?>" />
                                                <?php $__errorArgs = ['product_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                <div class="text-muted fs-7">A product name is required and recommended to be unique.</div>
                                            </div>
                                            <div>
                                                <label class="form-label">Description</label>
                                                <div id="kt_ecommerce_add_product_description" name="kt_ecommerce_add_product_description" class="min-h-200px mb-2"><?php echo $product->description; ?></div>
                                                <textarea id="description" name="description" class="d-none"><?php echo $product->description; ?></textarea>
                                                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                <div class="text-muted fs-7">Set a description to the product for better visibility.</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Media -->
                                    <div class="card card-flush py-4">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Media</h2>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="fv-row mb-2">
                                                <div class="dropzone" id="kt_ecommerce_add_product_media">
                                                    <div class="dz-message needsclick">
                                                        <i class="ki-duotone ki-file-up text-primary fs-3x"><span class="path1"></span><span class="path2"></span></i>
                                                        <div class="ms-4">
                                                            <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                                            <span class="fs-7 fw-semibold text-gray-400">Upload up to 10 files</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="file" name="images[]" id="images" class="form-control d-none" multiple accept="image/*" />
                                            </div>
                                            <div class="text-muted fs-7">Set the product media gallery.</div>
                                            <!-- Display Existing Images -->
                                            <div class="image-preview-container mt-3">
                                                <?php $__currentLoopData = $product->galleryImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <img src="<?php echo e(asset($image->path)); ?>" alt="Product Image" width="100" class="me-2 mb-2">
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Meta Options -->
                                    <div class="card card-flush py-4">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Meta Options</h2>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="mb-10">
                                                <label class="form-label">Meta Tag Title</label>
                                                <input type="text" class="form-control mb-2" name="meta_title" placeholder="Meta tag name" value="<?php echo e(old('meta_title', $product->meta_tag_title)); ?>" />
                                                <?php $__errorArgs = ['meta_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                <div class="text-muted fs-7">Set a meta tag title. Recommended to be simple and precise keywords.</div>
                                            </div>
                                            <div class="mb-10">
                                                <label class="form-label">Meta Tag Description</label>
                                                <div id="kt_ecommerce_add_product_meta_description" name="kt_ecommerce_add_product_meta_description" class="min-h-100px mb-2"><?php echo $product->meta_tag_description; ?></div>
                                                <textarea id="meta_tag_description" name="meta_tag_description" class="d-none"><?php echo $product->meta_tag_description; ?></textarea>
                                                <?php $__errorArgs = ['meta_tag_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                <div class="text-muted fs-7">Set a meta tag description to the product for increased SEO ranking.</div>
                                            </div>
                                            <div>
                                                <label class="form-label">Meta Tag Keywords</label>
                                                <input id="kt_ecommerce_add_product_meta_keywords" name="meta_tag_keywords" class="form-control mb-2" value="<?php echo e(old('meta_tag_keywords', $product->meta_tag_keywords)); ?>" />
                                                <?php $__errorArgs = ['meta_tag_keywords'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                <div class="text-muted fs-7">Set a list of keywords that the product is related to. Separate the keywords by adding a comma <code>,</code> between each keyword.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pricing & Stocks Tab -->
                            <div class="tab-pane fade" id="kt_ecommerce_add_product_advanced" role="tab-panel">
                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                    <div class="card card-flush py-4">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Inventory</h2>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="mb-10 fv-row">
                                                <div class="w-100 w-md-800px">
                                                    <label class="required form-label">SKU</label>
                                                    <input type="text" name="sku" id="sku" class="form-control mb-2" placeholder="Barcode Number" value="<?php echo e(old('sku', $product->sku)); ?>" required />
                                                    <?php $__errorArgs = ['sku'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    <div class="text-muted fs-7">Enter the product SKU.</div>
                                                </div>
                                                <div class="w-100 w-md-800px">
                                                    <label class="required form-label">Barcode</label>
                                                    <input type="text" name="barcode" class="form-control mb-2" placeholder="Barcode Number" value="<?php echo e(old('barcode', $product->barcode)); ?>" />
                                                    <?php $__errorArgs = ['barcode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    <div class="text-muted fs-7">Enter the product barcode number.</div>
                                                </div>
                                                <div class="w-100 w-md-800px">
                                                    <label class="required form-label">Stock (Quantity)</label>
                                                    <div class="d-flex gap-3">
                                                        <input type="number" name="stock" class="form-control mb-2" placeholder="On shelf" value="<?php echo e(old('stock', $product->stock)); ?>" required />
                                                    </div>
                                                    <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    <div class="text-muted fs-7">Enter the product quantity.</div>
                                                </div>
                                                <div class="w-100 w-md-800px">
                                                    <label class="required form-label">Stock Alert</label>
                                                    <div class="d-flex gap-3">
                                                        <input type="number" name="stock_alert" class="form-control mb-2" placeholder="Stock alert" value="<?php echo e(old('stock_alert', $product->stock_alert)); ?>" required />
                                                    </div>
                                                    <?php $__errorArgs = ['stock_alert'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    <div class="text-muted fs-7">Enter the product quantity for alert.</div>
                                                </div>
                                                <div class="w-100 w-md-800px">
                                                    <label class="required form-label">Base Price</label>
                                                    <div class="d-flex gap-3">
                                                        <input type="number" name="price" class="form-control mb-2" placeholder="Price" value="<?php echo e(old('price', $product->base_price)); ?>" required />
                                                    </div>
                                                    <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    <div class="text-muted fs-7">Enter the product price.</div>
                                                </div>
                                                <div class="w-100 w-md-800px">
                                                    <label class="required form-label">Sale Price</label>
                                                    <div class="d-flex gap-3">
                                                        <input type="number" name="sale_price" class="form-control mb-2" placeholder="Sale Price" value="<?php echo e(old('sale_price', $product->sale_price)); ?>" required />
                                                    </div>
                                                    <?php $__errorArgs = ['sale_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    <div class="text-muted fs-7">Enter the product sale price.</div>
                                                </div>
                                                <div class="w-100 w-md-800px">
                                                    <label class="form-label">Select Images</label>
                                                    <input type="file" name="images[]" id="images" class="form-control" multiple accept="image/*" />
                                                    <div class="image-preview-container mt-3" id="imagePreview"></div>
                                                </div>
                                                <div class="w-100 w-md-800px">
                                                    <label class="required form-label">Discount Type</label>
                                                    <select class="form-select" name="kt_ecommerce_add_product_options[0][discounttype]" required>
                                                        <option value="nodiscount" <?php echo e(old('kt_ecommerce_add_product_options.0.discounttype', $product->discounttype ?? 'nodiscount') == 'nodiscount' ? 'selected' : ''); ?>>No Discount</option>
                                                        <option value="percentage" <?php echo e(old('kt_ecommerce_add_product_options.0.discounttype', $product->discounttype ?? '') == 'percentage' ? 'selected' : ''); ?>>Percentage %</option>
                                                        <option value="fixed" <?php echo e(old('kt_ecommerce_add_product_options.0.discounttype', $product->discounttype ?? '') == 'fixed' ? 'selected' : ''); ?>>Fixed</option>
                                                    </select>
                                                    <?php $__errorArgs = ['kt_ecommerce_add_product_options.0.discounttype'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="w-100 w-md-800px">
                                                    <label class="required form-label">If Percentage %</label>
                                                    <div class="d-flex gap-3">
                                                        <input type="number" name="kt_ecommerce_add_product_options[0][percentage]" class="form-control mb-2" placeholder="Enter Percentage" value="<?php echo e(old('kt_ecommerce_add_product_options.0.percentage', $product->percentage ?? '')); ?>" />
                                                    </div>
                                                    <?php $__errorArgs = ['kt_ecommerce_add_product_options.0.percentage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    <div class="text-muted fs-7">Enter the Percentage Value.</div>
                                                </div>
                                                <div class="w-100 w-md-800px">
                                                    <label class="required form-label">If Fixed Price</label>
                                                    <div class="d-flex gap-3">
                                                        <input type="number" name="kt_ecommerce_add_product_options[0][fixed]" class="form-control mb-2" placeholder="Enter Fixed Discount Price" value="<?php echo e(old('kt_ecommerce_add_product_options.0.fixed', $product->fixed ?? '')); ?>" />
                                                    </div>
                                                    <?php $__errorArgs = ['kt_ecommerce_add_product_options.0.fixed'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    <div class="text-muted fs-7">Enter the Fixed Discounted Price.</div>
                                                </div>
                                                <div class="d-flex flex-wrap gap-5">
                                                    <div class="fv-row w-100 flex-md-root">
                                                        <label class="required form-label">Tax Class</label>
                                                        <select class="form-select mb-2" name="tax" data-control="select2" data-hide-search="true" data-placeholder="Select an option">
                                                            <option value="0" <?php echo e(old('tax', $product->tax) == 0 ? 'selected' : ''); ?>>Tax Free</option>
                                                            <option value="1" <?php echo e(old('tax', $product->tax) == 1 ? 'selected' : ''); ?>>Taxable Goods</option>
                                                            <option value="2" <?php echo e(old('tax', $product->tax) == 2 ? 'selected' : ''); ?>>Downloadable Product</option>
                                                        </select>
                                                        <?php $__errorArgs = ['tax'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="alert alert-danger"><?php echo e($message); ?></div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        <div class="text-muted fs-7">Set the product tax class.</div>
                                                    </div>
                                                    <div class="fv-row w-100 flex-md-root">
                                                        <label class="form-label">VAT Amount (%)</label>
                                                        <input type="text" name="vat_amount" class="form-control mb-2" value="<?php echo e(old('vat_amount', $product->vat_amount)); ?>" />
                                                        <?php $__errorArgs = ['vat_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="alert alert-danger"><?php echo e($message); ?></div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        <div class="text-muted fs-7">Set the product VAT amount.</div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-wrap gap-5">
                                                    <div class="fv-row w-100 flex-md-root">
                                                        <label class="form-label">Manufactured On</label>
                                                        <input type="date" name="manufacture" class="form-control mb-2" value="<?php echo e(old('manufacture', $product->manufactured)); ?>" />
                                                        <?php $__errorArgs = ['manufacture'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="alert alert-danger"><?php echo e($message); ?></div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        <div class="text-muted fs-7">Set the product Manufacture Date.</div>
                                                    </div>
                                                    <div class="fv-row w-100 flex-md-root">
                                                        <label class="form-label">Expiry On</label>
                                                        <input type="date" name="expiry" class="form-control mb-2" value="<?php echo e(old('expiry', $product->expiry)); ?>" />
                                                        <?php $__errorArgs = ['expiry'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="alert alert-danger"><?php echo e($message); ?></div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        <div class="text-muted fs-7">Set the product Expiry Date.</div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-stack">
                                                    <label class="form-label">Product's Featuring</label>
                                                </div>
                                                <div class="d-flex flex-stack">
                                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                                        <input class="form-check-input" name="is_featured" type="checkbox" value="1" <?php echo e(old('is_featured', $product->is_featured) ? 'checked' : ''); ?> />
                                                        <span class="form-check-label fw-semibold text-muted">Featured Product</span>
                                                    </label>
                                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                                        <input class="form-check-input" name="is_new" type="checkbox" value="1" <?php echo e(old('is_new', $product->is_new) ? 'checked' : ''); ?> />
                                                        <span class="form-check-label fw-semibold text-muted">New Product</span>
                                                    </label>
                                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                                        <input class="form-check-input" name="on_sale" type="checkbox" value="1" <?php echo e(old('on_sale', $product->on_sale) ? 'checked' : ''); ?> />
                                                        <span class="form-check-label fw-semibold text-muted">On Sale</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="<?php echo e(route('product.index')); ?>" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">Cancel</a>
                            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                                <span class="indicator-label">Save Changes</span>
                                <span class="indicator-progress">Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Select2 for multi-select fields
        $('#category, #unit, #brand, #warehouses, #kt_ecommerce_add_product_tags').select2({
            placeholder: "Select an option",
            allowClear: true
        });

        // Image preview for new uploads
        document.getElementById('images').addEventListener('change', function(event) {
            let previewContainer = document.getElementById('imagePreview');
            previewContainer.innerHTML = '';
            Array.from(event.target.files).forEach(file => {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'preview-img';
                    img.style.width = '100px';
                    img.style.margin = '5px';
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lola\resources\views/product/edit.blade.php ENDPATH**/ ?>