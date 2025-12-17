@extends('layouts.master')

@section('content')

<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">

        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">

                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Products
                    </h1>

                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
                        <li class="breadcrumb-item text-muted">eCommerce</li>
                        <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
                        <li class="breadcrumb-item text-muted">Catalog</li>
                        <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
                        <li class="breadcrumb-item text-gray-800">Products</li>
                    </ul>
                </div>
                <!--end::Page title-->

                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('product.create') }}" class="btn btn-primary">
                        Add Product
                    </a>
                </div>
                <!--end::Actions-->
            </div>
        </div>
        <!--end::Toolbar-->

        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">

                <!--begin::Products Card-->
                <div class="card card-flush">

                    <!--begin::Card header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                                    <span class="path1"></span><span class="path2"></span>
                                </i>
                                <input type="text" data-kt-ecommerce-product-filter="search"
                                       class="form-control form-control-solid w-250px ps-12"
                                       placeholder="Search Product" />
                            </div>
                        </div>

                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <div class="w-100 mw-150px">
                                <select class="form-select form-select-solid"
                                        data-control="select2"
                                        data-hide-search="true"
                                        data-placeholder="Status"
                                        data-kt-ecommerce-product-filter="status">
                                    <option value="all">All</option>
                                    <option value="published">Published</option>
                                    <option value="draft">Draft</option>
                                </select>
                            </div>

                            <a href="{{ route('product.create') }}" class="btn btn-primary">
                                Add Product
                            </a>
                        </div>
                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox"
                                                   data-kt-check="true"
                                                   data-kt-check-target="#kt_ecommerce_products_table .form-check-input" />
                                        </div>
                                    </th>
                                    <th class="min-w-200px">Product</th>
                                    <th class="text-end min-w-100px">SKU</th>
                                    <th class="text-end min-w-70px">Qty</th>
                                    <th class="text-end min-w-100px">Price</th>
                                    <th class="text-end min-w-100px">Sale Price</th>
                                    <th class="text-end min-w-100px">Status</th>
                                    <th class="text-end min-w-70px">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @forelse($products as $product)
                                    <tr>
                                        <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="{{ $product->id }}" />
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="{{ route('product.edit', $product->id) }}" class="symbol symbol-50px me-5">
                                                    @if($product->thumbnail)
                                                        <span class="symbol-label"
                                                              style="background-image: url('{{ asset($product->thumbnail) }}');
                                                                     background-size: cover;
                                                                     background-position: center;"></span>
                                                    @else
                                                        <span class="symbol-label"
                                                              style="background-image: url('{{ asset('assets/media/svg/files/blank-image.svg') }}');
                                                                     background-size: cover;"></span>
                                                    @endif
                                                </a>

                                                <div class="d-flex flex-column">
                                                    <a href="{{ route('product.edit', $product->id) }}"
                                                       class="text-gray-800 text-hover-primary fs-5 fw-bold">
                                                        {{ $product->name }}
                                                    </a>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="text-end">{{ $product->sku }}</td>
                                        <td class="text-end">{{ $product->stock }}</td>
                                        <td class="text-end">{{ number_format($product->base_price, 2) }}</td>
                                        <td class="text-end">{{ number_format($product->sale_price, 2) }}</td>

                                        <td class="text-end">
                                            <span class="badge badge-light-{{ $product->status == 'published' ? 'success' : 'warning' }}">
                                                {{ ucfirst($product->status) }}
                                            </span>
                                        </td>

                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-light btn-active-light-primary"
                                               data-kt-menu-trigger="click"
                                               data-kt-menu-placement="bottom-end">
                                                Actions
                                                <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                            </a>

                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                 data-kt-menu="true">

                                                <!-- Edit -->
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('product.edit', $product->id) }}" class="menu-link px-3">
                                                        Edit
                                                    </a>
                                                </div>

                                                <!-- Delete -->
                                                <div class="menu-item px-3">
                                                    <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="menu-link px-3 text-danger border-0 bg-transparent text-start w-100"
                                                                onclick="return confirm('Are you sure you want to delete this product? This action cannot be undone.')">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>

                                            </div>
                                            <!--end::Menu-->
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-10">
                                            <div class="text-muted fs-4">No products found.</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Products Card-->
            </div>
        </div>
        <!--end::Content-->
    </div>
</div>
<!--end::Main-->

@endsection