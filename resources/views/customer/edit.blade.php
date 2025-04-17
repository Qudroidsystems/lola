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
                  Customer
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
                                                                Customer
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
                        <a href="{{ route('customer.index') }}" class="btn btn-sm fw-bold btn-primary"  >
                       Customer Listing       </a>
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
        <form id="kt_ecommerce_add_customer_form" class="form d-flex flex-column flex-lg-row" action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
            @csrf


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
                                            <label class="required form-label">First Name</label>
                                            <!--end::Label-->

                                            <!--begin::Input-->
                                                        <input type="text" name="first_name" class="form-control mb-2" placeholder="First Name" value="" required/>
                                            <!--end::Input-->


                                        </div>
                                        <!--end::Input group-->


                                    </div>
                                    <!--end::Card header-->



                                     <!--begin::Card body-->
                                     <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">Last Name</label>
                                            <!--end::Label-->

                                            <!--begin::Input-->
                                                        <input type="text" name="last_name" class="form-control mb-2" placeholder="Last name" value="" required />
                                            <!--end::Input-->


                                        </div>
                                        <!--end::Input group-->


                                    </div>
                                    <!--end::Card header-->



                                     <!--begin::Card body-->
                                     <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">Email</label>
                                            <!--end::Label-->

                                            <!--begin::Input-->
                                                        <input type="email" name="email" class="form-control mb-2" placeholder="customer email" value=""  required/>
                                            <!--end::Input-->

                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">A customer name is required and recommended to be unique.</div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Input group-->


                                    </div>
                                    <!--end::Card header-->



                                     <!--begin::Card body-->
                                     <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">Phone Number</label>
                                            <!--end::Label-->

                                            <!--begin::Input-->
                                                        <input type="phone" name="phone_number" class="form-control mb-2" placeholder="Phone Number" value="" required/>
                                            <!--end::Input-->


                                        </div>
                                        <!--end::Input group-->


                                    </div>
                                    <!--end::Card header-->



                                     <!--begin::Card body-->
                                     <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">Phone Number 2</label>
                                            <!--end::Label-->

                                            <!--begin::Input-->
                                                        <input type="phone" name="phone_number2" class="form-control mb-2" placeholder="Phone Number 2" value=""  />
                                            <!--end::Input-->


                                        </div>
                                        <!--end::Input group-->


                                    </div>
                                    <!--end::Card header-->



                                     <!--begin::Card body-->
                                     <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">Home Address</label>
                                            <!--end::Label-->

                                            <!--begin::Input-->
                                                        <input type="text" name="home_address" class="form-control mb-2" placeholder="home_address" value="" required/>
                                            <!--end::Input-->


                                        </div>
                                        <!--end::Input group-->


                                    </div>
                                    <!--end::Card header-->



                                     <!--begin::Card body-->
                                     <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">Office Address</label>
                                            <!--end::Label-->

                                            <!--begin::Input-->
                                                        <input type="text" name="office_address" class="form-control mb-2" placeholder="Office Address" value="" />
                                            <!--end::Input-->


                                        </div>
                                        <!--end::Input group-->


                                    </div>
                                    <!--end::Card header-->


                                      <!--begin::Card body-->
                                      <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">Gender</label>
                                            <!--end::Label-->

                                             <!--begin::Select2-->
                                                <select name="gender" class="form-select mb-2" data-control="select2" data-placeholder="Select an option" id="kt_ecommerce_add_product_status_select">
                                                    <option value="draft">Male</option>
                                                    <option value="scheduled">Gender</option>
                                                </select>
                                                <!--end::Select2-->


                                        </div>
                                        <!--end::Input group-->


                                    </div>
                                    <!--end::Card header-->



                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <a href="products.html" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">
                            Cancel
                        </a>
                        <!--end::Button-->

                        <!--begin::Button-->
                        <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
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
                   <!--end::General options-->








                </div>
                <!--end::Main column-->
        </form>
</div>
    <!--end::Content container-->
</div>
<!--end::Content-->


@endsection
