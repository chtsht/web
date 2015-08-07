<?php

$Response = $Client->get('chtshts/');
$resp = $Response->json();

$Chtshts = (isset($resp['chtshts'])) ? $resp['chtshts'] : null;

$metaTitle = 'List';
$metaDescription = 'Listing all cheatsheets.  A quick resource for those that find the man pages too much';