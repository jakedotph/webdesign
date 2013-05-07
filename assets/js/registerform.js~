$(document).ready(function(){	
	$("div#registerform").hide();
	
	$("img#registerformclose").click(function(){
		$("div#registerform").fadeOut(500);
	});
	
		$(window).scroll(function () {
		set = $(document).scrollTop()+100+"px";
		$('div#registerform').animate({top:set},{duration:500,queue:false});
	});
});

$.fn.registerform = function() {
	 $("div#loginform").hide(500);
    $("div#registerform").fadeToggle(500);
};