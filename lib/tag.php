<?php

$Response = $Client->get('tag/'.$uri[2]);
$resp = $Response->json();

$Tag = (isset($resp['tag'])) ? $resp['tag'] : null;

$metaTitle = 'Tag '.$Tag['name'];
$metaDescription = 'Listing of all cheatsheets for the tag '.$Tag['name'].'.';