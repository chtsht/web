<?php

if (isset($Chtsht['id'])) {
	$metaTitle = $Chtsht['name'];
	$metaDescription = 'A cheatsheet for '.$Chtsht['name'].'.';

	// format elements
	foreach ($Chtsht['blocks'] as $v=>$Block) {
		foreach ($Block['elements'] as $x=>$Element) {
			$Chtsht['blocks'][$v]['elements'][$x]['content'] = preg_replace('/\[var\](.+?)\[\/var\]/is','<span class="var">\\1</span>',$Chtsht['blocks'][$v]['elements'][$x]['content']);
			$Chtsht['blocks'][$v]['elements'][$x]['description'] = preg_replace('/\[var\](.+?)\[\/var\]/is','<span class="var">\\1</span>',$Chtsht['blocks'][$v]['elements'][$x]['description']);
		}
	}
} else {
	$metaTitle = urldecode($uri[1]);
	$metaDescription = 'A cheatsheet for '.urldecode($uri[1]).'.';
	$chtshtUrl = $uri[1];

	$lib = 'chtsht-not-exist';
}