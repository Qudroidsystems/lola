<?php $__env->startSection('content'); ?>
<?php
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Spatie\Permission\Models\Role;
?>

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
            Roles List
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
                                                        User Management                                            </li>
                                    <!--end::Item-->
                                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->

                                <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">
                                                        Roles                                            </li>
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
            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_648698624af08">
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
                        <label class="form-label fw-semibold">Roles:</label>
                        <!--end::Label-->

                        <!--begin::Input-->
                        <div>
                            <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_648698624af08" data-allow-clear="true">
                                <option></option>
                                <?php $__currentLoopData = $role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($r->name); ?>"><?php echo e($r->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </select>
                        </div>
                        <!--end::Input-->
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
    <!--end::Menu 1-->
     </div>
            <!--end::Filter menu-->


        <!--begin::Secondary button-->

            <!--end::Secondary button-->


           </div>
    <!--end::Actions-->

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
            </div>
            <!--end::Toolbar container-->

 </div>
    <!--end::Toolbar-->



    <!--begin::Content-->
    <div id="kt_app_content" class="app-content  flex-column-fluid " >


            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container  container-xxl ">

    <!--begin::Row-->
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">

        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <!--begin::Col-->
            <div class="col-md-4">
                <!--begin::Card-->
                <div class="card card-flush h-md-100">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2><?php echo e($role->name); ?></h2>&nbsp;
                            <h2 class="<?php echo e($role->badge); ?>">Role Badge</h2>
                        </div>
                        <!--end::Card title-->
                    </div>

                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body pt-1">
                        <!--begin::Users-->
                     <?php
                        // $roles = Role::orderBy('name','DESC')->get();
                        // foreach ($roles as $role => $value) {
                            $roles_num =  DB::table('model_has_roles')->where('role_id',$role->id)->count();
                            $role_permissions = $role->permissions->pluck('name')->take(3);
                        // }

                        ?>
                            <div class="fw-bold text-gray-600 mb-5">Total users with this role: <?php echo e($roles_num); ?></div>
                            <!--end::Users-->
                            <div class="d-flex flex-column text-gray-600">
                            <!--begin::Permissions-->
                            <?php $__currentLoopData = $role_permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role_permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <div class="d-flex align-items-center py-2"><span class="bullet bg-primary me-3"></span> <?php echo e($role_permission); ?></div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <div class='d-flex align-items-center py-2'><span class='bullet bg-primary me-3'></span> <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-list')): ?><a href="<?php echo e(route('roles.show',$role->id)); ?>" <em>...and more</a><?php endif; ?></em></div>
                            </div>
                            <!--end::Permissions-->

                

                    </div>
                    <!--end::Card body-->

                    <!--begin::Card footer-->
                    <div class="card-footer flex-wrap pt-3">

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-list')): ?>
                        <a href="<?php echo e(route('roles.show',$role->id)); ?>" class="btn btn-light btn-sm  btn-active-primary my-1 me-2">View </a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-updateuserrole')): ?>
                        <a href="<?php echo e(route('roles.adduser',$role->id)); ?>" class="btn btn-light btn-sm btn-active-success my-1" >Add User </a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-delete')): ?>
                        <?php echo Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'class' => 'btn my-1 me-2 ']); ?>

                        <?php echo Form::submit('Delete', ['class' => 'btn btn-danger btn-xm btn-active-light-danger my-1']); ?>

                        <?php echo Form::close(); ?>

                        <?php endif; ?>
                    </div>
                    <!--end::Card footer-->

                </div>
                <!--end::Card-->

            </div>
            <!--end::Col-->

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        <!--begin::Add new card-->
        <div class="ol-md-4">
            <!--begin::Card-->
            <div class="card h-md-100">
                <!--begin::Card body-->
                <div class="card-body d-flex flex-center">
                    <!--begin::Button-->
                    <button type="button" class="btn btn-clear d-flex flex-column flex-center" data-bs-toggle="modal" data-bs-target="#kt_modal_add_role">
                        <!--begin::Illustration-->
                        <img src="<?php echo e(asset('html/assets/assets/media/logos/4.png')); ?>" alt="" class="mw-100 mh-150px mb-7"/>
                        <!--end::Illustration-->

                        <!--begin::Label-->
                        <div class="fw-bold fs-3 text-gray-600 text-hover-primary">Add New Role</div>
                        <!--end::Label-->
                    </button>
                    <!--begin::Button-->
                </div>
                <!--begin::Card body-->
            </div>
            <!--begin::Card-->
        </div>
        <!--begin::Add new card-->
    </div>
    <!--end::Row-->

    <!--begin::Modals-->

    <!--begin::Modal - Add role-->
    <div class="modal fade" id="kt_modal_add_role" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-750px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">Add a Role</h2>
                    <!--end::Modal title-->

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-roles-modal-action="close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>                </div>
                    <!--end::Close-->
                   </div>
                <!--end::Modal header-->

                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-lg-5 my-7">
                    <!--begin::Form-->
                    <form id="kt_modal_add_role_form" class="form" action="<?php echo e(route('roles.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_role_header" data-kt-scroll-wrappers="#kt_modal_add_role_scroll" data-kt-scroll-offset="300px">
                            <!--begin::Input group-->
                            <div class="fv-row mb-10">
                                <!--begin::Label-->
                                <label class="fs-5 fw-bold form-label mb-2">
                                    <span class="required">Role name</span>
                                </label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <input class="form-control form-control-solid" placeholder="Enter a role name" name="name" />
                                <!--end::Input-->
                            </div>


                             <!--begin::Input group-->
                             <div class="fv-row mb-10">
                                <!--begin::Label-->
                                <label class="fs-5 fw-bold form-label mb-2">
                                    <span class="required">Role badge</span>
                                </label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <select name="badge" class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-user-table-filter="two-step" data-hide-search="true">
                                    <option></option>
                                    <option value="badge badge-light">Light grey</option>
                                    <option value="badge badge-dark"> Dark</option>
                                    <option value="badge badge-primary">Blue</option>
                                    <option value="badge badge-secondary">Light blue</option>
                                    <option value="badge badge-success">Light green</option>
                                    <option value="badge badge-info">Purple</option>
                                    <option value="badge badge-warning">Yellow</option>
                                    <option value="badge badge-danger">Red</option>
                               </select>
                                <!--end::Input-->
                            </div>




                            <!--begin::Permissions-->
                            <div class="fv-row">
                                <!--begin::Label-->
                                <label class="fs-5 fw-bold form-label mb-2">Role Permissions</label>
                                <!--end::Label-->

                                <!--begin::Table wrapper-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                                        <!--begin::Table body-->
                                        <tbody class="text-gray-600 fw-semibold">
                                            <!--begin::Table row-->
                                            <tr>
                                                <td class="text-gray-800">
                                                    Administrator Access

                                                    <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Allows a full access to the system">
                                                        <i class="ki-duotone ki-information fs-7"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>                                                </span>
                                                </td>
                                                <td>
                                                    <!--begin::Checkbox-->
                                                    <label class="form-check form-check-custom form-check-solid me-9">
                                                        <input class="form-check-input" type="checkbox" value="" id="kt_roles_select_all" />
                                                        <span class="form-check-label" for="kt_roles_select_all">
                                                            Select all
                                                        </span>
                                                    </label>
                                                    <!--end::Checkbox-->
                                                </td>
                                            </tr>
                                            <!--end::Table row-->


                                              <?php $__currentLoopData = array_unique($perm_title); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <?php
                                              $permission = Permission::where('title',$value)->get();
                                              $word="";

                                             ?>

                                            <tr>
                                               <!--begin::Label-->
                                               <td class="text-gray-800"><?php echo e($value); ?></td>
                                               <!--end::Label-->


                                              <?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <?php
                                                    if(strpos($v->name, "list")){
                                                        $word = "View";
                                                        }
                                                        if(strpos($v->name, "create")){
                                                        $word = "Create";
                                                        }
                                                        if(strpos($v->name, "edit")){
                                                        $word = "Edit";
                                                        }
                                                        if(strpos($v->name, "delete")){
                                                        $word = "Delete";
                                                        }
                                                        if(strpos($v->name, "updateuserrole")){
                                                        $word = "Add user role";
                                                        }
                                            ?>
                                              <!--begin::Options-->
                                              <td>
                                                <!--begin::Wrapper-->
                                                <div class="d-flex">
                                                    <!--begin::Checkbox-->
                                                    <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                        <input class="form-check-input" type="checkbox" value="<?php echo e($v->id); ?>" name="permission[]"/>
                                                        <span class="form-check-label">
                                                            <?php echo e($word); ?>

                                                        </span>
                                                    </label>
                                             <!--end::Checkbox-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </td>
                                            <!--end::Options-->
                                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tr>


                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                                                                        <!--begin::Table row-->

                                                 </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Table wrapper-->
                            </div>
                            <!--end::Permissions-->
                        </div>
                        <!--end::Scroll-->

                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-kt-roles-modal-action="cancel">
                                Discard
                            </button>

                            <button type="submit" class="btn btn-primary" data-kt-roles-modal-action="submit">
                                <span class="indicator-label">
                                    Submit
                                </span>
                                <span class="indicator-progress">
                                    Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Add role-->



    <!--begin::Modal - Update role-->
    <div class="modal fade" id="kt_modal_update_role" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-750px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">Update Role</h2>
                    <!--end::Modal title-->

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-roles-modal-action="close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>                </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->

                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 my-7">
                    <!--begin::Form-->
                    <form id="kt_modal_update_role_form" class="form" action="#">
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_role_header" data-kt-scroll-wrappers="#kt_modal_update_role_scroll" data-kt-scroll-offset="300px">
                            <!--begin::Input group-->
                            <div class="fv-row mb-10">
                                <!--begin::Label-->
                                <label class="fs-5 fw-bold form-label mb-2">
                                    <span class="required">Role name <?php echo e($role->id); ?></span>
                                </label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <input class="form-control form-control-solid" placeholder="Enter a role name" name="role_name" value="Developer" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Permissions-->
                            <div class="fv-row">
                                <!--begin::Label-->
                                <label class="fs-5 fw-bold form-label mb-2">Role Permissions</label>
                                <!--end::Label-->

                                <!--begin::Table wrapper-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                                        <!--begin::Table body-->
                                        <tbody class="text-gray-600 fw-semibold">
                                            <!--begin::Table row-->
                                            <tr>
                                                <td class="text-gray-800">
                                                    Administrator Access


                                                    <span class="ms-1"  data-bs-toggle="tooltip" title="Allows a full access to the system" >
                                                        <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                            <span class="path1"></span><span class="path2">
                                                                </span><span class="path3"></span></i></span>
                                                </td>
                                                <td>
                                                    <!--begin::Checkbox-->
                                                    <label class="form-check form-check-sm form-check-custom form-check-solid me-9">
                                                        <input class="form-check-input" type="checkbox" value="" id="kt_roles_select_all" />
                                                        <span class="form-check-label" for="kt_roles_select_all">
                                                            Select all
                                                        </span>
                                                    </label>
                                                    <!--end::Checkbox-->
                                                </td>
                                            </tr>
                                            <!--end::Table row-->
                                             <!--begin::Table row-->

                                             <?php $__currentLoopData = array_unique($perm_title); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <?php
                                              $permission = Permission::where('title',$value)->get();
                                              $word="";

                                             ?>

                                            <tr>
                                               <!--begin::Label-->
                                               <td class="text-gray-800"><?php echo e($value); ?></td>
                                               <!--end::Label-->


                                              <?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <?php
                                                    if(strpos($v->name, "list")){
                                                        $word = "View";
                                                        }
                                                        if(strpos($v->name, "create")){
                                                        $word = "Create";
                                                        }
                                                        if(strpos($v->name, "edit")){
                                                        $word = "Edit";
                                                        }
                                                        if(strpos($v->name, "delete")){
                                                        $word = "Delete";
                                                        }
                                            ?>
                                              <!--begin::Options-->
                                              <td>
                                                <!--begin::Wrapper-->
                                                <div class="d-flex">
                                                    <!--begin::Checkbox-->
                                                    <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                        <input class="form-check-input" type="checkbox" value="<?php echo e($v->id); ?>" name="permission[]"/>
                                                        <span class="form-check-label">
                                                            <?php echo e($word); ?>

                                                        </span>
                                                    </label>
                                             <!--end::Checkbox-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </td>
                                            <!--end::Options-->
                                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                             </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Table wrapper-->
                            </div>
                            <!--end::Permissions-->
                        </div>
                        <!--end::Scroll-->

                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-kt-roles-modal-action="cancel">
                                Discard
                            </button>

                            <button type="submit" class="btn btn-primary" data-kt-roles-modal-action="submit">
                                <span class="indicator-label">
                                    Submit
                                </span>
                                <span class="indicator-progress">
                                    Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Update role--><!--end::Modals-->

       </div>
            <!--end::Content container-->
        </div>
    <!--end::Content-->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\vitemart-ec\resources\views/roles/index.blade.php ENDPATH**/ ?>