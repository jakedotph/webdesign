$(document).ready(function(){	
	$("div#loginform").hide();
	
	$("img#loginformclose").click(function(){
		$("div#loginform").fadeOut(500);
	});
	
		$(window).scroll(function () {
		set = $(document).scrollTop()+100+"px";
		$('div#loginform').animate({top:set},{duration:500,queue:false});
	});
});

$.fn.loginform = function() {
	 $("div#registerform").hide(500);	
    $("div#loginform").fadeToggle(500);
};