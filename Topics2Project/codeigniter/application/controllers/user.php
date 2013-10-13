
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
          //  $resultSalt=$this->user_model->getSalt($username);
            
         /*   if($resultSalt){//als er een salt is 
                 $salt='';
                 foreach ($resultSalt as $row) {
                 $salt=$row->Mem_Salt;
            }
            echo $salt;*/
                $boolean =$this->user_model->login($username,$password);
                if($boolean){
                     return TRUE;
                }
                else{
                    return FALSE;
                }
          /*  }
            
            else{//als er geen salt is => betekend dat de username fout is
              $data['validate']='';
              $data['var']='add';
              $data['passwordError']='de username die u ingaf bestaat niet in onze database';
              $this->load->view('login',$data);  
            }*/
             
        }
        
        public function passwordRecovery()
        {
            $this->load->library('form_validation');
            $this->load->helper('string');  //om een random string te kunnen genereren kun de deze helper gebruken
            
           $this->form_validation->set_rules('username', 'Username', 
                'trim|required|xss_clean');
           
           //het ophalen van het emial address
            $username=$this->input->post('username');
            $result=$this->user_model->getEmail($username);
            //het email address als er een is in een var zetten
            if ($result) {
                //als je een result terug krijgtt dan ...
                $email='';
           
            foreach ($result as $row) {
                $email=$row->Mem_Email;
            }
            
           
            //het genereren van een nieuw passwoord voor de gebruiker
           $password= random_string('alnum',10);
           $salt=random_string('sha1',10);
           
           //het password updaten in de database
           $this->user_model->updatePassword($username,$password, $salt);
           //email sturen nr gebruiker
           $this->user_model->sendEmail($username,$password,$email);
           //tonen dat de email is verzonden
           $this->load->view('passwordRecovery');
        }
        //anders printen dat de gebruiker niet aanwezig is in de database
            else {
                 $data['validate']='';
                 $data['var']='add';
                 $data['passwordError']='de username die u ingaf bestaat niet in onze database';
                $this->load->view('login',$data);
           
                }     
        }
        
        
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */








