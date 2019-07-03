<?php
function get_tid($token)
{
	$linklist = 'https://graph.facebook.com/me/threads?fields=from&limit=5000&access_token='.$token;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $linklist);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3833.0 Safari/537.36');

	$data = curl_exec($ch);
	curl_close($ch);

	$infotid = json_decode($data);
	$info = array();
	foreach ($infothreadid->data as $value) {
		array_push($info, $value->id);
	}

	return $tid;
}