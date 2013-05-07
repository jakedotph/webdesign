<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends CI_Controller
{
	
	var $desdata;	
	
	public function __construct()
	{
		parent :: __construct();
		$this->load->library('accountmanager');
		$this->load->library('designermanager');
		$this->load->library('gallerymanager');
		$this->load->library('session');
		$this->load->helper('url');
	}
	
	public function index()
	{				
		$accmgr = $this->accountmanager;
		$desmgr = $this->designermanager;

		if(!$des_id = $accmgr->check_session())		
		{
			redirect('login/relogin');	
		}
		$this->load_designer();
	}
	
	public function logout()
	{
		$accmgr = $this->accountmanager;
		$accmgr->close_session();
		redirect('login');
	}
	
	public function load_designer()
	{		
		$accmgr = $this->accountmanager;
		$desmgr = $this->designermanager;
		$gmgr = $this->gallerymanager;
		
		if(!$des_id = $accmgr->check_session())		
		{
			redirect('login/relogin');	
		}
		
		if(!$desdata = $desmgr->check_exists($des_id))
		{
			echo $desmgr->get_error_message();			
		}
		
		$this->desdata = $desdata;		
		
		$data["name"] = $desdata->des_lname . ', ' . $desdata->des_fname;
		$data["username"] = $desdata->des_username;
		$data["about"] = $desdata->about;
		
		if($imagenames = $gmgr->get_all_image_data($des_id))
			$data["images"] = $imagenames;
		
		$this->load->view('main/menu.php');
		$this->load->view('main/body.php',array("data"=>$data));
	}
	
	public function load_gallery($message=null)
	{
		$accmgr = $this->accountmanager;
		$desmgr = $this->designermanager;
		$gmgr = $this->gallerymanager;
		
		if(!$des_id = $accmgr->check_session())		
		{
			redirect('login/relogin');	
		}
						
		$this->load->view('main/menu');
		
		if($message!=null)
		{
			if(isset($message["error"]))
				$this->load->view('msg/error_msg',array("error"=>$message["error"]));
			else if(isset($message["notify"]))
				$this->load->view('msg/notify_msg',array("notify"=>$message["notify"]));
		}
		
		if($imagenames = $gmgr->get_all_image_data($des_id))
			$this->load->view('main/gallery/index',array("images"=>$imagenames));
		else
			$this->load->view('main/gallery/index');
	}
	
	public function gallery_upload()
	{
		$accmgr = $this->accountmanager;
		$desmgr = $this->designermanager;
		
		if(!$des_id = $accmgr->check_session())		
		{
			redirect('login/relogin');	
		}
		
		if(!$desdata = $desmgr->check_exists($des_id))
		{
			echo $desmgr->get_error_message();			
		}
		
		$this->desdata = $desdata;
		
		$image_name = $this->input->post('image_name');
		$image_desc = $this->input->post('image_desc');				
		
		$this->load->library('gallerymanager');
		$gmgr = $this->gallerymanager;
		
		$image_id = $gmgr->add_image($this->desdata->des_id,$image_name,$image_desc);
		
		$config['upload_path'] = '.'.UPLOADGALLERYDIRNAME;
		$config['allowed_types'] = 'jpg|png';
		$config['file_name'] = $gmgr->generate_name($this->desdata->des_id,$image_id);
		
		$this->load->library('upload',$config);
		
		if ( ! $this->upload->do_upload())
		{	
			$gmgr->delete_image($this->desdata->des_id,$image_id);
			$message["error"] = $this->upload->display_errors();
			$this->load_gallery($message);			
		}
		else
		{
			$message["notify"] = "Successfully uploaded image";
			$this->load_gallery($message);
		}	
	}
	
	public function modify_image()
	{
		$this->load->library('gallerymanager');
		$gmgr = $this->gallerymanager;
		
		$accmgr = $this->accountmanager;
		$desmgr = $this->designermanager;
		
		if(!$des_id = $accmgr->check_session())		
		{
			redirect('login/relogin');	
		}
		
		$image_id = $this->input->post("image_id");
		$image_name = $this->input->post("image_name");
		$image_desc = $this->input->post("image_desc");
		
		if(!$gmgr->update_image_data($des_id,$image_id,$image_name,$image_desc))
			echo 'Update Failed';
		else
		{
			$message["notify"] = "Successfully modified image data";
			$this->load_gallery($message);
		}
	}
	
	public function delete_image()
	{
		$this->load->library('gallerymanager');
		$gmgr = $this->gallerymanager;
		
		$accmgr = $this->accountmanager;
		$desmgr = $this->designermanager;
		
		if(!$des_id = $accmgr->check_session())		
		{
			redirect('login/relogin');	
		}
		
		if(!$desdata = $desmgr->check_exists($des_id))
		{
			echo $desmgr->get_error_message();			
		}
		
		$image_id = $this->input->post("image_id");
		$message = array();
		if(!$gmgr->delete_image($desdata->des_id,$image_id))
		{
			$message["error"] = "Unable to delete image. Please try again later";			
		}
		else
			$message["notify"] = "Successfully deleted image";
		$this->load_gallery($message);
	}
}