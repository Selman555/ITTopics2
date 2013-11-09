<?php
class User_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
	function login($username,$password,$salt)
    {
     
        $this->db->select('Mem_Username,Mem_Password');
        $this->db->where('Mem_Username',$username);
        $this->db->where('Mem_Password',sha1($password.$salt));
        $this->db->limit(1);
        $query = $this->db->get('members');//het ophalen van de geselecteerde members
        
        if($query->num_rows()==1){
            return $query->result();
        }
        else{
            return FALSE;
        }
        
    }
    
    function sendEmail($gebruikersnaam,$wachtwoord,$email)
    {
	    //email verificatie (codeigniter database inladen)
	    $subject = 'Wachtwoord opgevraagd';
	    $message = '
				<b>Beste '.$gebruikersnaam.',</b><br />
				<br />
				U ben uw wachtwoord vergeten, en daarom sturen we u de volgende gegevens:<br />
				<br />
				Gebruikersnaam - '.$gebruikersnaam.'<br />
				Wachtwoord - '.$wachtwoord.'<br />
				<br />
				<br />
				Indien u uw wachtwoord niet heeft opgevraagd mag u deze mail negeren
				';
	    $this->load->library('email');
	    $config['mailtype'] = 'html'; //mailopmaak defini�ren
	    $this->email->initialize($config); //instelling uit de $config[] array halen+
	    $this->email->from('topics2.groep1@gmail.com', 'Topics2 - Groep 1'); //verzender groep 1
	    $this->email->to($email); //ontvanger
	    $this->email->subject($subject); //onderwerp toevoegen
	    $this->email->message($message); //bericht toevoegen
	    $this->email->send(); //verzenden
	    return true;
    }
    
    
    function getEmail($username)
    {
        $this->db->select('Mem_Email');
        $this->db->where('Mem_Username',$username);
        $this->db->limit(1);
        $query = $this->db->get('members');//het ophalen van de geselecteerde members
        
        if($query->num_rows()==1){
            return $query->result();
        }
        else{
            return FALSE;
        }
    }
    
    /**
     * Maakt gebruik van de cUrl library om een http-get request uit te voeren naar de webservice.
     * De gebruikerstabel wordt ge�pdate voor de $username met het opgegeven $password + de $salt door een sha1 functie.
     * 
     * @param String $username
     * @param String $password
     * @param String $salt
     * @return boolean succes
     */
    function updatePassword($username, $password, $salt){
    	$data = array(
    			"username" => $username,
    			"password" => sha1($password.$salt)
    	);

    	return putRequest($data, 'Login/changePassword');
    }
    
    /**
     * Maakt gebruik van de cUrl library om een http-put request uit te voeren naar de webservice.
     * De gebruikerstabel wordt ge�pdate voor de $username met het opgegeven $email adres.
     * 
     * @param String $username
     * @param String $email
     * @return boolean succes
     */
    public function updateEmail($username, $email) {
    	$data = array(
    			"username" => $username,
    			"email" => $email
    	);
    	return putRequest($data, 'Login/changeEmail');
    }
    
    /**
     * Haalt de salt voor een bepaalde gebruiker op uit de database.
     * @param String $username
     * @return boolean succes
     */
    function getSalt($username)
    {
        $this->db->select('Mem_Salt');
        $this->db->where('Mem_Username',$username);
        $this->db->limit(1);
        $query = $this->db->get('members');//het ophalen van de geselecteerde members
        
        if($query->num_rows()==1){
            return $query->result();
        }
        else{
            return false;
        }
    }
    
    function getRequest($path) {
    	$headers = array (
    			'Accept: application/json',
    			'Content-Type: application/json',
    	);
    	$curl_instance = curl_init();
        curl_setopt($curl_instance, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_instance, CURLOPT_URL, 'http://localhost:8080/Groep1/webresources/'.$path);
        
        try {
        	$data = json_decode(curl_exec($curl_instance), true);
        } catch (HttpException $ex) {
        	$data = null;
        }
        return $data;
    }
    
    function putRequest($data, $path) {
    	$headers = array (
    			'Accept: application/json',
    			'Content-Type: application/json',
    	);
    	$curl_instance = curl_init();
    	curl_setopt($curl_instance, CURLOPT_URL, 'http://localhost:8080/Groep1/webresources/'.$path);
    	curl_setopt($curl_instance, CURLOPT_HTTPHEADER, $headers);
    	curl_setopt($curl_instance, CURLOPT_CONNECTTIMEOUT, 10);
    	curl_setopt($curl_instance, CURLOPT_RETURNTRANSFER, true);
    	curl_setopt($curl_instance, CURLOPT_CUSTOMREQUEST, "PUT");
    	curl_setopt($curl_instance, CURLOPT_POSTFIELDS, json_encode($data, JSON_FORCE_OBJECT));
    	
    	try {
    		curl_exec($curl_instance);
    		curl_close($curl_instance);
    		$curl_instance == null;
    		return true;
    	} catch (HttpException $ex) {
    		curl_close($curl_instance);
    		$curl_instance == null;
    		return false;
    	}
    }
} 
?>