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
        this.initDividends();

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
                'expenditure_months' : [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
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
                'expenditure_months' : data.expenditure_months
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
                'expenditure_months[0]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'expenditure_months[1]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'expenditure_months[2]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'expenditure_months[3]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'expenditure_months[4]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'expenditure_months[5]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'expenditure_months[6]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'expenditure_months[7]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'expenditure_months[8]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'expenditure_months[9]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'expenditure_months[10]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'expenditure_months[11]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
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

    initDividends : function () {
        var self = this;

        $("input.dividend-months").keyup(function() {
            var val = 0;
            $("input.dividend-months").each(function(index, value) {
                val += $(value).val() * 1;
            });

            $("input[name='dividend_years[0]']").val(val);
        });

        $("#add-dividend").click(function() {
            var values = {
                'dividend_id' : '0', 
                'dividend_name' : '', 
                'dividend_months' : [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                'dividend_years' : [0, 0, 0]
            };

            self.setDividendValues(values);

            $("#dividends-list").hide();
            $("#edit-dividend").show();
            
            return false;
        })

        $("a.edit-dividend").click(function () {
            var data = $(this).data();

            var values = {
                'dividend_id' : data.id, 
                'dividend_name' : data.name, 
                'dividend_months' : data.dividend_months,
                'dividend_years' : data.dividend_years
            };

            self.setDividendValues(values);

            $("#dividends-list").hide();
            $("#edit-dividend").show();
            
            return false;
        })

        $("#cancel-dividend").click(function() {
            $("#dividends-list").show();
            $("#edit-dividend").hide();
            
            return false;
        })

        $("#delete-dividend").click(function() {
            if (confirm('Are you sure you want to delete this dividend and profit distribution?'))
            {
                var id = $('#budget-dividend-form').find("input[name='dividend_id']").val();
                var href = $(this).attr('href') + "/" + id;
                $(this).attr('href', href);

                return true;
            }
            else {
                return false;
            }
        })

        $('#budget-dividend-form').bootstrapValidator({
            submitHandler: function(validator, form, submitButton) {
                alert(1);

                return false;
            },
            fields: {
                dividend_name: {
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
                'dividend_months[0]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'dividend_months[1]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'dividend_months[2]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'dividend_months[3]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'dividend_months[4]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'dividend_months[5]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'dividend_months[6]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'dividend_months[7]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'dividend_months[8]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'dividend_months[9]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'dividend_months[10]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'dividend_months[11]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'dividend_years[1]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'dividend_years[2]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
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

    setExpenditureValues : function (values) {
        $("#budget-expenditure-form").find('.form-group').removeClass('has-error has-feedback');
        $("#budget-expenditure-form").find('.form-group').find('small.help-block').hide();
        $("#budget-expenditure-form").find('.form-group').find('i.form-control-feedback').hide();

        $("input[name='expenditure_id']").val(values['expenditure_id']);
        $("input[name='expenditure_name']").val(values['expenditure_name']);

        for (var $i = 0; $i < 12; $i++) {
            $("input[name='expenditure_months[" + $i + "]']").val(values['expenditure_months'][$i]);
        }

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
    },

    setDividendValues : function (values) {
        $("#budget-dividend-form").find('.form-group').removeClass('has-error has-feedback');
        $("#budget-dividend-form").find('.form-group').find('small.help-block').hide();
        $("#budget-dividend-form").find('.form-group').find('i.form-control-feedback').hide();

        $("input[name='dividend_id']").val(values['dividend_id']);
        $("input[name='dividend_name']").val(values['dividend_name']);

        for (var $i = 0; $i < 12; $i++) {
            $("input[name='dividend_months[" + $i + "]']").val(values['dividend_months'][$i]);
        }

        for (var $i = 0; $i < 3; $i++) {
            $("input[name='dividend_years[" + $i + "]']").val(values['dividend_years'][$i]);
        }

        if (values['dividend_id'] * 1 == 0) {
            $("#delete-dividend").hide();
        }
        else {
            $("#delete-dividend").show();
        }
    }
}