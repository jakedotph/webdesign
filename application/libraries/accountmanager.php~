<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*

Account Manager Library

---Approves and Disables designer account
---Provides login and logout, session support

**/

class AccountManager
{
	
	//Global Declarations
	var $error_msg;
	var $CI;
	var $desmgr;
	
	//Class Constructor
	public function __construct()
	{						
		$this->CI =& get_instance(); //Loads CI Instance, since libraries cannot access '$this->' automatically
		$this->CI->load->database();
		$this->CI->load->library('session');
		$this->CI->load->library('designermanager'); //Loads the designer manager library
		$this->desmgr = $this->CI->designermanager;
	}
	
	//Set up session for the current user
	public function create_session($designer_id)
	{		
		$this->CI->session->set_userdata("designer_id",$designer_id);
		$this->CI->session->set_userdata("isloggedin",TRUE);		
	}
			
	//Checks if currently logged in
	//returns : des_id
	public function check_session()
	{
		$des_id = $this->CI->session->userdata("designer_id");
		if($des_id && $this->CI->session->userdata("isloggedin"))
			return $des_id;
		else
			$this->error_msg = "Session expired";
	}
	
	//Closes the session - All session data will be dumped
	public function close_session()
	{
		$this->CI->session->sess_destroy();
	}
	
	//Checks whether designer exists in the designer account and already approved by the admin
	//returns : des_id
	public function validate_designer($username,$password)
	{
		$sql = "Select des_id from DESIGNER_ACCOUNT where des_username = '$username' and des_password = '$password'";
		$query = $this->CI->db->query($sql);
		
		if($query->num_rows()==1)
		{
			$result = $query->result();
			$des_id = $result[0]->des_id;
			
			$type["des_id"] = $des_id; 
			$desdata = $this->desmgr->fetch_designer($type);
			if($desdata->des_status == "1") //Checks if approved
				return $des_id;
			else
				$this->error_msg = "Your account has not been approved yet.";
		}
		else
			$this->error_msg = "Invalid username or password";
	}
	
	//Checks whether designer exists in the designer account
	//returns : all DESIGNER_ACCOUNT data for the current designer
	public function check_exists($des_id)
	{
		$sql = "Select des_username from DESIGNER_ACCOUNT where des_id = '$des_id'";
		$query = $this->CI->db->query($sql);
		
		if($query->num_rows()==1)
		{
			$result = $query->result();			
			return $result[0];
		}
		else
			$this->error_msg = "User does not exist";
	}
	
	//Approves designer by updating des_status to '1'
	//@param : des_id
	public function approve_designer($des_id)
	{
		$type["des_id"] = $des_id;
		if(!$data = $this->desmgr->fetch_designer($type))
			return $this->desmgr->get_error_message();
		
		$this->desmgr->update_designer($des_id,array("des_status"=>1));
		return true;
	}
	
	//Totally deletes designer data in DESIGNER and DESIGNER_ACCOUNT tables
	//@param : des_id
	public function disable_designer($des_id)
	{
		if($this->desmgr->delete_designer($des_id))
		{
			/*
				Add removal of designer's web images and requests command here			
			*/
		}
		else
			$this->error_msg = "Internal Error: " . mysql_error();
	}
	
	//Gets the current error message
	//returns : error message	
	public function get_error_message()
	{
		return $this->error_msg;
	}
}