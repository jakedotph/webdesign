<!--Picture Container for Image ID (<?=$image["ID"];?>)-->

<div class="webpicscontainer"
	onmouseover="$(this).showchangestrip(<?=$image["ID"];?>);" 
	onmouseout="$(this).hidechangestrip(<?=$image["ID"];?>);"
>
	
	<div class="change" id = "<?=$image["ID"];?>">
		<div class="modify" style="float:left;">
			<button style="border-style:none;background-color:transparent;" onclick="$(this).showeditform(<?=$image["ID"];?>,'<?=$image["Name"];?>','<?=$image["Description"];?>','<?=base_url(UPLOADGALLERYDIRNAME.$image["URL"]);?>');">
				<img style="opacity:1" src="<?=base_url('assets/res/edit.png')?>"/>
			</button>
		</div>
		<div class="remove" style="float:right;">
			<?
				$this->load->helper('form');
				echo form_open('designer/deleteimage');
				echo form_hidden("image_id",$image["ID"]);				
			?>
			<button type="submit" style="border-style:none;background-color:transparent;">
				<img style="opacity:1" src="<?=base_url('assets/res/delete.png')?>"/>
			</button>
			<?=form_close()?>
		</div>
	</div>	
	<img class = "webpic" src="<?=base_url(UPLOADGALLERYDIRNAME.$image["URL"]);?>" alt="" align="center"/>
	<div class="header" onclick="$(this).toggledescription(<?=$image["ID"];?>);">
		<?=$image["Name"];?>		
	</div>		
</div>
<div id = "<?='img'.$image["ID"];?>" class="gallerydesc">
	<textarea class = "content" readonly><?=$image["Description"];?>
	</textarea>
	</div>
