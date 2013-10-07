<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {
	function __construct() {
		parent::__construct();
                $this->load->helper('url');
                //$this->load->model('user_model','',TRUE);
	}

	
	public function index()
	{
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('username', 'Username', 
                'trim|required|xss_clean');
            //$this->form_validation->set_rules('password', 'Password', 
              //  'trim|required|xss_clean|callback_check_database');
		//check_database = een functie die gaat uitzoeken 
            //of het passwoord overeenkomt met de juiste usernaam
	}
	
	
}
