<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*

Gallery Manager

---Provides essential functions for adding, modifying, fetching, and deleting of designer images

**/

class GalleryManager
{
	//Global Declarations
	var $error_msg;
	var $CI;
	
	//Class Constructor
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->database();
	}
	
	//Inserts image data to the database
	//@params : designer id, image name, image description
	//@returns : image id
	public function add_image($des_id,$image_name,$image_des)
	{
		$sql = "Insert into DESIGNER_GALLERY(des_id,image_name,image_desc) values ('".$des_id."','".$image_name."','".$image_des."')";
		$exec = $this->CI->db->query($sql);
		if($exec)
		{
			$image_id = $this->get_max_image_id($des_id);
			if($this->update_image_filename($des_id,$image_id))
				return $image_id;						
		}
		return $exec;
	}
	
	//Returns the current maximum image_id - commonly the newly inserted/uploaded image
	//@params: designer id
	public function get_max_image_id($des_id)
	{
		$sql = "Select max(image_id) as image_id from DESIGNER_GALLERY where des_id = '".$des_id."'";
		$exec = $this->CI->db->query($sql);
		if($exec)
		{
			return $exec->result()[0]->image_id;
		}
	}
	
	//Returns the local filename of the image
	//@params: designer id, image id
	//@returns: [designer id]_[image_id] - official image naming protocol
	public function generate_name($des_id,$image_id)
	{		
		return $des_id."_".$image_id.".jpg";
	}
	
	//Updates the image data to the database
	//@params : designer id, image id, image name, image description
	public function update_image_data($des_id,$image_id,$image_name,$image_des)
	{
		$sql = "Update DESIGNER_GALLERY set image_name = '$image_name', image_desc = '$image_des' where image_id = $image_id and des_id = $des_id";
		$exec =  $this->CI->db->query($sql);
		return $exec;
	}
	
	//Updates image's filename
	//@params : designer id, image id
	public function update_image_filename($des_id,$image_id)
	{
		$filename = $this->generate_name($des_id,$image_id);
		$sql = "Update DESIGNER_GALLERY set file_name = '".$filename."' where image_id = $image_id and des_id = $des_id";
		$exec =  $this->CI->db->query($sql);
		return $exec;
	}
	
	//Deletes image, logical and physical data
	//@params : designer id, image id
	public function delete_image($des_id,$image_id)
	{		
		$path = UPLOADGALLERYDIR.$this->generate_name($des_id,$image_id);
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
	
	//Returns all image data (complete)
	//@params : designer id
	public function get_all_images($des_id)
	{						
		$sql = "Select * from DESIGNER_GALLERY where des_id = '".$des_id."'";
		$query = $this->CI->db->query($sql);
		if($query->num_rows()>=1)
		{
			return $query->result();
		}
	}
	
	//Returns clean image data
	//@params : designer id
	//@returns : associative image data
	//
	//This function is used for displaying images to the view	
	public function get_all_image_data($des_id)
	{
		$imagenames = array();		
		if($images = $this->get_all_images($des_id))
		{					
			$intCtr=0;
			foreach($images as $image)
			{
				$imagenames[$intCtr]["ID"] = $image->image_id;
				$imagenames[$intCtr]["URL"] = $image->file_name;
				$imagenames[$intCtr]["Name"] = $image->image_name;
				$imagenames[$intCtr]["Description"] = $image->image_desc;
				$intCtr++;
			}
			
			return $imagenames;
		}
	}
	
	//Obsolete - for testing only
	public function rename($path,$newname)
	{
		return rename($path,$newname);
	}
}