
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
          if(!$this->form_validation->run()){ 
              $data['validate']='U heeft een verkeerd passwoord of username ingegeven.';
              $data['var']='add';
              $data['passwordError']='';
              $this->load->view('login',$data);
          }
          else{
            $this->load->view('todo');//staat op dit moment symbool voor de pagina's waarbij login vereist is
        }

	}
        
      public function verify_login($password){
         
        
            $username=$this->input->post('username');
            $boolean =$this->user_model->login($username,$password);
            if($boolean){
                return TRUE;
            }
            else{
               return FALSE;
            }
             
        }
        
        public function passwordRecovery()
        {
            $this->load->library('form_validation');
            
           $this->form_validation->set_rules('username', 'Username', 
                'trim|required|xss_clean');
           
           //het ophalen van het emial address
            $username=$this->input->post('username');
            $result=$this->user_model->getEmail($username);
            //het email address als er een is in een var zetten
            if ($result) {
                $email='';
                $passw='';
            $sess_array = array();
            foreach ($result as $row) {
                $email=$row->Mem_Email;
                $sess_array = array(
                    'email'=>$row->Mem_Email
                );
               
            }
            echo $email;
            echo $passw;
            
            
            return TRUE;
        }
        //anders printen dat de gebruiker niet aanwezig is in de database
            else {
                 $data['validate']='';
                 $data['var']='add';
                 $data['passwordError']='de username die u ingaf bestaat niet in onze database';
                $this->load->view('login',$data);
           
                return FALSE;
                }     
        }
        
        
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */








