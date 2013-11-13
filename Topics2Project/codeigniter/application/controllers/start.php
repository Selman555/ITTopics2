<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Start extends CI_Controller {
	function __construct() {
		parent::__construct();
		//Taalinstellingen voor de gebruiker ophalen of instellen
		$this->load->model('user_model');
		if(!($this->session->userdata('language'))){
			$this->session->set_userdata('language','nederlands');
		}
		$this->load->helper(array('form'));
		$this->load->library('form_validation'); //Post data validatie
	}

	public function index()
	{
		if (!$this->session->userdata('iplogged')) {
			$this->iplogging();
			$this->session->set_userdata('iplogged', true);
		}
        $data = $this->getCMS('hoofdpagina');
        if ($data['text'] == null) {
        	$data['text'] = $this->lang->line ( 'webserviceError' );
        }
		$this->load->view('index', $data);
	}

	public function cmsIndex() {
		$this->form_validation->set_rules('hoofdpagina', 'hoofdpagina','callback_verify_xss|xss_clean|required|trim');
		 
		if($this->form_validation->run()){
			$content = $this->input->post('hoofdpagina');
			$data['text'] = $content;
			$this->session->set_flashdata("errors", "Saved!");
			
			$this->setCMS('hoofdpagina', $content, 'index');
		} else {
			$this->session->set_flashdata("errors", "Kon gegevens niet wegschrijven.");
			$data['text'] = "Save failed. Make sure you aren't accidently injecting scripts.";
		}
		$this->load->view('index', $data);
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
        $data['error']="";
    	$this->load->view('login',$data);
    }
    public function about()
    {
    	$data = $this->getCMS('aboutpagina');
    	if ($data['text'] == null) {
    		$data['text'] = $this->lang->line ( 'webserviceError' );
    	}
    	$this->load->view('about', $data);
    }
    
    public function contact()
    {
        $data['error'] = $this->lang->line('');
        $this->load->view('contact',$data);
    }
    
    public function tasks() {
    	$data['tasks'] = $this->user_model->getTasks();
    	$this->load->view('tasks', $data);
    }
   
    public function cmsAboutOpdrachtgever() 
    {
    	$this->form_validation->set_rules('aboutpagina', 'aboutpagina','callback_verify_xss|xss_clean|required|trim');
		 
		if($this->form_validation->run()){
			$content = $this->input->post('aboutpagina');
			$data['text'] = $content;
			$this->session->set_flashdata("errors", "Saved!");
			
    		$this->setCMS('aboutpagina', $content, 'about');
    	} else {
    		$this->session->set_flashdata("errors", "Kon gegevens niet wegschrijven.");
    		$data['text'] = "Save failed. Make sure you aren't accidently injecting scripts.";
    	}
    	$this->load->view('about', $data);
    }
    
    public function verify_xss($content) {
		return !stristr($content, "<script");
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
    	$data = array(
    			"id" => $id,
    			"taalcode" => $taalcode,
    			"text" => $content
    	);
    	
    	return $this->user_model->putRequest($data, 'webresources/cmspost/inserttext');
    }
    
    public function getCMS($id) {
        $taalcode = '';
        if($this->session->userdata('language') == 'nederlands') {
        	$taalcode = 'NL';
        } else {
        	$taalcode = 'EN';
        }
        
        return $this->user_model->getRequest('webresources/cmspost/gettext?id='.$id.'&taalcode='.$taalcode);
    }
    
    public function iplogging() {
    	$baseurl = 'http://localhost:8080/Groep1/Iplogging?ipadress=';
    	$ipadress = $this->input->ip_address ();
    
    	$url = $baseurl . $ipadress;
    	$this->do_post_request ( $url, '', null );
    }
    
    function do_post_request($url, $data, $optional_headers = null) {
    	$params = array (
    			'http' => array (
    					'method' => 'POST',
    					'content' => $data
    			)
    	);
    	if ($optional_headers !== null) {
    		$params ['http'] ['header'] = $optional_headers;
    	}
    	$ctx = stream_context_create ( $params );
    	$fp = @fopen ( $url, 'rb', false, $ctx );
    	if (! $fp) {
    		throw new Exception ( "Problem with $url, $php_errormsg" );
    	}
    	$response = @stream_get_contents ( $fp );
    	if ($response === false) {
    		throw new Exception ( "Problem reading data from $url, $php_errormsg" );
    	}
    	return $response;
    }
    
}

/* End of file start.php */
/* Location: ./application/controllers/start.php */