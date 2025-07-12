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

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!--== Page Title Area Start ==-->
    <div id="page-title-area">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="page-title-content">
                        <h1>Dashboard</h1>
                        <ul class="breadcrumb">
                            <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                            <li><a href="<?php echo e(route('user.dashboard')); ?>" class="active">Dashboard</a></li>
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
            <div class="row">
                <div class="col-lg-12">
                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <div class="row">
                            <!-- Sidebar Navigation -->
                            <div class="col-lg-3">
                                <div class="myaccount-tab-menu nav" role="tablist">
                                    <a href="#dashboard" class="active" data-bs-toggle="tab"><i class="fa fa-dashboard"></i> Dashboard</a>
                                    <a href="#orders" data-bs-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Orders</a>
                                    <a href="#address" data-bs-toggle="tab"><i class="fa fa-map-marker"></i> Address</a>
                                    <a href="#account-info" data-bs-toggle="tab"><i class="fa fa-user"></i> Account Details</a>
                                    <a href="<?php echo e(route('logout')); ?>"><i class="fa fa-sign-out"></i> Logout</a>
                                </div>
                            </div>

                            <!-- Content Area -->
                            <div class="col-lg-9 mt-5 mt-lg-0">
                                <div class="tab-content" id="myaccountContent">
                                    <!-- Dashboard -->
                                    <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Dashboard</h3>
                                            <div class="welcome">
                                                <p>Hello, <strong><?php echo e($user->name); ?></strong> (Not <strong><?php echo e($user->name); ?>?</strong> <a href="<?php echo e(route('logout')); ?>" class="logout">Logout</a>)</p>
                                            </div>
                                            <p>From your dashboard, you can check your orders, manage your address, and edit account details.</p>
                                        </div>
                                    </div>

                                    <!-- Orders Section -->
                                    <div class="tab-pane fade" id="orders" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Orders</h3>
                                            <div class="myaccount-table table-responsive text-center">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Order</th>
                                                            <th>Date</th>
                                                            <th>Status</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                            <tr>
                                                                <td><?php echo e($order->id); ?></td>
                                                                <td><?php echo e($order->created_at->format('M d, Y')); ?></td>
                                                                <td><?php echo e(ucfirst($order->status)); ?></td>
                                                                <td>RM <?php echo e(number_format($order->total, 2)); ?></td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                            <tr><td colspan="4">No orders found.</td></tr>
                                                        <?php endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Address -->
                                    <div class="tab-pane fade" id="address" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Billing Address</h3>
                                            <?php if($billingAddress): ?>
                                                <address>
                                                    <p><strong><?php echo e($user->name); ?></strong></p>
                                                    <p><?php echo e($billingAddress->street); ?>, <?php echo e($billingAddress->city); ?><br>
                                                        <?php echo e($billingAddress->state); ?>, <?php echo e($billingAddress->zip); ?></p>
                                                    <p>Phone: <?php echo e($billingAddress->phone ?? 'N/A'); ?></p>
                                                </address>
                                                <a href="<?php echo e(route('user.address.edit')); ?>" class="btn-add-to-cart"><i class="fa fa-edit"></i> Edit Address</a>
                                            <?php else: ?>
                                                <p>No billing address added.</p>
                                                <a href="<?php echo e(route('user.address.edit')); ?>" class="btn-add-to-cart"><i class="fa fa-plus"></i> Add Address</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Account Details -->
                                    <div class="tab-pane fade" id="account-info" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Account Details</h3>
                                            <form action="<?php echo e(route('user.update')); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label class="required">Full Name</label>
                                                            <input type="text" name="name" value="<?php echo e($user->name); ?>" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label class="required">Email</label>
                                                            <input type="email" name="email" value="<?php echo e($user->email); ?>" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn-add-to-cart" type="submit">Save Changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Content End -->
                        </div>
                    </div>
                    <!-- My Account Page End -->
                </div>
            </div>
        </div>
    </div>
    <!--== Page Content Wrapper End ==-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lola\resources\views/frontend/user-dashboard.blade.php ENDPATH**/ ?>