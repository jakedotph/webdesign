<script src="<?=base_url('assets/js/registerform.js');?>"></script>

<div id = "registerform" class="containerfloat" style="width:600px;height:540px;margin-top:-270px;margin-left:-300;">
	<div class="remove" style="float:right;margin-right:-10px;margin-top:-10px;">
		<img id = "registerformclose" style="opacity:1" src="<?=base_url('assets/res/delete.png')?>"/>
	</div>
	<div class="header">
	Register Designer
	</div>
	<div class="registerform">
	
		<?php
			$this->load->helper('form');	
			echo form_open('register');
		?>
		
		<ul class="formlist">
			<li>Username
				<br><? echo isset($data["des_username"])?form_input('des_username',$data["des_username"]):form_input('des_username')?>
			</li>
			
			<li>
			
				<div style="float:left;">First Name
					<br><? echo isset($data["des_fname"])?form_input('des_fname',$data["des_fname"]):form_input('des_fname')?>
				</div>
				<div style="float:left;">Middle Name
					<br><? echo isset($data["des_mname"])?form_input('des_mname',$data["des_mname"]):form_input('des_mname')?>
				</div>
				<div>	Last Name
					<br><? echo isset($data["des_lname"])?form_input('des_lname',$data["des_lname"]):form_input('des_lname')?>
				</div>
			</li>
			
			<li>Contact Number
				<br><? echo isset($data["contact_no"])?form_input('contact_no',$data["contact_no"]):form_input('contact_no')?>
			</li>
		
			<li>Email Address
				<br><td><? echo isset($data["email_add"])?form_input('email_add',$data["email_add"]):form_input('email_add')?>
			</li>
			
			<li>Location
				<br><td><? echo isset($data["location"])?form_input('location',$data["location"]):form_input('location')?>
			</li>
			
			<li>About yourself
				<br><? echo isset($data["about"])?form_input('about',$data["about"]):form_input('about')?>
			</li>
			
			<li>Password
				<br><? echo form_password('password');?>
			</li>
			
			<li style = "float:right; margin-right:20px">
				<? echo form_submit('register','Register Now');?>
			</li>
		</ul>	
		<?=form_close()?>
	</div>
</div>