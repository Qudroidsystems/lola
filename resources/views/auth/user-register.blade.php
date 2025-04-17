<!DOCTYPE html>

<html lang="en" >
    <!--begin::Head-->

<!-- Mirrored from preview.keenthemes.com/metronic8/demo1/authentication/layouts/creative/sign-in.html')}} by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 Jun 2023 04:07:02 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
      <title>Login | Adrahstudios</title>
        <meta charset="utf-8"/>

        <meta name="viewport" content="width=device-width, initial-scale=1"/>

        <link rel="shortcut icon" href="{{ asset('html/assets/assets/media/logos/favicon.ico')}}"/>

        <!--begin::Fonts(mandatory for all pages)-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>        <!--end::Fonts-->



                    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
                            <link href="{{ asset('html/assets/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>
                            <link href="{{ asset('html/assets/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
                        <!--end::Global Stylesheets Bundle-->


        <script>
            // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
            if (window.top != window.self) {
                window.top.location.replace(window.self.location.href);
            }
        </script>
    </head>
    <!--end::Head-->

    <!--begin::Body-->
    <body  id="kt_body"  class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center bgi-no-repeat" >
        <!--begin::Theme mode setup on page load-->
<script>
	var defaultThemeMode = "light";
	var themeMode;

	if ( document.documentElement ) {
		if ( document.documentElement.hasAttribute("data-bs-theme-mode")) {
			themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
		} else {
			if ( localStorage.getItem("data-bs-theme") !== null ) {
				themeMode = localStorage.getItem("data-bs-theme");
			} else {
				themeMode = defaultThemeMode;
			}
		}

		if (themeMode === "system") {
			themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
		}

		document.documentElement.setAttribute("data-bs-theme", themeMode);
	}
</script>
<!--end::Theme mode setup on page load-->
                    <!--Begin::Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html')}}?id=GTM-5FS8GGP" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!--End::Google Tag Manager (noscript) -->

        <!--begin::Root-->
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <!--begin::Page bg image-->
<style>
    body {
        background-image: url('{{ asset('html/assets/assets/media/auth/bg4.jpg')}}');
    }

    [data-bs-theme="dark"] body {
        background-image: url('{{ asset('html/assets/assets/media/auth/bg4-dark.jpg')}}');
    }
</style>
<!--end::Page bg image-->

<!--begin::Authentication - Sign-in -->
<div class="d-flex flex-column flex-column-fluid flex-lg-row">
    <!--begin::Aside-->
    <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
        <!--begin::Aside-->
        <div class="d-flex flex-center flex-lg-start flex-column">


            <!--begin::Title-->
            <h2 class="text-white fw-normal m-0">
                <img alt="Logo" src="{{ asset('html/assets/assets/media/logos/logo.png')}}" class="h-100px app-sidebar-logo-default"/> Adrahstudios
            </h2>
            <!--end::Title-->
        </div>
        <!--begin::Aside-->
    </div>
    <!--begin::Aside-->

    <!--begin::Body-->
    <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
        <!--begin::Card-->
        <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
            <!--begin::Wrapper-->
            <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">


<!--begin::Form-->
<form class="form w-100" method="POST" action="{{ route('register') }}" novalidate="novalidate" id="kt_sign_up_form" >
    @csrf
    <!--begin::Heading-->
    <div class="text-center mb-11">
        <!--begin::Title-->
        <h1 class="text-dark fw-bolder mb-3">
            Sign Up
        </h1>
        <!--end::Title-->


    </div>
    <!--begin::Heading-->

    <!--begin::Separator-->
    <div class="separator separator-content my-14"><span class="w-125px text-gray-500 fw-semibold fs-7"></span></div>
    <!--end::Separator-->

    <!--begin::Input group--->
    <div class="fv-row mb-8">
        <!--begin::Email-->
        <input type="text" placeholder="Full Name"   class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus/>
        <!--end::Email-->

        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    </div>

      <!--begin::Input group--->
      <div class="fv-row mb-8">
        <!--begin::Email-->
        <input type="text" placeholder="Email"   class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus/>
        <!--end::Email-->

        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    </div>

    <!--begin::Input group-->
    <div class="fv-row mb-8" data-kt-password-meter="true">
        <!--begin::Wrapper-->
        <div class="mb-1">
            <!--begin::Input wrapper-->
            <div class="position-relative mb-3">
                <input class="form-control bg-transparent @error('password') is-invalid @enderror"  required autocomplete="new-password"" type="password" placeholder="Password" name="password"/>

                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                    <i class="ki-duotone ki-eye-slash fs-2"></i>

                    <i class="ki-duotone ki-eye fs-2 d-none"></i>                </span>

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!--end::Input wrapper-->

            <!--begin::Meter-->
            <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
            </div>
            <!--end::Meter-->
        </div>
        <!--end::Wrapper-->

        <!--begin::Hint-->
        <div class="text-muted">
            Use 8 or more characters with a mix of letters, numbers & symbols.
        </div>
        <!--end::Hint-->
    </div>
    <!--end::Input group--->

    <!--end::Input group--->
    <div class="fv-row mb-8">
        <!--begin::Repeat Password-->
        <input type="text" placeholder="Repeat Password" name="password_confirmation" type="password" autocomplete="off" class="form-control bg-transparent"/>
        <!--end::Repeat Password-->
    </div>
    <!--end::Input group--->

    <!--begin::Accept-->
    <div class="fv-row mb-8">
        <label class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="toc" value="1"/>
            <span class="form-check-label fw-semibold text-gray-700 fs-base ms-1">
                I Accept the <a href="#" class="ms-1 link-primary">Terms</a>
            </span>
        </label>
    </div>
    <!--end::Accept-->

    <!--begin::Submit button-->
    <div class="d-grid mb-10">
        <button type="submit" id="kt_sign_up_submit" class="btn btn-primary">

<!--begin::Indicator label-->
<span class="indicator-label">
    Sign up</span>
<!--end::Indicator label-->

<!--begin::Indicator progress-->
<span class="indicator-progress">
    Please wait...    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
</span>
<!--end::Indicator progress-->        </button>
    </div>
    <!--end::Submit button-->

    <!--begin::Sign up-->
    <div class="text-gray-500 text-center fw-semibold fs-6">
        Already have an Account?

        <a href="{{ route('login') }}" class="link-primary fw-semibold">
            Sign in
        </a>
    </div>
    <!--end::Sign up-->
</form>
<!--end::Form-->


            </div>
            <!--end::Wrapper-->

            <!--begin::Footer-->
            <div class="d-flex flex-stack px-lg-10">

                <!--begin::Links-->
                <div class="d-flex fw-semibold text-primary fs-base gap-5">
                    <a href="#" target="_blank">About Qudroid Systems</a>

                </div>
                <!--end::Links-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Body-->
</div>
<!--end::Authentication - Sign-in--></div>
<!--end::Root-->

        <!--begin::Javascript-->
        <script>
            var hostUrl = "{{ asset('html/assets/assets/index.html')}}";        </script>

                    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
                            <script src="{{ asset('html/assets/assets/plugins/global/plugins.bundle.js')}}"></script>
                            <script src="{{ asset('html/assets/assets/js/scripts.bundle.js')}}"></script>
                        <!--end::Global Javascript Bundle-->


                    <!--begin::Custom Javascript(used for this page only)-->
                            <script src="{{ asset('html/assets/assets/js/custom/authentication/sign-in/general.js')}}"></script>
                        <!--end::Custom Javascript-->
                <!--end::Javascript-->

            </body>
    <!--end::Body-->


</html>
