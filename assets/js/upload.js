$(document).ready(function(){	
	$("div#uploadimageform").hide();
	
	$("img#uploadimageformclose").click(function(){
		$("div#uploadimageform").fadeOut(500);
	});
	
		$(window).scroll(function () {
		set = $(document).scrollTop()+170+"px";
		$('div#uploadimageform').animate({top:set},{duration:500,queue:false});
	});
});

$.fn.upload = function() {
    $("div#uploadimageform").fadeIn(500);
};