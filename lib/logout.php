<?php

if (isset($_SESSION['token'])) {
	$Client->setDefaultOption('headers/token',$token);
	$Response = $Client->post(API.'logout');
	unset($_SESSION['token']);
}

header('Location: /');