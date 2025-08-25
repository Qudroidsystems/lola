

<?php $__env->startSection('content'); ?>
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <!--begin::Page title-->
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                            Dashboard
                        </h1>
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <li class="breadcrumb-item text-muted">
                                <a href="/dashboard" class="text-muted text-hover-primary">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">Dashboards</li>
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page title-->
                </div>
            </div>
            <!--end::Toolbar-->

            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <?php if(session('error')): ?>
                        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
                    <?php endif; ?>
                    <!--begin::Row-->
                    <div class="row g-5 g-xl-10 mb-xl-10">
                        <!--begin::Col-->
                        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                            <!--begin::Card widget 4 (Expected Earnings)-->
                            <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                                <div class="card-header pt-5">
                                    <div class="card-title d-flex flex-column">
                                        <div class="d-flex align-items-center">
                                            <span class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">RM</span>
                                            <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2"><?php echo e(number_format($expectedEarnings ?? 0, 2, '.', ',')); ?></span>
                                            <span class="badge badge-light-<?php echo e($earningsChange >= 0 ? 'success' : 'danger'); ?> fs-base">
                                                <i class="ki-duotone ki-arrow-<?php echo e($earningsChange >= 0 ? 'up' : 'down'); ?> fs-5 text-<?php echo e($earningsChange >= 0 ? 'success' : 'danger'); ?> ms-n1">
                                                    <span class="path1"></span><span class="path2"></span>
                                                </i>
                                                <?php echo e(number_format(abs($earningsChange), 1)); ?>%
                                            </span>
                                        </div>
                                        <span class="text-gray-400 pt-1 fw-semibold fs-6">Expected Earnings</span>
                                    </div>
                                </div>
                                <div class="card-body pt-2 pb-4 d-flex align-items-center">
                                    <div class="d-flex flex-center me-5 pt-2">
                                        <div id="kt_card_widget_4_chart" style="min-width: 70px; min-height: 70px" data-kt-size="70" data-kt-line="11"></div>
                                    </div>
                                    <div class="d-flex flex-column content-justify-center w-100">
                                        <?php $__currentLoopData = array_slice($categorySales, 0, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category => $total): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="d-flex fs-6 fw-semibold align-items-center my-1">
                                                <div class="bullet w-8px h-6px rounded-2 <?php echo e($loop->index == 0 ? 'bg-danger' : ($loop->index == 1 ? 'bg-primary' : 'bg-light')); ?> me-3"></div>
                                                <div class="text-gray-500 flex-grow-1 me-4"><?php echo e($category); ?></div>
                                                <div class="fw-bolder text-gray-700 text-xxl-end">RM <?php echo e(number_format($total ?? 0, 2, '.', ',')); ?></div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                            <!--end::Card widget 4-->

                            <!--begin::Card widget 5 (Orders This Month)-->
                            <div class="card card-flush h-md-50 mb-xl-10">
                                <div class="card-header pt-5">
                                    <div class="card-title d-flex flex-column">
                                        <div class="d-flex align-items-center">
                                            <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2"><?php echo e($ordersThisMonth); ?></span>
                                            <span class="badge badge-light-<?php echo e($ordersChange >= 0 ? 'success' : 'danger'); ?> fs-base">
                                                <i class="ki-duotone ki-arrow-<?php echo e($ordersChange >= 0 ? 'up' : 'down'); ?> fs-5 text-<?php echo e($ordersChange >= 0 ? 'success' : 'danger'); ?> ms-n1">
                                                    <span class="path1"></span><span class="path2"></span>
                                                </i>
                                                <?php echo e(number_format(abs($ordersChange), 1)); ?>%
                                            </span>
                                        </div>
                                        <span class="text-gray-400 pt-1 fw-semibold fs-6">Orders This Month</span>
                                    </div>
                                </div>
                                <div class="card-body d-flex align-items-end pt-0">
                                    <div class="d-flex align-items-center flex-column mt-3 w-100">
                                        <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                            <span class="fw-bolder fs-6 text-dark"><?php echo e(max(0, 3000 - $ordersThisMonth)); ?> to Goal</span>
                                            <span class="fw-bold fs-6 text-gray-400"><?php echo e(round(($ordersThisMonth / 3000) * 100)); ?>%</span>
                                        </div>
                                        <div class="h-8px mx-3 w-100 bg-light-success rounded">
                                            <div class="bg-success rounded h-8px" role="progressbar" style="width: <?php echo e(round(($ordersThisMonth / 3000) * 100)); ?>%;" aria-valuenow="<?php echo e($ordersThisMonth); ?>" aria-valuemin="0" aria-valuemax="3000"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Card widget 5-->
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                            <!--begin::Card widget 6 (Average Daily Sales)-->
                            <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                                <div class="card-header pt-5">
                                    <div class="card-title d-flex flex-column">
                                        <div class="d-flex align-items-center">
                                            <span class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">RM</span>
                                            <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2"><?php echo e(number_format($avgDailySales ?? 0, 2, '.', ',')); ?></span>
                                            <span class="badge badge-light-<?php echo e($avgSalesChange >= 0 ? 'success' : 'danger'); ?> fs-base">
                                                <i class="ki-duotone ki-arrow-<?php echo e($avgSalesChange >= 0 ? 'up' : 'down'); ?> fs-5 text-<?php echo e($avgSalesChange >= 0 ? 'success' : 'danger'); ?> ms-n1">
                                                    <span class="path1"></span><span class="path2"></span>
                                                </i>
                                                <?php echo e(number_format(abs($avgSalesChange), 1)); ?>%
                                            </span>
                                        </div>
                                        <span class="text-gray-400 pt-1 fw-semibold fs-6">Average Daily Sales</span>
                                    </div>
                                </div>
                                <div class="card-body d-flex align-items-end px-0 pb-0">
                                    <div id="kt_card_widget_6_chart" class="w-100" style="height: 80px"></div>
                                </div>
                            </div>
                            <!--end::Card widget 6-->

                            <!--begin::Card widget 7 (New Customers)-->
                            <div class="card card-flush h-md-50 mb-xl-10">
                                <div class="card-header pt-5">
                                    <div class="card-title d-flex flex-column">
                                        <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2"><?php echo e(number_format($newCustomersCount, 0)); ?></span>
                                        <span class="text-gray-400 pt-1 fw-semibold fs-6">New Customers This Month</span>
                                    </div>
                                </div>
                                <div class="card-body d-flex flex-column justify-content-end pe-0">
                                    <span class="fs-6 fw-bolder text-gray-800 d-block mb-2">Recent Customers</span>
                                    <div class="symbol-group symbol-hover flex-nowrap">
                                        <?php $__currentLoopData = $recentCustomers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="<?php echo e($customer->name); ?>">
                                                <span class="symbol-label bg-<?php echo e(['primary', 'warning', 'danger'][rand(0,2)]); ?> text-inverse-<?php echo e(['primary', 'warning', 'danger'][rand(0,2)]); ?> fw-bold"><?php echo e(substr($customer->name, 0, 1)); ?></span>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <a href="#" class="symbol symbol-35px symbol-circle" data-bs-toggle="modal" data-bs-target="#kt_modal_view_users">
                                            <span class="symbol-label bg-light text-gray-400 fs-8 fw-bold">+<?php echo e(max(0, $newCustomersCount - 6)); ?></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!--end::Card widget 7-->
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
                            <!--begin::Chart widget 3 (Sales This Month)-->
                            <div class="card card-flush overflow-hidden h-md-100">
                                <div class="card-header py-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-dark">Sales This Month</span>
                                        <span class="text-gray-400 mt-1 fw-semibold fs-6">Users from all channels</span>
                                    </h3>
                                    <div class="card-toolbar">
                                        <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end"
                                            data-kt-menu-trigger="click"
                                            data-kt-menu-placement="bottom-end"
                                            data-kt-menu-overflow="true">
                                            <i class="ki-duotone ki-dots-square fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                        </button>
                                        <!--begin::Menu 2-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <div class="menu-content fs-6 text-dark fw-bold px-3 py-4">Quick Actions</div>
                                            </div>
                                            <div class="separator mb-3 opacity-75"></div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">New Ticket</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">New Customer</a>
                                            </div>
                                            <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                                <a href="#" class="menu-link px-3">
                                                    <span class="menu-title">New Group</span>
                                                    <span class="menu-arrow"></span>
                                                </a>
                                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Admin Group</a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Staff Group</a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Member Group</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">New Contact</a>
                                            </div>
                                            <div class="separator mt-3 opacity-75"></div>
                                            <div class="menu-item px-3">
                                                <div class="menu-content px-3 py-3">
                                                    <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Menu 2-->
                                    </div>
                                </div>
                                <div class="card-body d-flex justify-content-between flex-column pb-1 px-0">
                                    <div class="px-9 mb-5">
                                        <div class="d-flex mb-2">
                                            <span class="fs-4 fw-semibold text-gray-400 me-1">RM</span>
                                            <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2"><?php echo e(number_format($expectedEarnings ?? 0, 2, '.', ',')); ?></span>
                                        </div>
                                        <span class="fs-6 fw-semibold text-gray-400">Another RM <?php echo e(number_format(max(0, 50000 - $expectedEarnings), 2, '.', ',')); ?> to Goal</span>
                                    </div>
                                    <div id="kt_charts_widget_3" class="min-h-auto ps-4 pe-6" style="height: 300px"></div>
                                </div>
                            </div>
                            <!--end::Chart widget 3-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->

                    <!--begin::Row-->
                    <div class="row gy-5 g-xl-10">
                        <!--begin::Col-->
                        <div class="col-xl-4 mb-xl-10"></div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-xl-12 mb-5 mb-xl-10">
                            <!--begin::Table Widget 4 (Product Orders)-->
                            <div class="card card-flush h-xl-100">
                                <div class="card-header pt-7">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-gray-800">Product Orders</span>
                                        <span class="text-gray-400 mt-1 fw-semibold fs-6">Avg. <?php echo e(round($ordersThisMonth / max(1, \Carbon\Carbon::now()->day))); ?> orders per day</span>
                                    </h3>
                                    <div class="card-toolbar">
                                        <div class="d-flex flex-stack flex-wrap gap-4">
                                            <div class="d-flex align-items-center fw-bold">
                                                <div class="text-gray-400 fs-7 me-2">Category</div>
                                                <select class="form-select form-select-transparent text-gray-800 fs-base lh-1 fw-bold py-0 ps-3 w-auto" data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px" data-placeholder="Select an option">
                                                    <option value="Show All" selected>Show All</option>
                                                    <?php $__currentLoopData = $categorySales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category => $total): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($category); ?>"><?php echo e($category); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="d-flex align-items-center fw-bold">
                                                <div class="text-gray-400 fs-7 me-2">Status</div>
                                                <select class="form-select form-select-transparent text-dark fs-7 lh-1 fw-bold py-0 ps-3 w-auto" data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px" data-placeholder="Select an option" data-kt-table-widget-4="filter_status">
                                                    <option value="Show All" selected>Show All</option>
                                                    <option value="pending">Pending</option>
                                                    <option value="completed">Completed</option>
                                                    <option value="rejected">Rejected</option>
                                                </select>
                                            </div>
                                            <div class="position-relative my-1">
                                                <i class="ki-duotone ki-magnifier fs-2 position-absolute top-50 translate-middle-y ms-4"><span class="path1"></span><span class="path2"></span></i>
                                                <input type="text" data-kt-table-widget-4="search" class="form-control w-150px fs-7 ps-12" placeholder="Search" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-2">
                                    <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_4_table">
                                        <thead>
                                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                <th class="min-w-100px">Order ID</th>
                                                <th class="text-end min-w-100px">Created</th>
                                                <th class="text-end min-w-125px">Customer</th>
                                                <th class="text-end min-w-100px">Total</th>
                                                <th class="text-end min-w-100px">Profit</th>
                                                <th class="text-end min-w-50px">Status</th>
                                                <th class="text-end"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-bold text-gray-600">
                                            <?php $__currentLoopData = $productOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <a href="#" class="text-gray-800 text-hover-primary">#<?php echo e($order['id']); ?></a>
                                                    </td>
                                                    <td class="text-end"><?php echo e($order['created_at']); ?></td>
                                                    <td class="text-end">
                                                        <a href="#" class="text-gray-600 text-hover-primary"><?php echo e($order['customer']); ?></a>
                                                    </td>
                                                    <td class="text-end">RM <?php echo e(number_format($order['total'] ?? 0, 2, '.', ',')); ?></td>
                                                    <td class="text-end">RM <?php echo e(number_format($order['profit'] ?? 0, 2, '.', ',')); ?></td>
                                                    <td class="text-end">
                                                        <span class="badge py-3 px-4 fs-7 badge-light-<?php echo e($order['status'] == 'completed' ? 'success' : ($order['status'] == 'pending' ? 'warning' : 'danger')); ?>"><?php echo e(ucfirst($order['status'])); ?></span>
                                                    </td>
                                                    <td class="text-end">
                                                        <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" data-kt-table-widget-4="expand_row">
                                                            <i class="ki-duotone ki-plus fs-4 m-0 toggle-off"></i>
                                                            <i class="ki-duotone ki-minus fs-4 m-0 toggle-on"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr data-kt-table-widget-4="subtable_template" class="d-none">
                                                    <td colspan="7">
                                                        <div class="text-gray-800 fs-6 fw-bold mb-2">Cart Items for <?php echo e($order['customer']); ?></div>
                                                        <div class="d-flex align-items-center gap-3">
                                                            <a href="#" class="symbol symbol-50px bg-secondary bg-opacity-25 rounded">
                                                                <img src="#" data-kt-src-path="/metronic8/demo1/assets/media/stock/ecommerce/" alt="" data-kt-table-widget-4="template_image" />
                                                            </a>
                                                            <div class="d-flex flex-column text-muted">
                                                                <a href="#" class="text-gray-800 text-hover-primary fw-bold" data-kt-table-widget-4="template_name">Product name</a>
                                                                <div class="fs-7" data-kt-table-widget-4="template_description">Product description</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end">
                                                        <div class="text-gray-800 fs-7">Cost</div>
                                                        <div class="text-muted fs-7 fw-bold" data-kt-table-widget-4="template_cost">1</div>
                                                    </td>
                                                    <td class="text-end">
                                                        <div class="text-gray-800 fs-7">Qty</div>
                                                        <div class="text-muted fs-7 fw-bold" data-kt-table-widget-4="template_qty">1</div>
                                                    </td>
                                                    <td class="text-end">
                                                        <div class="text-gray-800 fs-7">Total</div>
                                                        <div class="text-muted fs-7 fw-bold" data-kt-table-widget-4="template_total">name</div>
                                                    </td>
                                                    <td class="text-end">
                                                        <div class="text-gray-800 fs-7 me-3">On hand</div>
                                                        <div class="text-muted fs-7 fw-bold" data-kt-table-widget-4="template_stock">32</div>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <?php if($order['items']->isEmpty()): ?>
                                                    <tr class="subtable-row d-none" data-kt-table-widget-4="subtable">
                                                        <td colspan="7" class="text-center text-muted">No cart items for this user.</td>
                                                    </tr>
                                                <?php else: ?>
                                                    <?php $__currentLoopData = $order['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr class="subtable-row d-none" data-kt-table-widget-4="subtable">
                                                            <td colspan="2">
                                                                <div class="d-flex align-items-center gap-3">
                                                                    <a href="#" class="symbol symbol-50px bg-secondary bg-opacity-25 rounded">
                                                                        <img src="<?php echo e($item['image']); ?>" alt="<?php echo e($item['name']); ?>" />
                                                                    </a>
                                                                    <div class="d-flex flex-column text-muted">
                                                                        <a href="#" class="text-gray-800 text-hover-primary fw-bold"><?php echo e($item['name']); ?></a>
                                                                        <div class="fs-7"><?php echo e($item['description']); ?></div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-end">
                                                                <div class="text-gray-800 fs-7">Cost</div>
                                                                <div class="text-muted fs-7 fw-bold">RM <?php echo e(number_format($item['cost'] ?? 0, 2, '.', ',')); ?></div>
                                                            </td>
                                                            <td class="text-end">
                                                                <div class="text-gray-800 fs-7">Qty</div>
                                                                <div class="text-muted fs-7 fw-bold"><?php echo e($item['quantity']); ?></div>
                                                            </td>
                                                            <td class="text-end">
                                                                <div class="text-gray-800 fs-7">Total</div>
                                                                <div class="text-muted fs-7 fw-bold">RM <?php echo e(number_format($item['total'] ?? 0, 2, '.', ',')); ?></div>
                                                            </td>
                                                            <td class="text-end">
                                                                <div class="text-gray-800 fs-7 me-3">On hand</div>
                                                                <div class="text-muted fs-7 fw-bold"><?php echo e($item['stock']); ?></div>
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                    <!--begin::Pagination-->
                                    <div class="d-flex justify-content-end mt-5">
                                        <?php echo e($productOrders->links()); ?>

                                    </div>
                                    <!--end::Pagination-->
                                </div>
                            </div>
                            <!--end::Table Widget 4-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Main-->

    <!--begin::Chart.js CDN-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
    <!--end::Chart.js CDN-->

    <!--begin::Chart Initialization-->
    <script>
        // Function to format numbers in Malaysian style (e.g., 1,234.56)
        function formatMYR(value) {
            return Number(value).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '&,');
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Category Sales Chart (kt_card_widget_4_chart)
            const ctx4 = document.getElementById('kt_card_widget_4_chart').getContext('2d');
            new Chart(ctx4, {
                type: 'pie',
                data: {
                    labels: <?php echo json_encode(array_keys($categorySales), 15, 512) ?>,
                    datasets: [{
                        data: <?php echo json_encode(array_values($categorySales), 15, 512) ?>,
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
                        hoverOffset: 20
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return `${context.label}: RM ${formatMYR(context.raw)}`;
                                }
                            }
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // Daily Sales Chart (kt_card_widget_6_chart)
            const ctx6 = document.getElementById('kt_card_widget_6_chart').getContext('2d');
            new Chart(ctx6, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode(array_keys($dailySales), 15, 512) ?>,
                    datasets: [{
                        label: 'Daily Sales',
                        data: <?php echo json_encode(array_values($dailySales), 15, 512) ?>,
                        borderColor: '#36A2EB',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Sales (RM)'
                            },
                            ticks: {
                                callback: function (value) {
                                    return 'RM ' + formatMYR(value);
                                }
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Date'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return `RM ${formatMYR(context.raw)}`;
                                }
                            }
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // Sales This Month Chart (kt_charts_widget_3)
            const ctx3 = document.getElementById('kt_charts_widget_3').getContext('2d');
            new Chart(ctx3, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode(array_keys($categorySales), 15, 512) ?>,
                    datasets: [{
                        label: 'Sales by Category',
                        data: <?php echo json_encode(array_values($categorySales), 15, 512) ?>,
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
                        borderColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Sales (RM)'
                            },
                            ticks: {
                                callback: function (value) {
                                    return 'RM ' + formatMYR(value);
                                }
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Category'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return `${context.label}: RM ${formatMYR(context.raw)}`;
                                }
                            }
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        });
    </script>
    <!--end::Chart Initialization-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lola\resources\views/dashboard.blade.php ENDPATH**/ ?>