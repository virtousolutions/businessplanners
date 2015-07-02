$(document).ready(function () {
    $('#survey-form').bootstrapValidator({
        fields: {
            full_name : {
                validators: {
                    notEmpty: {
                        message: 'Full Name is a required field.'
                    },
                    stringLength: {
                        min: 3,
                        message: 'Name must be more than 5 characters long.'
                    }
                }
            },
            email_address : {
                validators: {
                    notEmpty: {
                        message: 'Email address is a required field.'
                    },
                    emailAddress: {
                        message: 'Email address is not valid.'
                    }
                }
            },
            'business_plan_purpose[]' : {
                validators: {
                    notEmpty: {
                        message: 'Choose the purpose(s) of your business plan.'
                    }
                }
            },
            remuneration_report : {
                validators: {
                    notEmpty: {
                        message: ''
                    }
                }
            },
            iht_report : {
                validators: {
                    notEmpty: {
                        message: ''
                    }
                }
            }
        }
    });
});