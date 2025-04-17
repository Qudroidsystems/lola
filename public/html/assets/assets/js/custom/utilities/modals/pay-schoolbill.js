"use strict";

// Class definition
var KTModalNewCard = function () {
	var submitButton;
	var cancelButton;
	var validator;
	var form;
	var modal;
	var modalEl;

	// Init form inputs
	var initForm = function() {
		// Expiry month. For more info, plase visit the official plugin site: https://select2.org/
        $(form.querySelector('[name="card_expiry_month"]')).on('change', function() {
            // Revalidate the field when an option is chosen
            validator.revalidateField('card_expiry_month');
        });

		// Expiry year. For more info, plase visit the official plugin site: https://select2.org/
        $(form.querySelector('[name="card_expiry_year"]')).on('change', function() {
            // Revalidate the field when an option is chosen
            validator.revalidateField('card_expiry_year');
        });
	}

	// Handle form validation and submission
	var handleForm = function() {
		// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
		validator = FormValidation.formValidation(
			form,
			{
				fields: {
                    'actual_amount': {
                        validators: {
                            notEmpty: {
                                message: 'Actual amount is required'
                            },

                        }
                    },
					'payment_amount2': {
						validators: {
							notEmpty: {
								message: 'Amount is required'
							},
							digits: {
								message: 'Amount must contain only digits'
							},
					     }
					},
                    'payment_method2': {
						validators: {
							notEmpty: {
								message: 'Select an Option'
							},
							// digits: {
							// 	message: 'Amount must contain only digits'
							// },
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

        function getFormattedNumber() {
            const inputValue = document.getElementById('payment_amount').value;
            // Remove commas
            const plainNumber = parseFloat(inputValue.replace(/,/g, ''));

            return plainNumber;
           }


		// Action buttons
		submitButton.addEventListener('click', function (e) {
			// Prevent default button action
			e.preventDefault();

			// Validate form before submit
			if (validator) {
				validator.validate().then(function (status) {
					console.log('validated!');

                    // get the payment data from the form
                    const payment = parseFloat(document.getElementById('payment_amount2').value);
                    const balance = parseFloat(document.getElementById('balance2').value);

                    const actual = parseFloat(document.getElementById('actual_amount').value);

                     if(payment > balance){

                         alert("Payment amount cannot be more than Outstanding amount");
                         return false;
                     }
					if (status == 'Valid') {
						// Show loading indication
						submitButton.setAttribute('data-kt-indicator', 'on');

						// Disable button to avoid multiple clicks
						submitButton.disabled = true;

						// Simulate form submission
						setTimeout(function() {
							// Remove loading indication
							submitButton.removeAttribute('data-kt-indicator');

							// Enable button
							submitButton.disabled = false;

							// Show popup confirmation
							Swal.fire({
								text: "Payment Made Successfully",
								icon: "success",
								buttonsStyling: false,
								confirmButtonText: "Ok, got it!",
								customClass: {
									confirmButton: "btn btn-primary"
								}
							}).then(function (result) {
								if (result.isConfirmed) {
									modal.hide();
								}
							});

							form.submit(); // Submit form
						}, 2000);
					} else {
						// Show popup warning
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
		});

		cancelButton.addEventListener('click', function (e) {
			e.preventDefault();

			// Show confirmation message
			Swal.fire({
				text: "Are you sure you would like to cancel?",
				icon: "warning",
				showCancelButton: true,
				buttonsStyling: false,
				confirmButtonText: "Yes, cancel it!",
				cancelButtonText: "No, return",
				customClass: {
					confirmButton: "btn btn-primary",
					cancelButton: "btn btn-active-light"
				}
			}).then(function (result) {
				if (result.value) {
					form.reset(); // Reset form
					modal.hide(); // Hide modal
				} else if (result.dismiss === 'cancel') {
					// Show error message
					Swal.fire({
						text: "Your form has not been cancelled!.",
						icon: "error",
						buttonsStyling: false,
						confirmButtonText: "Ok, got it!",
						customClass: {
							confirmButton: "btn btn-primary",
						}
					});
				}
			});
		});
	}

	// Capture data-id and display it in the modal
	var handleModal = function() {
		modalEl.addEventListener('show.bs.modal', function(event) {
			var button = event.relatedTarget; // Button that triggered the modal
			var id = button.getAttribute('data-student_id'); // Extract data-student_id
            var amount =  button.getAttribute('data-amount'); // Extract data-amount
            var amount_actual =  button.getAttribute('data-amount_actual'); // Extract data-amount
            var amountpaid =  button.getAttribute('data-amount_paid'); // Extract data-amount_paid
            var balance =  button.getAttribute('data-balance'); // Extract data-balance
            var school_bill_id =  button.getAttribute('data-school_bill_id'); // Extract data-school_bill_id
            var class_id =  button.getAttribute('data-class_id'); // Extract data-schoolclass_id
            var term_id =  button.getAttribute('data-term_id'); // Extract data-term_id
            var session_id =  button.getAttribute('data-session_id'); // Extract data-session_id


            // Update the input field in the modal
			var inputField = modalEl.querySelector('#student_id');
			if (inputField) {
				inputField.value = id;
			}

			// Update the input field in the modal
			var inputField = modalEl.querySelector('#school_bill_id');
			if (inputField) {
				inputField.value = school_bill_id;
			}

           // Display the value in the div with id 'amount_d'
            var amountDiv = modalEl.querySelector('#amount_d');
            var actual_amountInput = modalEl.querySelector('#actual_amount');
            if (amountDiv) {
                amountDiv.innerText = '₦'+ amount;
                actual_amountInput.value = parseFloat(amount_actual);
            }

            // Display the value in the div with id 'amount_paid_d'
            var amountPaidDiv = modalEl.querySelector('#amount_paid_d');
            if (amountPaidDiv) {
                amountPaidDiv.innerText ='Amount Paid: ₦'+ amountpaid;
            }

            // Display the value in the div with id 'balance_d'
            var balanceDiv = modalEl.querySelector('#balance_d');
            var balanceInput = modalEl.querySelector('#balance2');
            if (balanceDiv) {
                balanceDiv.innerText ='Outstanding: ₦' + balance;
                balanceInput.value = parseFloat(balance.replace(/,/g, ''));
            }

                 // Update the input field in the modal
			var schoolclassField = modalEl.querySelector('#class_id');
			if (schoolclassField) {
				schoolclassField.value = class_id;
			}

                 // Update the input field in the modal
			var termField = modalEl.querySelector('#term_id');
			if (termField) {
				termField.value = term_id;
			}

                 // Update the input field in the modal
			var sessionField = modalEl.querySelector('#session_id');
			if (sessionField) {
				sessionField.value = session_id;
			}

                  // Update the input field in the modal
			var lastAmountPaidField = modalEl.querySelector('#last_amount_paid');
			if (lastAmountPaidField) {
				lastAmountPaidField.value = amountpaid;

			}

            var outstandingField = modalEl.querySelector('#outstanding');
			if (outstandingField) {
				outstandingField.value = balance;
			}
		});
	};


    $('#kt_modal_new_card').on('hidden.bs.modal', function () {
        $(this).find('input').val('');
        validator.resetForm(true);
    });

	return {
		// Public functions
		init: function () {
			// Elements
			modalEl = document.querySelector('#kt_modal_new_card');

			if (!modalEl) {
				return;
			}

			modal = new bootstrap.Modal(modalEl);

			form = document.querySelector('#kt_modal_new_card_form');
			submitButton = document.getElementById('kt_modal_new_card_submit');
			cancelButton = document.getElementById('kt_modal_new_card_cancel');

			initForm();
			handleForm();
			handleModal(); // Initialize the modal handler
		}
	};
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
	KTModalNewCard.init();
});
