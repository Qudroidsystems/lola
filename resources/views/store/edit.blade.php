@extends('layouts.master')
@section('content')

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
                  Store
                        </h1>
                <!--end::Title-->


                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                        <!--begin::Item-->
                                                <li class="breadcrumb-item text-muted">
                                                                <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">
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
                                                            Store
                                                                  </li>
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
                        <a href="{{ route('store.index') }}" class="btn btn-sm fw-bold btn-primary"  >
                        Store Listing
                        </a>
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
        <form id="kt_ecommerce_add_variant_form" class="form d-flex flex-column flex-lg-row" action="{{ route('store.update', $warehouse->id) }}" method="POST">
            @csrf
            @method('PUT')


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
                        <label class="required form-label">Store Name</label>
                        <!--end::Label-->

                        <!--begin::Input-->
                                    <input type="text" name="name" class="form-control mb-2" placeholder="Store name" value="{{ $warehouse->name }}" required />
                        <!--end::Input-->

                        <!--begin::Description-->
                        <div class="text-muted fs-7">A Store name is required and recommended to be unique.</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->

                </div>
                <!--end::Card header-->

                 <!--begin::Card body-->
                 <div class="card-body pt-0">
                    <!--begin::Input group-->
                    <div class="mb-10 fv-row">
                        <!--begin::Label-->
                        <label class="required form-label">Store Location</label>
                        <!--end::Label-->

                        <!--begin::Input-->
                                    <input type="text" name="location" class="form-control mb-2" placeholder="Store Location" value="{{ $warehouse->location }}" required />
                        <!--end::Input-->


                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->

                </div>
                <!--end::Card header-->

                 <!--begin::Card body-->
                 <div class="card-body pt-0">
                    <!--begin::Input group-->
                    <div class="mb-10 fv-row">
                        <!--begin::Label-->
                        <label class="required form-label">Store Capacity</label>
                        <!--end::Label-->

                        <!--begin::Input-->
                                    <input type="number" name="capacity" class="form-control mb-2" placeholder="Store Capacity" value="{{ $warehouse->capacity }}" required />
                        <!--end::Input-->


                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->

                </div>
                <!--end::Card header-->




                 <!--begin::Card body-->
                 <div class="card-body pt-0">
                    <!--begin::Input group-->
                    <div class="mb-10 fv-row">
                        <!--begin::Label-->
                        <label class="required form-label">Status</label>
                        <!--end::Label-->

                         <!--begin::Select2-->
                         <div class="w-100 w-md-800px">
                         
                            <select class="form-select" name="status" required >
                                <option></option>
                                <option value="active" selected>Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            [Selected Status : {{ $warehouse->status }}]
                        </div>
                        <!--end::Select2-->


                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->

                </div>
                <!--end::Card header-->

                            




                </div>
                <!--end::General options-->




                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <a href="{{ route('store.create') }}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">
                            Cancel
                        </a>
                        <!--end::Button-->

                        <!--begin::Button-->
                        <button type="submit" id="kt_ecommerce_add_variant_submit" class="btn btn-primary">
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


@endsection
