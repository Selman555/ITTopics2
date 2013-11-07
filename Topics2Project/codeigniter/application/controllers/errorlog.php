<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Start extends CI_Controller {
	function __construct() {
	}
	
	public function log_error($pagename, $message)
	{
		$baseurl='http://localhost:8080/Groep1/webresources/ErrorLoging/AddLog';
		$data = '{\"page\": \""'.$pagename.'"\", \"message\":\""'.$message.'"\"}';
		
		$this->do_post_request($url,$data,null);
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
	
}