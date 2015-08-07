<?php

if (isset($uri[2]) and $uri[2] == 'github') {
	if (isset($_GET['code'])) {
		$params['state'] = $_GET['state'];
		$params['code'] = $_GET['code'];

		$Response = $Client->post(API.'login/github', ['body'=>$params]);

		$resp = $Response->json();

		$_SESSION['token'] = $resp['token'];
	} else {
		$params = array(
			'client_id' => GITHUB_OATH_CLIENT_ID,
			'scope' => 'user',
			'state' => hash('sha256', microtime(TRUE).rand().$_SERVER['REMOTE_ADDR'])
		);

		header('Location: https://github.com/login/oauth/authorize?' . http_build_query($params));
		die();
	}

	header('Location: '.URL);
}

$metaTitle = 'Log In - CHTSHT.io';
$metaDescription = 'Log into CHTSHT.io via Github';