$(document).ready(function () {
    $('#notification').fadeOut(10000);
    
    loans.init();
});

var loans = {
    changed : false,
    init : function () {
        var self = this;

        $('a.back-to-outline').click(function () {
            // refresh the page
            return true;
        })
        
        $("#add-loan").click(function() {
            var values = {
                'li_id' : '0', 
                'loan_invest_name' : '', 
                'type_of_funding' : 'Loan',
                'loan_invest_interest_rate' : 0,
                'loan_invest_years_to_pay' : 1,
                'loan_invest_pays_per_years' : 1,
                'months' : [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                'years' : [0, 0, 0]

            };

            self.setLoan(values);

            $("#loans-list").hide();
            $("#edit-loan").show();
            
            return false;
        })

        $("a.edit-loan").click(function () {
            var data = $(this).data();

            var values = {
                'li_id' : data.li_id, 
                'loan_invest_name' : data.loan_invest_name, 
                'type_of_funding' : data.type_of_funding,
                'loan_invest_interest_rate' : data.loan_invest_interest_rate,
                'loan_invest_years_to_pay' : data.loan_invest_years_to_pay,
                'loan_invest_pays_per_years' : data.loan_invest_pays_per_years,
                'months' : data.months,
                'years' : data.years
            };

            self.setLoan(values);

            $("#loans-list").hide();
            $("#edit-loan").show();
            
            return false;
        })

        $("#cancel-loan").click(function() {
            $("#loans-list").show();
            $("#edit-loan").hide();
            
            return false;
        })

        $("#delete-loan").click(function() {
            if (confirm('Are you sure you want to delete this loan projection?'))
            {
                var id = $('#loan-form').find("input[name='li_id']").val();
                var href = $(this).attr('href') + "/" + id;
                $(this).attr('href', href);

                return true;
            }
            else {
                return false;
            }
        });

        $("select[name='type_of_funding']").change(function () {
            self.toggleLoanFundingFields();
        });

        $('#loan-form').bootstrapValidator({
            fields: {
                loan_invest_name: {
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
                loan_invest_interest_rate: {
                    validators: {
                        notEmpty: {
                            message: 'Interest rate is a required field.'
                        },
                        numeric: {
                            message: 'Interest rate should be a valid number.'
                        },
                        between: {
                            min: 0,
                            max: 100,
                            message: 'Interest rate value should be between 0 to 100.'
                        }
                    }
                },
                loan_invest_years_to_pay: {
                    validators: {
                        notEmpty: {
                            message: 'Years to pay is a required field.'
                        },
                        integer: {
                            message: 'Years to pay should be a vwhole number.'
                        },
                        between: {
                            min: 1,
                            max: 100,
                            message: 'Years to pay value should be between 1 to 100.'
                        }
                    }
                },
                loan_invest_pays_per_years: {
                    validators: {
                        notEmpty: {
                            message: 'Pays per year is a required field.'
                        },
                        integer: {
                            message: 'Pays per year should be a vwhole number.'
                        },
                        between: {
                            min: 1,
                            max: 365,
                            message: 'Years to pay value should be between 1 to 365.'
                        }
                    }
                },
                'months[0]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'months[1]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'months[2]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'months[3]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'months[4]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'months[5]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'months[6]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'months[7]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'months[8]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'months[9]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'months[10]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'months[11]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'years[1]' : {
                    validators: {
                        notEmpty: {
                            message: 'Amount is a required field.'
                        },
                        numeric: {
                            message: 'Amount should be a valid number.'
                        },
                    }
                },
                'years[2]' : {
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

        $("#loan-form").submit(function() {
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

    setLoan : function (values) {
        $("#sale-form").find('.form-group').removeClass('has-error has-feedback');
        $("#sale-form").find('.form-group').find('small.help-block').hide();
        $("#sale-form").find('.form-group').find('i.form-control-feedback').hide();

        $("input[name='li_id']").val(values['li_id']);
        $("input[name='loan_invest_name']").val(values['loan_invest_name']);
        $("select[name='type_of_funding']").val(values['type_of_funding']);
        $("input[name='loan_invest_interest_rate']").val(values['loan_invest_interest_rate']);
        $("input[name='loan_invest_years_to_pay']").val(values['loan_invest_years_to_pay']);
        $("input[name='loan_invest_pays_per_years']").val(values['loan_invest_pays_per_years']);

        for (var $i = 0; $i < 12; $i++) {
            $("input[name='months[" + $i + "]']").val(values['months'][$i]);
        }

        for (var $i = 0; $i < 3; $i++) {
            $("input[name='years[" + $i + "]']").val(values['years'][$i]);
        }

        if (values['li_id'] * 1 == 0) {
            $("#delete-loan").hide();
        }
        else {
            $("#delete-loan").show();
        }

        this.toggleLoanFundingFields();
    },

    toggleLoanFundingFields : function() {
        if ($("select[name='type_of_funding']").val() == 'Loan') {
            $("#loan_funding_fields").show();
        }
        else {
            $("#loan_funding_fields").hide();
        }
    }
}