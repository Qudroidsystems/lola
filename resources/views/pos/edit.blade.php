@extends('layouts.master')
@section('content')

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
        Product Form
            </h1>
    <!--end::Title-->


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



    <!--begin::Secondary button-->
        <!--end::Secondary button-->

    <!--begin::Primary button-->
            <a href="{{ route('product.index') }}" class="btn btn-sm fw-bold btn-primary" >
           Product Listings       </a>
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
            <!--begin::Form-->
<form action="{{ route('product.store') }}" method="POST" id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row" enctype="multipart/form-data">
@csrf
    <!--begin::Aside column-->
    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
        <!--begin::Thumbnail settings-->
<div class="card card-flush py-4">
    <!--begin::Card header-->
    <div class="card-header">
        <!--begin::Card title-->
        <div class="card-title">
            <h2>Thumbnail</h2>
        </div>
        <!--end::Card title-->
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body text-center pt-0">
        <!--begin::Image input-->
                    <!--begin::Image input placeholder-->
            <style>
                .image-input-placeholder {
                    background-image: url('../../../assets/media/svg/files/blank-image.svg');
                }

                [data-bs-theme="dark"] .image-input-placeholder {
                    background-image: url('../../../assets/media/svg/files/blank-image-dark.svg');
                }
            </style>
            <!--end::Image input placeholder-->

        <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
            <!--begin::Preview existing avatar-->
                            <div class="image-input-wrapper w-150px h-150px"></div>
                        <!--end::Preview existing avatar-->

            <!--begin::Label-->
            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                <i class="ki-duotone ki-pencil fs-7"><span class="path1"></span><span class="path2"></span></i>
                <!--begin::Inputs-->
                <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                <input type="hidden" name="avatar_remove" />
                <!--end::Inputs-->
            </label>
            <!--end::Label-->

            <!--begin::Cancel-->
            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>            </span>
            <!--end::Cancel-->

            <!--begin::Remove-->
            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>            </span>
            <!--end::Remove-->
        </div>
        <!--end::Image input-->

        <!--begin::Description-->
        <div class="text-muted fs-7">Set the product thumbnail image. Only *.png, *.jpg and *.jpeg image files are accepted</div>
        <!--end::Description-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Thumbnail settings-->
        <!--begin::Status-->
<div class="card card-flush py-4">
    <!--begin::Card header-->
    <div class="card-header">
        <!--begin::Card title-->
        <div class="card-title">
            <h2>Status</h2>
        </div>
        <!--end::Card title-->

        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_product_status"></div>
        </div>
        <!--begin::Card toolbar-->
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Select2-->
        <select class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add_product_status_select">
            <option></option>
            <option value="published" selected>Published</option>
            <option value="draft">Draft</option>
            <option value="scheduled">Scheduled</option>
            <option value="inactive">Inactive</option>
        </select>
        <!--end::Select2-->

        <!--begin::Description-->
        <div class="text-muted fs-7">Set the product status.</div>
        <!--end::Description-->

        <!--begin::Datepicker-->
        <div class="d-none mt-10">
            <label for="kt_ecommerce_add_product_status_datepicker" class="form-label">Select publishing date and time</label>
            <input class="form-control" id="kt_ecommerce_add_product_status_datepicker" placeholder="Pick date & time" />
        </div>
        <!--end::Datepicker-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Status-->

<!--begin::Category & tags-->
<div class="card card-flush py-4">
    <!--begin::Card header-->
    <div class="card-header">
        <!--begin::Card title-->
        <div class="card-title">
            <h2>Category , Tag  & Unit</h2>
        </div>
        <!--end::Card title-->
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Input group-->
        <!--begin::Label-->
        <label class="form-label">Categories</label>
        <!--end::Label-->

        <!--begin::Select2-->
        <select name="category" class="form-select mb-2" required>
                            <option value="">Select a category</option>
                            <option value="Computers">Computers</option>
                            <option value="Watches">Watches</option>
                            <option value="Headphones">Headphones</option>
                            <option value="Footwear">Footwear</option>
                            <option value="Cameras">Cameras</option>
                            <option value="Shirts">Shirts</option>
                            <option value="Household">Household</option>
                            <option value="Handbags">Handbags</option>
                            <option value="Wines">Wines</option>
                            <option value="Sandals">Sandals</option>
                    </select>
        <!--end::Select2-->

        <!--begin::Description-->
        <div class="text-muted fs-7 mb-7">Add product to a category.</div>
        <!--end::Description-->
        <!--end::Input group-->

        <!--begin::Button-->
        <a href="{{ route('category.create') }}" class="btn btn-light-primary btn-sm mb-10">
            <i class="ki-duotone ki-plus fs-2"></i>            Create new category
        </a>
        <!--end::Button-->

        <!--begin::Input group-->
        <!--begin::Label-->
        <label class="form-label d-block">Tags</label>
        <!--end::Label-->

        <!--begin::Input-->
                <input id="kt_ecommerce_add_product_tags" name="kt_ecommerce_add_product_tags" class="form-control mb-2" value="" required/>
        <!--end::Input-->

        <!--begin::Description-->
        <div class="text-muted fs-7">Add tags to a product.</div>
        <!--end::Description-->
         <!--begin::Button-->
         <a href="{{ route('unit.create') }}" class="btn btn-light-primary btn-sm mb-10">
            <i class="ki-duotone ki-plus fs-2"></i>            Create new tag
        </a>
        <!--end::Button-->

        <!--end::Input group-->
    </div>
    <!--end::Card body-->



        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Input group-->
            <!--begin::Label-->
            <label class="form-label">Unit</label>
            <!--end::Label-->

            <!--begin::Select2-->
            <select class="form-select mb-2" data-control="select22" required >
                                <option value="">Select a Unit</option>
                                <option value="Computers">Computers</option>
                                <option value="Watches">Watches</option>
                                <option value="Headphones">Headphones</option>
                                <option value="Footwear">Footwear</option>
                                <option value="Cameras">Cameras</option>
                                <option value="Shirts">Shirts</option>
                                <option value="Household">Household</option>
                                <option value="Handbags">Handbags</option>
                                <option value="Wines">Wines</option>
                                <option value="Sandals">Sandals</option>
                        </select>
            <!--end::Select2-->

            <!--begin::Description-->
            <div class="text-muted fs-7 mb-7">Add Unit to Product.</div>
            <!--end::Description-->
            <!--end::Input group-->

            <!--begin::Button-->
            <a href="{{ route('unit.create') }}" class="btn btn-light-primary btn-sm mb-10">
                <i class="ki-duotone ki-plus fs-2"></i>            Create new Unit
            </a>
            <!--end::Button-->


        </div>
        <!--end::Card body-->
</div>
<!--end::Category & tags-->
        <!--begin::Weekly sales-->
{{-- <div class="card card-flush py-4">
    <!--begin::Card header-->
    <div class="card-header">
        <!--begin::Card title-->
        <div class="card-title">
            <h2>Weekly Sales</h2>
        </div>
        <!--end::Card title-->
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-0">
        <span class="text-muted">No data available. Sales data will begin capturing once product has been published.</span>
    </div>
    <!--end::Card body-->
</div> --}}
<!--end::Weekly sales-->
        <!--begin::Template settings-->
<div class="card card-flush py-4">
    <!--begin::Card header-->
    <div class="card-header">
        <!--begin::Card title-->
        <div class="card-title">
            <h2>Product Brand</h2>
        </div>
        <!--end::Card title-->
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Select store template-->
        <label for="kt_ecommerce_add_product_store_template" class="form-label">Select a product Brand</label>
        <!--end::Select store template-->

        <!--begin::Select2-->
        <select class="form-select mb-2" data-control="select22" required>
            <option value="">Select a Brand</option>
            <option value="default" selected>Default template</option>
            <option value="electronics">Electronics</option>
            <option value="office">Office stationary</option>
            <option value="fashion">Fashion</option>
        </select>
        <!--end::Select2-->

        <!--begin::Description-->
        <div class="text-muted fs-7">Assign Product brand.</div>
        <!--end::Description-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Template settings-->


        <!--begin::Template settings-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2>Store</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Select store template-->
                <label for="kt_ecommerce_add_product_store_template" class="form-label">Select a product store</label>
                <!--end::Select store template-->

                <!--begin::Select2-->
                <select class="form-select mb-2" required>
                    <option value="">Select a Store</option>
                    <option value="electronics">Electronics</option>
                    <option value="office">Office stationary</option>
                    <option value="fashion">Fashion</option>
                </select>
                <!--end::Select2-->

                <!--begin::Description-->
                <div class="text-muted fs-7">Assign a store from which this product is found.</div>
                <!--end::Description-->
                 <!--begin::Button-->
                    <a href="{{ route('unit.create') }}" class="btn btn-light-primary btn-sm mb-10">
                        <i class="ki-duotone ki-plus fs-2"></i>            Create new Store
                    </a>
            <!--end::Button-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Template settings-->


 </div>
    <!--end::Aside column-->

    <!--begin::Main column-->
    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
        <!--begin:::Tabs-->
<ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2">
    <!--begin:::Tab item-->
    <li class="nav-item">
        <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_add_product_general">Product Infomation</a>
    </li>
    <!--end:::Tab item-->

    <!--begin:::Tab item-->
    <li class="nav-item">
        <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_ecommerce_add_product_advanced">Pricing & Stocks</a>
    </li>
    <!--end:::Tab item-->

    </ul>
<!--end:::Tabs-->
        <!--begin::Tab content-->
        <div class="tab-content">
            <!--begin::Tab pane-->
            <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                <div class="d-flex flex-column gap-7 gap-lg-10">

<!--begin::General options-->
<div class="card card-flush py-4">
    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title">
            <h2>Product Information</h2>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Input group-->
        <div class="mb-10 fv-row">
            <!--begin::Label-->
            <label class="required form-label">Product Name</label>
            <!--end::Label-->

            <!--begin::Input-->
                        <input type="text" name="product_name" class="form-control mb-2" placeholder="Product name" value="" />
            <!--end::Input-->

            <!--begin::Description-->
            <div class="text-muted fs-7">A product name is required and recommended to be unique.</div>
            <!--end::Description-->
        </div>
        <!--end::Input group-->



        <!--begin::Input group-->
        <div>
            <!--begin::Label-->
            <label class="form-label">Description</label>
            <!--end::Label-->

            <!--begin::Editor-->
            <div id="kt_ecommerce_add_product_description" name="kt_ecommerce_add_product_description" class="min-h-200px mb-2"></div>
            <textarea id="description" name="description" class="d-none"></textarea>
            <!--end::Editor-->

            <!--begin::Description-->
            <div class="text-muted fs-7">Set a description to the product for better visibility.</div>
            <!--end::Description-->
        </div>
        <!--end::Input group-->
    </div>
    <!--end::Card header-->
</div>
<!--end::General options-->
<!--begin::Media-->
<div class="card card-flush py-4">
    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title">
            <h2>Media</h2>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Input group-->
        <div class="fv-row mb-2">
            <!--begin::Dropzone-->
            <div class="dropzone" id="kt_ecommerce_add_product_media">
                <!--begin::Message-->
                <div class="dz-message needsclick">
                    <!--begin::Icon-->
                    <i class="ki-duotone ki-file-up text-primary fs-3x"><span class="path1"></span><span class="path2"></span></i>                    <!--end::Icon-->
                    <!--begin::Info-->
                    <div class="ms-4">
                        <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here or click to upload.</h3>
                        <span class="fs-7 fw-semibold text-gray-400">Upload up to 10 files</span>
                    </div>
                    <!--end::Info-->
                </div>
            </div>
            <!--end::Dropzone-->
        </div>
        <!--end::Input group-->

        <!--begin::Description-->
        <div class="text-muted fs-7">Set the product media gallery.</div>
        <!--end::Description-->
    </div>
    <!--end::Card header-->
</div>
<!--end::Media-->

<!--begin::Meta options-->
<div class="card card-flush py-4">
    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title">
            <h2>Meta Options</h2>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Input group-->
        <div class="mb-10">
            <!--begin::Label-->
            <label class="form-label">Meta Tag Title</label>
            <!--end::Label-->

            <!--begin::Input-->
            <input type="text" class="form-control mb-2" name="meta_title" placeholder="Meta tag name" />
            <!--end::Input-->

            <!--begin::Description-->
            <div class="text-muted fs-7">Set a meta tag title. Recommended to be simple and precise keywords.</div>
            <!--end::Description-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="mb-10">
            <!--begin::Label-->
            <label class="form-label">Meta Tag Description</label>
            <!--end::Label-->

            <!--begin::Editor-->
            <div id="kt_ecommerce_add_product_meta_description" name="kt_ecommerce_add_product_meta_description" class="min-h-100px mb-2"></div>
            <textarea id="meta_tag_description" name="meta_tag_description" class="d-none"></textarea>
            <!--end::Editor-->

            <!--begin::Description-->
            <div class="text-muted fs-7">Set a meta tag description to the product for increased SEO ranking.</div>
            <!--end::Description-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div>
            <!--begin::Label-->
            <label class="form-label">Meta Tag Keywords</label>
            <!--end::Label-->

            <!--begin::Editor-->
            <input id="kt_ecommerce_add_product_meta_keywords" name="kt_ecommerce_add_product_meta_keywords" class="form-control mb-2" />
            <!--end::Editor-->

            <!--begin::Description-->
            <div class="text-muted fs-7">Set a list of keywords that the product is related to. Separate the keywords by adding a comma <code>,</code> between each keyword.</div>
            <!--end::Description-->
        </div>
        <!--end::Input group-->
    </div>
    <!--end::Card header-->
</div>
<!--end::Meta options-->

                </div>
            </div>
            <!--end::Tab pane-->

            <!--begin::Tab pane-->
            <div class="tab-pane fade" id="kt_ecommerce_add_product_advanced" role="tab-panel">
                <div class="d-flex flex-column gap-7 gap-lg-10">



<!--begin::Variations-->
<div class="card card-flush py-4">
    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title">
            <h2>Inventory</h2>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-0 ">
        <!--begin::Input group-->
        <div class="" data-kt-ecommerce-catalog-add-product="auto-options">
            <!--begin::Label-->
            <label class="form-label">Add Product Variations</label>
            <!--end::Label-->


            <!--begin::Repeater-->
            <div id="kt_ecommerce_add_product_options">
                <!--begin::Form group-->
                <div class="form-group repeater-item">
                    <div data-repeater-list="kt_ecommerce_add_product_options" class="d-flex flex-column gap-3">
                        <div data-repeater-item class="form-group d-flex flex-wrap align-items-center gap-5">
                            <!--begin::Select2-->
                            <div class="w-100 w-md-800px">
                                <select required class="form-select" name="product_option" data-placeholder="Select a variation" data-kt-ecommerce-catalog-add-product="product_option">
                                    <option value="color">Color</option>
                                    <option value="size">Size</option>
                                    <option value="material">Material</option>
                                    <option value="style">Style</option>
                                </select>
                            </div>
                            <!--end::Select2-->







                                    <!--begin::Input group-->
                                    <div class="w-100 w-md-800px">
                                        <!--begin::Label-->
                                        <label class="required form-label">SKU</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input type="text" name="sku" class="form-control mb-2" placeholder="Barcode Number" value="" />
                                        <!--end::Input-->

                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">Enter the product SKU.</div>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Input group-->


                                    <!--begin::Input group-->
                                    <div class="w-100 w-md-800px">
                                        <!--begin::Label-->
                                        <label class="required form-label">Barcode</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input type="text" name="barcode" class="form-control mb-2" placeholder="Barcode Number" value="" />
                                        <!--end::Input-->

                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">Enter the product barcode number.</div>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Input group-->

                                     <!--begin::Input group-->
                                     <div class="w-100 w-md-800px">
                                        <!--begin::Label-->
                                        <label class="required form-label">Stock (Quantity)</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <div class="d-flex gap-3">
                                            <input type="number" name="stock" class="form-control mb-2" placeholder="On shelf" value="" />

                                        </div>
                                        <!--end::Input-->

                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">Enter the product quantity.</div>
                                        <!--end::Description-->
                                    </div>


                                      <!--begin::Input group-->
                                      <div class="w-100 w-md-800px">
                                        <!--begin::Label-->
                                        <label class="required form-label">Stock Alert</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <div class="d-flex gap-3">
                                            <input type="number" name="stock_alert" class="form-control mb-2" placeholder="On shelf" value="" />

                                        </div>
                                        <!--end::Input-->

                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">Enter the product quantity.</div>
                                        <!--end::Description-->
                                    </div>



                                        <!--begin::Input group-->
                                        <div class="w-100 w-md-800px">
                                            <!--begin::Label-->
                                            <label class="required form-label">Price</label>
                                            <!--end::Label-->

                                            <!--begin::Input-->
                                            <div class="d-flex gap-3">
                                                <input type="number" name="price" class="form-control mb-2" placeholder="On shelf" value="" />

                                            </div>
                                            <!--end::Input-->

                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">Enter the product Price.</div>
                                            <!--end::Description-->
                                        </div>
                                    <!--end::Input group-->


                                           <!--begin::Card body-->
                                            <div class="card-body text-center pt-0">
                                                <!--begin::Image input-->
                                                            <!--begin::Image input placeholder-->
                                                    <style>
                                                        .image-input-placeholder {
                                                            background-image: url('../../../assets/media/svg/files/blank-image.svg');
                                                        }

                                                        [data-bs-theme="dark"] .image-input-placeholder {
                                                            background-image: url('../../../assets/media/svg/files/blank-image-dark.svg');
                                                        }
                                                    </style>
                                                    <!--end::Image input placeholder-->

                                                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                                    <!--begin::Preview existing avatar-->
                                                                    <div class="image-input-wrapper w-150px h-150px"></div>
                                                                <!--end::Preview existing avatar-->

                                                    <!--begin::Label-->
                                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                                        <i class="ki-duotone ki-pencil fs-7"><span class="path1"></span><span class="path2"></span></i>
                                                        <!--begin::Inputs-->
                                                        <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                                        <input type="hidden" name="avatar_remove" />
                                                        <!--end::Inputs-->
                                                    </label>
                                                    <!--end::Label-->

                                                    <!--begin::Cancel-->
                                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                                        <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>            </span>
                                                    <!--end::Cancel-->

                                                    <!--begin::Remove-->
                                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                                        <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>            </span>
                                                    <!--end::Remove-->
                                                </div>
                                                <!--end::Image input-->

                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">Set the product thumbnail image. Only *.png, *.jpg and *.jpeg image files are accepted</div>
                                                <!--end::Description-->
                                            </div>


                                    <!--end::Input group-->

                             <!--begin::Select2-->
                             <div class="w-100 w-md-800px">
                                <!--begin::Label-->
                              <label class="required form-label">Discount Type</label>
                              <!--end::Label-->
                                <select class="form-select" name="kt_ecommerce_add_product_options[0][discounttype]" required >
                                    <option value="nodiscount">No Discount</option>
                                    <option value="percentage">Percentage %</option>
                                    <option value="fixed">Fixed</option>
                                </select>
                            </div>
                            <!--end::Select2-->

                               <!--begin::Input group-->
                               <div class="w-100 w-md-800px">
                                <!--begin::Label-->
                                <label class="required form-label">If Percentage %</label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <div class="d-flex gap-3">
                                    <input type="number" name="kt_ecommerce_add_product_options[0][percentage]" class="form-control mb-2" placeholder="Enter Percentage" value="" />

                                </div>
                                <!--end::Input-->

                                <!--begin::Description-->
                                <div class="text-muted fs-7">Enter the Percentage Value.</div>
                                <!--end::Description-->
                            </div>
                        <!--end::Input group-->


                           <!--begin::Input group-->
                           <div class="w-100 w-md-800px">
                            <!--begin::Label-->
                            <label class="required form-label">If Fixed Price</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <div class="d-flex gap-3">
                                <input type="number" name="kt_ecommerce_add_product_options[0][fixed]" class="form-control mb-2" placeholder="Enter Fixed Discount Price" value="" />

                            </div>
                            <!--end::Input-->

                            <!--begin::Description-->
                            <div class="text-muted fs-7">Enter the Fixed Discounted Price.</div>
                            <!--end::Description-->
                        </div>
                        <!--end::Input group-->




                                        <!--begin::Tax-->
                            <div class="d-flex flex-wrap gap-5">
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label">Tax Class</label>
                                    <!--end::Label-->

                                    <!--begin::Select2-->
                                    <select class="form-select mb-2" name="tax" data-control="select2" data-hide-search="true" data-placeholder="Select an option">
                                        <option></option>
                                        <option value="0">Tax Free</option>
                                        <option value="1">Taxable Goods</option>
                                    <option value="2">Downloadable Product</option>
                                    </select>
                                    <!--end::Select2-->

                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set the product tax class.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="form-label">VAT Amount (%)</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" name="taxValue" class="form-control mb-2" value="" />
                                    <!--end::Input-->

                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set the product VAT about.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end:Tax-->

                            <button type="button" data-repeater-delete class="btn btn-sm btn-icon btn-light-danger">
                                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                             </button>
                        </div>
                    </div>
                </div>
                <!--end::Form group-->

                <!--begin::Form group-->
                <div class="form-group mt-5">
                    <button type="button" data-repeater-create class="btn btn-sm btn-light-primary">
                        <i class="ki-duotone ki-plus fs-2"></i> Add another variation
                    </button>
                </div>
                <!--end::Form group-->
            </div>
            <!--end::Repeater-->
        </div>
        <!--end::Input group-->
    </div>
    <!--end::Card header-->
</div>
<!--end::Variations-->



<!--begin::Shipping-->
{{-- <div class="card card-flush py-4">
    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title">
            <h2>Shipping</h2>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Input group-->
        <div class="fv-row">
            <!--begin::Input-->
            <div class="form-check form-check-custom form-check-solid mb-2">
                                    <input class="form-check-input" type="checkbox" id="kt_ecommerce_add_product_shipping_checkbox" value="1" />
                                <label class="form-check-label">
                    This is a physical product
                </label>
            </div>
            <!--end::Input-->

            <!--begin::Description-->
            <div class="text-muted fs-7">Set if the product is a physical or digital item. Physical products may require shipping.</div>
            <!--end::Description-->
        </div>
        <!--end::Input group-->

        <!--begin::Shipping form-->
        <div id="kt_ecommerce_add_product_shipping" class="d-none mt-10">
            <!--begin::Input group-->
            <div class="mb-10 fv-row">
                <!--begin::Label-->
                <label class="form-label">Weight</label>
                <!--end::Label-->

                <!--begin::Editor-->
                <input type="text" name="weight" class="form-control mb-2" placeholder="Product weight" value="" />
                <!--end::Editor-->

                <!--begin::Description-->
                <div class="text-muted fs-7">Set a product weight in kilograms (kg).</div>
                <!--end::Description-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="fv-row">
                <!--begin::Label-->
                <label class="form-label">Dimension</label>
                <!--end::Label-->

                <!--begin::Input-->
                <div class="d-flex flex-wrap flex-sm-nowrap gap-3">
                    <input type="number" name="width" class="form-control mb-2" placeholder="Width (w)" value="" />
                    <input type="number" name="height" class="form-control mb-2" placeholder="Height (h)" value="" />
                    <input type="number" name="length" class="form-control mb-2" placeholder="Lengtn (l)" value="" />
                </div>
                <!--end::Input-->

                <!--begin::Description-->
                <div class="text-muted fs-7">Enter the product dimensions in centimeters (cm).</div>
                <!--end::Description-->
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Shipping form-->
    </div>
    <!--end::Card header-->
</div> --}}
<!--end::Shipping-->

            </div>
            </div>
            <!--end::Tab pane-->

                    </div>
        <!--end::Tab content-->

        <div class="d-flex justify-content-end">
            <!--begin::Button-->
            <a href="products.html" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">
                Cancel
            </a>
            <!--end::Button-->

            <!--begin::Button-->
            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
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
<!--end::Form-->        </div>
        <!--end::Content container-->
    </div>
<!--end::Content-->

@endsection
