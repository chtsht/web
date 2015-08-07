<?php

$apiMethod = $uri[2];
$apiUri = implode('/',array_slice($uri, 3, count($uri)));
$userTokenUri = ($token) ? "?token=$token" : '';

$params = (isset($_POST)) ? $_POST : null;

switch($apiMethod) {
	case 'get':
		$Response = $Client->get($apiUri);
		break;
	case 'post':
		$Response = $Client->post($apiUri, ['body'=>$params]);
		break;
	case 'put':
		$Response = $Client->put($apiUri.'/'.$_POST['id'], ['body'=>$params]);
		break;
	case 'delete':
		$Response = $Client->delete($apiUri);
		break;
}

header('Content-type: application/json');
print $Response->getBody();
exit;