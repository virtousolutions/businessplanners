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
            },
            contact_name: {
                validators: {
                    notEmpty: {
                        message: 'Contact name is a required field.'
                    },
                    stringLength: {
                        min: 3,
                        message: 'Contact name must be more than 3 characters long.'
                    }
                }
            },
	        address_1: {
                validators: {
                    notEmpty: {
                        message: 'Address 1 is a required field.'
                    },
                }
            },
            city: {
                validators: {
                    notEmpty: {
                        message: 'Town/City is a required field.'
                    },
                }
            },
            country: {
                validators: {
                    notEmpty: {
                        message: 'Country is a required field.'
                    },
                }
            },
	        post_code: {
                validators: {
                    notEmpty: {
                        message: 'Post code is a required field.'
                    },
		            zipCode: {
                        message: 'The value is not a valid UK postcode.'
                    }
                }
            },
	        telephone: {
                validators: {
                    notEmpty: {
                        message: 'Telephone number is a required field.'
                    }
                }
            },
	        email: {
                validators: {
                    emailAddress: {
                        message: 'Email address is not valid.'
                    }
                }
            }
        }
    });
});