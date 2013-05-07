<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DesignerManager
{
	var $CI;
	var $error_msg;
	var $data;
	var $fields;
		
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->data = Array();		
		$this->CI->load->database();
		$this->CI->load->library('session');
	}
	
	public function create_designer($data)
	{				
		if($this->fetch_designer($data["des_username"]))
		{
			$this->error_msg = "Designer already exist!";
			return false;
		}
				
		$fields = $this->CI->db->list_fields('DESIGNER');		
		$insert = Array();		
		
		foreach($fields as $field)
		{
			if(isset($data[$field]))
				$insert[] = array($field,$data[$field]);
		}
		
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
		return $exec;		
	}
	
	public function update_designer($des_id,$data)
	{		
		$fields = $this->CI->db->list_fields('DESIGNER');
		
		$insert = Array();
		foreach($fields as $field)
		{
			if(isset($data[$field]))
				$insert[] = array($field,$data[$field]);
		}
		
		$insertscript = 'Update DESIGNER set ';
		$insertmax = count($insert); 
		for($i=0;$i<$insertmax-1;$i++)
			$insertscript .= $insert[$i][0] . ' = ' . "'".$insert[$i][1]."', ";		
		$insertscript .= $insert[$i][0] . ' = ' . "'".$insert[$i][1]."' ";		
		$insertscript .= "where des_id = '".$des_id."'";		
		$exec = $this->CI->db->query($insertscript);				
		return $exec;
	}
	
	public function fetch_designer($username)
	{
		$sql = "Select * from DESIGNER where des_username = '".$username."'";
		$query = $this->CI->db->query($sql);		
		
		if($query->num_rows()==1)
		{
			$this->data = $query->result()[0];
			return $this->data;
		}
		else
			$this->error_msg = "No designer found";		
	}
	
	public function check_exists($des_id)
	{
		$sql = "Select * from DESIGNER where des_id = '".$des_id."'";
		$query = $this->CI->db->query($sql);
		
		if($query->num_rows()==1)
		{
			$this->data = $query->result()[0];
			return $this->data;
		}
		else
			$this->error_msg = "No designer found";
	}
	
	public function delete_designer($des_id)
	{
		if(!$this->check_exists($des_id))
			return true;
		$sql = "Delete from DESIGNER where des_id ='".$des_id."'";
		$exec = $this->CI->db->query($sql);
		return $exec;
	}
	
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