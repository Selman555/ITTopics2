<?php class User_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
 function login($username,$password)
    {
        $this->db->select('Men_Username,Men_Password');
        $this->db->from('members');
        $this->db->where('username',$username);
        $this->db->where('password',($password));
        $this->db->limit(1);
        
        if($query->num_rows()==1){
            return TRUE;
        }
        else{
            return FALSE;
        }
        
    }
    
    function sendEmail()
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
        
    }
}
?>