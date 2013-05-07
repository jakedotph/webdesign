<div class="containerfloat" style="height:340px;margin-top:-170px" id = "uploadimageform">
	<div class="remove" style="float:right;margin-right:-10px;margin-top:-10px;">
			<img id = "uploadimageformclose" style="opacity:1" src="<?=base_url('assets/res/delete.png')?>"/>
	</div>
	<div class="header" id = "galleryheader">			
		Upload your website screenshot
	</div>
	<div align = "center" >
		<?
			$this->load->helper('form');
			echo form_open_multipart('designer/upload');
		?>
		
		<div style="margin-top:20px;margin-bottom:20px;">		
		<input type="file" name="userfile" size="20" />
		<input id="inputimageid" type="hidden" name="image_id" value="notset"/>		
		</div>
		
		<table>
			<tr><td>Name</td><td><input type="text" name = "image_name" size = "30" value=""/></td></tr> 	
			<tr><td>Description</td>
			<td colspan = "2">
				<textarea name = "image_desc" rows="7" cols="24"></textarea>
			</td></tr>
		</table>
		
		<br>		
		<input type="submit" value="Upload Now"/>	
		</form>
	</div>
	<br>
</div>