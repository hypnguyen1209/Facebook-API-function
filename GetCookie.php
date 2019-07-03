<?php
function get_cookie($token, $new_app_id, $type = 'text')
{
	$linklist = 'https://api.facebook.com/method/auth.getSessionforApp?access_token='.$token.'&format=json&new_app_id='.$new_app_id.'&generate_session_cookies=1';

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $linklist);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/68.4.154 Chrome/62.4.3202.154 Safari/537.36');

	$data = curl_exec($ch);
	curl_close($ch);

	$data = json_decode($data);
	if ($type == 'json') {
		$cookie = json_encode($data->session_cookies);
	}
	elseif ($type == 'text') {
		$cookie = '';
	 	foreach ($data->session_cookies as $value) {
	 		$cookie .= $value->name. '=' .$value->value. ';';
	 	}
	}
	return $cookie;
}