$(document).ready(function () {
    $('#update-form').bootstrapValidator({
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
                    },
                    identical: {
                        field: 'password_confirmation',
                        message: 'The password and its confirm are not the same'
                    }
                }
            },
            password_confirmation : {
                validators: {
                    identical: {
                        field: 'password',
                        message: 'The password and its confirm are not the same'
                    }
                }
            }
        }
    });
});