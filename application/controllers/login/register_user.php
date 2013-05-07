<?php

class Register_User extends CI_Controller
{
	public function __construct()
	{
		parent :: __construct();
		
		$this->load->library('accountmanager');
		$this->load->library('designermanager');
	}
	
	public function load_main($message=null,$data=null)
	{
		$this->load->view('template/menu');
		
		if(isset($message["error"]))
			$this->load->view('msg/error_msg',array("error"=>$message["error"]));
		else if(isset($message["notify"]))
			$this->load->view('msg/notify_msg',array("notify"=>$message["notify"]));
		
		$this->load->view('login/forms/loginform');	
		$this->load->view('login/forms/registerform',isset($data["data"])?array("data"=>$data["data"]):null);
	}	
	
	public function register()
	{
		$accmgr = $this->accountmanager;
		$desmgr = $this->designermanager;
				
		$data["des_username"] = $this->input->post("des_username");
		$data["des_fname"] = $this->input->post("des_fname");
		$data["des_mname"] = $this->input->post("des_mname");
		$data["des_lname"] = $this->input->post("des_lname");
		$data["email_add"] = $this->input->post("email_add");
		$data["contact_no"] = $this->input->post("contact_no");
		$data["password"] = $this->input->post("password");
		$data["location"] = $this->input->post("location");
		$data["about"] = $this->input->post("about");
		
		if(!$desmgr->create_designer($data))
		{			
			$message["error"] = $desmgr->get_error_message();
			$dataall["data"] = $data;	
			$this->load_main($message,$dataall);
		}
		else
			redirect('login/notify');
	}
}