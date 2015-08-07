<?php

$Response = $Client->get('chtsht/latest/10');
$resp = $Response->json();

$Chtshts = (isset($resp['chtshts'])) ? $resp['chtshts'] : null;

$metaTitle = 'CHTSHT.io';
$metaDescription = 'View and create cheatsheets for commands and other programs.';