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

    $.ajax({
        method: "post",
        dataType: 'json',
        url: "recaptcha.php", 
        success: function(result){
            if(result.code == 0){
              $("#captchaImages").attr('src', result.src);
            }else{
              $(".message").show();
              $(".message").html(result.msg);
            }
        }
    });

    function refreshCaptcha()
    {
        $.ajax({
            method: "post",
            dataType: 'json',
            url: "recaptcha.php", 
            success: function(result){
                if(result.code == 0){
                    $("#captchaImages").attr('src', result.src);
                }else{
                  $(".message").show();
                  $(".message").html(result.msg);
                }
            }
        });
    }

    $("#refresh").on('click',function(e){
        refreshCaptcha();
        e.preventDefault();
    });

    $("#contactus").submit(function(e){
        $("#contactSubmit").attr('disabled','disabled');
        var name, email, message, captcha;

        name = $("#name").val();
        email = $("#email").val();
        message = $("#message").val();
        captcha = $("#captchaCode").val();

        $.ajax({
            method: "post",
            url: "app/contact_us", 
            dataType: 'json',
            data: {'name' : name, 'email': email, 'message': message, 'captcha': captcha},
            success: function(result){
                $(".message").html(result.text);
                $("#contactSubmit").removeAttr('disabled');
                
                if(result.type == 'success')
                {
                    name = $("#name").val('');
                    email = $("#email").val('');
                    message = $("#message").val('');
                    captcha = $("#captchaCode").val('');

                    refreshCaptcha();
                }
            }
        });

        e.preventDefault();
    });
});