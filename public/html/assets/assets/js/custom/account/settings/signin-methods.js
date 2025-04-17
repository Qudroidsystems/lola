"use strict";

// Class definition
var KTAccountSettingsSigninMethods = function () {
    var signInForm;
    var signInMainEl;
    var signInEditEl;
    var passwordMainEl;
    var passwordEditEl;
    var signInChangeEmail;
    var signInCancelEmail;
    var passwordChange;
    var passwordCancel;

    var toggleChangeEmail = function () {
        signInMainEl.classList.toggle('d-none');
        signInChangeEmail.classList.toggle('d-none');
        signInEditEl.classList.toggle('d-none');
    }

    var toggleChangePassword = function () {
        passwordMainEl.classList.toggle('d-none');
        passwordChange.classList.toggle('d-none');
        passwordEditEl.classList.toggle('d-none');
    }

    // Private functions
    var initSettings = function () {
        if (!signInMainEl) {
            return;
        }

        // toggle UI
        signInChangeEmail.querySelector('button').addEventListener('click', function () {
            toggleChangeEmail();
        });

        signInCancelEmail.addEventListener('click', function () {
            toggleChangeEmail();
        });

        passwordChange.querySelector('button').addEventListener('click', function () {
            toggleChangePassword();
        });

        passwordCancel.addEventListener('click', function () {
            toggleChangePassword();
        });
    }

    var handleChangeEmail = function (e) {
        var validation;

        if (!signInForm) {
            return;
        }

        validation = FormValidation.formValidation(
            signInForm,
            {
                fields: {
                   schoolclassid: {
                        validators: {
                            notEmpty: {
                                message: 'School Class required'
                             }
                            }
                          },
                      termid: {
                            validators: {
                                notEmpty: {
                                    message: 'Session is required'
                                }
                            }
                        },
                    sessionid: {
                        validators: {
                            notEmpty: {
                                message: 'Session is required'
                            }
                        }
                    }
                },

                plugins: { //Learn more: https://formvalidation.io/guide/plugins
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row'
                    })
                }
            }
        );

        signInForm.querySelector('#kt_signin_submit').addEventListener('click', function (e) {
            e.preventDefault();
            console.log('click');
        var userid = document.getElementById("userid").value;
        var emailaddress = document.getElementById("emailaddress").value;
            validation.validate().then(function (status) {
                if (status == 'Valid') {
                    $.ajaxSetup({
                        headers: {
                                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                     });
                  //  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url     :"/ajaxemailupdate",
                        data: {userid:userid,emailaddress:emailaddress},
                        dataType: 'JSON',
                        success: function (results) {
                            if (results.success) {
                                swal.fire({
                                    text: " " + results.message,
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn font-weight-bold btn-light-primary"
                                    }
                                }).then(function(){
                                    // refresh page after 2 seconds
                                    setTimeout(function(){
                                    location.reload();
                                    },500);
                                    signInForm.reset();
                                    validation.resetForm(); // Reset formvalidation --- more info: https://formvalidation.io/guide/api/reset-form/
                                    toggleChangeEmail();
                                });

                            } else {
                               console.log(results);
                                swal.fire("Error!", results.message, "error");
                            }
                        }
                    });

                } else {
                    swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    });
                }
            });
        });
    }

    var handleChangePassword = function (e) {
        var validation;

        // form elements
        var passwordForm = document.getElementById('kt_signin_change_password');

        if (!passwordForm) {
            return;
        }

        validation = FormValidation.formValidation(
            passwordForm,
            {
                fields: {
                    currentpassword: {
                        validators: {
                            notEmpty: {
                                message: 'Current Password is required'
                            }
                        }
                    },

                    newpassword: {
                        validators: {
                            notEmpty: {
                                message: 'New Password is required'
                            }
                        }
                    },

                    confirmpassword: {
                        validators: {
                            notEmpty: {
                                message: 'Confirm Password is required'
                            },
                            identical: {
                                compare: function() {
                                    return passwordForm.querySelector('[name="newpassword"]').value;
                                },
                                message: 'The password and its confirm are not the same'
                            }
                        }
                    },
                },

                plugins: { //Learn more: https://formvalidation.io/guide/plugins
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row'
                    })
                }
            }
        );

        passwordForm.querySelector('#kt_password_submit').addEventListener('click', function (e) {
            e.preventDefault();
            console.log('click');
            var userid = document.getElementById("pid").value;
            var npword = document.getElementById("newpassword").value;


            validation.validate().then(function (status) {
                if (status == 'Valid') {
                    $.ajaxSetup({
                        headers: {
                                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                     });

                    $.ajax({
                        type: 'POST',
                        url     :"/ajaxpasswordupdate",
                        data: {userid:userid,password:npword},
                        dataType: 'JSON',
                        success: function (results) {
                            if (results.success) {
                                swal.fire({
                                    text: " "+ results.message,
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn font-weight-bold btn-light-primary"
                                    }
                                }).then(function(){
                                    // refresh page after 2 seconds
                                    setTimeout(function(){
                                    location.reload();
                                    },500);
                                    signInForm.reset();
                                    validation.resetForm(); // Reset formvalidation --- more info: https://formvalidation.io/guide/api/reset-form/
                                    toggleChangeEmail();
                                });

                            } else {
                               console.log(results);
                                swal.fire("Error!", results.message, "error");
                            }
                        }
                    });

                } else {
                    swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    });
                }
            });
        });
    }

    // Public methods
    return {
        init: function () {
            signInForm = document.getElementById('kt_signin_change_email');
            signInMainEl = document.getElementById('kt_signin_email');
            signInEditEl = document.getElementById('kt_signin_email_edit');
            passwordMainEl = document.getElementById('kt_signin_password');
            passwordEditEl = document.getElementById('kt_signin_password_edit');
            signInChangeEmail = document.getElementById('kt_signin_email_button');
            signInCancelEmail = document.getElementById('kt_signin_cancel');
            passwordChange = document.getElementById('kt_signin_password_button');
            passwordCancel = document.getElementById('kt_password_cancel');

            initSettings();
            handleChangeEmail();
            handleChangePassword();
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTAccountSettingsSigninMethods.init();
});
