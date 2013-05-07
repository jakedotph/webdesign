<?php

class Login_User extends CI_Controller
{
	public function __construct()
	{
		parent :: __construct();
		$this->load->library('accountmanager');
		$this->load->helper('url');
	}
	
	public function index()
	{			
		$username = $this->input->post("username");
		$password = $this->input->post("password");		

		$accmgr = $this->accountmanager;		
		
		if(!$des_id = $accmgr->validate_designer($username,$password))
		{
			redirect('login/retry');
			return;
		}
		else
		{			
			$accmgr->create_session($des_id);
			redirect('designer');	
		}
	}
	
	public function load_main($message=null)
	{
		$this->load->view('template/menu');
		
		if(isset($message["error"]))
			$this->load->view('msg/error_msg',array("error"=>$message["error"]));
		else if(isset($message["notify"]))
			$this->load->view('msg/notify_msg',array("notify"=>$message["notify"]));
		
		$this->load->view('login/forms/loginform');
		$this->load->view('login/forms/registerform');
	}
	
	public function authentication_failed()	
	{							
		$message["error"] = "Invalid Username or Password";
		$this->load_main($message);	
	}
	
	public function session_expired()
	{				
		$message["error"] = "You must login first";
		$this->load_main($message);
	}
	
	public function notify_activation()
	{	
		$message["notify"] = "Your account is successfully registered. You will receive an email when approved. Thank you!";
		$this->load_main($message);
	}
}