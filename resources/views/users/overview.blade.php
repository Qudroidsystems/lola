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
                            Account Overview
                        </h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('home') }}" class="text-muted text-hover-primary">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">Account</li>
                        </ul>
                    </div>
                    <!--end::Page title-->
                </div>
            </div>
            <!--end::Toolbar-->

            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl">

                    @include('users.inc.navbar')

                    @if(is_null($userbio))
                        <div class="alert alert-info alert-dismissible fade show mb-5" role="alert">
                            <strong>Profile information is incomplete!</strong><br>
                            Please <a href="{{ route('user.settings', Auth::user()->id) }}" class="alert-link">complete your biodata</a> to unlock full profile features.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!--begin::details View-->
                    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                        <!--begin::Card header-->
                        <div class="card-header cursor-pointer">
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">Profile Details</h3>
                            </div>
                            <a href="{{ route('user.settings', Auth::user()->id) }}" class="btn btn-sm btn-primary align-self-center">
                                Edit Profile
                            </a>
                        </div>
                        <!--end::Card header-->

                        <!--begin::Card body-->
                        <div class="card-body p-9">
                            <!--begin::Row-->
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">Full Name</label>
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">
                                        {{ $userbio?->firstname ?? 'Not set' }}
                                        {{ $userbio?->lastname ?? '' }}
                                        {{ $userbio?->othernames ?? '' }}
                                    </span>
                                </div>
                            </div>
                            <!--end::Row-->

                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">Address</label>
                                <div class="col-lg-8 fv-row">
                                    <span class="fw-semibold text-gray-800 fs-6">
                                        {{ $userbio?->address ?? 'Not provided' }}
                                    </span>
                                </div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">
                                    Contact Phone
                                    <span class="ms-1" data-bs-toggle="tooltip" title="Phone number must be active">
                                        <i class="ki-duotone ki-information fs-7"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                    </span>
                                </label>
                                <div class="col-lg-8 d-flex align-items-center">
                                    <span class="fw-bold fs-6 text-gray-800 me-2">
                                        {{ $userbio?->phone ?? 'Not provided' }}
                                    </span>
                                </div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">Date of Birth</label>
                                <div class="col-lg-8">
                                    <a href="#" class="fw-semibold fs-6 text-gray-800 text-hover-primary">
                                        {{ $userbio?->dob ?? 'Not set' }}
                                    </a>
                                </div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">
                                    Nationality
                                    <span class="ms-1" data-bs-toggle="tooltip" title="Country of origination">
                                        <i class="ki-duotone ki-information fs-7"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                    </span>
                                </label>
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">
                                        {{ $userbio?->nationality ?? 'Not specified' }}
                                    </span>
                                </div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">Gender</label>
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">
                                        {{ $userbio?->gender ?? 'Not specified' }}
                                    </span>
                                </div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-10">
                                <label class="col-lg-4 fw-semibold text-muted">Marital Status</label>
                                <div class="col-lg-8">
                                    <span class="fw-semibold fs-6 text-gray-800">
                                        {{ $userbio?->maritalstatus ?? 'Not specified' }}
                                    </span>
                                </div>
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::details View-->
                </div>
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->
    </div>
    <!--end::Main-->
@endsection
