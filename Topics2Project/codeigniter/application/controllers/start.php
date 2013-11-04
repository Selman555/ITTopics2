<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Start extends CI_Controller {
	function __construct() {
		parent::__construct();
		//Taalinstellingen voor de gebruiker ophalen of instellen
		if(!($this->session->userdata('language'))){
			$this->session->set_userdata('language','nederlands');
		}
	}

	public function index()
	{		
        $data = $this->getCMS('hoofdpagina');
		$this->load->view('index', $data);
	}

	public function cmsIndex() {
		if (isset($_POST['hoofdpagina'])) {
			$this->setCMS('hoofdpagina', $_POST['hoofdpagina'], 'index');
		} else {
			$this->session->set_flashdata("errors", "Kon gegevens niet inlezen.");
			$this->load->view('index');
		}
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
    	$data = $this->getCMS('aboutpagina');
    	$this->load->view('about', $data);
    }
    public function cmsAboutOpdrachtgever() 
    {
    	if (isset($_POST['aboutpagina'])) {
    		$this->setCMS('aboutpagina', $_POST['aboutpagina'], 'about');
    	} else {
    		$this->session->set_flashdata("errors", "Kon gegevens niet inlezen.");
    		$this->load->view('about');
    	}
    }
   
    public function setCMS($id, $content, $view)
    {
    	$content = str_replace(array("\r\n", "\r"), "__NewLine__", $content);
    	$taalcode = '';
    	if($this->session->userdata('language') == 'nederlands') {
    		$taalcode = 'NL';
    	} else {
    		$taalcode = 'EN';
    	}
    	$headers = array (
    			'Accept: application/json',
    			'Content-Type: application/json',
    	);
    	$data = array(
    			"id" => $id,
    			"taalcode" => $taalcode,
    			"text" => $content
    	);
    	$curl_instance = curl_init();
    	curl_setopt($curl_instance, CURLOPT_URL, 'http://192.168.0.251:8080/Groep1/webresources/cmspost/inserttext');
    	curl_setopt($curl_instance, CURLOPT_HTTPHEADER, $headers);
    	curl_setopt($curl_instance, CURLOPT_CONNECTTIMEOUT, 10);
    	curl_setopt($curl_instance, CURLOPT_RETURNTRANSFER, true);
    	curl_setopt($curl_instance, CURLOPT_CUSTOMREQUEST, "PUT");
    	curl_setopt($curl_instance, CURLOPT_POSTFIELDS, json_encode($data, JSON_FORCE_OBJECT));
    		
    	try {
    		curl_exec($curl_instance);
    		curl_close($curl_instance);
    		$curl_instance == null;
    		$this->load->view($view, $data);
    	} catch (HttpException $ex) {
    		curl_close($curl_instance);
    		$curl_instance == null;
    		$this->session->set_flashdata("errors", "De webservice kon uw aanvraag niet verwerken.");
    		$this->load->view($view);
    	}
    }
    
    public function getCMS($id) {
        $taalcode = '';
        if($this->session->userdata('language') == 'nederlands') {
        	$taalcode = 'NL';
        } else {
        	$taalcode = 'EN';
        }
        $curl_instance = curl_init();
        curl_setopt($curl_instance, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_instance, CURLOPT_URL, 'http://192.168.0.251:8080/Groep1/webresources/cmspost/gettext?id='.$id.'&taalcode='.$taalcode);
        
        try {
        	$data = json_decode(curl_exec($curl_instance), true);
        	if ($data == null) {
        		$data['text'] = "Nothing to see here, sorry!";
        	}
        	return $data;
        } catch (HttpException $ex) {
        	$data['text'] = $ex;
        	return $data;
        }
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */