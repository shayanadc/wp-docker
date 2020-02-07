(function($) {
    'use strict';

    $(document).ready(initScript);

    function initScript() {

        //defing global ajax post url
        window.ajaxPostUrl = ajax_object.ajax_url;
        // validating login form request
        wpcrlValidateAndProcessLoginForm();
        // validating registration form request
        wpcrlValidateAndProcessRegisterForm();
        // validating reset password form request
        wpcrlValidateAndProcessResetPasswordForm();
        //Show Reset password
        wpcrlShowResetPasswordForm();
        //Return to login
        wpcrlReturnToLoginForm();
        generateCaptcha();

    }

    // Validate login form
    function wpcrlValidateAndProcessLoginForm() {
        $('#wpcrlLoginForm').formValidation({
            message: 'This value is not valid',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                wpcrl_username: {
                    message: 'نام کاربری معتبر نمی باشد.',
                    validators: {
                        notEmpty: {
                            message: 'وارد کردن نام کاربری اجباریست.'
                        }
                    }
                },
                wpcrl_password: {
                    validators: {
                        notEmpty: {
                            message: 'وارد کردن رمز عبور اجباریست.'
                        }
                    }
                }
            }
        }).on('success.form.fv', function(e) {
            $('#wpcrl-login-alert').hide();
            // You can get the form instance
            var $loginForm = $(e.target);
            // and the FormValidation instance
            var fv = $loginForm.data('formValidation');
            var content = $loginForm.serialize();

            // start processing
            $('#wpcrl-login-loader-info').show();
            wpcrlStartLoginProcess(content);
            // Prevent form submission
            e.preventDefault();
        });
    }

    // Make ajax request with user credentials
    function wpcrlStartLoginProcess(content) {

        var loginRequest = jQuery.ajax({
            type: 'POST',
            url: ajaxPostUrl,
            data: content + '&action=wpcrl_user_login',
            dataType: 'json',
            success: function(data) {
                $('#wpcrl-login-loader-info').hide();
                // check login status
                if (true == data.logged_in) {
                    $('#wpcrl-login-alert').removeClass('alert-danger');
                    $('#wpcrl-login-alert').addClass('alert-success');
                    $('#wpcrl-login-alert').show();
                    $('#wpcrl-login-alert').html(data.success);

                    // redirect to redirection url provided
                    window.location = data.redirection_url;

                } else {

                    $('#wpcrl-login-alert').show();
                    $('#wpcrl-login-alert').html(data.error);

                }
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    // Validate registration form


    function randomNumber(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    }

    function generateCaptcha() {
        $('#captchaOperation').html([randomNumber(1, 100), '+', randomNumber(1, 200), '='].join(' '));
    }

    // Validate registration form
    function wpcrlValidateAndProcessRegisterForm() {
        $('#wpcrlRegisterForm').formValidation({
            message: 'This value is not valid',
            icon: {
                required: 'glyphicon glyphicon-asterisk',
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                wpcrl_username: {
                    message: 'نام کاربری معتبر نمی باشد.',
                    validators: {
                        notEmpty: {
                            message: 'وارد کردن نام کاربری اجباریست.'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'نام کاربری باید بین 6 تا 30 کلمه باشد.'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_\.]+$/,
                            message: 'نام کاربری شامل، حروف و اعداد می باشد.'
                        }
                    }
                },
                wpcrl_email: {
                    validators: {
                        notEmpty: {
                            message: 'وارد کردن ایمیل اجباریست.'
                        },
                        regexp: {
                            regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                            message: 'این ایمیل صحیح نمی باشد.'
                        }
                    }
                },
                wpcrl_password: {
                    validators: {
                        notEmpty: {
                            message: 'وارد کردن رمز عبور اجباریست.'
                        },
                        stringLength: {
                            min: 6,
                            message: 'رمز عبور حداقل باید 6 کلمه و یا حروف باشد.'
                        }
                    }
                },
                wpcrl_password2: {
                    validators: {
                        notEmpty: {
                            message: 'وارد کردن رمز عبور اجباریست.'
                        },
                        identical: {
                            field: 'wpcrl_password',
                            message: 'رمز عبور و تایید آن یکسان نیست'
                        },
                        stringLength: {
                            min: 6,
                            message: 'رمز عبور حداقل باید 6 کلمه و یا حروف باشد.'
                        }
                    }
                },
                wpcrl_captcha: {
                    validators: {
                        callback: {
                            message: 'Wrong answer',
                            callback: function(value, validator, $field) {
                                var items = $('#captchaOperation').html().split(' '),
                                        sum = parseInt(items[0]) + parseInt(items[2]);
                                return value == sum;
                            }
                        }
                    }
                }
            }
        }).on('success.form.fv', function(e) {
            $('#wpcrl-register-alert').hide();
            $('#wpcrl-mail-alert').hide();
            $('body, html').animate({
                scrollTop: 0
            }, 'slow');
            // You can get the form instance
            var $registerForm = $(e.target);
            // and the FormValidation instance
            var fv = $registerForm.data('formValidation');
            var content = $registerForm.serialize();

            // start processing
            $('#wpcrl-reg-loader-info').show();
            wpcrlStartRegistrationProcess(content);
            // Prevent form submission
            e.preventDefault();
        }).on('err.form.fv', function(e) {
            // Regenerate the captcha
            generateCaptcha();
        });
    }


    // Make ajax request with user credentials
    function wpcrlStartRegistrationProcess(content) {

        var registerRequest = $.ajax({
            type: 'POST',
            url: ajaxPostUrl,
            data: content + '&action=wpcrl_user_registration',
            dataType: 'json',
            success: function(data) {

                $('#wpcrl-reg-loader-info').hide();
                //check mail sent status
                if (data.mail_status == false) {

                    $('#wpcrl-mail-alert').show();
                    $('#wpcrl-mail-alert').html('Could not able to send the email notification.');
                }
                // check login status
                if (true == data.reg_status) {
                    $('#wpcrl-register-alert').removeClass('alert-danger');
                    $('#wpcrl-register-alert').addClass('alert-success');
                    $('#wpcrl-register-alert').show();
                    $('#wpcrl-register-alert').html(data.success);

                } else {
                    $('#wpcrl-register-alert').addClass('alert-danger');
                    $('#wpcrl-register-alert').show();
                    $('#wpcrl-register-alert').html(data.error);

                }
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    function wpcrlShowResetPasswordForm() {
        $('#btnForgotPassword').click(function() {
              $('#wpcrlResetPasswordSection').removeClass('hidden');
              $('#wpcrlLoginForm').slideUp(500);  
               $('#wpcrlResetPasswordSection').slideDown(500);
        });
    }
    
    function wpcrlReturnToLoginForm() {
        $('#btnReturnToLogin').click(function() {
              $('#wpcrlResetPasswordSection').slideUp(500);              
              $('#wpcrlResetPasswordSection').addClass('hidden');
              $('#wpcrlLoginForm').removeClass('hidden');
              $('#wpcrlLoginForm').slideDown(500);               
        });
    }

    // Validate reset password form
    //Neelkanth
    function wpcrlValidateAndProcessResetPasswordForm() {

        $('#wpcrlResetPasswordForm').formValidation({
            message: 'This value is not valid',
            icon: {
                required: 'glyphicon glyphicon-asterisk',
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                wpcrl_rp_email: {
                    validators: {
                        notEmpty: {
                            message: 'لطفا آدرس ایمیل خود را که در هنگام ثبت نام استفاده کردید وارد کنید.'
                        },
                        regexp: {
                            regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                            message: 'این ایمیل صحیح نمی باشد.'
                        }
                    }
                },
                wpcrl_newpassword: {
                    validators: {
                        notEmpty: {
                            message: 'وارد کردن رمز عبور اجباریست.'
                        },
                        stringLength: {
                            min: 6,
                            message: 'رمز عبور حداقل باید 6 کلمه و یا حروف باشد.'
                        }
                    }
                }
            }
        }).on('success.form.fv', function(e) {
            $('#wpcrl-resetpassword-alert').hide();

            $('body, html').animate({
                scrollTop: 0
            }, 'slow');
            // You can get the form instance
            var $resetPasswordForm = $(e.target);
            // and the FormValidation instance
            var fv = $resetPasswordForm.data('formValidation');
            var content = $resetPasswordForm.serialize();
            
            // start processing
            $('#wpcrl-resetpassword-loader-info').show();
            wpcrlStartResetPasswordProcess(content);
            // Prevent form submission
            e.preventDefault();
        });
    }

    // Make ajax request with email
    //Neelkanth
    function wpcrlStartResetPasswordProcess(content) {
        
        var resetPasswordRequest = jQuery.ajax({
            type: 'POST',
            url: ajaxPostUrl,
            data: content + '&action=wpcrl_resetpassword',
            dataType: 'json',
            success: function(data) {
                
                $('#wpcrl-resetpassword-loader-info').hide();
                // check login status
                if (data.success) {
                    
                    $('#wpcrl-resetpassword-alert').removeClass('alert-danger');
                    $('#wpcrl-resetpassword-alert').addClass('alert-success');
                    $('#wpcrl-resetpassword-alert').show();
                    $('#wpcrl-resetpassword-alert').html(data.success);

                } else {

                    $('#wpcrl-resetpassword-alert').show();
                    $('#wpcrl-resetpassword-alert').html(data.error);

                }
            },
            error: function(data) {
                console.log(data);
            }
        });
    }



})(jQuery);
