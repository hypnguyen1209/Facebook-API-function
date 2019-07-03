<?php
function get_id_post($uid, $token)
{
	$linklist = 'https://graph.facebook.com/'.$uid.'/feed?fields=id&limit=5000&access_token='.$token;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $linklist);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/68.4.154 Chrome/62.4.3202.154 Safari/537.36');
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$data = curl_exec($ch);
	curl_close($ch);

	$infoidpost = json_decode($data);
	$info = array();

	foreach ($infoidpost->data as $value) {
		$public_scope = explode('_', $value->id);
		$var = $public_scope[1];
		array_push($info, $var);
	}
	return $info;
}