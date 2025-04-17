<?php $__env->startSection('content'); ?>

                        <!--begin::Main-->
                        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                            <!--begin::Content wrapper-->
                            <div class="d-flex flex-column flex-column-fluid">

            <!--begin::Toolbar-->
            <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

                        <!--begin::Toolbar container-->
                    <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">



            <!--begin::Page title-->
            <div  class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                  Unit
                        </h1>
                <!--end::Title-->


                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                        <!--begin::Item-->
                                                <li class="breadcrumb-item text-muted">
                                                                <a href="<?php echo e(route('dashboard')); ?>" class="text-muted text-hover-primary">
                                            Home                            </a>
                                                        </li>
                                            <!--end::Item-->
                                                <!--begin::Item-->
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                </li>
                                <!--end::Item-->

                                        <!--begin::Item-->
                                                <li class="breadcrumb-item text-muted">
                                                                eCommerce
                                                               </li>
                                            <!--end::Item-->
                                                <!--begin::Item-->
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                </li>
                                <!--end::Item-->

                                        <!--begin::Item-->
                                                <li class="breadcrumb-item text-muted">
                                                             Unit
                                                                  </li>
                                            <!--end::Item-->

                                </ul>
                    <!--end::Breadcrumb-->
                </div>
            <!--end::Page title-->

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

            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">



                <!--begin::Secondary button-->
                    <!--end::Secondary button-->

                <!--begin::Primary button-->
                        <a href="<?php echo e(route('unit.index')); ?>" class="btn btn-sm fw-bold btn-primary"  >
                       Unit Listing       </a>
                    <!--end::Primary button-->
            </div>
            <!--end::Actions-->
                    </div>
                    <!--end::Toolbar container-->
                </div>
            <!--end::Toolbar-->
<!--begin::Content-->
<div id="kt_app_content" class="app-content  flex-column-fluid " >


    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container  container-xxl ">
        <form id="kt_ecommerce_add_category_form" class="form d-flex flex-column flex-lg-row" action="<?php echo e(route('unit.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>


                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!--begin::General options-->
                <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>General</h2>
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Input group-->
                    <div class="mb-10 fv-row">
                        <!--begin::Label-->
                        <label class="required form-label">Unit Name</label>
                        <!--end::Label-->

                        <!--begin::Input-->
                                    <input type="text" name="name" class="form-control mb-2" placeholder="Unit name" value="" />
                        <!--end::Input-->

                        <!--begin::Description-->
                        <div class="text-muted fs-7">A Unit name is required and recommended to be unique.</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->

                </div>
                <!--end::Card header-->
                </div>
                <!--end::General options-->
                    <!--begin::Meta options-->
                <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Meta Options</h2>
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">


                    <!--begin::Input group-->
                    <div class="mb-10">
                        <!--begin::Label-->
                        <label class="form-label">Unit Description</label>
                        <!--end::Label-->

                        <!--begin::Editor-->
                        <div id="kt_ecommerce_add_category_meta_description" name="kt_ecommerce_add_category_meta_description" class="min-h-100px mb-2"></div>
                        <textarea id="meta_tag_description" name="unit_description" class="d-none"></textarea>
                        <!--end::Editor-->

                        <!--begin::Description-->
                        <div class="text-muted fs-7">Set a meta tag description to the Unit for increased SEO ranking.</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div>
                        <!--begin::Label-->
                        <label class="form-label">Unit Abbreviation</label>
                        <!--end::Label-->

                        <!--begin::Editor-->
                        <input type="text" name="abbreviation" class="form-control mb-2" />
                        <!--end::Editor-->


                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Card header-->
                </div>
                <!--end::Meta options-->




                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <a href="products.html" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">
                            Cancel
                        </a>
                        <!--end::Button-->

                        <!--begin::Button-->
                        <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                            <span class="indicator-label">
                                Save Changes
                            </span>
                            <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                        <!--end::Button-->
                    </div>
                </div>
                <!--end::Main column-->
        </form>
</div>
    <!--end::Content container-->
</div>
<!--end::Content-->


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\vitemart-ec\resources\views/unit/add.blade.php ENDPATH**/ ?>