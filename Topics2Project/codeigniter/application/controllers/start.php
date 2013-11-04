<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Start extends CI_Controller {
	function __construct() {
		parent::__construct();
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
<<<<<<< HEAD
		//Taalinstellingen voor de gebruiker ophalen of instellen
		if(!($this->session->userdata('language'))){
			$this->session->set_userdata('language','nederlands');
		}
		
        $data = $this->getCMS('hoofdpagina');
        
		$this->load->view('index', $data);
	}

	public function cmsIndex() {
		if (isset($_POST['hoofdpagina'])) {
			$content = str_replace(array("\r\n", "\r"), "__NewLine__", $_POST['hoofdpagina']);
			$taalcode = '';
			$id = 'hoofdpagina';
			if($this->session->userdata('language') == 'nederlands') {
				$taalcode = 'NL';
			} else {
				$taalcode = 'EN';
			}
			$headers = array(
				'Accept: application/json',
				'Content-Type: application/json',
			);
			$data = array(
				"id" => 'hoofdpagina',
				"taalcode" => $taalcode,
				"text" => $content
			);
			$curl_instance = curl_init();
			curl_setopt($curl_instance, CURLOPT_URL, 'http://192.168.0.251:8084/Groep1/webresources/cmspost/inserttext');
			curl_setopt($curl_instance, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($curl_instance, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($curl_instance, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl_instance, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($curl_instance, CURLOPT_POSTFIELDS, json_encode($data, JSON_FORCE_OBJECT));
			
			try {
				curl_exec($curl_instance);
				curl_close($curl_instance);
				$curl_instance == null;
				$this->load->view('index', $data);
			} catch (HttpException $ex) {
				curl_close($curl_instance);
				$curl_instance == null;
				$this->session->set_flashdata("errors", "De webservice kon uw aanvraag niet verwerken.");
				$this->load->view('index');
			}
		} else {
			$this->session->set_flashdata("errors", "Kon uw mama's gegevens niet inlezen.");
			$this->load->view('index');
		}
=======
            if(!($this->session->userdata('language'))){
             $this->session->set_userdata('language','nederlands');
            }
		$this->load->view('index');
            
            
>>>>>>> dedd6ce308d042596aa22a4d0ef9afe38fe26b45
	}
	
	public function leden()
	{
                
		$this->load->view('groepsleden');
	}
	
	public function todo()
	{
                
		$this->load->view('todo');
            
	}
	
    public function login()
    {
        
    	$this->load->view('login');
        
    }
    public function about()
    {
        
    	$this->load->view('about');
        
    }
   
<<<<<<< HEAD
    public function getCMS($id) {
        $taalcode = '';
        if($this->session->userdata('language') == 'nederlands') {
        	$taalcode = 'NL';
        } else {
        	$taalcode = 'EN';
        }
        $curl_instance = curl_init();
        curl_setopt($curl_instance, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_instance, CURLOPT_URL, 'http://192.168.0.251:8084/Groep1/webresources/cmspost/gettext?id='.$id.'&taalcode='.$taalcode);
        
        try {
        	$data = json_decode(curl_exec($curl_instance), true);
        	if ($data == null) {
        		$data['text'] = "Nothing to see here, sorry.";
        	}
        	return $data;
        } catch (HttpException $ex) {
        	$data['text'] = $ex;
        	return $data;
        }
    }
=======
    
>>>>>>> dedd6ce308d042596aa22a4d0ef9afe38fe26b45
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */