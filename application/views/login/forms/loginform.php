<script src="<?=base_url('assets/js/loginform.js');?>"></script>
<div id = "loginform" class="containerfloat" style="height:200px;margin-top:-100px;">
	<div class="remove" style="float:right;margin-right:-10px;margin-top:-10px;">
		<img id = "loginformclose" style="opacity:1" src="<?=base_url('assets/res/delete.png')?>"/>
	</div>
	
	<div class="header">
		Login Designer
	</div>
	<br>		
	<div align="center">
	<?php
		$this->load->helper('form');				
		echo form_open('login/validate');
	?>

	<table>
		<tr>
			<td align="right">Username</td>
			<td><? echo form_input('username')?></td>
		</tr>
		<tr>
			<td align="right">Password</td>
			<td><? echo form_password('password')?></td>
		</tr>						
	</table>	
	<? echo form_submit('login','Login')?>		
	<?=form_close()?>
	</div>
</div>