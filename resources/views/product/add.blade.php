@extends('layouts.master')

@section('content')

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
                        Add New Product
                    </h1>
                    <!--end::Title-->

                    <!-- Flash Messages -->
                    @if ($errors->any())
                        <div class="alert alert-danger mt-5">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
                        <li class="breadcrumb-item text-muted">eCommerce</li>
                        <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('product.index') }}" class="text-muted text-hover-primary">Products</a>
                        </li>
                        <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
                        <li class="breadcrumb-item text-gray-800">Add Product</li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->

                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('product.index') }}" class="btn btn-sm fw-bold btn-primary">
                        Product Listings
                    </a>
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->

        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Form-->
                <form action="{{ route('product.store') }}" method="POST" id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row" enctype="multipart/form-data">
                    @csrf

                    <!--begin::Aside column (Left Sidebar)-->
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">

                        <!-- Thumbnail -->
                        <div class="card card-flush py-4">
                            <div class="card-header"><div class="card-title"><h2>Thumbnail</h2></div></div>
                            <div class="card-body text-center pt-0">
                                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                    <div class="image-input-wrapper w-150px h-150px"></div>
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change thumbnail">
                                        <i class="ki-duotone ki-pencil fs-7"><span class="path1"></span><span class="path2"></span></i>
                                        <input type="file" name="thumbnail" accept=".png, .jpg, .jpeg, .gif" required />
                                        <input type="hidden" name="avatar_remove" />
                                    </label>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel">
                                        <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>
                                    </span>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove">
                                        <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>
                                    </span>
                                </div>
                                <div class="text-muted fs-7">Only *.png, *.jpg, *.jpeg, *.gif accepted</div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title"><h2>Status</h2></div>
                                <div class="card-toolbar">
                                    <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_product_status"></div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <select name="status" class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select status" id="kt_ecommerce_add_product_status_select" required>
                                    <option value="published" selected>Published</option>
                                    <option value="draft">Draft</option>
                                </select>
                            </div>
                        </div>

                        <!-- Categories, Tags, Units, Brands, Warehouses -->
                        <div class="card card-flush py-4">
                            <div class="card-header"><div class="card-title"><h2>Relations</h2></div></div>
                            <div class="card-body pt-0">

                                <!-- Categories -->
                                <div class="mb-7">
                                    <label class="form-label required">Categories</label>
                                    <select name="category[]" multiple class="form-select" data-control="select2" data-placeholder="Select categories" required>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Tags -->
                                <div class="mb-7">
                                    <label class="form-label">Tags</label>
                                    <select name="selected_tag_ids[]" multiple class="form-select" data-control="select2" data-placeholder="Select or type tags" id="kt_ecommerce_add_product_tags">
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Units -->
                                <div class="mb-7">
                                    <label class="form-label required">Units</label>
                                    <select name="unit[]" multiple class="form-select" data-control="select2" data-placeholder="Select units" required>
                                        @foreach($units as $unit)
                                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Brands -->
                                <div class="mb-7">
                                    <label class="form-label required">Brand</label>
                                    <select name="brand[]" multiple class="form-select" data-control="select2" data-placeholder="Select brands" required>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Warehouses -->
                                <div class="mb-7">
                                    <label class="form-label required">Warehouses / Stores</label>
                                    <select name="warehouses[]" multiple class="form-select" data-control="select2" data-placeholder="Select warehouses" required>
                                        @foreach($stores as $store)
                                            <option value="{{ $store->id }}">{{ $store->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--end::Aside column-->

                    <!--begin::Main column (Right Content)-->
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2">
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_add_product_general">General</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_ecommerce_add_product_advanced">Inventory & Pricing</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <!-- General Tab -->
                            <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general">
                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                    <div class="card card-flush py-4">
                                        <div class="card-header"><div class="card-title"><h2>Product Information</h2></div></div>
                                        <div class="card-body pt-0">
                                            <div class="mb-10">
                                                <label class="required form-label">Product Name</label>
                                                <input type="text" name="product_name" class="form-control mb-2" placeholder="Product name" value="{{ old('product_name') }}" required />
                                            </div>

                                            <div class="mb-10">
                                                <label class="form-label">Description</label>
                                                <textarea name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Gallery Images -->
                                    <div class="card card-flush py-4">
                                        <div class="card-header"><div class="card-title"><h2>Gallery Images</h2></div></div>
                                        <div class="card-body pt-0">
                                            <input type="file" name="images[]" multiple class="form-control" accept="image/*" />
                                            <div class="text-muted fs-7 mt-3">Upload multiple product images (optional).</div>
                                            <div id="imagePreview" class="d-flex flex-wrap gap-3 mt-5"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Advanced Tab -->
                            <div class="tab-pane fade" id="kt_ecommerce_add_product_advanced">
                                <div class="card card-flush py-4">
                                    <div class="card-header"><div class="card-title"><h2>Inventory & Pricing</h2></div></div>
                                    <div class="card-body pt-0">
                                        <div class="row g-9 mb-10">
                                            <div class="col-md-6">
                                                <label class="required form-label">SKU</label>
                                                <input type="text" name="sku" class="form-control" value="{{ old('sku') }}" required />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Barcode</label>
                                                <input type="text" name="barcode" class="form-control" value="{{ old('barcode') }}" />
                                            </div>
                                            <div class="col-md-4">
                                                <label class="required form-label">Stock Quantity</label>
                                                <input type="number" name="stock" class="form-control" value="{{ old('stock', 0) }}" min="0" required />
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Stock Alert</label>
                                                <input type="number" name="stock_alert" class="form-control" value="{{ old('stock_alert') }}" min="0" />
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Tax (%)</label>
                                                <input type="number" name="tax" step="0.01" class="form-control" value="{{ old('tax') }}" min="0" max="100" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="required form-label">Base Price</label>
                                                <input type="number" name="price" step="0.01" class="form-control" value="{{ old('price') }}" required />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="required form-label">Sale Price</label>
                                                <input type="number" name="sale_price" step="0.01" class="form-control" value="{{ old('sale_price') }}" required />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Manufactured On</label>
                                                <input type="date" name="manufacture" class="form-control" value="{{ old('manufacture') }}" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Expiry On</label>
                                                <input type="date" name="expiry" class="form-control" value="{{ old('expiry') }}" />
                                            </div>
                                        </div>

                                        <div class="d-flex gap-10 mb-10">
                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} />
                                                <span class="form-check-label">Featured</span>
                                            </label>
                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" name="is_new" value="1" {{ old('is_new') ? 'checked' : '' }} />
                                                <span class="form-check-label">New</span>
                                            </label>
                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" name="on_sale" value="1" {{ old('on_sale') ? 'checked' : '' }} />
                                                <span class="form-check-label">On Sale</span>
                                            </label>
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <a href="{{ route('product.index') }}" class="btn btn-light me-5">Cancel</a>
                                            <button type="submit" class="btn btn-primary">
                                                <span class="indicator-label">Save Product</span>
                                                <span class="indicator-progress">Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Main column-->
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize all Select2
        $("select[data-control='select2']").select2({
            placeholder: function() {
                return $(this).data('placeholder') || "Select an option";
            },
            allowClear: true
        });

        // Enable tagging on tags field
        $("#kt_ecommerce_add_product_tags").select2({
            tags: true,
            tokenSeparators: [','],
            placeholder: "Select or type new tags"
        });

        // Image preview
        $('#images').on('change', function(e) {
            $('#imagePreview').empty();
            Array.from(e.target.files).forEach(file => {
                if (file.type.match('image.*')) {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        let img = $('<img>').attr('src', e.target.result)
                                            .addClass('rounded')
                                            .css({ width: '100px', height: '100px', objectFit: 'cover' });
                        $('#imagePreview').append(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    });
</script>
@endpush

@endsection