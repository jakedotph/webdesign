<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
	Main page of the designer module	
**/

class Login_Main extends CI_Controller
{	
	public function index()
	{		 						
		$this->load->view('template/menu');
		$this->load->view('login/forms/loginform');
		$this->load->view('login/forms/registerform');	
	}
}