<?php

$param = htmlspecialchars($_GET["getToDo"]);
if ($param === 'true') {
    $urlGetToDo = 'http://localhost:8080/Groep1/ToDos?getTodo=true';
    $response = do_post_request($urlGetToDo, '', null);
    echo $response;
} else {
    if ($param === 'false') {
        $naam = htmlspecialchars($_GET["naam"]);
        $omschrijving = htmlspecialchars($_GET["omschrijving"]);
        $richting = htmlspecialchars($_GET["richting"]);
        $prioriteit = htmlspecialchars($_GET["prioriteit"]);

        $urlSetScore = 'http://localhost:8080/Groep1/ToDos?getToDo=false&Naam=' . $naam . '&Omschrijving=' . $omschrijving . '&Richting=' . $richting . '&Prioriteit=' . $prioriteit;
        $response = do_post_request($urlSetScore, '', null);
    }
}

function do_post_request($url, $data, $optional_headers = null) {
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
