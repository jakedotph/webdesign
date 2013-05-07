<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GalleryManager
{
	var $error_msg;
	var $CI;
	
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->database();
	}
	
	public function add_image($des_id,$image_name,$image_des)
	{
		$sql = "Insert into DESIGNER_GALLERY(des_id,image_name,image_desc) values ('".$des_id."','".$image_name."','".$image_des."')";
		$exec = $this->CI->db->query($sql);
		if($exec)
		{
			return $this->get_max_image_id($des_id);
		}
		return $exec;
	}
	
	public function get_max_image_id($des_id)
	{
		$sql = "Select max(image_id) as image_id from DESIGNER_GALLERY where des_id = '".$des_id."'";
		$exec = $this->CI->db->query($sql);
		if($exec)
		{
			return $exec->result()[0]->image_id;
		}
	}
	
	public function generate_name($des_username,$des_id,$image_id)
	{
		return $des_username."_".$des_id."_".$image_id.".jpg";
	}
	
	public function update_image_data($des_id,$image_id,$image_name,$image_des)
	{
		$sql = "Update DESIGNER_GALLERY set image_name = '$image_name', image_desc = '$image_des' where image_id = $image_id and des_id = $des_id";
		$exec =  $this->CI->db->query($sql);
		return $exec;
	}
	
	public function delete_image($des_username,$des_id,$image_id)
	{		
		$path = UPLOADGALLERYDIR.$this->generate_name($des_username,$des_id,$image_id);
		if(file_exists($path))
		{
			if(unlink($path))
			{
			}
			else
				echo 'Failed to delete';
		}
		
		$sql = "Delete from DESIGNER_GALLERY where image_id = '".$image_id."'";
		return $exec = $this->CI->db->query($sql);
	}
	
	public function get_all_images($des_id)
	{						
		$sql = "Select * from DESIGNER_GALLERY where des_id = '".$des_id."'";
		$query = $this->CI->db->query($sql);
		if($query->num_rows()>=1)
		{
			return $query->result();
		}
	}
	
	public function get_all_image_data($des_id)
	{
		$imagenames = array();
		$desdata = $this->CI->designermanager->check_exists($des_id);
		if($images = $this->get_all_images($des_id))
		{					
			$intCtr=0;
			foreach($images as $image)
			{
				$imagenames[$intCtr]["ID"] = $image->image_id;
				$imagenames[$intCtr]["URL"] = $this->generate_name($desdata->des_username,$des_id,$image->image_id);
				$imagenames[$intCtr]["Name"] = $image->image_name;
				$imagenames[$intCtr]["Description"] = $image->image_desc;
				$intCtr++;
			}
			
			return $imagenames;
		}
	}
	
	public function rename($path,$newname)
	{
		return rename($path,$newname);
	}
}