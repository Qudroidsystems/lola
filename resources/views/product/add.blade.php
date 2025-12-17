@extends('layouts.master')

@section('content')

<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">

        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Add New Product
                    </h1>

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

                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
                        <li class="breadcrumb-item text-muted">eCommerce</li>
                        <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
                        <li class="breadcrumb-item text-muted">Catalog</li>
                        <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
                        <li class="breadcrumb-item text-gray-800">Add Product</li>
                    </ul>
                </div>

                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('product.index') }}" class="btn btn-sm fw-bold btn-primary">
                        Product Listings
                    </a>
                </div>
            </div>
        </div>
        <!--end::Toolbar-->

        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">

                <form action="{{ route('product.store') }}" method="POST" id="kt_ecommerce_add_product_form"
                      class="form d-flex flex-column flex-lg-row" enctype="multipart/form-data">
                    @csrf

                    <!--begin::Aside column-->
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">

                        <!--begin::Thumbnail settings-->
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title"><h2>Thumbnail</h2></div>
                            </div>
                            <div class="card-body text-center pt-0">
                                <style>
                                    .image-input-placeholder {
                                        background-image: url("{{ asset('assets/media/svg/files/blank-image.svg') }}");
                                    }
                                    [data-bs-theme="dark"] .image-input-placeholder {
                                        background-image: url("{{ asset('assets/media/svg/files/blank-image-dark.svg') }}");
                                    }
                                </style>

                                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3"
                                     data-kt-image-input="true">
                                    <div class="image-input-wrapper w-150px h-150px"></div>

                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                           data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change thumbnail">
                                        <i class="ki-duotone ki-pencil fs-7"><span class="path1"></span><span class="path2"></span></i>
                                        <input type="file" name="thumbnail" accept=".png, .jpg, .jpeg, .gif" required />
                                        <input type="hidden" name="avatar_remove" />
                                    </label>

                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                          data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel">
                                        <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>
                                    </span>

                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                          data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove">
                                        <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>
                                    </span>
                                </div>

                                <div class="text-muted fs-7">Only *.png, *.jpg, *.jpeg and *.gif files are accepted</div>
                            </div>
                        </div>
                        <!--end::Thumbnail settings-->

                        <!--begin::Status-->
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title"><h2>Status</h2></div>
                                <div class="card-toolbar">
                                    <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_product_status"></div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <select name="status" class="form-select mb-2" data-control="select2" data-hide-search="true"
                                        data-placeholder="Select an option" id="kt_ecommerce_add_product_status_select" required>
                                    <option value="published" selected>Published</option>
                                    <option value="draft">Draft</option>
                                    <option value="scheduled">Scheduled</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                <div class="text-muted fs-7">Set the product status.</div>
                            </div>
                        </div>
                        <!--end::Status-->

                        <!--begin::Category & tags-->
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title"><h2>Category, Tag & Unit</h2></div>
                            </div>
                            <div class="card-body pt-0">

                                <!-- Categories -->
                                <div class="mb-7">
                                    <label class="form-label required">Categories</label>
                                    <select name="category[]" multiple class="form-select mb-2" data-control="select2"
                                            data-placeholder="Select categories" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-muted fs-7 mb-7">Add product to one or more categories.</div>
                                    <a href="{{ route('category.create') }}" class="btn btn-light-primary btn-sm mb-10">
                                        <i class="ki-duotone ki-plus fs-2"></i> Create new category
                                    </a>
                                </div>

                                <!-- Tags -->
                                <div class="mb-7">
                                    <label class="form-label">Tags</label>
                                    <select name="selected_tag_ids[]" multiple class="form-select mb-2" data-control="select2"
                                            data-placeholder="Select or type tags" id="kt_ecommerce_add_product_tags">
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-muted fs-7 mb-7">Add tags to a product.</div>
                                </div>

                                <!-- Unit -->
                                <div class="mb-7">
                                    <label class="form-label required">Unit</label>
                                    <select name="unit[]" multiple class="form-select mb-2" data-control="select2"
                                            data-placeholder="Select units" required>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-muted fs-7 mb-7">Add one or more units to product.</div>
                                    <a href="{{ route('unit.create') }}" class="btn btn-light-primary btn-sm mb-10">
                                        <i class="ki-duotone ki-plus fs-2"></i> Create new Unit
                                    </a>
                                </div>

                            </div>
                        </div>
                        <!--end::Category & tags-->

                        <!-- Product Brand -->
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title"><h2>Product Brand</h2></div>
                            </div>
                            <div class="card-body pt-0">
                                <label class="form-label required">Select a product Brand</label>
                                <select name="brand[]" multiple class="form-select mb-2" data-control="select2"
                                        data-placeholder="Select brands" required>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-muted fs-7">Assign one or more brands.</div>
                            </div>
                        </div>

                        <!-- Store / Warehouse -->
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title"><h2>Store</h2></div>
                            </div>
                            <div class="card-body pt-0">
                                <label class="form-label required">Select a product store</label>
                                <select name="warehouses[]" multiple class="form-select mb-2" data-control="select2"
                                        data-placeholder="Select stores" required>
                                    @foreach ($stores as $store)
                                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-muted fs-7">Assign product to one or more stores.</div>
                            </div>
                        </div>

                    </div>
                    <!--end::Aside column-->

                    <!--begin::Main column-->
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2">
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                   href="#kt_ecommerce_add_product_general">Product Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                                   href="#kt_ecommerce_add_product_advanced">Pricing & Stocks</a>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <!--begin::General Tab-->
                            <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general">
                                <div class="d-flex flex-column gap-7 gap-lg-10">

                                    <div class="card card-flush py-4">
                                        <div class="card-header">
                                            <div class="card-title"><h2>Product Information</h2></div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="mb-10 fv-row">
                                                <label class="required form-label">Product Name</label>
                                                <input type="text" name="product_name" class="form-control mb-2"
                                                       placeholder="Product name" value="{{ old('product_name') }}" required />
                                                <div class="text-muted fs-7">A product name is required and recommended to be unique.</div>
                                            </div>

                                            <div class="mb-10">
                                                <label class="form-label">Description</label>
                                                <div id="kt_ecommerce_add_product_description" class="min-h-200px mb-2"></div>
                                                <textarea name="description" id="description" class="d-none">{{ old('description') }}</textarea>
                                                <div class="text-muted fs-7">Set a description to the product for better visibility.</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card card-flush py-4">
                                        <div class="card-header">
                                            <div class="card-title"><h2>Media</h2></div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="fv-row mb-2">
                                                <label class="form-label">Gallery Images</label>
                                                <input type="file" name="images[]" id="images" multiple class="form-control" accept="image/*" />
                                                <div class="text-muted fs-7 mt-3">Upload multiple product images (optional).</div>
                                            </div>
                                            <div id="imagePreview" class="d-flex flex-wrap gap-4 mt-5"></div>
                                        </div>
                                    </div>

                                    <div class="card card-flush py-4">
                                        <div class="card-header">
                                            <div class="card-title"><h2>Meta Options</h2></div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="mb-10">
                                                <label class="form-label">Meta Tag Title</label>
                                                <input type="text" name="meta_title" class="form-control mb-2"
                                                       placeholder="Meta tag title" value="{{ old('meta_title') }}" />
                                            </div>
                                            <div class="mb-10">
                                                <label class="form-label">Meta Tag Description</label>
                                                <textarea name="meta_tag_description" class="form-control" rows="4">{{ old('meta_tag_description') }}</textarea>
                                            </div>
                                            <div class="mb-10">
                                                <label class="form-label">Meta Tag Keywords</label>
                                                <input type="text" name="meta_tag_keywords" class="form-control mb-2"
                                                       placeholder="keyword1, keyword2" value="{{ old('meta_tag_keywords') }}" />
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!--end::General Tab-->

                            <!--begin::Advanced Tab-->
                            <div class="tab-pane fade" id="kt_ecommerce_add_product_advanced">
                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                    <div class="card card-flush py-4">
                                        <div class="card-header">
                                            <div class="card-title"><h2>Inventory</h2></div>
                                        </div>
                                        <div class="card-body pt-0">

                                            <div class="row g-9 mb-10">
                                                <div class="col-md-6 fv-row">
                                                    <label class="required form-label">SKU</label>
                                                    <input type="text" name="sku" class="form-control mb-2" value="{{ old('sku') }}" required />
                                                </div>
                                                <div class="col-md-6 fv-row">
                                                    <label class="required form-label">Barcode</label>
                                                    <input type="text" name="barcode" class="form-control mb-2" value="{{ old('barcode') }}" />
                                                </div>

                                                <div class="col-md-4 fv-row">
                                                    <label class="required form-label">Stock (Quantity)</label>
                                                    <input type="number" name="stock" class="form-control mb-2" value="{{ old('stock', 0) }}" min="0" required />
                                                </div>
                                                <div class="col-md-4 fv-row">
                                                    <label class="required form-label">Stock Alert</label>
                                                    <input type="number" name="stock_alert" class="form-control mb-2" value="{{ old('stock_alert') }}" min="0" />
                                                </div>

                                                <div class="col-md-4 fv-row">
                                                    <label class="form-label">Base Price</label>
                                                    <input type="number" name="price" step="0.01" class="form-control mb-2" value="{{ old('price') }}" required />
                                                </div>

                                                <div class="col-md-6 fv-row">
                                                    <label class="required form-label">Sale Price</label>
                                                    <input type="number" name="sale_price" step="0.01" class="form-control mb-2" value="{{ old('sale_price') }}" required />
                                                </div>

                                                <div class="col-md-6 fv-row">
                                                    <label class="form-label">Tax Class</label>
                                                    <select class="form-select mb-2" name="tax" data-control="select2" data-hide-search="true">
                                                        <option value="0">Tax Free</option>
                                                        <option value="1">Taxable Goods</option>
                                                        <option value="2">Downloadable Product</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6 fv-row">
                                                    <label class="form-label">VAT Amount (%)</label>
                                                    <input type="text" name="vat_amount" class="form-control mb-2" value="{{ old('vat_amount') }}" />
                                                </div>

                                                <div class="col-md-6 fv-row">
                                                    <label class="form-label">Manufactured On</label>
                                                    <input type="date" name="manufacture" class="form-control mb-2" value="{{ old('manufacture') }}" />
                                                </div>
                                                <div class="col-md-6 fv-row">
                                                    <label class="form-label">Expiry On</label>
                                                    <input type="date" name="expiry" class="form-control mb-2" value="{{ old('expiry') }}" />
                                                </div>
                                            </div>

                                            <div class="d-flex flex-stack mb-10">
                                                <label class="form-check form-switch form-check-custom form-check-solid me-10">
                                                    <input class="form-check-input" name="is_featured" type="checkbox" value="1" {{ old('is_featured') ? 'checked' : '' }} />
                                                    <span class="form-check-label fw-semibold text-muted">Featured Product</span>
                                                </label>
                                                <label class="form-check form-switch form-check-custom form-check-solid me-10">
                                                    <input class="form-check-input" name="is_new" type="checkbox" value="1" {{ old('is_new') ? 'checked' : '' }} />
                                                    <span class="form-check-label fw-semibold text-muted">New Product</span>
                                                </label>
                                                <label class="form-check form-switch form-check-custom form-check-solid">
                                                    <input class="form-check-input" name="on_sale" type="checkbox" value="1" {{ old('on_sale') ? 'checked' : '' }} />
                                                    <span class="form-check-label fw-semibold text-muted">On Sale</span>
                                                </label>
                                            </div>

                                            <div class="d-flex justify-content-end">
                                                <a href="{{ route('product.index') }}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">
                                                    Cancel
                                                </a>
                                                <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                                                    <span class="indicator-label">Save Changes</span>
                                                    <span class="indicator-progress">Please wait... 
                                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                    </span>
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Advanced Tab-->

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

        // Enable tagging for tags
        $("#kt_ecommerce_add_product_tags").select2({
            tags: true,
            tokenSeparators: [','],
            placeholder: "Select or type new tags"
        });

        // Gallery preview
        $("#images").on('change', function(e) {
            $("#imagePreview").empty();
            $.each(e.target.files, function(i, file) {
                if (file.type.match('image.*')) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $("<img>").attr("src", e.target.result)
                                  .addClass("rounded")
                                  .css({ width: "120px", height: "120px", objectFit: "cover", margin: "5px" })
                                  .appendTo("#imagePreview");
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    });
</script>
@endpush

@endsection