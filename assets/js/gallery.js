$(document).ready(function(){
	/*				
	$("#galleryheader").click(function(){
		$("#gallerycontent").slideToggle(500);					
	});
	*/
	
	$("div.change").hide();
	$("div#editimageform").hide();
	$("div.gallerydesc").hide();
	
	$("img#editimageformclose").click(function(){
		$("div#editimageform").fadeOut(500);
	});
	
	$(window).scroll(function () {
		set = $(document).scrollTop()+300+"px";
		$('div#editimageform').animate({top:set},{duration:500,queue:false});
	});
});

$.fn.showchangestrip = function(image_id) {
     $("div.change#"+image_id).show();		
};

$.fn.hidechangestrip = function(image_id) {
     $("div.change#"+image_id).hide();
};

$.fn.toggledescription = function(image_id) {
     $("div.gallerydesc#img"+image_id).toggle(500);	
}

$.fn.showeditform = function(image_id,image_name,image_desc,image_url)
{
	$("img.editimageimage").attr("src",image_url);
	$("input#inputimageid").attr("value",image_id);
	$("input#inputimagename").attr("value",image_name);
	$("textarea#inputimagedesc").text(image_desc);
	$( "div#editimageform" ).fadeIn();
};