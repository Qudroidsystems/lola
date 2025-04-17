"use strict";

// Class definition
var KTAppEcommerceSalesSaveOrder = function () {
    // Shared variables
    var table;
    var datatable;

    // Private functions
    const initSaveOrder = () => {
        // Init flatpickr
        $('#kt_ecommerce_edit_order_date').flatpickr({
            altInput: true,
            altFormat: "d F, Y",
            dateFormat: "Y-m-d",
        });

        // Init select2 country options
        // Format options
        const optionFormat = (item) => {
            if ( !item.id ) {
                return item.text;
            }

            var span = document.createElement('span');
            var template = '';

            template += '<img src="' + item.element.getAttribute('data-kt-select2-country') + '" class="rounded-circle h-20px me-2" alt="image"/>';
            template += item.text;

            span.innerHTML = template;

            return $(span);
        }

        // Init Select2 --- more info: https://select2.org/
        $('#kt_ecommerce_edit_order_billing_country').select2({
            placeholder: "Select a country",
            minimumResultsForSearch: Infinity,
            templateSelection: optionFormat,
            templateResult: optionFormat
        });

        $('#kt_ecommerce_edit_order_shipping_country').select2({
            placeholder: "Select a country",
            minimumResultsForSearch: Infinity,
            templateSelection: optionFormat,
            templateResult: optionFormat
        });

        // Init datatable --- more info on datatables: https://datatables.net/manual/
        table = document.querySelector('#kt_ecommerce_edit_order_product_table-ajax');
        datatable = $(table).DataTable({
            'order': [],
            "scrollY": "400px",
            "scrollCollapse": true,
            "paging": false,
            "info": false,
            'columnDefs': [
                { orderable: false, targets: 0 }, // Disable ordering on column 0 (checkbox)
            ]
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-ecommerce-edit-order-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }

    // Handle shipping form
    const handleShippingForm = () => {
        // Select elements
        const element = document.getElementById('kt_ecommerce_edit_order_shipping_form');
        const checkbox = document.getElementById('same_as_billing');

        // Show/hide shipping form
        checkbox.addEventListener('change', e => {
            if (e.target.checked) {
                element.classList.add('d-none');
            } else {
                element.classList.remove('d-none');
            }
        });
    }



document.addEventListener('DOMContentLoaded', function () {
                 // Utility Functions
                const formatMoney = (amount) => {
                    const number = parseFloat(amount);
                    if (isNaN(number)) return '₦0.00';
                    return '₦' + number.toLocaleString('en-NG', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                };

                const generateOrderId = () => 'ORD-' + new Date().getTime();

                // DOM Elements
                const printBillsButton = document.querySelector('.btn-primary.fs-1');
                const printPreviewModal = new bootstrap.Modal(document.getElementById('print-receipt'));
                const printSlipButton = document.getElementById('printSlip');
                const itemSelectedTable = document.getElementById('itemSelectedTable');
                const barcodeInput = document.getElementById('searchInput');
                const clearAllButton = document.querySelector('.btn-light-primary');

                const quantityModal = document.getElementById('quantityModal');
                const modalQuantityInput = document.getElementById('modalQuantityInput');
                const updateQuantityBtn = document.getElementById('updateQuantityBtn');
                const searchInput = document.getElementById('searchInput');

                 // Function to focus search input
                function focusSearchInput() {
                    if (!quantityModal.classList.contains('show')) {
                        searchInput.focus();
                    }
                }

                // Always focus search input unless modal is shown
                document.addEventListener('click', focusSearchInput);

                // When modal is shown, focus the quantity input field
                quantityModal.addEventListener('shown.bs.modal', () => {
                    modalQuantityInput.focus();
                });

                // When modal is hidden, return focus to the search input
                quantityModal.addEventListener('hidden.bs.modal', () => {
                    searchInput.focus();
                });

                // When update button is clicked, close modal and refocus search input
                updateQuantityBtn.addEventListener('click', () => {
                    const modal = bootstrap.Modal.getInstance(quantityModal);
                    modal.hide(); // Close the modal
                });


                // Total Calculation Elements
                const totalElement = document.querySelector('[data-kt-pos-element="total"]');
                const discountElement = document.querySelector('[data-kt-pos-element="discount"]');
                const taxElement = document.querySelector('[data-kt-pos-element="tax"]');
                const grandTotalElement = document.querySelector('[data-kt-pos-element="grant-total"]');

                // State Variables
                let orderItems = [];
                let orderId = generateOrderId();
                let barcodeBuffer = '';
                let timeout;
                let selectedProductRow = null;

                // Preloader for Barcode
                const barcodePreloader = document.createElement('div');
                barcodePreloader.id = 'barcodePreloader';
                barcodePreloader.classList.add('position-absolute', 'd-none', 'align-items-center', 'justify-content-center');
                barcodePreloader.style.cssText = 'top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1050; width: 50px; height: 50px;';
                barcodePreloader.innerHTML = `
                    <div class="spinner-border text-primary" role="status" style="width: 30px; height: 30px;">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                `;
                document.body.appendChild(barcodePreloader);


            // Create a dismissible alert for barcode scanner mode
            const createBarcodeAlert = () => {
                            // Remove any existing alerts first
                            const existingAlert = document.getElementById('barcodeScannerAlert');
                            if (existingAlert) {
                                existingAlert.remove();
                            }

                            // Create alert element
                            const alertDiv = document.createElement('div');
                            alertDiv.id = 'barcodeScannerAlert';
                            alertDiv.className = 'alert alert-primary alert-dismissible fade show position-fixed';
                            alertDiv.style.cssText = `
                                z-index: 1060;
                                top: 20px;
                                left: 50%;
                                transform: translateX(-50%);
                                max-width: 400px;
                                width: 90%;
                            `;
                            alertDiv.innerHTML = `
                                <strong>Barcode Scanner Mode:</strong> Scan items to add them to the order.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            `;

                            // Append to body to ensure visibility
                            document.body.appendChild(alertDiv);

                            // Initialize Bootstrap dismiss functionality
                            const alert = new bootstrap.Alert(alertDiv);

                            // Optional: Auto-dismiss after 5 seconds
                            setTimeout(() => {
                                if (alertDiv) {
                                    bootstrap.Alert.getInstance(alertDiv)?.close();
                                }
                            }, 5000);
            };




            // Utility Functions for Order Management
            const calculateTotals = () => {
                let subtotal = orderItems.reduce((total, item) => total + parseFloat(item.total), 0);
                const discount = 0; // Implement discount logic if needed
                const taxRate = 0.075; // Example: 7.5% tax
                const tax = subtotal * taxRate;
                const grandTotal = subtotal + tax - discount;

                totalElement.innerHTML = formatMoney(subtotal);
                discountElement.innerHTML = `- ${formatMoney(discount)}`;
                taxElement.innerHTML = formatMoney(tax);
                grandTotalElement.innerHTML = formatMoney(grandTotal);
            };



            const updatePrintBillsButtonState = () => {
                if (printBillsButton) {
                    printBillsButton.disabled = orderItems.length === 0;
                }
            };

            // Disable Print Bills Button Initially
            if (printBillsButton) {
                printBillsButton.disabled = true;
            }

            // Function to remove product from order
            const removeProductFromOrder = (productId) => {
                // Remove from orderItems
                orderItems = orderItems.filter(item => item.productId !== productId);

                // Remove row from table
                const rowToRemove = itemSelectedTable.querySelector(`[data-kt-ecommerce-edit-order-id="${productId}"]`);
                if (rowToRemove) {
                    rowToRemove.remove();
                }

                // Uncheck the corresponding checkbox in the product list
                const productCheckbox = document.querySelector(`#kt_ecommerce_edit_order_product_table-ajax input[value="${productId}"]`);
                if (productCheckbox) {
                    productCheckbox.checked = false;
                }

                calculateTotals();
                updatePrintBillsButtonState();
            };



            // Function to handle quantity modal
            // const handleQuantityClick = (event) => {
            //     selectedProductRow = event.target.closest('[data-kt-pos-element="item"]');

            //     if (!selectedProductRow) return;

            //     // Get current quantity
            //     const currentQuantity = selectedProductRow.querySelector('#quantityInput').value;

            //     // Get product name from row
            //     const productName = selectedProductRow.querySelector('.text-hover-primary')?.innerText || "Selected Product";

            //     // Update modal input with current quantity
            //     modalQuantityInput.value = currentQuantity;

            //     // Set product name inside modal
            //     document.getElementById('modalProductName').innerText = productName;

            //     // Show the modal
            //     const modal = new bootstrap.Modal(quantityModal);
            //     modal.show();
            // };


            // const handleQuantityClick = (event) => {
            //     selectedProductRow = event.target.closest('[data-kt-pos-element="item"]');

            //     if (!selectedProductRow) return;

            //     // Get current quantity
            //     const currentQuantity = selectedProductRow.querySelector('#quantityInput').value;

            //     // Get product name from row
            //     const productName = selectedProductRow.querySelector('.text-hover-primary')?.innerText || "Selected Product";

            //     // Update modal input with current quantity
            //     modalQuantityInput.value = currentQuantity;

            //     // Set product name inside modal
            //     document.getElementById('modalProductName').innerText = productName;

            //     // Show the modal
            //     const modal = new bootstrap.Modal(quantityModal);
            //     modal.show();

            //     // Ensure input is focused and text is fully selected
            //     setTimeout(() => {
            //         modalQuantityInput.focus();
            //         modalQuantityInput.select(); // Highlights the entire value for easy change
            //     }, 300); // Slight delay to ensure the modal is fully loaded
            // };


            const handleQuantityClick = (event) => {
                selectedProductRow = event.target.closest('[data-kt-pos-element="item"]');

                if (!selectedProductRow) return;

                // Get current quantity
                const currentQuantity = selectedProductRow.querySelector('#quantityInput').value;

                // Get product name from row
                const productName = selectedProductRow.querySelector('.text-hover-primary')?.innerText || "Selected Product";

                // Update modal input with current quantity
                modalQuantityInput.value = currentQuantity;

                // Set product name inside modal
                document.getElementById('modalProductName').innerText = productName;

                // Show the modal
                const modal = new bootstrap.Modal(quantityModal);
                modal.show();

                // Ensure input is focused and text is fully selected
                setTimeout(() => {
                    modalQuantityInput.focus();
                    modalQuantityInput.select(); // Highlights the entire value for easy change
                }, 300);
            };

            // Listen for "Enter" key press inside the quantity input
            modalQuantityInput.addEventListener('keydown', (event) => {
                if (event.key === 'Enter') {
                    event.preventDefault(); // Prevent form submission if inside a form
                    document.getElementById('updateQuantityBtn').click(); // Trigger the update button click
                }
            });

            // Ensure the Update button is always enabled
            document.getElementById('updateQuantityBtn').disabled = false;





            const updateQuantity = () => {
                if (selectedProductRow) {
                    const newQuantity = parseInt(modalQuantityInput.value);
                    const price = parseFloat(selectedProductRow.getAttribute('data-kt-pos-item-price'));

                    if (isNaN(newQuantity) || newQuantity <= 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid Quantity',
                            text: 'Please enter a valid quantity (positive integer).',
                        });
                        return;
                    }

                    const total = (newQuantity * price).toFixed(2);
                    selectedProductRow.querySelector('#quantityInput').value = newQuantity;
                    selectedProductRow.querySelector('[data-kt-pos-element="item-total"]').innerHTML = formatMoney(total);

                    // ** Update `orderItems` **
                    const productId = selectedProductRow.getAttribute('data-kt-ecommerce-edit-order-id'); // Adjust this attribute based on your setup
                    const itemIndex = orderItems.findIndex(item => item.productId == productId);

                    if (itemIndex !== -1) {
                        orderItems[itemIndex].quantity = newQuantity;
                        orderItems[itemIndex].total = total;
                    } else {
                        console.error(`Item with productId ${productId} not found in orderItems`);
                    }

                    // Recalculate totals
                    calculateTotals();
                }
            };


            // Function to add product to order
            const addProductToOrder = (product) => {
                // Check if product already exists in order
                const existingItemIndex = orderItems.findIndex(item => item.productId === product.id);

                if (existingItemIndex > -1) {
                    // Increment quantity of existing item
                    orderItems[existingItemIndex].quantity += 1;
                    orderItems[existingItemIndex].total = (
                        orderItems[existingItemIndex].quantity * product.base_price
                    ).toFixed(2);

                    // Update existing row in the table
                    const existingRow = itemSelectedTable.querySelector(`[data-kt-ecommerce-edit-order-id="${product.id}"]`);
                    if (existingRow) {
                        const quantityInput = existingRow.querySelector('.quantityInput');
                        const totalElement = existingRow.querySelector('[data-kt-pos-element="item-total"]');

                        quantityInput.value = orderItems[existingItemIndex].quantity;
                        totalElement.textContent = formatMoney(orderItems[existingItemIndex].total);
                    }
                } else {
                    // Add new product to order
                    const newItem = {
                        productId: product.id,
                        productName: product.name,
                        productPrice: product.base_price,
                        quantity: 1,
                        total: product.base_price,
                        barcode: product.sku
                    };

                    orderItems.push(newItem);

                    // Create and append new row with the desired structure
                    const row = document.createElement('tr');
                    row.setAttribute('data-barcode', product.sku);
                    row.setAttribute('data-product-id', product.id);
                    row.setAttribute('data-kt-ecommerce-edit-order-id', product.id);
                    row.setAttribute('data-kt-pos-element', 'item');
                    row.setAttribute('data-kt-pos-item-price', product.base_price);
                    row.setAttribute('data-product-name', product.name);
                    row.setAttribute('data-product-price', product.base_price);

                    const initialQuantity = 1;
                    const initialTotal = (initialQuantity * product.base_price).toFixed(2);

                    row.innerHTML = `
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="${product.id}" checked />
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center" data-kt-ecommerce-edit-order-filter="product" data-kt-ecommerce-edit-order-id="${product.id}">
                                <div class="ms-5">
                                    <a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bold">${product.name}</a>
                                    <div class="fw-semibold fs-7">Price: <span data-kt-ecommerce-edit-order-filter="price">
                                        <span class="fw-bold text-success ms-3">${formatMoney(product.base_price)}</span>
                                    </span></div>
                                    <div class="text-muted fs-7">SKU: ${product.sku}</div>
                                </div>
                            </div>
                        </td>
                        <td class="text-end pe-5" data-order="0">
                            <input type="text" id="quantityInput" value="${initialQuantity}" readonly class="form-control border-0 text-center px-0 quantityInput" style="font-size: 18px; width: 50px;">
                        </td>
                        <td class="text-end pe-5" data-order="0">
                            <span class="fw-bold text-success ms-3" data-kt-pos-element="item-total">${formatMoney(initialTotal)}</span>
                        </td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-icon btn-light-danger remove-item" type="button">
                                <i class="ki-duotone ki-cross fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </button>
                        </td>
                    `;

                    // Add event listeners to new row elements
                    const quantityInput = row.querySelector('.quantityInput');
                    quantityInput.addEventListener('click', handleQuantityClick);

                    const removeButton = row.querySelector('.remove-item');
                    removeButton.addEventListener('click', () => {
                        removeProductFromOrder(product.id);
                    });

                    // Append the row to the table
                    itemSelectedTable.appendChild(row);
                }

                calculateTotals();
                updatePrintBillsButtonState();
            };

            // Function to populate product table

            const populateTable = (products) => {
                const tbody = document.querySelector('#kt_ecommerce_edit_order_product_table-ajax tbody');
                tbody.innerHTML = ''; // Clear existing table rows

                products.forEach(product => {
                    const row = document.createElement('tr');
                    row.setAttribute('data-barcode', product.sku);
                    row.setAttribute('data-product-id', product.id);
                    row.setAttribute('data-kt-ecommerce-edit-order-id-ajax', product.id);
                    row.setAttribute('data-kt-pos-element', 'item');
                    row.setAttribute('data-kt-pos-item-price', product.base_price);
                    row.setAttribute('data-product-name', product.name);
                    row.setAttribute('data-product-price', product.base_price);

                    row.innerHTML = `
                        <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="${product.id}" />
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center" data-kt-ecommerce-edit-order-filter-ajax="product" data-kt-ecommerce-edit-order-id-ajax="${product.id}">
                                    <a href="#" class="symbol symbol-50px">
                                        <span class="symbol-label" style="background-image:url('${product.cover ? product.cover.path : '/storage/uploads/category_default.jpg'}');"></span>
                                    </a>
                                    <div class="ms-5">
                                        <a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bold">${product.name}</a>
                                        <div class="fw-semibold fs-7">Price:<span data-kt-ecommerce-edit-order-filter-ajax="price">
                                            <span class="fw-bold text-success ms-3">${formatMoney(product.base_price)}</span>
                                        </span></div>
                                        <div class="text-muted fs-7">SKU: ${product.sku}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-end pe-5 " data-order="0">
                                <span class="badge ${product.stock < product.stock_alert ? 'badge-light-danger' : 'badge-light-success'}">
                                    ${Number(product.stock)}
                                </span>
                            </td>
                            <td class="text-end pe-5" data-order="0">
                                <span>
                                        ${product.categories.map(category => category.name).join(', ')}
                                </span>
                            </td>
                            <td class="text-end pe-5" data-order="0">
                                <span>
                                 ${Number(product.status).toFixed(2)}
                                </span>
                            </td>
                             <td class="text-end pe-5" data-order="0">
                                <span>
                                   ${Number(product.discount_value).toFixed(2)}
                                </span>
                            </td>
                    `;

                    const checkbox = row.querySelector('.form-check-input');

                    // Add click event listener to the row
                    row.addEventListener('click', (e) => {
                        // Prevent triggering the checkbox toggle multiple times when clicking on the checkbox itself
                        if (e.target.tagName !== 'INPUT') {
                            checkbox.checked = !checkbox.checked;
                            if (checkbox.checked) {
                                addProductToOrder(product);
                            } else {
                                removeProductFromOrder(product.id);
                            }
                        }
                    });

                    // Append the row to the table body
                    tbody.appendChild(row);
                });
            };




            barcodeInput.addEventListener('input', (e) => {
                clearTimeout(timeout); // Reset the debounce timeout

                const inputValue = e.target.value.trim(); // Get the input value
                barcodeBuffer = inputValue;

                // Show preloader
                barcodePreloader.classList.remove('d-none');
                barcodePreloader.classList.add('d-flex');

                // Debounced function for handling input (both barcode and manual search)
                timeout = setTimeout(() => {
                    barcodeBuffer = ''; // Clear buffer after processing

                    if (!inputValue) {
                        barcodePreloader.classList.remove('d-flex');
                        barcodePreloader.classList.add('d-none');
                        Swal.fire({
                            icon: 'info',
                            title: 'No Input',
                            text: 'Please enter a barcode or search term.',
                        });
                        return;
                    }

                    // Determine if input is a barcode or a manual search term
                    const isBarcode = /^\d{12,}$/.test(inputValue); // Example: Barcode typically has 12+ numeric characters

                    fetch(`${productSearchQuery}?query=${inputValue}`)
                        .then(response => response.json())
                        .then(data => {
                            barcodePreloader.classList.remove('d-flex');
                            barcodePreloader.classList.add('d-none');

                            if (!data) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'No Data',
                                    text: 'No response received from server.',
                                });
                                return;
                            }

                            if (data.status === 'success' && data.data && data.data.length > 0) {
                                console.log("data from backend:",data.data);
                                populateTable(data.data);

                                if (isBarcode) {
                                    // Handle automatic addition for barcode scanning
                                    const product = data.data[0];
                                    const checkbox = document.querySelector(`#kt_ecommerce_edit_order_product_table-ajax input[value="${product.id}"]`);
                                    if (checkbox) {
                                        checkbox.checked = true;
                                        addProductToOrder(product);
                                    }
                                } else {
                                    // Manual search: Display results, but don't auto-add
                                    // Swal.fire({
                                    //     icon: 'success',
                                    //     title: 'Search Results',
                                    //     text: `Found ${data.data.length} product(s) matching your search.`,
                                    // });
                                }
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Product Not Found',
                                    text: 'No products found for your input.',
                                });
                            }
                        })
                        .catch(error => {
                            barcodePreloader.classList.remove('d-flex');
                            barcodePreloader.classList.add('d-none');
                            Swal.fire({
                                icon: 'error',
                                title: 'Search Error',
                                text: 'Unable to search for products. Please try again.',
                            });
                        });
                }, 300); // Adjust debounce delay as needed
            });


            const sendOrderToBackend = () => {
                const paymentMethod = document.querySelector('input[name="paymentmethod"]:checked');
                if (!paymentMethod) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Payment Method Required',
                        text: 'Please select a payment method before proceeding.',
                    });
                    return;
                }

                Swal.fire({
                    title: 'Confirm Order',
                    text: 'Are you sure you want to submit this order?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, submit it!',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(paymentStoreUrl, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            },
                            body: JSON.stringify({
                                items: orderItems,
                                payment_method: paymentMethod.value,
                            }),
                        })
                            .then(response => response.json())
                            .then(data => {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Order Submitted',
                                    text: 'Your order has been submitted successfully.',
                                }).then(() => {
                                    // Update receipt table with the order details
                                    const receiptTableBody = document.querySelector('#receiptTableBody');
                                    receiptTableBody.innerHTML = '';

                                    data.items.forEach((item, index) => {
                                        const row = document.createElement('tr');
                                        row.innerHTML = `
                                            <td>${index + 1}</td>
                                            <td>${item.product_name}</td>
                                            <td>${item.quantity}</td>
                                            <td>${formatMoney(item.price)}</td>
                                            <td>${formatMoney(item.total)}</td>
                                        `;
                                        receiptTableBody.appendChild(row);
                                    });

                                    const summaryRow = document.createElement('tr');
                                    summaryRow.classList.add('subtotal-row');
                                    summaryRow.innerHTML = `
                                        <td colspan="5">
                                            <table class="table-borderless w-100 table-fit">
                                                <tr>
                                                    <td>Sub Total :</td>
                                                    <td class="text-end">${formatMoney(data.total_amount)}</td>
                                                </tr>
                                                <tr>
                                                    <td>Discount :</td>
                                                    <td class="text-end">${formatMoney(data.discount)}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total Payable :</td>
                                                    <td class="text-end">${formatMoney(data.total_amount)}</td>
                                                </tr>
                                            </table>
                                        </td>
                                    `;
                                    receiptTableBody.appendChild(summaryRow);

                                    // Update receipt information
                                    document.querySelector('#receiptOrderId').textContent = data.order_id;
                                    document.querySelector('#receiptGrandTotal').textContent = formatMoney(data.grand_total);
                                    document.querySelector('#invoiceUserName').textContent = data.customer_name || 'N/A';
                                    document.querySelector('#invoiceNumber').textContent = data.invoice_id.invoice_no || 'N/A';
                                    document.querySelector('#orderId').textContent = data.order_id || 'N/A';
                                    document.querySelector('#invoiceDate').textContent = data.date || new Date().toLocaleDateString();

                                    printPreviewModal.show();

                                });
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Submission Failed',
                                    text: 'There was an error submitting your order. Please try again.',
                                });
                            });
                    }
                });
            };


            // Handle clear all action
            clearAllButton.addEventListener('click', () => {
                orderItems = [];
                itemSelectedTable.innerHTML = '';
                calculateTotals();
                updatePrintBillsButtonState();

                // Uncheck all checkboxes in product list
                const productCheckboxes = document.querySelectorAll('#kt_ecommerce_edit_order_product_table-ajax input[type="checkbox"]');
                productCheckboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
            });


                    // Initialize modal update button
                updateQuantityBtn.addEventListener('click', updateQuantity);





                    // Print Bills Button
                    if (printBillsButton) {
                        printBillsButton.addEventListener('click', sendOrderToBackend);
                    }

                    // Print Slip Button
                    printSlipButton.addEventListener('click', () => {
                        // Show the print preview
                        window.print();

                        // Reload the window after the print window is closed
                        window.onafterprint = () => {
                            location.reload(); // Reload the current page
                        };

                        // Hide the print preview modal
                        printPreviewModal.hide();
                    });


                      // Listen for when the modal is shown
                      printPreviewModal._element.addEventListener('shown.bs.modal', function () {
                        clearItems();
                    });



});


    // Submit form handler
    const handleSubmit = () => {
        // Define variables
        let validator;

        // Get elements
        const form = document.getElementById('kt_ecommerce_edit_order_form');
        const submitButton = document.getElementById('kt_ecommerce_edit_order_submit');

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'payment_method': {
                        validators: {
                            notEmpty: {
                                message: 'Payment method is required'
                            }
                        }
                    },
                    'shipping_method': {
                        validators: {
                            notEmpty: {
                                message: 'Shipping method is required'
                            }
                        }
                    },
                    'order_date': {
                        validators: {
                            notEmpty: {
                                message: 'Order date is required'
                            }
                        }
                    },
                    'billing_order_address_1': {
                        validators: {
                            notEmpty: {
                                message: 'Address line 1 is required'
                            }
                        }
                    },
                    'billing_order_postcode': {
                        validators: {
                            notEmpty: {
                                message: 'Postcode is required'
                            }
                        }
                    },
                    'billing_order_state': {
                        validators: {
                            notEmpty: {
                                message: 'State is required'
                            }
                        }
                    },
                    'billing_order_country': {
                        validators: {
                            notEmpty: {
                                message: 'Country is required'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );

        // Handle submit button
        submitButton.addEventListener('click', e => {
            e.preventDefault();

            // Validate form before submit
            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');

                    if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');

                        // Disable submit button whilst loading
                        submitButton.disabled = true;

                        setTimeout(function () {
                            submitButton.removeAttribute('data-kt-indicator');

                            Swal.fire({
                                text: "Form has been successfully submitted!",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            }).then(function (result) {
                                if (result.isConfirmed) {
                                    // Enable submit button after loading
                                    submitButton.disabled = false;

                                    // Redirect to customers list page
                                    window.location = form.getAttribute("data-kt-redirect");
                                }
                            });
                        }, 2000);
                    } else {
                        Swal.fire({
                            html: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                });
            }
        })
    }


    // Public methods
    return {
        init: function () {

            initSaveOrder();
            handleSearchDatatable();
            handleShippingForm();
            handleProductSelect();
            handleSubmit();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTAppEcommerceSalesSaveOrder.init();
});
