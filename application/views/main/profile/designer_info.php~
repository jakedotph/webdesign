<script src="<?=base_url('assets/js/jquery.js')?>"></script>


<div class = "profiledata" >
	<div class = "avatarcontainer" style="float:left;">
	<img id = "avatar" src="<?=base_url('assets/res/avatar.png') ?>" alt="" width = "100" height= "100"/>	
	</div>
	<div class ="datacontainer" style="float:left;">
		<table>
			<tr><td>Username : </td><td><?=$username?></td></tr>
			<tr><td>Real Name : </td><td><?=$name?></td></tr>
			<tr><td>About : </td><td><?=$about?></td></tr>
			<tr><td colspan="2" align="center">
				<? $this->load->helper('form');
					echo form_open('designer/update');
					echo form_submit('change','Change');
					echo form_close();
				?></tr></td>			
		</table>		
	</div>	
	<div style="clear:both"></div>
</div>