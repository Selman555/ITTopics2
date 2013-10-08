<?php class User_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
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
	    $config['mailtype'] = 'html'; //mailopmaak definiëren
	    $this->email->initialize($config); //instelling uit de configuratie halen+
	    $this->email->from('topics2.groep1@gmail.com', 'Topics2 - Groep 1: wachtwoord'); //verzender groep 1
	    $this->email->to($email); //ontvanger
	    $this->email->subject($subject); //onderwerp toevoegen
	    //inhoud van het bericht met activatiecode als link.
	    $this->email->message($message);
	    $this->email->send();
	    return true;
    }
}
?>