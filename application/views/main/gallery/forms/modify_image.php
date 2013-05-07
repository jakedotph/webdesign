<div class="containerfloat" id = "editimageform">
	<div class="remove" style="float:right;margin-right:-10px;margin-top:-10px;">
		<img id = "editimageformclose" style="opacity:1" src="<?=base_url('assets/res/delete.png')?>"/>
	</div>
	<div class="header" id = "galleryheader">
		Modify website screenshot data
	</div>
			
	<div class="editimagecontainter" align="center">
		<img class="editimageimage" src="#"></img>
	</div>
	<br>
	<div align="center">
		<?		
			$this->load->helper('form');
			echo form_open('designer/modifyimage');
		?>
			<input id="inputimageid" type="hidden" name="image_id" value="notset"/>
			<table>
				<tr><td>Name</td><td><input type="text" name = "image_name" size = "30" id="inputimagename" value="Name Here"/></td></tr> 	
				<tr><td>Description</td>
				<td colspan = "2">
					<textarea id = "inputimagedesc" name = "image_desc" rows="7" cols="24"></textarea>
				</td></tr>
			</table>
			<br>			
			<?=form_submit('modify','Modify')?>
			<?=form_close()?>
	</div>
</div>