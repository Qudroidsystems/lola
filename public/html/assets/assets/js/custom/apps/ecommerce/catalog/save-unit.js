"use strict";

// Class definition
var KTAppEcommerceSaveCategory = function () {

    // Private functions

    // Init quill editor
    // const initQuill = () => {
    //     // Define all elements for quill editor
    //     const elements = [
    //         '#kt_ecommerce_add_category_description',
    //         '#kt_ecommerce_add_category_meta_description'
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

    // Init tagify
    const initTagify = () => {
        // Define all elements for tagify
        const elements = [
            '#kt_ecommerce_add_category_meta_keywords'
        ];

        // Loop all elements
        elements.forEach(element => {
            // Get tagify element
            const tagify = document.querySelector(element);

            // Break if element not found
            if (!tagify) {
                return;
            }

            // Init tagify --- more info: https://yaireo.github.io/tagify/
            new Tagify(tagify);
        });
    }

    // Init form repeater --- more info: https://github.com/DubFriend/jquery.repeater
    // const initFormRepeater = () => {
    //     $('#kt_ecommerce_add_category_conditions').repeater({
    //         initEmpty: false,

    //         defaultValues: {
    //             'text-input': 'foo'
    //         },

    //         show: function () {
    //             $(this).slideDown();

    //             // Init select2 on new repeated items
    //             initConditionsSelect2();
    //         },

    //         hide: function (deleteElement) {
    //             $(this).slideUp(deleteElement);
    //         }
    //     });
    // }

    // Init condition select2
    const initConditionsSelect2 = () => {
        // Tnit new repeating condition types
        const allConditionTypes = document.querySelectorAll('[data-kt-ecommerce-catalog-add-category="condition_type"]');
        allConditionTypes.forEach(type => {
            if ($(type).hasClass("select2-hidden-accessible")) {
                return;
            } else {
                $(type).select2({
                    minimumResultsForSearch: -1
                });
            }
        });

        // Tnit new repeating condition equals
        const allConditionEquals = document.querySelectorAll('[data-kt-ecommerce-catalog-add-category="condition_equals"]');
        allConditionEquals.forEach(equal => {
            if ($(equal).hasClass("select2-hidden-accessible")) {
                return;
            } else {
                $(equal).select2({
                    minimumResultsForSearch: -1
                });
            }
        });
    }

    // Category status handler
    const handleStatus = () => {
        const target = document.getElementById('kt_ecommerce_add_category_status');
        const select = document.getElementById('kt_ecommerce_add_category_status_select');
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
                case "unpublished": {
                    target.classList.remove(...statusClasses);
                    target.classList.add('bg-danger');
                    hideDatepicker();
                    break;
                }
                default:
                    break;
            }
        });


        // Handle datepicker
        const datepicker = document.getElementById('kt_ecommerce_add_category_status_datepicker');

        // Init flatpickr --- more info: https://flatpickr.js.org/
        $('#kt_ecommerce_add_category_status_datepicker').flatpickr({
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
        let quill2;

        // Get elements
        const form = document.getElementById('kt_ecommerce_add_category_form');
        const submitButton = document.getElementById('kt_ecommerce_add_category_submit');
         // Define all elements for quill editor
         const elements = [
            '#kt_ecommerce_add_category_description',
            '#kt_ecommerce_add_category_meta_description'
        ];

        const editorElement2 = document.getElementById('kt_ecommerce_add_category_meta_description');
        const hiddenInput2 = document.getElementById('meta_tag_description');

        quill2 = new Quill(editorElement2, {
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
            theme: 'snow' // or 'bubble'
        });

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'name': {
                        validators: {
                            notEmpty: {
                                message: 'Brand name is required'
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
            hiddenInput2.value = quill2.root.innerHTML;
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
                            text: "Sorry, looks like there are some errors detected, please try again.",
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
            //initQuill();
            initTagify();
            // initFormRepeater();
            // initConditionsSelect2();

            // Handle forms
            // handleStatus();
            handleConditions();
            handleSubmit();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTAppEcommerceSaveCategory.init();
});
