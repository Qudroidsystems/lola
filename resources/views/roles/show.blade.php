
@extends('layouts.master')
@section('content')
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
<div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 "

         >

            <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">



<!--begin::Page title-->
<div  class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
    <!--begin::Title-->
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        View Role Details
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
@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (\Session::has('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
{{ \Session::get('status') }}
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (\Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
{{ \Session::get('success') }}
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<!--begin::Actions-->
<div class="d-flex align-items-center gap-2 gap-lg-3">


    <!--begin::Secondary button-->
        <!--end::Secondary button-->

    <!--begin::Primary button-->
    @can('role-updateuserrole')
    <a href="{{ route('roles.adduser',$role->id) }}" class="btn btn-light btn-sm btn-active-success my-1" >Add User </a>
    @endcan
            <a href="{{ route('roles.index') }}" class="btn btn-sm fw-bold btn-primary">
           < Back       </a>
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
            <!--begin::Layout-->
<div class="d-flex flex-column flex-lg-row">
    <!--begin::Sidebar-->
    <div class="flex-column flex-lg-row-auto w-100 w-lg-200px w-xl-300px mb-10">

<!--begin::Card-->
<div class="card card-flush">
    <!--begin::Card header-->
    <div class="card-header">
        <!--begin::Card title-->
        <div class="card-title">
            <h1 class="mb-0 {{ $role->badge }}"> {{ $role->name }}</h1>
        </div>
        <!--end::Card title-->
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Permissions-->
        <div class="d-flex flex-column text-gray-600">
            @foreach ( $rolePermissions as $rm )


                            <div class="d-flex align-items-center py-2">
                                <span class="bullet bg-primary me-3">
                                </span>
                            {{$rm->name}}
                            </div>

            @endforeach
            <div class="d-flex align-items-center py-2 d-none">
                <span class='bullet bg-primary me-3'></span> <em>and 3 more...</em>
            </div>

        </div>
        <!--end::Permissions-->
    </div>
    <!--end::Card body-->

    <!--begin::Card footer-->
    <div class="card-footer pt-0">
        <button type="button" class="btn btn-light btn-active-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_update_role">Edit Role</button>
    </div>
    <!--end::Card footer-->
</div>
<!--end::Card-->

<!--begin::Modal-->

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
                {!! Form::model($role, ['route' => ['roles.update', $role->id],
                'method' => 'PATCH','class' => 'form','id'=>'kt_modal_update_role_form']) !!}
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_role_header" data-kt-scroll-wrappers="#kt_modal_update_role_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bold form-label mb-2">
                                <span class="required">Role name</span>
                            </label>
                            <!--end::Label-->

                            <!--begin::Input-->
                        <input class="form-control form-control-solid" placeholder="Enter a role name"
                        name="name" value="{{ $role->name}}" />
                        <!--end::Input-->
                        </div>
                        <!--end::Input group-->


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

                                     @foreach (array_unique($perm_title) as $value)
                                     <?php
                                      $permission = Permission::where('title',$value)->get();
                                      $word="";

                                     ?>

                                    <tr>
                                       <!--begin::Label-->
                                       <td class="text-gray-800">{{ $value }}</td>
                                       <!--end::Label-->


                                      @foreach ($permission as $key => $v)
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

                                                {{ Form::checkbox('permission[]', $v->id,in_array($v->id, $rolePermissions2) ? true : false, array('class' => 'form-check-input')) }}
                                                <span class="form-check-label">
                                                    {{ $word}}
                                                </span>
                                            </label>
                                     <!--end::Checkbox-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </td>
                                    <!--end::Options-->
                                       @endforeach
                                </tr>
                                    @endforeach
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
<!--end::Modal - Update role--><!--end::Modal-->

</div>
    <!--end::Sidebar-->

    <!--begin::Content-->
    <div class="flex-lg-row-fluid ms-lg-10">
        <!--begin::Card-->
<div class="card card-flush mb-6 mb-xl-9">
    <!--begin::Card header-->
    <div class="card-header pt-5">
        <!--begin::Card title-->
        <div class="card-title">
            <h2 class="d-flex align-items-center"> Users Assigned<span class="text-gray-600 fs-6 ms-1"> ({{ $userRoleCount }})</span></h2>
        </div>
        <!--end::Card title-->

        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1"  data-kt-view-roles-table-toolbar="base">
                <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span class="path2"></span></i>                <input type="text" data-kt-roles-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Users" />
            </div>
            <!--end::Search-->

            <!--begin::Group actions-->
            <div class="d-flex justify-content-end align-items-center d-none" data-kt-view-roles-table-toolbar="selected">
                <div class="fw-bold me-5">
                    <span class="me-2" data-kt-view-roles-table-select="selected_count"></span> Selected
                </div>

                <button type="button" class="btn btn-danger" data-kt-view-roles-table-select="delete_selected">
                    Delete Selected
                </button>
            </div>
            <!--end::Group actions-->
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_roles_view_table">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="w-10px pe-2">
                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_roles_view_table .form-check-input" value="1" />
                        </div>
                    </th>
                    <th class="min-w-50px" style="color: green">SN</th>
                    <th class="min-w-150px" style="color: green">User</th>
                    <th class="min-w-125px" style="color: green">Joined Date</th>
                    <th class="text-end min-w-100px" style="color: green">Actions</th>
                </tr>
            </thead>
            <tbody class="fw-semibold text-gray-600">
            @php
                $i = 0
            @endphp
            @foreach ($usersWithRole as $user )


                    <tr data-url="{{ route('roles.removeuserrole', ['userid'=>$user->id,'roleid'=>$user->roleid]) }}">
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="1" />
                            </div>
                        </td>
                        <td id="{{ $user->id }}">{{ ++$i }}</td>
                        <td class="d-flex align-items-center">
                            <!--begin:: Avatar -->
                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                <a href="view.html">
                                                                    <div class="symbol-label">
                                            <img src="{{ asset('html/assets/assets/media/avatars/300-6.jpg')}}" alt="{{ $user->name }}" class="w-100" />
                                        </div>
                                                            </a>
                            </div>
                            <!--end::Avatar-->

                            <!--begin::User details-->
                            <div class="d-flex flex-column">


                                <span class="text-gray-800 text-hover-primary mb-1" >{{ $user->username }}</span>
                            </div>
                            <!--begin::User details-->
                        </td>
                        <td>
                            {{  $user->created_at }}
                           </td>
                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                Actions
                                <i class="ki-duotone ki-down fs-5 m-0"></i>                            </a>
                            <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                                        @can('role-edit')
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="{{ route('users.show',$user->id) }}" class="menu-link px-3">
                                                                View
                                                                </a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        @endcan
                                    </div>
                                    <!--end::Menu item-->

                                    @can('role-romove-fromrole')
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3" >
                                        {{-- <form method="post" class="menu-link px-3" data-kt-roles-table-filter="delete_row" data-route="">
                                          @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form> --}}
                                        <a
                                        href="javascript:void(0)"
                                        id="show-user"
                                        data-kt-roles-table-filter="delete_row"
                                        data-url="{{ route('roles.removeuserrole', ['userid'=>$user->id,'roleid'=>$user->roleid]) }}"
                                        class="btn btn-danger btn-sm">Delete</a>
                                    </div>
                                    <!--end::Menu item-->
                                    @endcan
                                </div>
                            <!--end::Menu-->
                        </td>

             </tr>
             @endforeach
                            </tbody>
        </table>
        <!--end::Table-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->    </div>
    <!--end::Content-->
</div>
<!--end::Layout-->        </div>
        <!--end::Content container-->
    </div>
<!--end::Content-->
@endsection
