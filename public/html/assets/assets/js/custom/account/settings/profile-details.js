"use strict";

// Class definition
var KTAccountSettingsProfileDetails = function () {
    // Private variables
    var form;
    var submitButton;
    var validation;

    // Private functions
    var initValidation = function () {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
            form,
            {
                fields: {
                    admissionNo: {
                        validators: {
                            notEmpty: {
                                message: 'Admission Number is required'
                            }
                        }
                    },
                    // avatar: {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'Student Picture required'
                    //         }
                    //     }
                    // },
                    title: {
                        validators: {
                            notEmpty: {
                                message: 'Title is required'
                            }
                        }
                    },
                    firstname: {
                        validators: {
                            notEmpty: {
                                message: 'First Name is required'
                            }
                        }
                    },
                    lastname: {
                        validators: {
                            notEmpty: {
                                message: 'Last name is required'
                            }
                        }
                    },
                    othername: {
                        validators: {
                            notEmpty: {
                                message: 'Other Name is required'
                            }
                        }
                    },
                    home_address: {
                        validators: {
                            notEmpty: {
                                message: 'Home Address 1 is required'
                            }
                        }
                    },
                    home_address2: {
                        validators: {
                            notEmpty: {
                                message: 'Home Address 2 is required'
                            }
                        }
                    },
                    dateofbirth: {
                        validators: {
                            notEmpty: {
                                message: 'Date Of Birth is required'
                            }
                        }
                    },
                    ag1: {
                        validators: {
                            notEmpty: {
                                message: 'Age is required'
                            }
                        }
                    },
                    Placeofbirth: {
                        validators: {
                            notEmpty: {
                                message: 'Place of Birth is required'
                            }
                        }
                    },
                    nationality: {
                        validators: {
                            notEmpty: {
                                message: 'Nationality is required'
                            }
                        }
                    },


                    state: {
                        validators: {
                            notEmpty: {
                                message: 'State is required'
                            }
                        }
                    },
                    local: {
                        validators: {
                            notEmpty: {
                                message: 'Local Goverment Name is required'
                            }
                        }
                    },
                    religion: {
                        validators: {
                            notEmpty: {
                                message: 'Religion is required'
                            }
                        }
                    },
                    last_school: {
                        validators: {
                            notEmpty: {
                                message: 'Last School Attended is required'
                            }
                        }
                    },
                    last_class: {
                        validators: {
                            notEmpty: {
                                message: 'Last Class attended is required'
                            }
                        }
                    },

                    'gender[]': {
                        validators: {
                            notEmpty: {
                                message: 'Please select at least one gender'
                            }
                        }
                    },
                    schoolclassid: {
                        validators: {
                            notEmpty: {
                                message: 'School Class is required'
                            }
                        }
                    },
                    sessionid: {
                        validators: {
                            notEmpty: {
                                message: 'Session   is required'
                            }
                        }
                    },

                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );

        // Select2 validation integration
        // $(form.querySelector('[name="country"]')).on('change', function() {
        //     // Revalidate the color field when an option is chosen
        //     validation.revalidateField('country');
        // });

        // $(form.querySelector('[name="language"]')).on('change', function() {
        //     // Revalidate the color field when an option is chosen
        //     validation.revalidateField('language');
        // });

        // $(form.querySelector('[name="timezone"]')).on('change', function() {
        //     // Revalidate the color field when an option is chosen
        //     validation.revalidateField('timezone');
        // });
    }

    var handleForm = function () {
        submitButton.addEventListener('click', function (e) {
            e.preventDefault();

            validation.validate().then(function (status) {
                if (status == 'Valid') {

                    swal.fire({
                        text: "Thank you! You've updated your basic info",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-light-primary"
                        }
                    });

                } else {
                    swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-light-primary"
                        }
                    });
                }
            });
        });
    }

    // Public methods
    return {
        init: function () {
            form = document.getElementById('kt_account_profile_details_form');

            if (!form) {
                return;
            }

            submitButton = form.querySelector('#kt_account_profile_details_submit');

            initValidation();
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTAccountSettingsProfileDetails.init();
});


