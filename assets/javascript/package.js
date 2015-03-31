$(document).ready(function () {
    $('#package-form').bootstrapValidator({
        fields: {
            first_name: {
                validators: {
                    notEmpty: {
                        message: 'First name is a required field.'
                    },
                    stringLength: {
                        min: 3,
                        message: 'First name must be more than 3 characters long.'
                    }
                }
            },
            last_name: {
                validators: {
                    notEmpty: {
                        message: 'Last name is a required field.'
                    },
                    stringLength: {
                        min: 3,
                        message: 'Last name must be more than 3 characters long.'
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
	        county: {
                validators: {
                    notEmpty: {
                        message: 'County/Province is a required field.'
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
	        mobile: {
                validators: {
                    notEmpty: {
                        message: 'Mobile number is a required field.'
                    }
                }
            },
            email_address: {
                validators: {
                    notEmpty: {
                        message: 'Email address is a required field.'
                    },
                    emailAddress: {
                        message: 'Email address is not valid.'
                    }
                }
            },
            terms_and_conditions : {
                validators: {
                    notEmpty: {
                        message: 'Kindly read and accept the terms and conditions.'
                    }
                }
            }
        }
    });
});