<?=link_tag('assets/css/style.css');?>
<script src="<?=base_url('assets/js/jquery.js')?>"></script>
<script src="<?=base_url('assets/js/gallery.js')?>"></script>
<script src="<?=base_url('assets/js/upload.js')?>"></script>

<div class = "gallery">
	<div class="header" id = "galleryheader">			
	<label style="float:left">Gallery</label>
		<div class="uploadform" style="float:right">			
			<button onclick="$(this).upload()" style="border-style:none;">
				<img style="opacity:1" height="24" width="24" src="<?=base_url('assets/res/upload.png')?>"/>
			</button>
		</div>
	<div style="clear:both"></div>
	</div>
	
	<div class ="content" id = "gallerycontent">
		<? if(!isset($images)) : ?>
		
		<div align="center">
			Your gallery is empty. Upload Now
			<div onclick="$(this).upload()">						
				<button style="border-style:none;background-color:transparent;">
					<img style="opacity:1" src="<?=base_url('assets/res/upload.png')?>"/>
				</button>				
			</div>
		</div>
		<br>
		
		<? else : ?>
			<? foreach($images as $image) : ?>
				<? $this->load->view('main/gallery/webpic_container',array("image"=>$image)); ?>
			<? endforeach; ?>			
		<? endif; ?>
	</div>
</div>

<br style="clear:both">
<br>

<?				
	$this->load->view('main/gallery/uploadform',array("action"=>"designer/upload"));
	$this->load->view('main/gallery/forms/modify_image');
?>
