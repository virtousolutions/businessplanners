$(document).ready(function () {
    $('#change-temp-password-form').bootstrapValidator({
        fields: {
            new_password: {
                validators: {
                    notEmpty: {
                        message: 'Password cannot be empty.'
                    },
                    stringLength: {
                        min: 6,
                        max: 32,
                        message: 'Password should be 6 - 32 characters.'
                    }
                }
            },
            confirm_password : {
                validators: {
                    notEmpty: {
                        message: 'Confirm password.'
                    }
                }
            }
        }
    });
});