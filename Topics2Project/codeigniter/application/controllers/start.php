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
        if(!($this->session->userdata('language'))){
        	$this->session->set_userdata('language','nederlands');
        }
        $taalcode = '';
        if($user_language=$this->session->userdata('language') == 'nederlands') {
        	$taalcode = 'NL';
        } else {
        	$taalcode = 'EN';
        }
        $curl_instance = curl_init();
        curl_setopt($curl_instance, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_instance, CURLOPT_URL, 'http://192.168.0.251:8084/Groep1/webresources/cmspost/gettext?id=hoofdpagina&taalcode='.$taalcode);
        
        $data = json_decode(curl_exec($curl_instance), true);
        
		$this->load->view('index', $data);
	}
	
	public function cmsIndex($content) {
		
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
   
    public function getCMS($id, $taalcode) {
    	$request = new HttpRequest('http://192.168.0.251:8084/Groep1/webresources/cmspost/gettext', HttpRequest::METH_GET);
    	$request->addQueryData(array('id' => $id, 'taalcode' => $taalcode));
    	
    	try {
    		$request->send();
    		if ($request->getResponseCode() == 200) {
    			return $request->getResponseBody();
    		}
    	} catch (HttpException $ex) {
    		return $ex;
    	}
    	
    	return "";
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */