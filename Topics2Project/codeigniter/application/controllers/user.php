
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct() {
		parent::__construct();
	}

	public function index()
	{		
	   $this->load->library('form_validation');
            
           $this->form_validation->set_rules('username', 'Username', 
                'trim|required|xss_clean');
           $username = $this->input->post('username');
           $password = $this->input->post('password');
           /*$this->form_validation->set_rules('password', 'Password', 
             'trim|required|xss_clean|callback_check_database');*/
		//check_database = een functie die gaat uitzoeken 
            //of het passwoord overeenkomt met de juiste usernaam

	}
        
        public function passwordRecovery()
        {
            $this->load->view('passwordRecovery');
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */








