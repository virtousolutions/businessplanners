$(document).ready( function () {
    // browser window scroll (in pixels) after which the "back to top" link is shown
	var offset = 100,
    //browser window scroll (in pixels) after which the "back to top" link opacity is reduced
    offset_opacity = 100,
    //duration of the top scrolling animation (in ms)
    scroll_top_duration = 700,
    //grab the "back to top" link
    $back_to_top = $('.cd-top');

	//hide or show the "back to top" link
	$(window).scroll(function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
		if( $(this).scrollTop() > offset_opacity ) { 
			$back_to_top.addClass('cd-fade-out');
		}
	});

	//smooth scroll to top
	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 0 ,
		 	}, scroll_top_duration
		);
	});

    $('#contactus').bootstrapValidator({
        fields: {
            name: {
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
            email: {
                validators: {
                    notEmpty: {
                        message: 'Email is a required field.'
                    },
                    emailAddress: {
                        message: 'Email is not valid.'
                    }
                }
            },
            message : {
                validators: {
                    notEmpty: {
                        message: 'Message is a required field.'
                    },
                    stringLength: {
                        min: 3,
                        message: 'Message must be more than 10 characters long.'
                    }
                }
            },
            /*captcha_code : {
                validators: {
                    notEmpty: {
                        message: 'Kindly copy the code.'
                    }
                }
            }*/
        }
    });

    $("#contactus").submit(function(e){
        $("#contactSubmit").attr('disabled','disabled');
        post_data = {
            'name'     : $('input[name=name]').val(),
            'email'    : $('input[name=email]').val(),
            'message'  : $('textarea[name=message]').val(),
            '_token'   : $('meta[name="_token"]').attr('content')
        };

        $.ajax({
            method: "post",
            url: "contact_us", 
            dataType: 'json',
            data: post_data,
            success: function(result){
                $("#contact-results").html(result.text);
                $("#contactSubmit").removeAttr('disabled');
                
                if(result.type == 'success')
                {
                    name = $("#name").val('');
                    email = $("#email").val('');
                    message = $("#message").val('');
                }
            }
        });

        e.preventDefault();
    });
});