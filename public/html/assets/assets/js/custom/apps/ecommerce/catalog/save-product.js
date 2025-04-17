"use strict";

// Class definition
var KTAppEcommerceSaveProduct = function () {

            // Private functions
            document.getElementById('images').addEventListener('change', function(event) {
                let previewContainer = document.getElementById('imagePreview');
                previewContainer.innerHTML = ""; // Clear previous previews

                Array.from(event.target.files).forEach((file, index) => {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        let wrapper = document.createElement('div');
                        wrapper.className = "preview-wrapper";

                        let img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = "preview-img";

                        let removeBtn = document.createElement('button');
                        removeBtn.className = "remove-btn";
                        removeBtn.innerHTML = "×";
                        removeBtn.onclick = function() {
                            wrapper.remove();
                        };

                        wrapper.appendChild(img);
                        wrapper.appendChild(removeBtn);
                        previewContainer.appendChild(wrapper);
                    };
                    reader.readAsDataURL(file);
                });
            });



    // // Init quill editor
    // const initQuill = () => {
    //     // Define all elements for quill editor
    //     const elements = [
    //         '#kt_ecommerce_add_product_description',
    //         '#kt_ecommerce_add_product_meta_description'
    //     ];

    //     // Loop all elements
    //     elements.forEach(element => {
    //         // Get quill element
    //         let quill = document.querySelector(element);

    //         // Break if element not found
    //         if (!quill) {
    //             return;
    //         }

    //         // Init quill --- more info: https://quilljs.com/docs/quickstart/
    //         quill = new Quill(element, {
    //             modules: {
    //                 toolbar: [
    //                     [{
    //                         header: [1, 2, false]
    //                     }],
    //                     ['bold', 'italic', 'underline'],
    //                     ['image', 'code-block']
    //                 ]
    //             },
    //             placeholder: 'Type your text here...',
    //             theme: 'snow' // or 'bubble'
    //         });
    //     });
    // }


            // Init quill editor
        const initQuill = () => {
            // Define all elements for quill editor
            const elements = [
                '#kt_ecommerce_add_product_description',
                //'#kt_ecommerce_add_product_meta_description'
            ];

            const form = document.getElementById('kt_ecommerce_add_product_form');

            // Loop all elements
            elements.forEach(selector => {
                // Get quill container element
                const container = document.querySelector(selector);

                // Break if element not found
                if (!container) return;

                // Init quill
                const quill = new Quill(selector, {
                    modules: {
                        toolbar: [
                            [{
                                header: [1, 2, false]
                            }],
                            ['bold', 'italic', 'underline'],
                            ['image', 'code-block']
                        ]
                    },
                    placeholder: 'Type your text here...',
                    theme: 'snow'
                });

                // Get corresponding textarea ID
                // const textareaId = selector.split('_').pop();
                // const textarea = document.getElementById(textareaId);
                const textarea = document.getElementById('description');

                // Update textarea on content change
                quill.on('text-change', () => {
                    if (textarea) {
                        textarea.value = quill.root.innerHTML;
                    }
                });

                // Update textarea before form submission
                if (form) {
                    form.addEventListener('submit', () => {
                        textarea.value = quill.root.innerHTML;
                    });
                }
            });
        };



    // Init tagify
    const initTagify = () => {

        const tagsInput = document.querySelector('#kt_ecommerce_add_product_tags');
    const _tagsInput = document.querySelector('#_tags');

    if (tagsInput && _tagsInput) {
        // Parse the _tags input value into an array of objects
        const tagsData = JSON.parse(_tagsInput.value);

        // Map the tagsData into a format Tagify accepts (whitelist of strings with additional data)
        const tagsWhitelist = tagsData.map(tag => ({
            value: tag.name, // Tag name for display
            id: tag.id       // Tag ID for submission
        }));

        // Initialize Tagify on the tags input
        const tagify = new Tagify(tagsInput, {
            whitelist: tagsWhitelist,
            dropdown: {
                maxItems: 20,           // Maximum allowed rendered suggestions
                classname: "tagify__inline__suggestions", // Custom class for styling
                enabled: 0,             // Show suggestions on focus
                closeOnSelect: false    // Do not close the suggestions dropdown after selecting an item
            }
        });

        // Sync tagify data to a hidden input for submission
        tagify.on('change', function () {
            // Extract IDs of selected tags
            const selectedTags = tagify.value.map(tag => tag.id);

            // Create a hidden input to store the selected IDs
            document.querySelector('#selected_tag_ids').value = JSON.stringify(selectedTags);
        });
    }

    }

    // Init form repeater --- more info: https://github.com/DubFriend/jquery.repeater
    const initFormRepeater = () => {
        $('#kt_ecommerce_add_product_options').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function () {
                $(this).slideDown();

                // Init select2 on new repeated items
                initConditionsSelect2();
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    }

    // Init condition select2
    const initConditionsSelect2 = () => {
        // Tnit new repeating condition types
        const allConditionTypes = document.querySelectorAll('[data-kt-ecommerce-catalog-add-product="product_option"]');
        allConditionTypes.forEach(type => {
            if ($(type).hasClass("select2-hidden-accessible")) {
                return;
            } else {
                $(type).select2({
                    minimumResultsForSearch: -1
                });
            }
        });
    }


    // // Init noUIslider
    // const initSlider = () => {
    //     var slider = document.querySelector("#kt_ecommerce_add_product_discount_slider");
    //     var value = document.querySelector("#kt_ecommerce_add_product_discount_label");

    //     noUiSlider.create(slider, {
    //         start: [10],
    //         connect: true,
    //         range: {
    //             "min": 1,
    //             "max": 100
    //         }
    //     });

    //     slider.noUiSlider.on("update", function (values, handle) {
    //         value.innerHTML = Math.round(values[handle]);
    //         if (handle) {
    //             value.innerHTML = Math.round(values[handle]);
    //         }
    //     });
    // }

    // Init DropzoneJS --- more info:
    const initDropzone = () => {
        var myDropzone = new Dropzone("#kt_ecommerce_add_product_media", {
            url: "https://keenthemes.com/scripts/void.php", // Set the url for your upload script location
            paramName: "gallery", // The name that will be used to transfer the file
            maxFiles: 10,
            maxFilesize: 10, // MB
            addRemoveLinks: true,
            accept: function (file, done) {
                if (file.name == "wow.jpg") {
                    done("Naha, you don't.");
                } else {
                    done();
                }
            }
        });
    }

    // Handle discount options
    // const handleDiscount = () => {
    //     const discountOptions = document.querySelectorAll('input[name="discount_option"]');
    //     const percentageEl = document.getElementById('kt_ecommerce_add_product_discount_percentage');
    //     const fixedEl = document.getElementById('kt_ecommerce_add_product_discount_fixed');

    //     discountOptions.forEach(option => {
    //         option.addEventListener('change', e => {
    //             const value = e.target.value;

    //             switch (value) {
    //                 case '2': {
    //                     percentageEl.classList.remove('d-none');
    //                     fixedEl.classList.add('d-none');
    //                     break;
    //                 }
    //                 case '3': {
    //                     percentageEl.classList.add('d-none');
    //                     fixedEl.classList.remove('d-none');
    //                     break;
    //                 }
    //                 default: {
    //                     percentageEl.classList.add('d-none');
    //                     fixedEl.classList.add('d-none');
    //                     break;
    //                 }
    //             }
    //         });
    //     });
    // }

    // Shipping option handler
    // const handleShipping = () => {
    //     const shippingOption = document.getElementById('kt_ecommerce_add_product_shipping_checkbox');
    //     const shippingForm = document.getElementById('kt_ecommerce_add_product_shipping');

    //     shippingOption.addEventListener('change', e => {
    //         const value = e.target.checked;

    //         if (value) {
    //             shippingForm.classList.remove('d-none');
    //         } else {
    //             shippingForm.classList.add('d-none');
    //         }
    //     });
    // }

    // Category status handler
    const handleStatus = () => {
        const target = document.getElementById('kt_ecommerce_add_product_status');
        const select = document.getElementById('kt_ecommerce_add_product_status_select');
        const statusClasses = ['bg-success', 'bg-warning', 'bg-danger'];

        $(select).on('change', function (e) {
            const value = e.target.value;

            switch (value) {
                case "published": {
                    target.classList.remove(...statusClasses);
                    target.classList.add('bg-success');
                    hideDatepicker();
                    break;
                }
                case "scheduled": {
                    target.classList.remove(...statusClasses);
                    target.classList.add('bg-warning');
                    showDatepicker();
                    break;
                }
                case "inactive": {
                    target.classList.remove(...statusClasses);
                    target.classList.add('bg-danger');
                    hideDatepicker();
                    break;
                }
                case "draft": {
                    target.classList.remove(...statusClasses);
                    target.classList.add('bg-primary');
                    hideDatepicker();
                    break;
                }
                default:
                    break;
            }
        });


        // Handle datepicker
        const datepicker = document.getElementById('kt_ecommerce_add_product_status_datepicker');

        // Init flatpickr --- more info: https://flatpickr.js.org/
        $('#kt_ecommerce_add_product_status_datepicker').flatpickr({
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });

        const showDatepicker = () => {
            datepicker.parentNode.classList.remove('d-none');
        }

        const hideDatepicker = () => {
            datepicker.parentNode.classList.add('d-none');
        }
    }

    // Condition type handler
    const handleConditions = () => {
        const allConditions = document.querySelectorAll('[name="method"][type="radio"]');
        const conditionMatch = document.querySelector('[data-kt-ecommerce-catalog-add-category="auto-options"]');
        allConditions.forEach(radio => {
            radio.addEventListener('change', e => {
                if (e.target.value === '1') {
                    conditionMatch.classList.remove('d-none');
                } else {
                    conditionMatch.classList.add('d-none');
                }
            });
        })
    }

    // Submit form handler
    const handleSubmit = () => {
        // Define variables
        let validator;

        // Get elements
        const form = document.getElementById('kt_ecommerce_add_product_form');
        const submitButton = document.getElementById('kt_ecommerce_add_product_submit');

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'name': {
                        validators: {
                            notEmpty: {
                                message: 'Product name is required'
                            }
                        }
                    },
                    'sku': {
                        validators: {
                            notEmpty: {
                                message: 'SKU is required'
                            }
                        }
                    },
                    'barcode': {
                        validators: {
                            notEmpty: {
                                message: 'Product barcode is required'
                            }
                        }
                    },
                    'stock': {
                        validators: {
                            notEmpty: {
                                message: 'Shelf quantity is required'
                            }
                        }
                    },
                    'stock_alert': {
                        validators: {
                            notEmpty: {
                                message: 'Stock alert is required'
                            }
                        }
                    },
                    'tax': {
                        validators: {
                            notEmpty: {
                                message: 'Product tax class is required'
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

    //           // Get all repeater items
    // const repeaterItems = document.querySelectorAll('.repeater-item');


    // // Loop through each repeater item
    // repeaterItems.forEach((item, index) => {
    //     // Get the discount type select element for each item
    //     const discountType = item.querySelector('select[name="discounttype"]');
    //      if (repeaterItems){
    //     alert(repeaterItems.item.toString())
    //      }
    //     const percentageInput = item.querySelector('input[name="percentage"]');
    //     const fixedInput = item.querySelector('input[name="fixed"]');
    //     alert(percentageInput)

    //     // Add an event listener to the submit button for each form
    //     const submitButton = document.getElementById('kt_ecommerce_add_product_submit');

    //     submitButton.addEventListener('click', e => {
    //         e.preventDefault();

    //         // Validate discount type and inputs
    //         let isValid = true;
    //         const discountTypeValue = discountType.value;

    //         if (discountTypeValue === 'percentage') {
    //             if (!percentageInput.value || parseFloat(percentageInput.value) <= 0) {
    //                 isValid = false;
    //                 Swal.fire({
    //                     icon: 'error',
    //                     title: 'Invalid Input',
    //                     text: 'Please enter a valid percentage value for the discount.',
    //                 });
    //             }
    //         } else if (discountTypeValue === 'fixed') {
    //             if (!fixedInput.value || parseFloat(fixedInput.value) <= 0) {
    //                 isValid = false;
    //                 Swal.fire({
    //                     icon: 'error',
    //                     title: 'Invalid Input',
    //                     text: 'Please enter a valid fixed discount value.',
    //                 });
    //             }
    //         }

    //         // If valid, submit the form
    //         if (isValid) {
    //             // Your form submission logic goes here
    //             console.log('Form is valid');
    //             // You can submit the form or perform other actions here
    //         }
    //     });
    // });


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
                                    // window.location = form.getAttribute("data-kt-redirect");
                                    form.submit();
                                }
                            });
                        }, 2000);
                    } else {
                        Swal.fire({
                            html: "Sorry, looks like there are some errors detected, please try again. <br/><br/>Please note that there may be errors in the <strong>General</strong> or <strong>Advanced</strong> tabs",
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
            // Init forms
            initQuill();
            initTagify();
           // initSlider();
            initFormRepeater();
            initDropzone();
            initConditionsSelect2();

            // Handle forms
            handleStatus();
            handleConditions();
            // handleDiscount();
            // handleShipping();
            handleSubmit();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTAppEcommerceSaveProduct.init();
});






