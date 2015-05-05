$(document).ready(function () {
    $('#notification').fadeOut(10000);
    
    budget.init();
});

var budget = {
    changed : false,
    tab : 'expenses',
    init : function () {
        this.initExpenditures();
        this.initPurchases();
        

        $('a.back-to-outline').click(function () {
            // refresh the page
            var new_location = $(this).attr('href') + "?b-tab=" + SELECTED_TAB;
            window.location = new_location;
            return false;
        })
    },

    initExpenditures : function () {
        var self = this;

        $("#add-expenditure").click(function() {
            var data =  $("select[name='expenditure_month_year_date']").data();

            var values = {
                'expenditure_id' : '0', 
                'expenditure_name' : '', 
                'expenditure_how_much_is_it' : '',
                'expenditure_percentage_of_change' : '',
                'expenditure_how_you_pay' : '1',
                'expenditure_month_year_date' : data.default_value,
                'expenditure_expected_change' : 'increase'
            };

            self.setExpenditureValues(values);

            $("#expenditure-list").hide();
            $("#edit-expenditure").show();
            
            return false;
        })

        $("a.edit-expenditure").click(function () {
            var data = $(this).data();

            var values = {
                'expenditure_id' : data.id, 
                'expenditure_name' : data.name, 
                'expenditure_how_much_is_it' : data.pay_amount,
                'expenditure_percentage_of_change' : data.percentage_of_change,
                'expenditure_how_you_pay' : data.pay_per_year,
                'expenditure_month_year_date' : data.start_date,
                'expenditure_expected_change' : data.expected_change
            };

            self.setExpenditureValues(values);

            $("#expenditure-list").hide();
            $("#edit-expenditure").show();
            
            return false;
        })

        $("#cancel-expenditure").click(function() {
            $("#expenditure-list").show();
            $("#edit-expenditure").hide();
            
            return false;
        })

        $("#delete-expenditure").click(function() {
            if (confirm('Are you sure you want to delete this expenditure?'))
            {
                var id = $('#budget-expenditure-form').find("input[name='expenditure_id']").val();
                var href = $(this).attr('href') + "/" + id;
                $(this).attr('href', href);

                return true;
            }
            else {
                return false;
            }
        })

        $('#budget-expenditure-form').bootstrapValidator({
            submitHandler: function(validator, form, submitButton) {
                alert(1);

                return false;
            },
            fields: {
                expenditure_name: {
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
                expenditure_how_much_is_it: {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        }
                    }
                },
                expenditure_percentage_of_change : {
                    validators: {
                        notEmpty: {
                            message: 'Forecasted Percentage Change Due to Inflation is a required field.'
                        },
                        numeric: {
                            message: 'Forecasted Percentage Change Due to Inflation should be a valid number.'
                        },
                        between: {
                            min: 0,
                            max: 100,
                            message: 'Forecasted Percentage Change Due to Inflation value should be between 0 to 100.'
                        }
                    }
                }
            }
        });

        $("#budget-expenditure-form").submit(function() {
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

    initPurchases : function () {
        var self = this;

        $("#add-purchase").click(function() {
            var data =  $("select[name='mp_date']").data();

            var values = {
                'mp_id' : '0', 
                'mp_name' : '', 
                'mp_price' : '',
                'mp_date' : data.default_value,
                'mp_depreciate' : 1
            };

            self.setPurchaseValues(values);

            $("#purchase-list").hide();
            $("#edit-purchase").show();
            
            return false;
        })

        $("a.edit-purchase").click(function () {
            var data = $(this).data();

            var values = {
                'mp_id' : data.mp_id, 
                'mp_name' : data.mp_name, 
                'mp_price' : data.mp_price,
                'mp_date' : data.mp_date,
                'mp_depreciate' : data.mp_depreciate
            };


            self.setPurchaseValues(values);

            $("#purchase-list").hide();
            $("#edit-purchase").show();
            
            return false;
        })

        $("#cancel-purchase").click(function() {
            $("#purchase-list").show();
            $("#edit-purchase").hide();
            
            return false;
        })

        $("#delete-purchase").click(function() {
            if (confirm('Are you sure you want to delete this major purchase?'))
            {
                var id = $('#budget-purchase-form').find("input[name='mp_id']").val();
                var href = $(this).attr('href') + "/" + id;
                $(this).attr('href', href);

                return true;
            }
            else {
                return false;
            }
        })

        $('#budget-purchase-form').bootstrapValidator({
            fields: {
                mp_name: {
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
                mp_price: {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        }
                    }
                },
            }
        });

        $("#budget-purchase-form").submit(function() {
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

    initTax : function () {
        var self = this;

        $('#budget-tax-form').bootstrapValidator({
            fields: {
                bp_income_tax_in_percentage: {
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

        $("#budget-tax-form").submit(function() {
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

    setExpenditureValues : function (values) {
        $("#budget-expenditure-form").find('.form-group').removeClass('has-error has-feedback');
        $("#budget-expenditure-form").find('.form-group').find('small.help-block').hide();
        $("#budget-expenditure-form").find('.form-group').find('i.form-control-feedback').hide();

        $("input[name='expenditure_id']").val(values['expenditure_id']);
        $("input[name='expenditure_name']").val(values['expenditure_name']);
        $("input[name='expenditure_how_much_is_it']").val(values['expenditure_how_much_is_it']);
        $("input[name='expenditure_percentage_of_change']").val(values['expenditure_percentage_of_change']);
        $("select[name='expenditure_how_you_pay']").val(values['expenditure_how_you_pay']);
        $("select[name='expenditure_month_year_date']").val(values['expenditure_month_year_date']);
        $("select[name='expenditure_expected_change']").val(values['expenditure_expected_change']);

        if (values['expenditure_id'] * 1 == 0) {
            $("#delete-expenditure").hide();
        }
        else {
            $("#delete-expenditure").show();
        }
    },

    setPurchaseValues : function (values) {
        $("#budget-purchase-form").find('.form-group').removeClass('has-error has-feedback');
        $("#budget-purchase-form").find('.form-group').find('small.help-block').hide();
        $("#budget-purchase-form").find('.form-group').find('i.form-control-feedback').hide();

        $("input[name='mp_id']").val(values['mp_id']);
        $("input[name='mp_name']").val(values['mp_name']);
        $("input[name='mp_price']").val(values['mp_price']);
        $("select[name='mp_date']").val(values['mp_date']);
        $("#mp_depreciate_" + values['mp_depreciate']).attr('checked', true);

        if (values['mp_id'] * 1 == 0) {
            $("#delete-purchase").hide();
        }
        else {
            $("#delete-purchase").show();
        }
    }
}