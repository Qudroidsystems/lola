@extends('layouts.master')

@section('content')

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
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
                                        <input type="file" name="thumbnail" accept=".png,.jpg,.jpeg,.gif" required />
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

                                <div class="text-muted fs-7">Only *.png, *.jpg, *.jpeg and *.gif files are accepted (max 5MB)</div>
                            </div>
                        </div>
                        <!--end::Thumbnail settings-->

                        <!-- Status, Categories, Tags, Units, Brands, Stores sections remain the same -->
                        <!-- ... paste your existing code for status, categories, tags, units, brands, stores here ... -->

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

                            <!-- General Tab -->
                            <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general">
                                <!-- Your existing product name, description, gallery, meta fields -->
                                <!-- ... keep your existing code ... -->

                                <div class="card card-flush py-4">
                                    <div class="card-header">
                                        <div class="card-title"><h2>Media</h2></div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="fv-row mb-2">
                                            <label class="form-label">Gallery Images</label>
                                            <input type="file" name="images[]" id="images" multiple class="form-control"
                                                   accept="image/*" />
                                            <div class="text-muted fs-7 mt-3">Upload multiple product images (max 5MB each)</div>
                                        </div>
                                        <div id="imagePreview" class="d-flex flex-wrap gap-4 mt-5"></div>
                                    </div>
                                </div>

                                <!-- ... rest of general tab ... -->
                            </div>

                            <!-- Pricing & Stocks Tab -->
                            <div class="tab-pane fade" id="kt_ecommerce_add_product_advanced">
                                <!-- Your existing inventory/pricing fields -->
                                <!-- ... keep your existing code ... -->
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
        $("select[data-control='select2']").select2({
            placeholder: function() { return $(this).data('placeholder') || "Select an option"; },
            allowClear: true
        });

        $("#kt_ecommerce_add_product_tags").select2({
            tags: true,
            tokenSeparators: [','],
            placeholder: "Select or type new tags"
        });

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
