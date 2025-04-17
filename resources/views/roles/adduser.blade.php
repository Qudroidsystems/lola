
@extends('layouts.master')
@section('content')
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

        </div>
        <!--end::Toolbar container-->
    </div>
<!--end::Toolbar-->

<!--begin::Content-->
<div id="kt_app_content" class="app-content  flex-column-fluid " >

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

        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container  container-xxl ">


<!--end::Navbar-->
<!--begin::Basic info-->
<div class="card mb-5 mb-xl-10">


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

        <!--begin::Basic info-->
<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bold m-0">Add User to {{ $role->name }} role</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->

    <!--begin::Content-->
    <div id="kt_account_settings_profile_details" class="collapse show">
        <!--begin::Form-->
        <form id="kt_account_profile_details_form" class="form" action="{{ route('roles.updateuserrole') }}">
            @csrf
            <!--begin::Card body-->
            <div class="card-body border-top p-9">



                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label  fw-semibold fs-6">Role</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="hidden" name="roleid" class="form-control form-control-lg form-control-solid" readonly value="{{ $role->id }}" />
                        <input type="text" name="role" class="form-control form-control-lg form-control-solid" readonly value="{{ $role->name }}" />
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->




                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                        <span class="required">User</span>
                        <span class="ms-1"  data-bs-toggle="tooltip" title="Select User for this role" >
                            <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1">
                                </span><span class="path2"></span><span class="path3"></span></i>
                            </span>
                        </label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <select name="name" aria-label="Select a Staff" data-control="select2" data-placeholder="Select a Staff" class="form-select form-select-solid form-select-lg fw-semibold">
                            <option value="">Select a Staff...</option>
                            @foreach ($users as $user )
                               <option value="{{ $user->id }}">{{ $user->name }}</option>
                           @endforeach


                         </select>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->





            </div>
            <!--end::Card body-->

            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Save Changes</button>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Content-->
</div>
<!--end::Basic info-->

    </div>
    <!--end::Content-->
</div>
<!--end::Basic info-->



    </div>
        <!--end::Content container-->
    </div>
<!--end::Content-->
@endsection
