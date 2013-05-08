<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*

Designer Manager		

---Creates, Updates and Deletes designer data

**/

class DesignerManager
{
	//Global Declarations
	var $CI;
	var $error_msg;
	var $data;
	var $fields;
		
	//Class Constructor
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->data = Array();		
		$this->CI->load->database();
		$this->CI->load->library('session');
	}
	
	//Inserts supplied data to the DESIGNER and DESIGNER_ACCOUNT tables
	//Sample
	//		$data["des_username"] = "myusername";
	//		...
	//		if(!$desmgr->create_designer($data))
	//			echo $desmgr->get_error_message();
	public function create_designer($data)
	{	
		//Check if designer username already exist -> defined by $type["des_username"]
		$type["des_username"] = $data["des_username"];		
		if($this->fetch_designer($type))
		{
			$this->error_msg = "Designer already exist!";
			return false;
		}
		
		//Get all fields from the DESIGNER
		$fields = $this->CI->db->list_fields('DESIGNER');		
		$insert = Array();		
		
		//Set to insert only fields supplied in the $data
		foreach($fields as $field)
		{
			if(isset($data[$field]))
				$insert[] = array($field,$data[$field]);
		}
		
		//Insertion starts here : All data insertion scripts are created automatically to be
		//flexible for database field changes
		$insertscript = 'Insert into DESIGNER(';
		$insertmax = count($insert); 
		for($i=0;$i<$insertmax-1;$i++)
			$insertscript .= $insert[$i][0] . ',';
		
		$insertscript .= $insert[$insertmax-1][0] . ') ';
		
		$insertscript .= 'values (';
		for($i=0;$i<$insertmax-1;$i++)
			$insertscript .= "'".$insert[$i][1] . "',";
		$insertscript .= "'".$insert[$insertmax-1][1] . "') ";
		
		$exec = $this->CI->db->query($insertscript);
		//If insert to DESIGNER succeed
		if($exec)
		{
			//Find the current des_id of the newly inserted designer
			$sql = "Select max(des_id) as des_id from DESIGNER";
			$query = $this->CI->db->query($sql);
			if($query->num_rows()==1)
			{
				$des_id = $query->result()[0]->des_id;
				//Creates data for DESIGNER_ACCOUNT
				return $this->create_designer_account($des_id,$data);
			}
		}
	}
	
	//Creates designer account
	//@params : des_id, array of data fields
	public function create_designer_account($des_id,$data)
	{
		//Get all fields from DESIGNER_ACCOUNT table
		$fields = $this->CI->db->list_fields('DESIGNER_ACCOUNT');		
		$insert = Array();
		
		$data["des_id"] = $des_id;
		
		//Set to insert only fields supplied in the $data
		foreach($fields as $field)
		{
			if(isset($data[$field]))
				$insert[] = array($field,$data[$field]);
		}
		
		//Insertion starts here : All data insertion scripts are created automatically to be
		//flexible for database field changes
		$insertscript = 'Insert into DESIGNER_ACCOUNT(';
		$insertmax = count($insert); 
		for($i=0;$i<$insertmax-1;$i++)
			$insertscript .= $insert[$i][0] . ',';
		
		$insertscript .= $insert[$insertmax-1][0] . ') ';
		
		$insertscript .= 'values (';
		for($i=0;$i<$insertmax-1;$i++)
			$insertscript .= "'".$insert[$i][1] . "',";
		$insertscript .= "'".$insert[$insertmax-1][1] . "') ";
		
		$exec = $this->CI->db->query($insertscript);
		//If insertion succeeds, return the result (boolean)
		return $exec;
	}

	//Get all designer's data
	//@param : array of selected field represented by $type
	//@returns: associative designer data
	//
	//$type["des_username"] = "username" - get designer data using its username
	//$type["des_id"] = "id" - get designer data using its id
	public function fetch_designer($type)
	{
		
		if(isset($type["des_username"]))
			return $this->fetch_un_designer($type["des_username"]);
		else if(isset($type["des_id"]))			
			return $this->fetch_id_designer($type["des_id"]);
	}
	
	//Get designer data given its username
	//@param : $des_username
	//@returns: associative designer data
	public function fetch_un_designer($username)
	{			
		$sql = "Select des_id from DESIGNER_ACCOUNT where des_username = '".$username."'";
		
		$query = $this->CI->db->query($sql);
		
		if($query->num_rows()==1)
		{						
			$des_id = $query->result()[0]->des_id;
			$sql = "Select * from DESIGNER where des_id = '".$des_id."'";
			$query = $this->CI->db->query($sql);
			if($query->num_rows()==1)
			{
				return $query->result()[0];
			}
			else
				$this->error_msg = "No designer found";
		}
		else
			$this->error_msg = "No designer found";		
	}
	
	//Get designer data given its id
	//@param : $des_id
	//@returns: associative designer data
	public function fetch_id_designer($des_id)
	{		
		$sql = "Select * from DESIGNER where des_id = '".$des_id."'";		
		$query = $this->CI->db->query($sql);		
		
		if($query->num_rows()==1)
		{
			return $query->result()[0];
		}
		else
			$this->error_msg = "No designer found";
	}
	
	//Get designer account data given its id
	//@param : $des_id
	//@returns: associative designer account data
	public function fetch_id_designer_account($des_id)
	{		
		$sql = "Select * from DESIGNER_ACCOUNT where des_id = '".$des_id."'";
		$query = $this->CI->db->query($sql);
		if($query->num_rows()==1)
		{
			return $query->result()[0];
		}
		else
			$this->error_msg = "No designer found";
	}
	
	//Modifies designer data
	//@param : des_id, array of fields
	//Sample
	//		$data["des_fname"] = "new name"; //will only update des_fname		
	public function update_designer($des_id,$data)
	{		
		$fields = $this->CI->db->list_fields('DESIGNER');
		
		$insert = Array();
		foreach($fields as $field)
		{
			if(isset($data[$field]))
				$insert[] = array($field,$data[$field]);
		}
		
		//Automated update script : for program flexibility
		$insertscript = 'Update DESIGNER set ';
		$insertmax = count($insert); 
		for($i=0;$i<$insertmax-1;$i++)
			$insertscript .= $insert[$i][0] . ' = ' . "'".$insert[$i][1]."', ";		
		$insertscript .= $insert[$i][0] . ' = ' . "'".$insert[$i][1]."' ";		
		$insertscript .= "where des_id = '".$des_id."'";		
		$exec = $this->CI->db->query($insertscript);		
		return $exec;
	}
	
	//Deletes all designer related tables data
	//No physical changes : All designer's local data will not be affected
	public function delete_designer($des_id)
	{			
		$type["des_id"] = $des_id;
		if(!$this->fetch_designer($type))
			return true;
		
		$sql = "Delete from DESIGNER_ACCOUNT where des_id ='".$des_id."'";
		$exec = $this->CI->db->query($sql);
		if($exec)
		{
			$sql = "Delete from DESIGNER_GALLERY where des_id ='".$des_id."'";
			$exec = $this->CI->db->query($sql);
			if($exec)
			{
				$sql = "Delete from DESIGNER where des_id ='".$des_id."'";
				$exec = $this->CI->db->query($sql);
			}
		}
		return $exec;
	}
	
	//Gets the current error message
	//@returns : error message	
	public function get_error_message()
	{
		return $this->error_msg;
	}
	
	public function get_designer_data($field)
	{
		if(isset($this->data[$field]))
			return $this->data[$field];
	}
}