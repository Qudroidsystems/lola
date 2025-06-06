 <!--begin::Navbar-->
 <div class="card mb-5 mb-xl-10">
    <div class="card-body pt-9 pb-0">
        <!--begin::Details-->
        <div class="d-flex flex-wrap flex-sm-nowrap">
            <!--begin: Pic-->
            <div class="me-7 mb-4">
                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                    <?php $image = "";?>
                    <?php
                    if ($user->avatar == NULL || $user->avatar =="" || !isset($user->avatar) ){
                           $image =  'unnamed.png';
                    }else {
                       $image =  $user->avatar;
                    }
                    ?>
                    <img src="<?php echo e(Storage::url('images/staffavatar/'.$image)); ?>" alt="image" />
                    <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                </div>
            </div>
            <!--end::Pic-->

            <!--begin::Info-->
            <div class="flex-grow-1">
                <!--begin::Title-->
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                    <!--begin::User-->
                    <div class="d-flex flex-column">
                        <!--begin::Name-->
                        <div class="d-flex align-items-center mb-2">
                            <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1"><?php echo e($user->name); ?></a>
                            <a href="#"><i class="ki-duotone ki-verify fs-1 text-primary"><span class="path1"></span><span class="path2"></span></i></a>
                        </div>
                        <!--end::Name-->

                        <!--begin::Info-->
                        <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                            <?php $__currentLoopData = $userroles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userrole): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="#" class="d-flex align-items-center  me-5 mb-2 <?php echo e($userrole->badge); ?>">
                                <i class="ki-duotone ki-profile-circle fs-4 me-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                    <?php echo e($userrole->name); ?>

                            </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                <i class="ki-duotone ki-geolocation fs-4 me-1"><span class="path1"></span><span class="path2"></span></i>
                                <?php echo e($userbio->address); ?>

                            </a>
                            <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                <i class="ki-duotone ki-sms fs-4 me-1"><span class="path1"></span><span class="path2"></span></i>
                                            <?php echo e($user->email); ?>

                            </a>
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::User-->


                </div>
                <!--end::Title-->

                <!--begin::Stats-->
                <div class="d-flex flex-wrap flex-stack">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column flex-grow-1 pe-8">
                        <!--begin::Stats-->
                        <div class="d-flex flex-wrap">
                            <!--begin::Stat-->
                            
                            <!--end::Stat-->

                            <!--begin::Stat-->
                            
                            <!--end::Stat-->


                        </div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Wrapper-->


                </div>
                <!--end::Stats-->
            </div>
            <!--end::Info-->
        </div>
        <!--end::Details-->

        <!--begin::Navs-->
        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                            <!--begin::Nav item-->
                <li class="nav-item mt-2">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5  <?php echo e(request()->is('overview*')
                        ? ' active' : ''); ?>" href="<?php echo e(route('user.overview',Auth::user()->id)); ?>">
                        Overview                    </a>
                </li>
                <!--end::Nav item-->
                            <!--begin::Nav item-->
                <li class="nav-item mt-2">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5 <?php echo e(request()->is('settings*')
                        ? ' active' : ''); ?>" href="<?php echo e(route('user.settings',Auth::user()->id)); ?>">
                        Settings                    </a>
                </li>
                <!--end::Nav item-->

                    </ul>
        <!--begin::Navs-->
    </div>
</div>
<!--end::Navbar-->
<?php /**PATH C:\xampp\htdocs\lola\resources\views/users/inc/navbar.blade.php ENDPATH**/ ?>