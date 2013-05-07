
<?
if(!isset($images))
	$this->load->view('main/gallery/display_gallery');
else
	 $this->load->view('main/gallery/display_gallery',$images);
?>