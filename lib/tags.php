<?php

$Response = $Client->get('tags/');
$resp = $Response->json();

$Tags = (isset($resp['tags'])) ? $resp['tags'] : null;

$metaTitle = 'Tags';
$metaDescription = 'Listing of all tags.';