$(document).ready(function () {
    $('#notification').fadeOut(10000);
    
    resources.init();
});

var resources = {
    changed : false,
    init : function () {
        this.initPersonnel();
        this.initExpenses();
        
        $('a.back-to-outline').click(function () {
            // refresh the page
            var new_location = $(this).attr('href') + "?h-tab=" + SELECTED_TAB;
            window.location = new_location;
            return false;
        })
    },

    initPersonnel : function () {
        var self = this;

        $("#add-personnel").click(function() {
            var data =  $("select[name='employee_start_date']").data();

            var values = {
                'employee_id' : '0', 
                'employee_name' : '', 
                'employee_type' : '',
                'employee_pay_per_year' : 1,
                'employee_pay_amount' : '',
                'employee_start_date' : data.default_value
            };

            self.setPersonnel(values);

            $("#personnel-list").hide();
            $("#edit-personnel").show();
            
            return false;
        })

        $("a.edit-personnel").click(function () {
            var data = $(this).data();

            var values = {
                'employee_id' : data.employee_id, 
                'employee_name' : data.employee_name, 
                'employee_type' : data.employee_type,
                'employee_pay_per_year' : data.employee_pay_per_year,
                'employee_pay_amount' : data.employee_pay_amount,
                'employee_start_date' : data.employee_start_date
            };

            self.setPersonnel(values);

            $("#personnel-list").hide();
            $("#edit-personnel").show();
            
            return false;
        })

        $("#cancel-personnel").click(function() {
            $("#personnel-list").show();
            $("#edit-personnel").hide();
            
            return false;
        })

        $("#delete-employee").click(function() {
            if (confirm('Are you sure you want to delete this employee?'))
            {
                var id = $('#human-resources-personnel-form').find("input[name='employee_id']").val();
                var href = $(this).attr('href') + "/" + id;
                $(this).attr('href', href);

                return true;
            }
            else {
                return false;
            }
        });

        $('#human-resources-personnel-form').bootstrapValidator({
            fields: {
                employee_name: {
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
                employee_type: {
                    validators: {
                        notEmpty: {
                            message: 'Employee type is a required field.'
                        }
                    }
                },
                employee_pay_amount: {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        }
                    }
                }
            }
        });

        $("#human-resources-personnel-form").submit(function() {
            var has_errors = $(this).find('div.form-group').hasClass('has-error');

            if (has_errors == true)
            {
                return false;
            }
            else {
                return true;
            }
        })
    },

    initExpenses : function () {
        var self = this;

        $('#human-resources-expenses-form').bootstrapValidator({
            fields: {
                bp_related_expenses_in_percentage: {
                    validators: {
                        notEmpty: {
                            message: 'This is a required field.'
                        },
                        numeric: {
                            message: 'The value should be a valid number.'
                        },
                        between: {
                            min: 0,
                            max: 100,
                            message: 'The value should be between 0 to 100.'
                        }
                    }
                }
            }
        });

        $("#human-resources-expenses-form").submit(function() {
            var has_errors = $(this).find('div.form-group').hasClass('has-error');

            if (has_errors == true)
            {
                return false;
            }
            else {
                return true;
            }
        })
    },

    setPersonnel : function (values) {
        $("#human-resources-personnel-form").find('.form-group').removeClass('has-error has-feedback');
        $("#human-resources-personnel-form").find('.form-group').find('small.help-block').hide();
        $("#human-resources-personnel-form").find('.form-group').find('i.form-control-feedback').hide();

        $("input[name='employee_id']").val(values['employee_id']);
        $("input[name='employee_name']").val(values['employee_name']);
        $("input[name='employee_pay_amount']").val(values['employee_pay_amount']);
        $("select[name='employee_pay_per_year']").val(values['employee_pay_per_year']);
        $("select[name='employee_start_date']").val(values['employee_start_date']);

        if (values['employee_type'] == 'contract')
        {
            $("#employee_type_contract").attr('checked', true);
        }
        else
        {
            $("#employee_type_regular").attr('checked', true);
        }

        if (values['employee_id'] * 1 == 0) {
            $("#delete-employee").hide();
        }
        else {
            $("#delete-employee").show();
        }
    },
}