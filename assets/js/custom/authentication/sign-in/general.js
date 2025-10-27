"use strict";

// Class definition
var KTSigninGeneral = function () {
    // Elements
    var form;
    var submitButton;
    var validator;

    // Handle form
    var handleValidation = function (e) {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
                form,
                {
                    fields: {
                        'email': {
                            validators: {
                                regexp: {
                                    regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                                    message: 'The value is not a valid email address',
                                },
                                notEmpty: {
                                    message: 'Email address is required'
                                }
                            }
                        },
                        'password': {
                            validators: {
                                notEmpty: {
                                    message: 'The password is required'
                                }
                            }
                        }
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: '.fv-row',
                            eleInvalidClass: '', // comment to enable invalid state icons
                            eleValidClass: '' // comment to enable valid state icons
                        })
                    }
                }
        );
    }

    var handleSubmitDemo = function (e) {
        // Handle form submit
        submitButton.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();

            // Validate form
            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    // Show loading indication
                    submitButton.setAttribute('data-kt-indicator', 'on');

                    // Disable button to avoid multiple click
                    submitButton.disabled = true;


                    // Simulate ajax request
                    setTimeout(function () {
                        // Hide loading indication
                        submitButton.removeAttribute('data-kt-indicator');

                        // Enable button
                        submitButton.disabled = false;

                        // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        Swal.fire({
                            text: "You have successfully logged in!",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function (result) {
                            if (result.isConfirmed) {
                                form.querySelector('[name="email"]').value = "";
                                form.querySelector('[name="password"]').value = "";

                                //form.submit(); // submit form
                                var redirectUrl = form.getAttribute('data-kt-redirect-url');
                                if (redirectUrl) {
                                    location.href = redirectUrl;
                                }
                            }
                        });
                    }, 2000);
                } else {
                    // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
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
        });
    }

    var handleSubmitAjax = function (e) {
        // Handle form submit
        submitButton.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();

            // Validate form
            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    // Show loading indication
                    submitButton.setAttribute('data-kt-indicator', 'on');

                    // Disable button to avoid multiple click
                    submitButton.disabled = true;

                    FormValidation.utils.fetch(baseurl + 'login/ajax_login', {
                        //url: baseurl + 'login/ajax_login',
                        method: 'POST',
                        dataType: 'json',
                        params: {
                            email: form.querySelector('[name="email"]').value,
                            password: form.querySelector('[name="password"]').value,
                        },
                    }).then(function (response) { // Return valid JSON
                        // Release button
                        //KTUtil.btnRelease(formSubmitButton);

                        var login_status = response.login_status;
                        var certified_status = response.certified;
                        console.log(login_status);
                        if (login_status === 'success') {
                            KTUtil.scrollTop();
                            var redirect_url = baseurl;
                            if (response.redirect_url && response.redirect_url.length)
                            {
                                redirect_url = response.redirect_url;
                            }

                            //certified
                            if (response.certified == false) {
                                Swal.fire({
                                    title: not_supported_for_attendance_recording,
                                    text: 'لكن لا زال بامكانك المتابعة',
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn font-weight-bold btn-light-danger"
                                    }
                                }).then(function () {
                                    //KTUtil.scrollTop();
                                    submitButton.setAttribute('data-kt-indicator', 'of');
                                    window.location.href = redirect_url;
                                });
                            } else {
                                window.location.href = redirect_url;
                            }

                        } else if (login_status == 'suspended') {
                            //var get_msg = msg_error_login_suspended;
                            //btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
                            //showErrorMsg(form, 'danger', get_msg);

                            Swal.fire({
                                text: your_account_has_been_suspended,
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn font-weight-bold btn-light-danger"
                                }
                            }).then(function () {
                                //KTUtil.scrollTop();
                                submitButton.setAttribute('data-kt-indicator', 'of');
                            });

                        } else if (login_status == 'invalid') {
                            var get_msg = msg_error_login;
                            var get_msg2 = get_msg_ok;
                            //var get_msg_ok = msg_error_ok;
                            //btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
                            //showErrorMsg(form, 'danger', get_msg);
                            submitButton.disabled = false;

                            Swal.fire({
                                text: get_msg,
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: get_msg2,
                                customClass: {
                                    confirmButton: "btn font-weight-bold btn-light-danger"
                                }
                            }).then(function () {
                                submitButton.setAttribute('data-kt-indicator', 'of');
                                //KTUtil.scrollTop();
                            });

                        } else if (login_status == 'disabled') {
                            //var get_msg = msg_error_disabled;
                            //btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
                            //showErrorMsg(form, 'danger', get_msg);


                            Swal.fire({
                                text: "Sorry, something went wrong, please try again.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn font-weight-bold btn-light-danger"
                                }
                            }).then(function () {
                                //KTUtil.scrollTop();
                                submitButton.setAttribute('data-kt-indicator', 'of');
                            });


                        } else {
                            Swal.fire({
                                text: "Sorry, something went wrong, please try again.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn font-weight-bold btn-light-danger"
                                }
                            }).then(function () {
                                //KTUtil.scrollTop();
                                submitButton.setAttribute('data-kt-indicator', 'of');
                            });
                        }
                    });

                } else {

                }
            });
        });
    };

    var isValidUrl = function (url) {
        try {
            new URL(url);
            return true;
        } catch (e) {
            return false;
        }
    };

    // Public functions
    return {
        // Initialization
        init: function () {
            form = document.querySelector('#kt_sign_in_form');
            submitButton = document.querySelector('#kt_sign_in_submit');

            handleValidation();

            if (isValidUrl(submitButton.closest('form').getAttribute('action'))) {
                handleSubmitAjax(); // use for ajax submit
            } else {
                handleSubmitDemo(); // used for demo purposes only
            }
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTSigninGeneral.init();
});