<?php
function get_token($username, $password)
{
	$linklist = 'https://api.facebook.com/restserver.php';

	$postdata = 'api_key=882a8490361da98702bf97a021ddc14d&email='.$username.'&format=JSON&locale=vi_vn&method=auth.login&password='.$password.'&return_ssl_resources=0&v=1.0&sig='.md5('api_key=882a8490361da98702bf97a021ddc14demail='.$username.'format=JSONlocale=vi_vnmethod=auth.loginpassword='.$password.'return_ssl_resources=0v=1.062f8ce9f74b12f84c123cc23437a4a32');

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $linklist);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; Android 4.4.2; SMART 3.5'' Touch+ Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/30.0.0.0 Mobile Safari/537.36');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);

	$data = curl_exec($ch);
	curl_close($ch);

	$infotoken = json_decode($data);
	$token = $infotoken->access_token;

	return $token;
}