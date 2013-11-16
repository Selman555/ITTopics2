<?php

$param = htmlspecialchars($_GET["getHighscore"]);
if($param === 'true')
{
	$urlGetScore = 'http://localhost:8080/Groep1/Highscore?getHighscore=true';
	$response = do_post_request($urlGetScore,'',null);
	echo $response;
}
else
{
	if($param === 'false')
	{
		$name = htmlspecialchars($_GET["Name"]);
		$score = htmlspecialchars($_GET["Score"]);
		
		$urlSetScore = 'http://localhost:8080/Groep1/Highscore?getHighscore=false&Name='.$name.'&Score='.$score;
		$response = do_post_request($urlSetScore,'',null);
	}
}


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
?>
