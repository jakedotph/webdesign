<script src="<?=base_url('assets/js/jquery.js');?>"></script>

<script>
	$(document).ready(function(){
		$("div.error").hide();
		$("div.error").fadeIn(200).fadeOut(200).fadeIn(200).delay(2000).fadeOut(500);
		$("div.error").click(function(){
			$(this).fadeOut(500);
		});
	});
</script>

<div class = "error">
<p><? echo $error?></p>
</div>