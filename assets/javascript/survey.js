$(document).ready(function () {
    $('#survey-form').bootstrapValidator({
        fields: {
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