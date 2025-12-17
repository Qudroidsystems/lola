@extends('layouts.master')

@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <!-- Toolbar similar to add -->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Edit Product: {{ $product->name }}
                    </h1>
                    <!-- Breadcrumb same as add -->
                </div>
            </div>
        </div>

        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="card card-flush">
                    <div class="card-header mt-6">
                        <div class="card-title">
                            <h2 class="fw-bold">Edit Product</h2>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Same fields as add, but with old() + existing values -->

                            <div class="mb-10">
                                <label class="form-label required">Product Name</label>
                                <input type="text" name="product_name" class="form-control" value="{{ old('product_name', $product->name) }}" required />
                            </div>

                            <div class="mb-10">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
                            </div>

                            <!-- SKU, Barcode, Stock -->
                            <div class="row mb-10">
                                <div class="col-md-4">
                                    <label class="form-label required">SKU</label>
                                    <input type="text" name="sku" class="form-control" value="{{ old('sku', $product->sku) }}" required />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Barcode</label>
                                    <input type="text" name="barcode" class="form-control" value="{{ old('barcode', $product->barcode) }}" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label required">Stock Quantity</label>
                                    <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required />
                                </div>
                            </div>

                            <!-- Prices -->
                            <div class="row mb-10">
                                <div class="col-md-6">
                                    <label class="form-label required">Base Price</label>
                                    <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->base_price) }}" required />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label required">Sale Price</label>
                                    <input type="number" step="0.01" name="sale_price" class="form-control" value="{{ old('sale_price', $product->sale_price) }}" required />
                                </div>
                            </div>

                            <!-- Multi-selects with pre-selected values -->
                            <div class="mb-10">
                                <label class="form-label required">Categories</label>
                                <select name="category[]" multiple class="form-select" data-control="select2" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $product->categories->contains($category->id) ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-10">
                                <label class="form-label required">Brands</label>
                                <select name="brand[]" multiple class="form-select" data-control="select2" required>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ $product->brands->contains($brand->id) ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-10">
                                <label class="form-label required">Units</label>
                                <select name="unit[]" multiple class="form-select" data-control="select2" required>
                                    @foreach($units as $unit)
                                        <option value="{{ $unit->id }}" {{ $product->units->contains($unit->id) ? 'selected' : '' }}>
                                            {{ $unit->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-10">
                                <label class="form-label required">Warehouses</label>
                                <select name="warehouses[]" multiple class="form-select" data-control="select2" required>
                                    @foreach($stores as $store)
                                        <option value="{{ $store->id }}" {{ $product->warehouses->contains($store->id) ? 'selected' : '' }}>
                                            {{ $store->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-10">
                                <label class="form-label">Tags</label>
                                <select name="selected_tag_ids[]" multiple class="form-select" data-control="select2" id="kt_ecommerce_add_product_tags">
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}" {{ $product->tags->contains($tag->id) ? 'selected' : '' }}>
                                            {{ $tag->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Thumbnail (optional on edit) -->
                            <div class="mb-10">
                                <label class="form-label">Current Thumbnail</label><br>
                                @if($product->thumbnail)
                                    <img src="{{ asset($product->thumbnail) }}" alt="thumbnail" style="max-height: 150px; border-radius: 8px;">
                                @endif
                                <label class="form-label mt-4">Change Thumbnail</label>
                                <input type="file" name="thumbnail" class="form-control" accept="image/*" />
                            </div>

                            <!-- Gallery Images -->
                            <div class="mb-10">
                                <label class="form-label">Current Gallery Images</label><br>
                                <div class="row">
                                    @foreach($product->images as $image)
                                        <div class="col-3 mb-3">
                                            <img src="{{ asset($image->path) }}" style="width:100%; border-radius:8px;">
                                        </div>
                                    @endforeach
                                </div>
                                <label class="form-label mt-4">Replace Gallery Images</label>
                                <input type="file" name="images[]" multiple class="form-control" accept="image/*" />
                                <small class="text-muted">Uploading new images will replace all current gallery images.</small>
                            </div>

                            <!-- Status & Checkboxes -->
                            <div class="row mb-10">
                                <div class="col-md-4">
                                    <label class="form-label required">Status</label>
                                    <select name="status" class="form-select" required>
                                        <option value="published" {{ $product->status == 'published' ? 'selected' : '' }}>Published</option>
                                        <option value="draft" {{ $product->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label">Options</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" {{ $product->is_featured ? 'checked' : '' }} />
                                        <label class="form-check-label">Featured</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="is_new" value="1" {{ $product->is_new ? 'checked' : '' }} />
                                        <label class="form-check-label">New</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="on_sale" value="1" {{ $product->on_sale ? 'checked' : '' }} />
                                        <label class="form-check-label">On Sale</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('product.index') }}" class="btn btn-light me-3">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection