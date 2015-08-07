<?php

$resp = null;
if (isset($_POST) and !empty($_POST)) {
	if (!$token)
		header("Location: /");

	$Response = $Client->post('/chtsht', [
		'body' => [
			'name'=>$_POST['name'],
			'description'=>$_POST['description']
		]
	]);

	if ($resp = $Response->getBody()) {
		$resp = json_decode($resp);
		if ($resp->status == 'OK')
			header("Location: /".$resp->chtsht->url);
	}
}

$name = (isset($_POST['name'])) ? $_POST['name'] : '';
$description = (isset($_POST['description'])) ? $_POST['description'] : '';

$metaTitle = 'Add a Chtsht';
$metaDescription = 'Adding a cheatsheet.  A quick resource for those that find the man pages too much';