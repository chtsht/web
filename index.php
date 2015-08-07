<?php

session_start();

require 'config/config.php';
require 'vendor/autoload.php';
require 'functions.php';

//$Response = new Response(APIKEY);
$Client = new GuzzleHttp\Client([
	'base_url'=>API,
	'defaults'=> [
		'auth'=>APIKEY
	]
]);

$User = getLoggedUser($Client);
$token = (isset($_SESSION['token'])) ? $_SESSION['token'] : null;
if ($token)
	$Client->setDefaultOption('headers/token',$token);

$path = parse_url($_SERVER['REQUEST_URI']);
$uri = explode('/',$path['path']);

if ($uri[1] == 'a') { //api wrapper
	require 'lib/api.php';

} else if (file_exists("lib/{$uri[1]}.php")) {
    $lib = $uri[1];

} else if ($uri[1] and (empty($uri[2]) or $uri[2] == 'history')) {
	$Response = $Client->get('chtsht/'.$uri[1]);

	if ($Response->getStatusCode() == '200') {
		$res = $Response->json();
		$Chtsht = (isset($res['chtsht'])) ? $res['chtsht'] : null;
	} else {
		require 'views/loadError.php';
		exit;
	}

	if (isset($uri[2]) && $uri[2] == 'history')
		$lib = 'history';
	else
		$lib = 'chtsht';
} else {
	$lib = 'home';
}

$ajax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ? true : false;

require 'lib/'.$lib.'.php';
require 'views/'.$lib.'.php';