$(document).ready( function () {
    $("#plan-details-form").bootstrapValidator({
        fields: {
            plan_name: {
                validators: {
                    notEmpty: {
                        message: 'Name is a required field.'
                    },
                    stringLength: {
                        min: 3,
                        message: 'Name must be more than 5 characters long.'
                    }
                }
            },
            start_month: {
                validators: {
                    notEmpty: {
                        message: 'Start month is a required field.'
                    }
                }
            },
            start_year : {
                validators: {
                    notEmpty: {
                        message: 'Start year is a required field.'
                    },
                    stringLength: {
                        min: 4,
                        max: 4,
                        message: 'You entered an invalid year.'
                    }
                }
            }
        }
    });
});