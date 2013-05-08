<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
	Register_User controller
	
		Provides all controls in designer profile manipulation
**/

class Main extends CI_Controller
{
	//Global Declarations
	var $desdata; //holds the current designer data
	var $desaccdata; //holds the current desigenr account data
	
	//Class construct
	public function __construct()
	{
		parent :: __construct();
		//Loads primary libraries for designer module
		$this->load->library('accountmanager'); //responsible for session
		$this->load->library('designermanager'); //responsible for designer data manipulation
		$this->load->library('gallerymanager'); //responsible for designer's images manipulation
		
		$this->load->library('session');
		$this->load->helper('url');
	}
	
	public function index()
	{				
		$accmgr = $this->accountmanager;
		$desmgr = $this->designermanager;
		
		//Checks if user is logged in
		if(!$des_id = $accmgr->check_session())		
		{
			//Throw back to the main page with notification
			redirect('login/relogin');	
		}
		$this->load_designer();
	}
	
	//Closes the session and redirects to the main page
	public function logout()
	{
		$accmgr = $this->accountmanager;
		$accmgr->close_session();
		redirect('login');
	}
	
	//Extracts the designers data based on the session's des_id
	//
	//Designer Profile Container
	//
	public function load_designer()
	{		
		$accmgr = $this->accountmanager;
		$desmgr = $this->designermanager;
		$gmgr = $this->gallerymanager;
		
		if(!$des_id = $accmgr->check_session())		
		{
			redirect('login/relogin');			
		}
				
		if(!$desaccdata = $desmgr->fetch_id_designer_account($des_id))
		{
			echo $desmgr->get_error_message();
		}		
		
		$type["des_id"] = $des_id;
		if(!$desdata = $desmgr->fetch_designer($type))
		{		
			echo $desmgr->get_error_message();
		}		
		
		$this->desdata = $desdata;
		$this->desaccdata = $desaccdata;
		
		$data["name"] = $desdata->des_lname . ', ' . $desdata->des_fname;
		$data["username"] = $desaccdata->des_username;
		$data["about"] = $desdata->des_about;
		
		if($imagenames = $gmgr->get_all_image_data($des_id))
			$data["images"] = $imagenames;
		
		$this->load->view('main/menu.php');
		$this->load->view('main/body.php',array("data"=>$data));
	}
	
	//Extracts the designer's images based on the session's des_id
	//
	//Gallery Container
	//
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
	
	//Called when view requests for upload : Using codeigniter upload library	
	public function gallery_upload()
	{
		$accmgr = $this->accountmanager;
		$desmgr = $this->designermanager;
		
		if(!$des_id = $accmgr->check_session())		
		{
			redirect('login/relogin');	
		}
		
		$type["des_id"] = $des_id;
		if(!$desdata = $desmgr->fetch_designer($type))
		{
			echo $desmgr->get_error_message();
		}
		
		$this->desdata = $desdata;
		
		$image_name = $this->input->post('image_name'); //get the image name from the post
		$image_desc = $this->input->post('image_desc');	//get the image description from the post
		
		$this->load->library('gallerymanager'); //loads the gallery manager
		$gmgr = $this->gallerymanager; //transfer instance to &gmgr
		
		//Adds the image data to the database, and gets the image id
		$image_id = $gmgr->add_image($this->desdata->des_id,$image_name,$image_desc);
		
		$config['upload_path'] = '.'.UPLOADGALLERYDIRNAME; //UPLOADGALLERYDIRNAME contains the current folder for designer gallery
		$config['allowed_types'] = 'jpg|png';
		$config['file_name'] = $gmgr->generate_name($this->desdata->des_id,$image_id); //asks the gallery manager to provide the name automatically
		
		$this->load->library('upload',$config);
		
		//Start the upload
		if ( ! $this->upload->do_upload())
		{	
			//Failure occured
			$gmgr->delete_image($this->desdata->des_id,$image_id); //deletes the image data from the database
			$message["error"] = $this->upload->display_errors();
			$this->load_gallery($message); //loads the gallery view with notification
		}
		else
		{
			//Upload Success
			$message["notify"] = "Successfully uploaded image";
			$this->load_gallery($message);
		}	
	}
	
	//Modifies image data
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
		
		//Calls gallery manager's update_image_data to modify the image's data
		if(!$gmgr->update_image_data($des_id,$image_id,$image_name,$image_desc))
			echo 'Update Failed';
		else
		{
			$message["notify"] = "Successfully modified image data";
			$this->load_gallery($message);
		}
	}
	
	//Deletes the image
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
		
		$type["des_id"] = $des_id;
		if(!$desdata = $desmgr->fetch_designer($type))
		{
			echo $desmgr->get_error_message();			
		}
		
		$image_id = $this->input->post("image_id");
		$message = array();
		
		//Calls the gallery manager delete_image to delete the image logically and physically
		if(!$gmgr->delete_image($desdata->des_id,$image_id))
		{
			$message["error"] = "Unable to delete image. Please try again later";			
		}
		else
			$message["notify"] = "Successfully deleted image";
		$this->load_gallery($message);
	}
}