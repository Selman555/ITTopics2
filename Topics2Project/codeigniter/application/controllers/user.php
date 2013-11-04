
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct() {
		parent::__construct();
                $this->load->model('user_model','',TRUE);
                 $this->load->helper(array('form'));

	}
	
	public function login()
	{
		$this->load->view('login');
	}

	public function loginUser()
	{
			//$this->iplogging();
            $this->load->library('form_validation');
            
            //het verplicht maken van username en password
            $this->form_validation->set_rules('username', 'Username','trim|required|xss_clean');   
            $this->form_validation->set_rules('password', 'Password','trim|required|xss_clean');
           
             //het ophalen van de salt
            if(!$this->form_validation->run()){ 
        	$this->session->set_flashdata("errors", "verkeerd passwoord en/of username");
                $this->load->view('login');
            } 
            else 
            {
                $username=$this->input->post('username');
                $password=$this->input->post('password');
                
                $resultSalt=$this->user_model->getSalt($username);
            
                if($resultSalt)
                    {//als er een salt is 
                        $salt='';
                        foreach ($resultSalt as $row) 
                        {
                        $salt=$row->Mem_Salt;
                        }
                
                        $boolean =$this->user_model->login($username,$password,$salt);
                         if($boolean)
                         {
                            $array=array();
                            foreach($boolean as $row)
                            {
                                  $array= array(
                                  'username'=>$row->Mem_Username,
                                  'logged_in'=>true
                                     );
                            }
                            $this->session->set_userdata($array);
       
                            redirect('start/index');
                        }
                        else
                        {
                             $this->session->set_flashdata("errors", "verkeerd passwoord en/of username");
                             $this->load->view('login');
                        }
                        
                    }
                    else
                    {
                        $this->session->set_flashdata("errors", "verkeerd passwoord en/of username");
                        $this->load->view('login');
                    }
            }
        }
        
    public function password_recovery()
    {
        $this->load->library('form_validation');
        $this->load->helper('string');  //dient om een random string te kunnen genereren 
            
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
         
        if(!$this->form_validation->run())
        { 
             $this->session->set_flashdata("errors", "verkeerde username");
             $this->load->view('login');
        } 
        else 
        {
            //het ophalen van het emial address
             $username=$this->input->post('username');
             $result=$this->user_model->getEmail($username);
        
             //het email address als er een is in een var zetten
             if ($result) 
              {
                $email='';
       
                foreach ($result as $row) 
                {
                    $email=$row->Mem_Email;
                }

                 //het genereren van een nieuw passwoord voor de gebruiker
                $password= random_string('alnum', 10);
                //genereren van een random int
                $salt=random_string('sha1',10);
           
                //het password updaten in de database
                $this->user_model->updatePassword($username,$password, $salt);
                //email sturen nr gebruiker
                $this->user_model->sendEmail($username,$password,$email);
                //tonen dat de email is verzonden
                $this->load->view('passwordRecovery');
            } 
            else 
            { //anders printen dat de gebruiker niet aanwezig is in de database
               $this->session->set_flashdata("errors", "verkeerde username");
               $this->load->view('login');
            }     
        }
    }
        
    //deel wanneer de user ingelog is
    
    public function prive()
    {
        if($this->session->userdata('logged_in'))
        {//probleem
            $session_date=$this->session->userdata('logged_in');
            $data['username']=$session_date['username'];
            $this->load->view('privatefiles');
        } else {
            redirect('login','refresh');
        } 
    }
    
    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        redirect('start/index','refresh');
    }
    
    public function language()
    {
        if($this->input->post('language')=='nederlands')
        {
            $this->session->set_userdata('language','nederlands');
        }
        else if($this->input->post('language')=='english')
        {
            $this->session->set_userdata('language','english');
        }
        
        redirect('start/index','refresh');
        
    }
	
	/*public function iplogging()
	{
		$baseurl='http://localhost:8282/Groep1/Iplogging?ipadress=';
		$ipadress=$this->input->ip_address();
		
		$url=$baseurl.$ipadress;
		$this->do_post_request($url,'',null);
	}*/
	
	function do_post_request($url, $data, $optional_headers = null)
	{
	  $params = array('http' => array(
				  'method' => 'POST',
				  'content' => $data
				));
	  if ($optional_headers !== null) {
		$params['http']['header'] = $optional_headers;
	  }
	  $ctx = stream_context_create($params);
	  $fp = @fopen($url, 'rb', false, $ctx);
	  if (!$fp) {
		throw new Exception("Problem with $url, $php_errormsg");
	  }
	  $response = @stream_get_contents($fp);
	  if ($response === false) {
		throw new Exception("Problem reading data from $url, $php_errormsg");
	  }
	  return $response;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */








