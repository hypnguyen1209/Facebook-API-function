<?php 
function get_info_user($uid, $token)
{
	$linklist = 'https://graph.facebook.com/'.$uid.'?access_token='.$token;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $linklist);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/68.4.154 Chrome/62.4.3202.154 Safari/537.36');
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$data = curl_exec($ch);
	curl_close($ch);
	$info = json_decode($data);

	$infouser = array();

	$var['name'] = $info->name;
	if (isset($info->gender) && $info->gender) {
		$var['gender'] = $info->gender;
	}
	else {
		$var['gender'] = 'Không xác định';
	}
	$var['link'] = $info->link;
	if (isset($info->username) && $info->username) {
		$var['username'] = $info->username;
	}
	$var['school'] = array();
	if (isset($info->education) && $info->education) {
		foreach ($info->education as $value) {
			$var = $value->school->name;
			array_push($var['school'], $var);
		}
	}
	else {
		$var['school'] = 'Thất học';
	}
	if (isset($info->birthday) && $info->birthday) {
		$format = explode('/', $info->birthday);
		$var['birthday'] = $format[1].'/'.$format[0].'/'.$format[2];
	}
	else {
		$var['birthday'] = 'Không rõ ngày tháng năm sinh';
	}
	if (isset($info->email) && $info->email) {
		$var['email'] = $info->email;
	}
	else {
		$var['email'] = 'Không có email';
	}
	if (isset($info->locale) && $info->locale) {
		$var['locale'] = $info->locale;
	}
	else {
		$var['locale'] = 'Vô gia cư';
	}
	if (isset($info->location) && $info->location) {
		$var['location'] = $info->location->name;
	}
	else {
		$var['location'] = 'Vô gia cư';
	}
	array_push($infouser, $var);

	return $infouser;
}