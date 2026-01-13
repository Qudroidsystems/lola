@extends('layouts.master')

@section('content')

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Edit Product
                    </h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
                        <li class="breadcrumb-item text-muted">eCommerce</li>
                        <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
                        <li class="breadcrumb-item text-muted">Catalog</li>
                        <li class="breadcrumb-item text-gray-800">Edit Product</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('product.index') }}" class="btn btn-sm fw-bold btn-primary">Product Listings</a>
                </div>
            </div>
        </div>

        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">

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

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('product.update', $product->id) }}" method="POST"
                      id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Left Column - Settings -->
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">

                        <!-- Thumbnail -->
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Thumbnail</h2>
                                </div>
                            </div>
                            <div class="card-body text-center pt-0">
                                <div class="image-input image-input-outline w-150px h-150px mb-3 {{ $product->thumbnail ? '' : 'image-input-empty' }}"
                                     data-kt-image-input="true"
                                     data-kt-image-input-default="{{ asset('assets/media/svg/files/blank-image.svg') }}">

                                    <!-- Current Image -->
                                    <div class="image-input-wrapper w-150px h-150px"
                                         @if($product->thumbnail)
                                             style="background-image: url('{{ Storage::url($product->thumbnail) }}')"
                                         @else
                                             style="background-image: url('{{ asset('assets/media/svg/files/blank-image.svg') }}')"
                                         @endif>
                                    </div>

                                    <!-- Buttons -->
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow position-absolute translate-middle start-100 top-0"
                                           data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change thumbnail">
                                        <i class="ki-duotone ki-pencil fs-7"><span class="path1"></span><span class="path2"></span></i>
                                        <input type="file" name="thumbnail" accept=".png, .jpg, .jpeg, .gif" />
                                        <input type="hidden" name="avatar_remove" />
                                    </label>

                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow position-absolute translate-middle start-100 top-0"
                                          data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel">
                                        <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>
                                    </span>

                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow position-absolute translate-middle start-100 top-0"
                                          data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove thumbnail">
                                        <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>
                                    </span>
                                </div>

                                <div class="text-muted fs-7">
                                    Set the product thumbnail image. Only *.png, *.jpg, *.jpeg files are accepted
                                </div>

                                @if($product->thumbnail)
                                    <div class="mt-3 text-muted fs-8">
                                        Current: <code>{{ basename($product->thumbnail) }}</code>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title"><h2>Status</h2></div>
                            </div>
                            <div class="card-body pt-0">
                                <select name="status" class="form-select mb-2" data-control="select2" data-hide-search="true" required>
                                    <option value="published" {{ $product->status == 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="draft" {{ $product->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                </select>
                            </div>
                        </div>

                        <!-- Categories, Tags, Units, Brands, Stores -->
                        <!-- ... keep your existing category/tag/unit/brand/store sections here ... -->
                        <!-- Just make sure to use Storage::url() if you display any existing images -->

                    </div>

                    <!-- Right Column - Main Content -->
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                        <!-- Tabs -->
                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2">
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_add_product_general">
                                    Product Information
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_ecommerce_add_product_advanced">
                                    Pricing & Stocks
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <!-- General Tab -->
                            <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general">
                                <!-- Product name, description, meta fields, gallery upload -->
                                <!-- ... your existing code ... -->
                            </div>

                            <!-- Pricing & Stocks Tab -->
                            <div class="tab-pane fade" id="kt_ecommerce_add_product_advanced">
                                <!-- ... your existing inventory/pricing fields ... -->
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-end mt-10">
                            <a href="{{ route('product.index') }}" class="btn btn-light me-5">Cancel</a>
                            <button type="submit" class="btn btn-primary" id="kt_ecommerce_add_product_submit">
                                <span class="indicator-label">Save Changes</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize all Select2 elements
        KTApp.initSelect2();

        // Initialize KeenThemes Image Input
        const imageInput = document.querySelector('[data-kt-image-input="true"]');
        if (imageInput) {
            new KTImageInput(imageInput);
        }

        // Optional: Gallery preview for new images
        const galleryInput = document.getElementById('images');
        if (galleryInput) {
            galleryInput.addEventListener('change', function(e) {
                const preview = document.getElementById('imagePreview') || document.createElement('div');
                preview.id = 'imagePreview';
                preview.className = 'd-flex flex-wrap gap-3 mt-4';
                galleryInput.parentNode.appendChild(preview);
                preview.innerHTML = '';

                Array.from(e.target.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(ev) {
                        const img = document.createElement('img');
                        img.src = ev.target.result;
                        img.className = 'rounded shadow';
                        img.style.width = '120px';
                        img.style.height = '120px';
                        img.style.objectFit = 'cover';
                        preview.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                });
            });
        }
    });
</script>
@endpush
