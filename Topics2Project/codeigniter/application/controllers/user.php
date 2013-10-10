
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct() {
		parent::__construct();
                $this->load->model('user_model','',TRUE);
	}

	public function index()
	{		
	   $this->load->library('form_validation');
            
           $this->form_validation->set_rules('username', 'Username', 
                'trim|required|xss_clean');
           $this->form_validation->set_rules('password', 'Password', 
             'trim|required|xss_clean|callback_verify_login');
          /*if($this->form_validation->run()==FALSE){
              log_message('error', 'Uw heeft een verkeerd passwoord ingegeven');
          }
          else{*/
            // $this->load->view('todo');
       //   }
           

	}
        
      public function verify_login($password){
          if($password=='nest'){
            return TRUE;
          }  
          else{
              return FALSE;
          }
          
          
          /*$username=$this->input->post('username');
            $boolean =$this->user_model->login($username,$password);
            if($boolean){
                return TRUE;
            }
            else{
               return FALSE;
            }*/
             
        }
        
        public function passwordRecovery()
        {
            $this->load->view('passwordRecovery');
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */








