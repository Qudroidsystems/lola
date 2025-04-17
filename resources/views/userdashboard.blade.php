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
       Dashboardddd
            </h1>
    <!--end::Title-->

            
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <!--begin::Item-->
                             <li class="breadcrumb-item text-muted">
                                 <a href="/dashboard" class="text-muted text-hover-primary">Home </a>
                                            </li>
                                <!--end::Item-->
                                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                                        
                            <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">Dashboards </li>
                                <!--end::Item-->
                                        
                    </ul>
        <!--end::Breadcrumb-->
    </div>
<!--end::Page title-->

        </div>
        <!--end::Toolbar container-->
    </div>
<!--end::Toolbar-->                                        
                    
<!--begin::Content-->
<div id="kt_app_content" class="app-content  flex-column-fluid " >
    
           
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container  container-xxl ">
        <!--begin::Row-->
<div class="row gy-5 g-xl-10">


<!--begin::Col-->
<div class="col-sm-10 col-xl-6 mb-5 mb-xl-10">
    
<!--begin::Card widget 2-->
<div class="card h-lg-100">
<!--begin::Body-->
<div class="card-body d-flex justify-content-between align-items-start flex-column">         
    <!--begin::Icon--> 
    <div class="m-0">
          
                   
    </div>                           
    <!--end::Icon-->

    <!--begin::Section--> 
    <div class="d-flex flex-column my-7">
        <!--begin::Number-->           
        <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">Welcome to StavOps</span> 
        <!--end::Number--> 

      
    </div>  
    <!--end::Section-->          
    
                            
</div>
<!--end::Body-->
</div>
<!--end::Card widget 2-->


 </div>
<!--end::Col-->    
</div>
<!--end::Row-->



 


</div>
    <!--end::Content container-->
</div>
<!--end::Content-->	
@endsection
      
