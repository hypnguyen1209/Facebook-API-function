<?php
function get_list_friend($uid, $token)
{
	$linklist = 'https://graph.facebook.com/'.$uid.'/friends?limit=5000&fields=name&access_token='.$token;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $linklist);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/68.4.154 Chrome/62.4.3202.154 Safari/537.36');
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$data = curl_exec($ch);
	curl_close($ch);

	$infofriend = json_decode($data);
	$info = array();

	foreach ($infofriend->data as $value) {
		$var['id'] = $value->id;
		$var['name'] = $value->name;
		array_push($info, $var);
	}
	return $info;
}