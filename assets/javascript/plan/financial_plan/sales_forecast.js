$(document).ready(function () {
    $('#notification').fadeOut(10000);
    
    sales.init();
});

var sales = {
    changed : false,
    init : function () {
        var self = this;

        $('a.back-to-outline').click(function () {
            // refresh the page
            var new_location = $(this).attr('href') + "?h-tab=" + SELECTED_TAB;
            window.location = new_location;
            return false;
        })
        
        $("#add-sale").click(function() {
            var values = {
                'sf_id' : '0', 
                'sales_forecast_name' : '', 
                'price' : 0,
                'cost' : 0,
                'months' : [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                'years' : [0, 0, 0]

            };

            self.setSale(values);

            $("#sales-list").hide();
            $("#edit-sale").show();
            
            return false;
        })

        $("a.edit-sale").click(function () {
            var data = $(this).data();

            var values = {
                'sf_id' : data.sf_id, 
                'sales_forecast_name' : data.sales_forecast_name, 
                'price' : data.price,
                'cost' : data.cost,
                'months' : data.months,
                'years' : data.years
            };

            self.setSale(values);

            $("#sales-list").hide();
            $("#edit-sale").show();
            
            return false;
        })

        $("#cancel-sale").click(function() {
            $("#sales-list").show();
            $("#edit-sale").hide();
            
            return false;
        })

        $("#delete-sale").click(function() {
            if (confirm('Are you sure you want to delete this sales forecast?'))
            {
                var id = $('#sale-form').find("input[name='sf_id']").val();
                var href = $(this).attr('href') + "/" + id;
                $(this).attr('href', href);

                return true;
            }
            else {
                return false;
            }
        });

        $('#sale-form').bootstrapValidator({
            fields: {
                sales_forecast_name: {
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
                price: {
                    validators: {
                        notEmpty: {
                            message: 'Price is a required field.'
                        },
                        numeric: {
                            message: 'Price should be a valid number.'
                        }
                    }
                },
                cost: {
                    validators: {
                        notEmpty: {
                            message: 'Cost is a required field.'
                        },
                        numeric: {
                            message: 'Cost should be a valid number.'
                        }
                    }
                }
            }
        });

        $("#sale-form").submit(function() {
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

    setSale : function (values) {
        $("#sale-form").find('.form-group').removeClass('has-error has-feedback');
        $("#sale-form").find('.form-group').find('small.help-block').hide();
        $("#sale-form").find('.form-group').find('i.form-control-feedback').hide();

        $("input[name='sf_id']").val(values['sf_id']);
        $("input[name='sales_forecast_name']").val(values['sales_forecast_name']);
        $("input[name='price']").val(values['price']);
        $("input[name='cost']").val(values['cost']);

        for (var $i = 0; $i < 12; $i++) {
            $("input[name='months[" + $i + "]']").val(values['months'][$i]);
        }

        for (var $i = 0; $i < 3; $i++) {
            $("input[name='years[" + $i + "]']").val(values['years'][$i]);
        }

        if (values['sf_id'] * 1 == 0) {
            $("#delete-sale").hide();
        }
        else {
            $("#delete-sale").show();
        }
    },
}