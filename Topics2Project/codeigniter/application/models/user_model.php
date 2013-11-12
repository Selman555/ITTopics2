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
		$json = $this->getRequest('webresources/Login/checkLogin?username='.$username.'&password='.sha1($password.$salt));
		return ($json[0]["level"]);
    }
    
    function getTasks()
    {
    	$json = $this->getRequest('Punten');
    	return $json;
    }
    
    function sendEmail($gebruikersnaam,$wachtwoord,$email)
    {
	    //email verificatie (codeigniter database inladen)
	    $subject = 'Pixel Apps - Aanmeldgegevens';
	    $message = '
				<b>Beste '.$gebruikersnaam.',</b><br />
				<br />
				U heeft gevraagd om uw wachtwoord te herstellen.<br />
				Met volgende gegevens kan u zich aanmelden.
				<br />
				Gebruikersnaam - '.$gebruikersnaam.'<br />
				Wachtwoord - '.$wachtwoord.'<br />
				<br />
				<br />
				U kan uw oud wachtwoord herstellen op de profielpagina. De link bevind zich onderaan op de pagina.<br />
				Indien u uw wachtwoord niet heeft opgevraagd mag u deze mail negeren.
				';
	    $config = Array(
	    		'protocol'  => 'smtp',
	    		'smtp_host' => 'ssl://smtp.googlemail.com',
	    		'smtp_port' => '465',
	    		'smtp_user' => 'topics2.groep1@gmail.com',
	    		'smtp_pass' => 'azerQSDF',
	    		'mailtype'  => 'html',
	    		'starttls'  => true,
	    		'newline'   => "\r\n"
	    );
	    $this->load->library('email', $config);
	    $this->email->from('topics2.groep1@gmail.com', 'Topics2 - Groep 1'); //verzender groep 1
	    $this->email->to($email); //ontvanger
	    $this->email->subject($subject); //onderwerp toevoegen
	    $this->email->message($message); //bericht toevoegen
	    $this->email->send(); //verzenden
	    return true;
    }
    function sendEmailContact($name,$email,$message)
    {
        $subject='Contacteer ons';
        $message='
                    <b>Beste Meneer, Mevrouw</b><br/>
                    <br/>
                    Hierbij brengen we u op de hoogte van het volgende:<br/>
                    <br/>
                    Boodschap:<br/><br/>
                    '.$message.'<br />
                    Contacteer ons op het volgende email adres: '.$email.'<br/>
                    <br/>0
                    <br/>
                    Met vriendelijke groeten<br/>
                    '.$name.'';
        
        $config = Array(
	    		'protocol'  => 'smtp',
	    		'smtp_host' => 'ssl://smtp.googlemail.com',
	    		'smtp_port' => '465',
	    		'smtp_user' => 'topics2.groep1@gmail.com',
	    		'smtp_pass' => 'azerQSDF',
	    		'mailtype'  => 'html',
	    		'starttls'  => true,
	    		'newline'   => "\r\n"
	    );
        $this->load->library('email', $config); 
        $this->email->from('topics2.groep1@gmail.com', 'Topics2 - Groep 1'); //verzender groep 1
	    $this->email->to($email); //ontvanger
        $this->email->subject($subject);
        $this->email->message($message); //bericht toevoegen
	$this->email->send(); //verzenden
	return true;
    }
    
    
    function getEmail($username)
    {
		$json = $this->getRequest('webresources/Login/getEmail?username='.$username);
		return ($json[0]["email"]);
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

    	return $this->putRequest($data, 'webresources/Login/changePassword');
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
    	return $this->putRequest($data, 'webresources/Login/changeEmail');
    }
    
    /**
     * Haalt de salt voor een bepaalde gebruiker op uit de database.
     * @param String $username
     * @return boolean succes
     */
   
    function getSalt($username)
    {
		$json = $this->getRequest('webresources/Login/getSalt?username='.$username);
		return ($json[0]["Salt"]);
		return true;
    }
    
    function getRequest($path) {
    	$headers = array (
    			'Accept: application/json',
    			'Content-Type: application/json',
    	);
    	$curl_instance = curl_init();
        curl_setopt($curl_instance, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_instance, CURLOPT_URL, 'http://localhost:8080/Groep1/'.$path);
        
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
    	curl_setopt($curl_instance, CURLOPT_URL, 'http://localhost:8080/Groep1/'.$path);
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