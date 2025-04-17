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
                    Categories
                        </h1>
                <!--end::Title-->


                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                        <!--begin::Item-->
                                                <li class="breadcrumb-item text-muted">
                                                                <a href="../../../index.html" class="text-muted text-hover-primary">
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
                                                                eCommerce                                            </li>
                                            <!--end::Item-->
                                                <!--begin::Item-->
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                </li>
                                <!--end::Item-->

                                        <!--begin::Item-->
                                                <li class="breadcrumb-item text-muted">
                                                                Catalog                                            </li>
                                            <!--end::Item-->

                                </ul>
                    <!--end::Breadcrumb-->
                </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">




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

            <!--begin::Category-->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4"><span class="path1"></span><span class="path2"></span></i>                <input type="text" data-kt-ecommerce-category-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Search Category" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--end::Card title-->

                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Add customer-->
                        <a href="<?php echo e(route('category.create')); ?>" class="btn btn-primary">
                            Add Category
                        </a>
                        <!--end::Add customer-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">

            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_category_table">
                <thead>
                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_category_table .form-check-input" value="1" />
                            </div>
                        </th>
                        <th class="min-w-250px">Category</th>
                        <th class="min-w-150px">Status</th>
                        <th class="min-w-150px">Meta Title</th>
                        <th class="min-w-150px">Date Created</th>
                        <th class="text-end min-w-70px">Actions</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <!--begin::Thumbnail-->
                                        <a href="#" class="symbol symbol-50px">

                                            <span class="symbol-label" style="background-image:url('<?php echo e($category->cover ? asset('storage/' . $category->cover->path) : asset('storage/uploads/category_default.jpg')); ?>');"></span>

                                        </a>
                                        <!--end::Thumbnail-->

                                        <div class="ms-5">
                                            <!--begin::Title-->
                                            <a href="edit-category.html" class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1" data-kt-ecommerce-category-filter="category_name"><?php echo e($category->name); ?></a>
                                            <!--end::Title-->

                                            <!--begin::Description-->
                                            <div class="text-muted fs-7 fw-bold"><?php echo e(nl2br(e(strip_tags($category->description)))); ?></div>
                                            <!--end::Description-->
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <?php if($category->status === 'published'): ?>

                                     <!--begin::Badges-->
                                     <div class="badge badge-light-success">

                                        <?php echo e($category->status); ?>

                                    </div>
                                    <!--end::Badges-->
                                    <?php elseif($category->status === 'unpublished'): ?>
                                         <!--begin::Badges-->
                                    <div class="badge badge-light-danger">

                                        <?php echo e($category->status); ?>

                                    </div>
                                    <!--end::Badges-->
                                    <?php elseif($category->status === 'scheduled'): ?>
                                         <!--begin::Badges-->
                                    <div class="badge badge-light-warning">

                                        <?php echo e($category->status); ?>

                                    </div>
                                    <!--end::Badges-->
                                    <?php else: ?>

                                         <!--begin::Badges-->
                                    <div class="badge badge-light-success">

                                        <?php echo e($category->status); ?>

                                    </div>
                                    <!--end::Badges-->
                                    <?php endif; ?>

                                </td>
                                <td>
                                    <!--begin::Badges-->
                                    <div ><?php echo e(nl2br(e(strip_tags($category->meta_tag_title)))); ?></div>
                                    <!--end::Badges-->
                                </td>
                                <td>
                                    <!--begin::Badges-->
                                    <div ><?php echo e(nl2br(e(strip_tags($category->created_at)))); ?></div>
                                    <!--end::Badges-->
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-active-light-primary btn-flex btn-center" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        Actions
                                        <i class="ki-duotone ki-down fs-5 ms-1"></i>                    </a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="<?php echo e(route('category.edit', $category->id)); ?>" class="btn btn-warning btn-sm">
                                                        Edit
                                            </a>
                                        </div>
                                        <!--end::Menu item-->

                                    <!--begin::Menu item-->
                                    <a
                                        href="javascript:void(0)"
                                        id="show-category"
                                        data-kt-ecommerce-category-filter="delete_row"
                                        data-url="<?php echo e(route('category.destroy', $category->id)); ?>"
                                        class="btn btn-danger btn-sm">Delete</a>
                                    <!--end::Menu item-->


                                </div>
                                <!--end::Menu-->
                                </td>
                            </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                        </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->    </div>
                <!--end::Card body-->
            </div>
            <!--end::Category-->
             </div>
                    <!--end::Content container-->
                </div>
            <!--end::Content-->



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\vitemart-ec\resources\views/category/index.blade.php ENDPATH**/ ?>