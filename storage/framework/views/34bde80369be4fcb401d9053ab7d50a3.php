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
                        <!--begin::Filter menu-->
                    <div class="m-0">
                        <!--begin::Menu toggle-->
                        <a href="#" class="btn btn-sm btn-flex bg-body btn-color-gray-700 btn-active-color-primary fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-filter fs-6 text-muted me-1"><span class="path1"></span><span class="path2"></span></i>
                            Filter
                        </a>
                        <!--end::Menu toggle-->



            <!--begin::Menu 1-->
            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_6486985a3eb08">
                <!--begin::Header-->
                <div class="px-7 py-5">
                    <div class="fs-5 text-dark fw-bold">Filter Options</div>
                </div>
                <!--end::Header-->

                <!--begin::Menu separator-->
                <div class="separator border-gray-200"></div>
                <!--end::Menu separator-->

                <!--begin::Form-->
                <div class="px-7 py-5">
                    <!--begin::Input group-->
                    <div class="mb-10">
                        <!--begin::Label-->
                        <label class="form-label fw-semibold">Status:</label>
                        <!--end::Label-->

                        <!--begin::Input-->
                        <div>
                            <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_6486985a3eb08" data-allow-clear="true">
                                <option></option>
                                <option value="1">Approved</option>
                                <option value="2">Pending</option>
                                <option value="2">In Process</option>
                                <option value="2">Rejected</option>
                            </select>
                        </div>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="mb-10">
                        <!--begin::Label-->
                        <label class="form-label fw-semibold">Member Type:</label>
                        <!--end::Label-->

                        <!--begin::Options-->
                        <div class="d-flex">
                            <!--begin::Options-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                <input class="form-check-input" type="checkbox" value="1"/>
                                <span class="form-check-label">
                                    Author
                                </span>
                            </label>
                            <!--end::Options-->

                            <!--begin::Options-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="2" checked="checked"/>
                                <span class="form-check-label">
                                    Customer
                                </span>
                            </label>
                            <!--end::Options-->
                        </div>
                        <!--end::Options-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="mb-10">
                        <!--begin::Label-->
                        <label class="form-label fw-semibold">Notifications:</label>
                        <!--end::Label-->

                        <!--begin::Switch-->
                        <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="" name="notifications" checked />
                            <label class="form-check-label">
                                Enabled
                            </label>
                        </div>
                        <!--end::Switch-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Actions-->
                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>

                        <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                    </div>
                    <!--end::Actions-->
                </div>
                <!--end::Form-->
            </div>
            <!--end::Menu 1-->        </div>
                    <!--end::Filter menu-->


                <!--begin::Secondary button-->
                    <!--end::Secondary button-->

                <!--begin::Primary button-->
                        <a href="#" class="btn btn-sm fw-bold btn-primary"  data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">
                        Create        </a>
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
                        <a href="add-category.html" class="btn btn-primary">
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
                        <th class="min-w-150px">Category Type</th>
                        <th class="text-end min-w-70px">Actions</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">

                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="#l" class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1" data-kt-ecommerce-customer-filter="customer_name"><?php echo e($customer->first_name); ?>  <?php echo e($customer->last_name); ?></a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <!--begin::Badges-->
                                        <div ><?php echo e($customer->email); ?></div>
                                        <!--end::Badges-->
                                    </td>
                                    <td>
                                        <!--begin::Badges-->
                                   <?php echo e($customer->phone_number); ?>,  <?php echo e($customer->phone_number_2); ?>

                                        <!--end::Badges-->
                                    </td>
                                    <td>
                                        <!--begin::Badges-->
                                        <div> <span style="color: green"> Home Address:</span>   <?php echo e($customer->home_address); ?></div>
                                        <p><div>  <span style="color: green">Office Address: </span> <?php echo e($customer->office_address); ?></div></p>
                                        <!--end::Badges-->
                                    </td>
                                    <td>
                                        <!--begin::Badges-->
                                        <div > <?php echo e($customer->gender); ?></div>
                                        <!--end::Badges-->
                                    </td>
                                    <td>
                                        <!--begin::Badges-->
                                        <div > <?php echo e($customer->gender); ?></div>
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
                                                <a href="<?php echo e(route('customer.edit', $customer->id)); ?>" class="btn btn-warning btn-sm">
                                                            Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                        <!--begin::Menu item-->
                                        <a
                                            href="javascript:void(0)"
                                            id="show-customer"
                                            data-kt-ecommerce-customer-filter="delete_row"
                                            data-url="<?php echo e(route('customer.destroy', $customer->id)); ?>"
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\vitemart-ec\resources\views/customer/index.blade.php ENDPATH**/ ?>