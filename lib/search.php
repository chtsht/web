<?php

$Response = $Client->get('search/'.$_POST['text']);
$resp = $Response->json();

header('Content-type: application/json');
echo json_encode($resp);
exit;