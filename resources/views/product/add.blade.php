@extends('layouts.master') @section('content')

<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Product Form
                    </h1>
                    <!--end::Title-->

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br />
                        <br />
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif @if (\Session::has('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ \Session::get('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif @if (\Session::has('success'))
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
                                Home
                            </a>
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
                            Catalog
                        </li>
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
                    <a href="{{ route('product.index') }}" class="btn btn-sm fw-bold btn-primary"> Product Listings </a>
                    <!--end::Primary button-->
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->

        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
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
                                        background-image: url("../../../assets/media/svg/files/blank-image.svg");
                                    }

                                    [data-bs-theme="dark"] .image-input-placeholder {
                                        background-image: url("../../../assets/media/svg/files/blank-image-dark.svg");
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
                                        <input type="file" name="thumbnail" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="avatar_remove" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Label-->

                                    <!--begin::Cancel-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                        <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>
                                    </span>
                                    <!--end::Cancel-->

                                    <!--begin::Remove-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                        <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>
                                    </span>
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
                                <select name="status" class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add_product_status_select">
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
                                    <h2>Category , Tag & Unit</h2>
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
                                <select name="category" id="category" class="form-select mb-2" required>
                                    <option value="" disabled selected>Select a category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <!--end::Select2-->

                                <!--begin::Description-->
                                <div class="text-muted fs-7 mb-7">Add product to a category.</div>
                                <!--end::Description-->
                                <!--end::Input group-->

                                <!--begin::Button-->
                                <a href="{{ route('category.create') }}" class="btn btn-light-primary btn-sm mb-10"> <i class="ki-duotone ki-plus fs-2"></i> Create new category </a>
                                <!--end::Button-->

                                <!--begin::Input group-->
                                <!--begin::Label-->
                                <label class="form-label d-block">Tags</label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                        <input id="kt_ecommerce_add_product_tags" name="kt_ecommerce_add_product_tags" class="form-control mb-2" value="" required/>
                                                        <!-- Hidden input to store tags data -->
                                        <input type="hidden" id="_tags" name="_tags" value='@json($tags)' />
                                                        <!-- Hidden input to store the selected tag IDs -->
                                        <input type="hidden" id="selected_tag_ids" name="selected_tag_ids" value="[]" />
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
                                <select name="unit" id="unit" class="form-select mb-2" data-control="select22" required>
                                    <option value="" disabled selected>Select a Unit</option>
                                    @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                                <!--end::Select2-->

                                <!--begin::Description-->
                                <div class="text-muted fs-7 mb-7">Add Unit to Product.</div>
                                <!--end::Description-->
                                <!--end::Input group-->

                                <!--begin::Button-->
                                <a href="{{ route('unit.create') }}" class="btn btn-light-primary btn-sm mb-10"> <i class="ki-duotone ki-plus fs-2"></i> Create new Unit </a>
                                <!--end::Button-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Category & tags-->
                        <!--begin::Weekly sales-->
                        {{--
                        <div class="card card-flush py-4">
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
                        </div>
                        --}}
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
                                <select name="brand" id="brand" class="form-select mb-2" data-control="select22" required>
                                    <option value="" disabled selected>Select a Brand</option>
                                    @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
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
                                <select name="warehouses" id="warehouses" class="form-select mb-2" required>
                                    <option value="" disabled selected>Select a Store</option>
                                    @foreach ($stores as $store)
                                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                                    @endforeach
                                </select>
                                <!--end::Select2-->

                                <!--begin::Description-->
                                <div class="text-muted fs-7">Assign a store from which this product is found.</div>
                                <!--end::Description-->
                                <!--begin::Button-->
                                <a href="{{ route('unit.create') }}" class="btn btn-light-primary btn-sm mb-10"> <i class="ki-duotone ki-plus fs-2"></i> Create new Store </a>
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
                                    {{--
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
                                                        <i class="ki-duotone ki-file-up text-primary fs-3x"><span class="path1"></span><span class="path2"></span></i>
                                                        <!--end::Icon-->
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
                                    --}}
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
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Input group-->
                                                <div class="w-100 w-md-800px">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">SKU</label>
                                                    <!--end::Label-->

                                                    <!--begin::Input-->
                                                    <input type="text" name="sku" id="sku" class="form-control mb-2" placeholder="Barcode Number" value="" required />
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
                                                    <input type="text" name="barcode" class="form-control mb-2" placeholder="Barcode Number" value="" required />
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
                                                        <input type="number" name="stock" class="form-control mb-2" placeholder="On shelf" value="" required />
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
                                                        <input type="number" name="stock_alert" class="form-control mb-2" placeholder="Stock alert" required value="" />
                                                    </div>
                                                    <!--end::Input-->

                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Enter the product quantity.</div>
                                                    <!--end::Description-->
                                                </div>

                                                <!--begin::Input group-->
                                                <div class="w-100 w-md-800px">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">Base Price</label>
                                                    <!--end::Label-->

                                                    <!--begin::Input-->
                                                    <div class="d-flex gap-3">
                                                        <input type="number" name="price" class="form-control mb-2" placeholder="Price" required value="" />
                                                    </div>
                                                    <!--end::Input-->

                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Enter the product Price.</div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Input group-->
                                                <div class="w-100 w-md-800px">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">Sale Price</label>
                                                    <!--end::Label-->

                                                    <!--begin::Input-->
                                                    <div class="d-flex gap-3">
                                                        <input type="number" name="sale_price" class="form-control mb-2" placeholder="Sale Price" required value="" />
                                                    </div>
                                                    <!--end::Input-->

                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Enter the product Price.</div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Input group-->
                                                <div class="w-100 w-md-800px">
                                                    <!-- Custom Styled File Input -->
                                                    <div class="mb-3">
                                                        <label for="images" class="form-label">Select Images</label>
                                                        <input type="file" name="images[]" id="images" class="form-control" multiple accept="image/*" />
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                <!-- Image Preview -->
                                                <div class="image-preview-container w-100 w-md-800px" id="imagePreview" style="width: 50px;"></div>

                                                <!--end::Input group-->

                                                <!--begin::Select2-->
                                                <div class="w-100 w-md-800px">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">Discount Type</label>
                                                    <!--end::Label-->
                                                    <select class="form-select" name="kt_ecommerce_add_product_options[0][discounttype]" required>
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
                                                        <input type="text" name="vat_amount" class="form-control mb-2" value="" />
                                                        <!--end::Input-->

                                                        <!--begin::Description-->
                                                        <div class="text-muted fs-7">Set the product VAT about.</div>
                                                        <!--end::Description-->
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                                <!--end:Tax-->

                                                <!--begin::Tax-->
                                                <div class="d-flex flex-wrap gap-5">
                                                    <!--begin::Input group-->
                                                    <div class="fv-row w-100 flex-md-root">
                                                        <!--begin::Label-->
                                                        <label class="form-label">Manufactured On</label>
                                                        <!--end::Label-->

                                                        <!--begin::Select2-->
                                                        <!--begin::Input-->
                                                        <input type="date" name="manufacture" class="form-control mb-2" value="" />
                                                        <!--end::Input-->

                                                        <!--end::Select2-->

                                                        <!--begin::Description-->
                                                        <div class="text-muted fs-7">Set the product Manufacture Date.</div>
                                                        <!--end::Description-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="fv-row w-100 flex-md-root">
                                                        <!--begin::Label-->
                                                        <label class="form-label">Expiry On</label>
                                                        <!--end::Label-->

                                                        <!--begin::Input-->
                                                        <input type="date" name="expiry" class="form-control mb-2" value="" />
                                                        <!--end::Input-->

                                                        <!--begin::Description-->
                                                        <div class="text-muted fs-7">Set the product Expiry Date.</div>
                                                        <!--end::Description-->
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                                <!--end:Tax-->

                                                <!--begin::Input group-->
                                                <div class="d-flex flex-stack">
                                                    <!--begin::Label-->
                                                    <label class="form-label">Product's Featuring</label>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Input group-->
                                                <div class="d-flex flex-stack">
                                                    <!--begin::Switch-->
                                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                                        <input class="form-check-input" name="is_featured" type="checkbox" value="1" checked="checked" />
                                                        <span class="form-check-label fw-semibold text-muted">
                                                            Featured Product
                                                        </span>
                                                    </label>
                                                    <!--end::Switch-->

                                                    <!--begin::Switch-->
                                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                                        <input class="form-check-input" name="is_new" type="checkbox" value="1" checked="checked" />
                                                        <span class="form-check-label fw-semibold text-muted">
                                                            New Product
                                                        </span>
                                                    </label>
                                                    <!--end::Switch-->

                                                    <!--begin::Switch-->
                                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                                        <input class="form-check-input" name="on_sale" type="checkbox" value="1" checked="checked" />
                                                        <span class="form-check-label fw-semibold text-muted">
                                                            On Sale
                                                        </span>
                                                    </label>
                                                    <!--end::Switch-->
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Input group-->
                                                <div class="d-flex flex-stack">
                                                    <!--begin::Label-->
                                                    <label class="form-label"></label>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Input group-->

                                                <!-- ... (keep existing header/content wrapper) ... -->

                                             
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
                                                        <span class="indicator-progress"> Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span> </span>
                                                    </button>
                                                    <!--end::Button-->
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Card header-->
                                    </div>
                                    <!--end::Variations-->
                                </div>
                            </div>
                            <!--end::Tab pane-->
                        </div>
                        <!--end::Tab content-->
                    </div>
                    <!--end::Main column-->
                </form>
                <!--end::Form-->
            </div>

            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
</div>







<script>
    // document.addEventListener('DOMContentLoaded', function() {
    //     const hasVariantsCheckbox = document.getElementById('hasVariants');
    //     const singleProductFields = document.getElementById('singleProductFields');
    //     const variantFields = document.getElementById('variantFields');

    //     hasVariantsCheckbox.addEventListener('change', function() {
    //         if (this.checked) {
    //             singleProductFields.classList.add('d-none');
    //             variantFields.classList.remove('d-none');
    //         } else {
    //             singleProductFields.classList.remove('d-none');
    //             variantFields.classList.add('d-none');
    //         }
    //     });

    //     // Initialize repeater
    //     $('#kt_ecommerce_add_product_variants').repeater({
    //         initEmpty: false,
    //         defaultValues: { 'text-input': '' },
    //         show: function() {
    //             $(this).slideDown();
    //         },
    //         hide: function(deleteElement) {
    //             $(this).slideUp(deleteElement);
    //         }
    //     });
    // });
</script>


@endsection
<script>
    document.getElementById('images').addEventListener('change', function(event) {
        let previewContainer = document.getElementById('imagePreview');
        previewContainer.innerHTML = ""; // Clear previous previews

        Array.from(event.target.files).forEach(file => {
            let reader = new FileReader();
            reader.onload = function(e) {
                let img = document.createElement('img');
                img.src = e.target.result;
                img.className = "preview-img";
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });
</script>

<!-- <script>
document.addEventListener("DOMContentLoaded", function () {
    let contentDiv = document.getElementById("kt_ecommerce_add_product_description");
    let hiddenTextarea = document.getElementById("description");

    // Sync content on input
    contentDiv.addEventListener("input", function () {
        hiddenTextarea.value = contentDiv.innerHTML;

    });


    // Also sync before form submission
    document.getElementById("kt_ecommerce_add_product_form").addEventListener("submit", function () {
        hiddenTextarea.value = contentDiv.innerHTML;
    });
});
</script> -->

