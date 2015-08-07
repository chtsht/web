<?php
class Util {
	protected function loadObj($instance, Array $data) {
		foreach ($data as $field => $value) {
			if (property_exists(get_class($instance), $field) && isset($value) === true && is_array($value) === false) {
				$instance->$field = $value;
			}
		}

		return $instance;
	}
}

function getLoggedUser($Client) {
	if (isset($_SESSION['token'])) {
		$Response = $Client->get(API.'user/'.$_SESSION['token']);

		if ($Response->getStatusCode() == '200') {
			$resp = $Response->json();
			return $resp['user'];
		} else { print 1;
			//require 'lib/logout.php';
			exit;
		}
	}
	return null;
}

function defineConstants() {
	$db = new db();
	$db->prepareSelectFields('config',array());
	$configs = $db->executeQueryAll();

	foreach($configs as $config) {
		define($config['constant'],$config['value']);
	}
}

function getConstants($app = null) {
	$app = ($app) ? array('app'=>'1') : array();
	$db = new db();
	$db->prepareSelectFields('config',$app);
	$configs = $db->executeQueryAll();
	return $configs;
}

function cleanText($text) { #cleans sent variable of html arrows and line breaks.  used with name fields and descriptions
	$text = preg_replace('/>/i','&gt;',$text);
	$text = preg_replace('/</i','&lt;',$text);
	$text = preg_replace('/\n/i','',$text);
	#$text = preg_replace('/"/i','',$text);
	#$text = preg_replace('/\'/i','',$text);
	return $text;
}

function messageBBC($message) {
	$message = preg_replace('/>/i','&gt;',$message);
	$message = preg_replace('/</i','&lt;',$message);
	$message = preg_replace('/\[url\](.+?)\[\/url\]/is','<a href="\\1" target="_blank">\1</a>',$message);
	$message = preg_replace('/\[url=(.+?)\](.+?)\[\/url\]/is','<a href="\\1" target="_blank">\2</a>',$message);
	$message = preg_replace(
	 array(
	   '/(^|\s|>)(www.[^<> \n\r]+)/iex',
	   '/(^|\s|>)([_A-Za-z0-9-]+(\\.[A-Za-z]{2,3})?\\.[A-Za-z]{2,4}\\/[^<> \n\r]+)/iex',
	   '/(?(?=<a[^>]*>.+<\/a>)(?:<a[^>]*>.+<\/a>)|([^="\']?)((?:https?):\/\/([^<> \n\r]+)))/iex'
	 ),  
	 array(
	   "stripslashes((strlen('\\2')>0?'\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>&nbsp;\\3':'\\0'))",
	   "stripslashes((strlen('\\2')>0?'\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>&nbsp;\\4':'\\0'))",
	   "stripslashes((strlen('\\2')>0?'\\1<a href=\"\\2\" target=\"_blank\">\\3</a>&nbsp;':'\\0'))",
	 ), $message);
		
	$message = preg_replace('/\[quote\]/is','<div class="quotebbc"><span style="font-size:10px; color: #474747">Quote:</span>',$message);
	$message = preg_replace('/\[\/quote\]/is','</div>',$message);

	$message = preg_replace('/\[\*\]/is','<span id="bullet">&#149;</span>',$message);
	$message = preg_replace('/\[b\](.+?)\[\/b\]/is','<b>\\1</b>',$message);
	$message = preg_replace('/\[B\](.+?)\[\/B\]/is','<b>\\1</b>',$message);
	$message = preg_replace('/\[i\](.+?)\[\/i\]/is','<i>\\1</i>',$message);
	$message = preg_replace('/\[I\](.+?)\[\/I\]/is','<i>\\1</i>',$message);
	$message = preg_replace('/\[u\](.+?)\[\/u\]/is','<u>\\1</u>',$message);
	$message = preg_replace('/\[U\](.+?)\[\/U\]/is','<u>\\1</u>',$message);
	$message = preg_replace('/\[s\](.+?)\[\/s\]/is','<u>\\1</u>',$message);
	$message = preg_replace('/\[S\](.+?)\[\/S\]/is','<u>\\1</u>',$message);
	
	$message = preg_replace('/\n/i','<br />',$message);

	#go to messageImg function
	$message = preg_replace('/\[img\](.+?)\[\/img\]/is','<img src="\\1" alt="" />',$message);
	$message = preg_replace('/\[IMG\](.+?)\[\/IMG\]/is','<img src="\\1" alt="" />',$message);
	$message = preg_replace_callback('/\[img id=\"(.*?)\"\]/ss','messageImg',$message);
	$message = preg_replace_callback('/\[img id=\'(.*?)\'\]/ss','messageImg',$message);
	$message = preg_replace_callback('/\[img id=(.*?)\]/ss','messageImg',$message);
	
	return $message;
}

function stripToText($message) {

	$stripArray = array(
		'/\[img id=\"(.*?)\"\]/ss',
		'/\[img id=\'(.*?)\'\]/ss',
		'/\[img id=(.*?)\]/ss',
		'/>/i',
		'/</i',
		'/\[url\](.+?)\[\/url\]/is',
		'/\[url=(.+?)\](.+?)\[\/url\]/is',
		'/\[quote\]/is',
		'/\[\/quote\]/is',
		'/\[\*\]/is',
		'/\[b\](.+?)\[\/b\]/is',
		'/\[B\](.+?)\[\/B\]/is',
		'/\[i\](.+?)\[\/i\]/is',
		'/\[I\](.+?)\[\/I\]/is',
		'/\[u\](.+?)\[\/u\]/is',
		'/\[U\](.+?)\[\/U\]/is',
		'/\[s\](.+?)\[\/s\]/is',
		'/\[S\](.+?)\[\/S\]/is',
		'/\[img\](.+?)\[\/img\]/is',
		'/\[IMG\](.+?)\[\/IMG\]/is',
		'/\[img id=\'(.*?)\'\]/ss',
		'/\[img id=(.*?)\]/ss',
		'/\[img id=\"(.*?)\"\]/ss',
		'/\[comment id=(.+?)\]/is'
	);

	foreach ($stripArray as $key=>$value) {
		$message = preg_replace($value,'',$message);
	}
	
	$message = str_replace('\n', ' ', $message);
	$message = trim($message);
	return $message;
}

function formatCommand($text) {
	$text = preg_replace('/\[var\](.+?)\[\/var\]/is','<span class="var">\\1</span>',$text);
	//$text = str_replace("\n", "<br />", $text);
	$text = explode("\n",$text);
	return $text;
}

function formatDescription($text) {
	$text = preg_replace('/\[var\](.+?)\[\/var\]/is','<span class="var">\\1</span>',$text);
	//$text = str_replace("\n", "<br />", $text);
	$text = explode("\n",$text);
	return $text;
}

function lastUpdatedShort($date) {
	$current = time();
	if ($date > 0) {
		if ($date+3660 > $current) { $send = number_format(($current-$date)/60) . " min"; }
		else if ($date+86400 > $current) { $send = number_format(($current-$date)/3660) . " hours"; }
		else { $send = number_format(($current-$date)/86400) . " days"; }
	} else { $send = "Invalid"; }
	return $send;
}

function multidimensional_search($parents, $searched) {
	if (empty($searched) || empty($parents)) {
		return false;
	}

	foreach ($parents as $key => $value) {
		$exists = true;
		foreach ($searched as $skey => $svalue) {
			$exists = ($exists && IsSet($parents[$key][$skey]) && $parents[$key][$skey] == $svalue);
		}
		if($exists){ return $key; }
	}

	return false;
}

function getStateArray() {
	return array(
		"al" => "Alabama",
		"ak" => "Alaska",
		"az" => "Arizona",
		"ar" => "Arkansas",

		"ca" => "California",
		"co" => "Colorado",
		"ct" => "Connecticut",
		"de" => "Delaware",
		"dc" => "Washington DC",
		"fl" => "Florida",

		"ga" => "Georgia",
		"hi" => "Hawaii",
		"id" => "Idaho",
		"il" => "Illinois",
		"in" => "Indiana",
		"ia" => "Iowa",

		"ks" => "Kansas",
		"ky" => "Kentucky",
		"la" => "Louisiana",
		"me" => "Maine",
		"md" => "Maryland",
		"ma" => "Massachusetts",

		"mi" => "Michigan",
		"mn" => "Minnesota",
		"ms" => "Mississippi",
		"mo" => "Missouri",
		"mt" => "Montana",
		"ne" => "Nebraska",

		"nv" => "Nevada",
		"nh" => "New Hampshire",
		"nj" => "New Jersey",
		"nm" => "New Mexico",
		"ny" => "New York",
		"nc" => "North Carolina",

		"nd" => "North Dakota",
		"oh" => "Ohio",
		"ok" => "Oklahoma",
		"or" => "Oregon",
		"pa" => "Pennsylvania",
		"ri" => "Rhode Island",

		"sc" => "South Carolina",
		"sd" => "South Dakota",
		"tn" => "Tennessee",
		"tx" => "Texas",
		"ut" => "Utah",
		"vt" => "Vermont",

		"va" => "Virginia",
		"wa" => "Washington",
		"wv" => "West Virginia",
		"wi" => "Wisconsin",
		"wy" => "Wyoming");
}

function gravatar($email,$s=48,$d=USER_DEFAULT_ICON) {
	$d = urlencode(BASEURL.'/'.$d);
    $url = 'http://www.gravatar.com/avatar/';
    $url .= md5(strtolower(trim($email)));
    $url .= "?s=$s&d=$d";
    return $url;
}

function uploadFile($tmp_name,$location) {
	if (is_file($location)) //for now, just remove the file
		unlink($location);

	return move_uploaded_file($tmp_name,$location);
}

function logFile($type,$page,$userId,$message) {
	/*$db = new getMysql();
	$db->connect();

	$ref = '';
	if (isset($_SERVER["HTTP_REFERER"]))
		$ref = $_SERVER["HTTP_REFERER"];
	$ipaddress = $_SERVER["REMOTE_ADDR"];
	$currentTime = time();
	$db->insert("log",array("$currentTime","$type","$ipaddress","$ref","$page","$userId","$message"), "date, type, ipaddress, referrer, page, userId, message");
	*/
}