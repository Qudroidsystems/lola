"use strict";

// Class definition
var KTAppEcommerceCategories = function () {
    // Shared variables
    var table;
    var datatable;

    // Private functions
    var initDatatable = function () {
        // Init datatable --- more info on datatables: https://datatables.net/manual/
        datatable = $(table).DataTable({
            "info": false,
            'order': [],
            'pageLength': 10,
            'columnDefs': [
                { orderable: false, targets: 0 }, // Disable ordering on column 0 (checkbox)
                { orderable: false, targets: 3 }, // Disable ordering on column 3 (actions)
            ]
        });

        // Re-init functions on datatable re-draws
        datatable.on('draw', function () {
            handleDeleteRows();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-ecommerce-tag-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }

    // Delete cateogry


    var handleDeleteRows = () => {
        const deleteButtons = table.querySelectorAll('[data-kt-ecommerce-tag-filter="delete_row"]');

        deleteButtons.forEach((d) => {
            d.addEventListener('click', function (e) {
                e.preventDefault();

                const parent = d.closest('tr');
                const tagName = parent.querySelector('[data-kt-ecommerce-tag-filter="tag_name"]').innerText;
                const userURL = d.dataset.url; // Retrieve URL from data attribute

                Swal.fire({
                    text: `Are you sure you want to delete ${tagName}?`,
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary",
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            text: `Deleting ${tagName}...`,
                            icon: "info",
                            showConfirmButton: false,
                            allowOutsideClick: false,
                        });

                        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                        $.ajax({
                            type: 'POST',
                            url: userURL,
                            data: { _token: CSRF_TOKEN, _method: 'DELETE' },
                            dataType: 'JSON',
                            success: function (results) {
                                if (results.success) {
                                    Swal.fire("Deleted!", `${tagName} has been deleted.`, "success");
                                    datatable.row($(parent)).remove().draw(); // Update table
                                } else {
                                    Swal.fire("Error!", results.message, "error");
                                }
                            },
                            error: function (xhr) {
                                Swal.fire("Error!", "Something went wrong. Please try again.", "error");
                                console.error(xhr.responseText);
                            },
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire(`${tagName} was not deleted.`, "", "info");
                    }
                });
            });
        });
    };


    // Public methods
    return {
        init: function () {
            table = document.querySelector('#kt_ecommerce_tag_table');

            if (!table) {
                return;
            }

            initDatatable();
            handleSearchDatatable();
            handleDeleteRows();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTAppEcommerceCategories.init();
});
