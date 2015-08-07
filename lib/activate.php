<?php

if (isset($_POST['displayName']) and isset($_COOKIE['chtshtLogin'])) { // After activate, save display name
	$Response->setFields(array(
		'm' => 'user-edit',
		'token'=>$_COOKIE['chtshtLogin'],
		'displayName'=>$_POST['displayName']
	));
	$resp = $Response->getResponse();
	if ($resp->state == 'success') {
		header('Location: /');
	} else {
		print 'something went wrong';
	}
}

$metaTitle = 'Activate User';