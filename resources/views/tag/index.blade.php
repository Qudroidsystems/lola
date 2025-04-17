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
                Tag
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
                                                                eCommerce                                            </li>
                                            <!--end::Item-->
                                                <!--begin::Item-->
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                </li>
                                <!--end::Item-->

                                        <!--begin::Item-->
                                                <li class="breadcrumb-item text-muted">
                                                             Tag                                       </li>
                                            <!--end::Item-->

                                </ul>
                    <!--end::Breadcrumb-->
                </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">




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

            <!--begin::unit-->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4"><span class="path1"></span><span class="path2"></span></i>
                             <input type="text" data-kt-ecommerce-tag-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Search unit" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--end::Card title-->

                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Add customer-->
                        <a href="{{ route('tag.create') }}" class="btn btn-primary">
                            Add Tag
                        </a>
                        <!--end::Add customer-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">

            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_tag_table">
                <thead>
                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_tag_table .form-check-input" value="1" />
                            </div>
                        </th>
                        <th class="min-w-250px">Tag</th>
                        <th class="min-w-250px">Tag</th>
                        <th class="text-end min-w-70px">Actions</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                    @foreach ($tags as $tag )
    <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <div class="ms-5">
                                            <!--begin::Title-->
                                            <a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1" data-kt-ecommerce-tag-filter="tag_name">{{ $tag->name }}</a>
                                            <!--end::Title-->


                                        </div>
                                    </div>
                                </td>
                                <td>
                                   {{  $tag->name }}

                                </td>

                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-active-light-primary btn-flex btn-center" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        Actions
                                        <i class="ki-duotone ki-down fs-5 ms-1"></i>                    </a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="{{ route('tag.edit', $tag->id) }}" class="btn btn-warning btn-sm">
                                                        Edit
                                            </a>
                                        </div>
                                        <!--end::Menu item-->

                                    <!--begin::Menu item-->
                                        <a
                                        href="javascript:void(0)"
                                        id="show-tag"
                                        data-kt-ecommerce-tag-filter="delete_row"
                                        data-url="{{ route('tag.destroy', $tag->id) }}"
                                        class="btn btn-danger btn-sm">Delete</a>
                                    <!--end::Menu item-->


                                </div>
                                <!--end::Menu-->
                                </td>
                            </tr>
                    @endforeach


                        </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->    </div>
                <!--end::Card body-->
            </div>
            <!--end::unit-->
             </div>
                    <!--end::Content container-->
                </div>
            <!--end::Content-->



@endsection
