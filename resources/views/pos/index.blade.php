@extends('layouts.master')
@section('content')

             <!--begin::Main-->
             <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                <!--begin::Content wrapper-->
                <div class="d-flex flex-column flex-column-fluid">

<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 "

         >

            <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">



<!--begin::Page title-->
<div  class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
    <!--begin::Title-->
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
        Pos
            </h1>
    <!--end::Title-->


        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">
                                                    <a href="../../../index.html" class="text-muted text-hover-primary">
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
                                                   Inventory
                                                    </li>
                                <!--end::Item-->
                                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->

                            <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">
                                                    Sales                                            </li>
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
        <div id="kt_app_content_container" class="app-container ">
            <!--begin::Form-->
 <div id="kt_ecommerce_edit_order_form" class="form d-flex flex-column flex-lg-row" data-kt-redirect="listing.html">


       <!--begin::Aside column-->
       <div class="w-100 flex-lg-row-auto w-lg-800px mb-7 me-7 me-lg-10">




             <!--begin::Order details-->
             <div class="card card-flush py-4">

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="d-flex flex-column gap-10">


                        <!--begin::Separator-->
                        <div class="separator"></div>
                        <!--end::Separator-->

                        <input
                        autocomplete="off"
                        type="text"
                        id="searchInput"
                        placeholder="Search or enter to show products"

                        class="form-control mb-3 form-control-lg w-300"
                        style="font-size: 1.25rem; padding: 15px; width: 100%;"
                        data-kt_ecommerce_edit_order_product_table-ajax-filter="search"
                         >





                    <div id="productTableContainer" class="table-dropdown hidden">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_edit_order_product_table-ajax">
                          <thead>
                              <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                  <th class="w-25px pe-2"></th>
                                  <th class="min-w-200px">Product Details</th>
                                  <th class="min-w-100px text-end pe-5">QANTITY</th>
                                  <th class="min-w-100px text-end pe-5"> CATEGORY</th>
                                  <th>Status</th>
                                  <th>Discount</th> <!-- Ensure you have 5 columns here -->

                              </tr>
                          </thead>
                          <tbody class="fw-semibold text-gray-600" >


                          </tbody>
                      </table>
                      <!--end::Table-->
                  </div>



                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_edit_order_product_table" >
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="w-25px pe-2"></th>
                                            <th class="min-w-200px">Product Details</th>
                                            <th class="min-w-100px text-end pe-5">QANTITY</th>
                                            <th class="min-w-100px text-end pe-5"> SUB-TOTAL</th>
                                            <th class="min-w-100px text-end pe-5">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600" id="itemSelectedTable">



                                    </tbody>
                        </table>
                        <!--end::Table-->



                    </div>
                </div>
                <!--end::Card header-->
            </div>
            <!--end::Order details-->



    </div>
    <!--end::Aside column-->





        <!--begin::Main column-->
        <div class="d-flex flex-column flex-lg-row-fluid gap-4 gap-lg-10">



           <!--begin::Pos order-->
           <div class="card card-flush bg-body " id="kt_pos_form">


            <div class="card-header pt-5">

                 <!--begin::Header-->
            <h6 class="card-title fw-bold text-gray-800 ">Choose Customer</h6>
            <!--begin::Separator-->
            <div class="separator"></div>
            <!--end::Separator-->
            <!--begin::Select2-->
            <select name="status" class="form-select mb-2" data-control="select2" data-placeholder="Select an option" id="kt_ecommerce_add_product_status_select">
                <option></option>
                <option value="published" selected>Walk in Customer</option>
            </select>
            <!--end::Select2-->
                <h3 class="card-title fw-bold text-gray-800 fs-2qx">Current Order</h3>

                <!--begin::Toolbar-->
                <div class="card-toolbar">
                    <button  class="btn btn-light-primary fs-4 fw-bold py-4">Clear All</button>
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Header-->

            <!--begin::Body-->
            <div class="card-body pt-0">
                <!--begin::Table container-->
                <div class="table-responsive mb-8">
                    <!--begin::Table-->
                    <table class="table align-middle gs-0 gy-4 my-0">
                        <!--begin::Table head-->
                        <thead>
                            <tr>
                                <th class="min-w-175px"></th>
                                <th class="w-125px"></th>
                                <th class="w-60px"></th>
                            </tr>
                        </thead>
                        <!--end::Table head-->


                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->

                <!--begin::Summary-->
                <div class="d-flex flex-stack bg-success rounded-3 p-6 mb-11">
                    <!--begin::Content-->
                    <div class="fs-6 fw-bold text-white">
                        <span class="d-block lh-1 mb-2">Subtotal</span>
                        <span class="d-block mb-2">Discounts</span>
                        <span class="d-block mb-9">Tax(%)</span>
                        <span class="d-block fs-2qx lh-1">Total</span>
                    </div>
                    <!--end::Content-->

                    <!--begin::Content-->
                    <div class="fs-6 fw-bold text-white text-end">
                        <span class="d-block lh-1 mb-2" data-kt-pos-element="total">₦0.00</span>
                        <span class="d-block mb-2" data-kt-pos-element="discount">-₦0.00</span>
                        <span class="d-block mb-9" data-kt-pos-element="tax">₦0.00</span>
                        <span class="d-block fs-2qx lh-1" data-kt-pos-element="grant-total">₦0.00</span>
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Summary-->

                <!--begin::Payment Method-->
                <div class="m-0">
                    <!--begin::Title-->
                    <h1 class="fw-bold text-gray-800 mb-5">Payment Method</h1>
                    <!--end::Title-->

                    <!--begin::Radio group-->
                    <div class="d-flex flex-equal gap-5 gap-xxl-9 px-0 mb-12" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                                            <!--begin::Radio-->
                            <label class="btn bg-light btn-color-gray-600 btn-active-text-gray-800 border border-3 border-gray-100 border-active-primary btn-active-light-primary w-100 px-4 " data-kt-button="true">
                                <!--begin::Input-->
                                <input class="btn-check" type="radio" name="paymentmethod" value="cash"/>
                                <!--end::Input-->

                                <!--begin::Icon-->
                                <i class="ki-duotone ki-dollar fs-2hx mb-2 pe-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>                        <!--end::Icon-->

                                <!--begin::Title-->
                                <span class="fs-7 fw-bold d-block">Cash</span>
                                <!--end::Title-->
                            </label>
                            <!--end::Radio-->
                                            <!--begin::Radio-->
                            <label class="btn bg-light btn-color-gray-600 btn-active-text-gray-800 border border-3 border-gray-100 border-active-primary btn-active-light-primary w-100 px-4 active" data-kt-button="true">
                                <!--begin::Input-->
                                <input class="btn-check" type="radio" name="paymentmethod" value="card"/>
                                <!--end::Input-->

                                <!--begin::Icon-->
                                <i class="ki-duotone ki-credit-cart fs-2hx mb-2 pe-0"><span class="path1"></span><span class="path2"></span></i>                        <!--end::Icon-->

                                <!--begin::Title-->
                                <span class="fs-7 fw-bold d-block">Card</span>
                                <!--end::Title-->
                            </label>
                            <!--end::Radio-->
                                            <!--begin::Radio-->
                            <label class="btn bg-light btn-color-gray-600 btn-active-text-gray-800 border border-3 border-gray-100 border-active-primary btn-active-light-primary w-100 px-4 " data-kt-button="true">
                                <!--begin::Input-->
                                <input class="btn-check" type="radio" name="paymentmethod" value="transfer"/>
                                <!--end::Input-->

                                <!--begin::Icon-->
                                <i class="ki-duotone ki-paypal fs-2hx mb-2 pe-0"><span class="path1"></span><span class="path2"></span></i>
                                    <!--end::Icon-->

                                <!--begin::Title-->
                                <span class="fs-7 fw-bold d-block">E-Wallet</span>
                                <!--end::Title-->
                            </label>
                            <!--end::Radio-->
                                    </div>
                    <!--end::Radio group-->

                    <!--begin::Actions-->
                    <button class="btn btn-primary fs-1 w-100 py-4" >Print Bills</button>
                    <!--end::Actions-->

                </div>
                <!--end::Payment Method-->
            </div>
            <!--end: Card Body-->
        </div>
        <!--end::Pos order-->




        </div>
        <!--end::Main column-->
</div>
<!--end::Form-->
  </div>
        <!--end::Content container-->
    </div>
<!--end::Content-->
{{--
<!-- Modal for Quantity Input -->
<div class="modal" id="quantityModal" tabindex="-1" aria-labelledby="quantityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quantityModalLabel">Enter Quantity</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="number" id="modalQuantityInput" class="form-control" min="1" value="1" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateQuantityBtn">Update</button>
            </div>
        </div>
    </div>
</div> --}}



<!-- Modal for Quantity Input -->
<div class="modal" id="quantityModal" tabindex="-1" aria-labelledby="quantityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quantityModalLabel">Update Quantity for <span id="modalProductName"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="number" id="modalQuantityInput" class="form-control" min="1" value="1" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateQuantityBtn">Update</button>
            </div>
        </div>
    </div>
</div>


    <!-- Print Receipt -->
    <div class="modal fade modal-default" id="print-receipt" aria-labelledby="print-receipt" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                {{-- <div class="d-flex justify-content-end">
                    <button type="button" class="close p-0" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div> --}}
                <div class="modal-body">
                    <div id="receiptContent">

                                <div class="icon-head text-center">
                                            <a href="javascript:void(0);">
                                                <img src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/logo.png" width="100" height="30" alt="Receipt Logo">
                                            </a>
                                </div>

                                <div class="text-center info text-center">
                                    <h6>Gozak Supermarket, Ondo.</h6>
                                    <p class="mb-0">Phone Number: +1 5656665656</p>
                                    <p class="mb-0">Email: <a href="https://dreamspos.dreamstechnologies.com/cdn-cgi/l/email-protection#f7928f969a879b92b7909a969e9bd994989a"><span class="__cf_email__" data-cfemail="cbaeb3aaa6bba7ae8baca6aaa2a7e5a8a4a6">[email&#160;protected]</span></a></p>
                                </div>
                                <div class="tax-invoice">
                                    <h6 class="text-center">Invoice Receipt </h6>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="invoice-user-name"><span>Name: </span><span id="invoiceUserName">John Doe</span></div>
                                            <div class="invoice-user-name"><span>Invoice No: </span><span id="invoiceNumber">CS132453</span></div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="invoice-user-name"><span>Order Id: </span><span id="orderId">#LL93784</span></div>
                                            <div class="invoice-user-name"><span>Date: </span><span id="invoiceDate">01.07.2022</span></div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table-borderless w-100 table-fit">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="receiptTableBody">

                                        <tr class="subtotal-row">
                                            <td colspan="4">
                                                <table class="table-borderless w-100 table-fit">
                                                    <tr>
                                                        <td>Sub Total :</td>
                                                        <td class="text-end">$700.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Discount :</td>
                                                        <td class="text-end">00.00</td>
                                                    </tr>

                                                    <tr>
                                                        <td>Total Bill :</td>
                                                        <td class="text-end">$655.00</td>
                                                    </tr>

                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>
                                <div>
                                    <p>Order ID: <span id="receiptOrderId"></span></p>
                                    <p>Grand Total: <span id="receiptGrandTotal"></span></p>
                                </div>
                     </div>
                                <div class="text-center invoice-bar">
                                    {{-- <p>**VAT against this challan is payable through central registration. Thank you for your business!</p> --}}
                                    <a href="javascript:void(0);">
                                        <img src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/barcode/barcode-03.jpg" alt="Barcode">
                                    </a>
                                    {{-- <p>Sale 31</p> --}}
                                    <p>Thank You For Shopping With Us. Please Come Again</p>

                                    <button id="printSlip" class="btn btn-primary">Print Receipt</button>
                                </div>


                </div>
            </div>
        </div>
    </div>
    <!-- /Print Receipt -->



     <!-- Print Receipt -->

    <!-- /Print Receipt -->


    <script>
        // Set the URL for the payments.store route in a JavaScript variable
        const paymentStoreUrl = '{{ route('orders.saveorders') }}';
        const productSearchQuery = '{{ route('products.search') }}';

        // document.addEventListener('click', () => {
        //     document.getElementById('searchInput').focus();
        // });



        document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('searchInput');
                const productTableContainer = document.getElementById('productTableContainer');
                const selectAllCheckbox = document.getElementById('selectAllCheckbox');
                const productCheckboxes = document.querySelectorAll('.product-checkbox');

                // Function to hide table
                function hideTable() {
                    productTableContainer.classList.remove('show');
                    productTableContainer.classList.add('hide');

                    setTimeout(() => {
                        productTableContainer.classList.add('hidden');
                    }, 500);
                }

                // Function to focus and select input
                function focusAndSelectInput() {
                    searchInput.focus();
                    searchInput.select();
                }

                // Ensure table is hidden on page load
                hideTable();

                // Toggle table visibility based on input
                searchInput.addEventListener('input', function() {
                    if (this.value.trim().length > 0) {
                        // Show table only when there are characters
                        productTableContainer.classList.remove('hidden', 'hide');
                        productTableContainer.classList.add('show');
                    } else {
                        // Hide table when input is empty
                        hideTable();
                    }
                });

                // Handle Enter key press to clear input and hide table
                searchInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        this.value = '';
                        hideTable();
                        e.preventDefault();
                    }
                });

                // Select all checkboxes
                selectAllCheckbox.addEventListener('change', function() {
                    productCheckboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });

                    // Clear input and hide table immediately
                    searchInput.value = '';
                    hideTable();
                    focusAndSelectInput();
                });

                // Individual product checkbox event
                productCheckboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        // Clear input and hide table immediately when checkbox is checked
                        if (this.checked) {
                            searchInput.value = '';
                            hideTable();
                            focusAndSelectInput();
                        }
                    });
                });

                // Prevent table from hiding when interacting with it
                productTableContainer.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
    });




            document.addEventListener('DOMContentLoaded', () => {
                    // Select the table element
                    const table = document.getElementById('kt_ecommerce_edit_order_product_table-ajax');
                    const filterSearch = document.querySelector('[data-kt_ecommerce_edit_order_product_table-ajax-filter="search"]');
                    const productTableContainer = document.getElementById('productTableContainer');

                    // Initialize DataTable
                    const datatable = $(table).DataTable({
                        info: false,
                        order: [],
                        pageLength: 10,
                        columnDefs: [
                            { orderable: false, targets: 0 }, // Disable ordering on column 0 (checkbox)
                            { orderable: false, targets: 5 }, // Disable ordering on column 7 (actions)
                        ],
                    });

                    // Add event listener to search input
                    filterSearch.addEventListener('input', (e) => {
                        const query = e.target.value.trim();

                        if (query.length > 0) {
                            // Show the table container
                            productTableContainer.classList.remove('hidden');

                            // Filter the table using the search query
                            datatable.search(query).draw();
                        } else {
                            // Hide the table container when input is empty
                            productTableContainer.classList.add('hidden');
                        }
                    });
    });

    </script>
@endsection
