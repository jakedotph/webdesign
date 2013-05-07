<?=link_tag('assets/css/style.css');?>

<div class="container"  style="width:50%">
	<div class="header">
	Designer Page
	</div>
	<?$this->load->view('main/profile/designer_info.php',$data);?>
</div>
<br style="clear:both">
<br>
<div>
<?
if(isset($images))
	$this->load->view('main/gallery/display_gallery.php',$images);
else
	$this->load->view('main/gallery/display_gallery.php');	
?>

</div>