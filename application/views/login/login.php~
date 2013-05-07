<?=link_tag('assets/css/style.css');?>
<div class="container">
<div class="header">Login Designer</div>
<?php
	$this->load->helper('form');	
	$this->load->helper('url');	
	echo form_open('login/validate');
?>

<table>
	<tr>
		<td>Username</td>
		<td><? echo form_input('username')?></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><? echo form_password('password')?></td>
	</tr>
	<tr>
		<td colspan='2' align='center'><? echo form_submit('login','Login')?></td>		
	</tr>
</table>

</div>

<hr>

No account yet? <a href= <?php echo site_url('registration')?> >Register</a>