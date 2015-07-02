jQuery(function($){

	var _token = $("meta[name='token']").attr('content');

	var GLOBAL = {
		respMenu : function(){
			$("#top-menu #btn-resp").click(function(){
				$("#primary").toggleClass('forprimary');
			});
		},
		contactus : function(){
			$("#contacttbl input[type='text'], #contacttbl textarea").blur(function(){
				if($(this).val() == ''){
					$(this).css({
						border : '2px solid red'
					});
				}else{
					$(this).css({
						border : '0'
					})
				}
			});
			$("#contactussubmit-btn").on('click', function(){
				var required = $("#contacttbl .required-field");
				var err = new Array();
				required.each(function(){
					if($(this).val() != ""){
						err[err.length] = '1';
					}else{
						err[err.length] = '0';
					}
				});

				if(in_array('0', err)){
					// Error Do nothing
				}else{
					// All field are not empty proceed!
					$.ajax({
						type:"POST",
						url:"contactus",
						dataType:"JSON",
						data:{
							// _token: $("meta[name='token']").attr('content'),
							name:$("#name").val(),
							contactnum:$("#contactnum").val(),
							email:$("#email").val(),
							headaboutus:$("#headaboutus").val(),
							message:$("#message").val()
						},
						success : function(d){
							// console.log(d);
							if(d.type == 'success'){
								$("<div class='mail-success col-md-7 col-md-offset-3'>"+d.text+"</div>").insertAfter('#contacttbl');
								$("#name").val("");
								$("#contactnum").val("");
								$("#email").val("");
								$("#headaboutus").val("");
								$("#message").val("");
								setTimeout(function(){
									$(".mail-success").remove();
								}, 4000)
							}
						}
					});
				}

			});
		},
		menuscroll : function(){
			$("#top-menu li a").on('click', function(){
				var id = $(this).attr('id');
				$("#banner").removeClass('forbanner');
				if(id == $.trim('forfeature')){
					var $feature = $(".thefeature").offset();
					$("html, body").animate({
						scrollTop : $feature.top
					}, 'slow');
				}else if(id == $.trim('forblog')){
					var $blog = $(".theblog").offset();
					$("html, body").animate({
						scrollTop : $blog.top
					}, 'slow');
				}else if(id == $.trim('forcontactus')){
					var $contactus = $(".thecontactus").offset();
					$("html, body").animate({
						scrollTop : $contactus.top
					}, 'slow');
				}else if(id == $.trim('forhome')){
					$("html, body").animate({
						scrollTop : '0'
					}, 'slow');
				}
			});
		},
		scrolltotop: function(){
			$(window).scroll(function(){
				if( $(this).scrollTop() > 100 ){
					$("#scrolltop").fadeIn();
				}else{
					$("#scrolltop").fadeOut();
				}
			});

			$("#scrolltop").click(function(){
				$("html, body").animate({
					scrollTop : '0'
				}, 'slow');
			});
		},
		executecode_here : function(){
			// For the responsive menu
			this.respMenu();

			// For the Contact Us
			this.contactus();

			// Menu Scroll
			this.menuscroll();

			// Scroll to top
			this.scrolltotop();
		}
	}

	GLOBAL.executecode_here();


function in_array(needle, haystack, argStrict) {
  var key = '',
  strict = !! argStrict;
  if (strict) {
    for (key in haystack) {
      if (haystack[key] === needle) {
        return true;
      }
    }
  } else {
    for (key in haystack) {
      if (haystack[key] == needle) {
        return true;
      }
    }
  }
  return false;
}

});