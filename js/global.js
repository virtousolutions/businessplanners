jQuery(function($){
	var _token = $("meta[name='token']").attr('content');
	// console.log(window.location.hash.substring(1))
	var GLOBAL = {
		respMenu : function(){
			$("#top-menu #btn-resp").click(function(){
				$("#banner").toggleClass('forbanner');
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
			$("#footer-menu li a").on('click', function(){
				var $contactus = $(".thecontactus").offset();
				$("html, body").animate({
					scrollTop : $contactus.top
				}, 'slow');
			});
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
					$("#scrollcon").addClass('scrolltop');
					$(".scrolltop").fadeIn();
				}else if($(this).scrollTop() == 100){
					$("#scrollcon").removeClass('scrolltop');
					$(".scrolltop").fadeOut();
				}
				else{
					$("#scrollcon").removeClass('scrolltop');
					$(".scrolltop").fadeOut();
				}
			});

			$(".scrolltop").click(function(){
				$("html, body").animate({
					scrollTop : '0'
				}, 700);
			});
		},
		checknametag : function(){
			if(window.location.hash.substring(1) == 'forfeature'){
				console.log(window.location.hash.substring(1));
				var $feature = $(".thefeature").offset();
				$("html, body").animate({
					scrollTop : $feature.top
				}, 'slow');
			}
			if(window.location.hash.substring(1) == 'forcontactus'){
				var $contactus = $(".thecontactus").offset();
				$("html, body").animate({
					scrollTop : $contactus.top
				}, 'slow');
			}
		},
		newRevBanner : function(){
			$('.head-banner').carousel({
			  interval: 5000
			});
		},
		fixednavigation : function(){
			$(window).scroll(function(event) {
				/* Act on the event */
				if($(this).scrollTop() > 100){
					$("#head-bg").css({
						position: 'fixed',
						top: '0',
						zIndex: '99999',
						backgroundColor: '#FFF',
					});
				}else{
					$("#head-bg").attr('style', '');
				}
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

			this.checknametag();

			this.newRevBanner();

			this.fixednavigation();
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