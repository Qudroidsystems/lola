
@extends('layouts.master')
@section('content')
<?php use Spatie\Permission\Models\Permission; ?>

            <!--begin::Main-->
            <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                <!--begin::Content wrapper-->
                <div class="d-flex flex-column flex-column-fluid">

<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 " >

            <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">



<!--begin::Page title-->
<div  class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
    <!--begin::Title-->
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
       Edit Role
            </h1>
    <!--end::Title-->


        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">
                                                    <a href="../index.html" class="text-muted text-hover-primary">
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
                                                   User Management                                           </li>
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
        </div>
        <!--end::Toolbar container-->
    </div>
<!--end::Toolbar-->

<!--begin::Content-->
<div id="kt_app_content" class="app-content  flex-column-fluid " >

        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container  container-xxl ">


<!--end::Navbar-->
<!--begin::Basic info-->
<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bold m-0">Edit Details</h3>
        </div>
        <!--end::Card title-->
    </div>

 <!--begin::Toolbar-->
 <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
    <!--begin::Filter-->
    <a href="{{ route('roles.index') }}" type="button" class="btn btn-light-primary me-3" >
        <i class="ki-duotone fs-2"><span class="path1"></span><span class="path2"></span></i>   << Back
    </a>
    <!--begin::Menu 1-->
    <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
    <!--begin::Header-->
    <div class="px-7 py-5">
        <a href="" class="fs-5 text-dark fw-bold"> </a>
    </div>
    <!--end::Header-->

    <!--begin::Separator-->
    <div class="separator border-gray-200"></div>
    <!--end::Separator-->


    </div>
    <!--end::Menu 1-->    <!--end::Filter-->




    </div>
    <!--end::Toolbar-->



    <!--begin::Content-->
    <div id="kt_account_settings_profile_details" class="collapse show">
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
                            <span class="required">Role name </span>
                        </label>
                        <!--end::Label-->

                        <!--begin::Input-->
                        <input class="form-control form-control-solid" placeholder="Enter a role name" name="name" value="{{ $role->name}}" />
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

                                                {{ Form::checkbox('permission[]', $v->id,
                                                 in_array($v->id, $rolePermissions) ? true : false, array('class' => 'form-check-input')) }}
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
                {!! Form::close() !!}
            <!--end::Form-->
        </div>

    </div>
    <!--end::Content-->
</div>
<!--end::Basic info-->



    </div>
        <!--end::Content container-->
    </div>
<!--end::Content-->

@endsection
