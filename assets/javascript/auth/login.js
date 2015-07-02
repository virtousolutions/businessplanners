$(document).ready(function () {
    $('#login-form').bootstrapValidator({
        fields: {
            email: {
                validators: {
                    notEmpty: {
                        message: 'Email address is a required field.'
                    },
                    emailAddress: {
                        message: 'Email address is not valid.'
                    }
                }
            },
            password : {
                validators: {
                    notEmpty: {
                        message: 'Password is a required field.'
                    }
                }
            }
        }
    });
});