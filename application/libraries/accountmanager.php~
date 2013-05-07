<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AccountManager
{
	var $error_msg;
	var $CI;
	var $desmgr;
	
	public function __construct()
	{						
		$this->CI =& get_instance();
		$this->CI->load->database();
		$this->CI->load->library('session');
		$this->CI->load->library('designermanager');
		$this->desmgr = $this->CI->designermanager;
	}
	
	public function create_session($designer_id)
	{		
		$this->CI->session->set_userdata("designer_id",$designer_id);
		$this->CI->session->set_userdata("isloggedin",TRUE);		
	}
			
	public function check_session()
	{
		$des_id = $this->CI->session->userdata("designer_id");
		if($des_id && $this->CI->session->userdata("isloggedin"))
			return $des_id;
		else
			$this->error_msg = "Session expired";
	}
	
	public function close_session()
	{
		$this->CI->session->sess_destroy();
	}
	
	public function validate_designer($username,$password)
	{
		$sql = "Select des_id from DESIGNER_ACCNT where des_username = '$username' and password = '$password'";
		$query = $this->CI->db->query($sql);
		
		if($query->num_rows()==1)
		{
			$result = $query->result();
			return $result[0]->des_id;
		}
		else
			$this->error_msg = "Invalid username or password";
	}
	
	public function check_exists($des_id)
	{
		$sql = "Select des_username from DESIGNER_ACCNT where des_id = '$des_id'";
		$query = $this->CI->db->query($sql);		
		
		if($query->num_rows()==1)
		{
			$result = $query->result();			
			return $result[0];
		}
		else
			$this->error_msg = "User does not exist";
	}
	
	public function approve_designer($des_id)
	{
		if($this->check_exists($des_id))
		{
			$this->error_msg = "Designer already exist";
			return false;
		}
		
		if(!$data = $this->desmgr->check_exists($des_id))
			return $this->desmgr->get_error_message();
		
		$sql = "Insert into DESIGNER_ACCNT(des_username,password,des_id) values ('$data->des_username','$data->password','$des_id')";
		$exec = $this->CI->db->query($sql);				
		
		if($exec)
		{
			$this->desmgr->update_designer($des_id,array("status"=>1));
			return true;
		}
		else
			$this->error_msg = "Internal Error: " . mysql_error();
	}	
	
	public function disable_designer($des_id)
	{
		if(!$this->check_exists($des_id))
			return true;		
		
		$sql = "Delete from DESIGNER_ACCNT where des_id = '$des_id'";
		$exec = $this->CI->db->query($sql);

		if($exec)
		{	
			if($this->desmgr->delete_designer($des_id))
			{
				/*
					Add removal of designer's web images and requests command here			
				*/
			}
		}
		else
			$this->error_msg = "Internal Error: " . mysql_error();
		
		return $exec;
	}
	
	public function get_error_message()
	{
		return $this->error_msg;
	}
}