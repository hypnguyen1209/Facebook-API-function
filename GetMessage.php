<?php
function get_message($tid, $token)
{
	$linklist = 'https://graph.facebook.com/'.$tid.'?limit=5000&access_token='.$token;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $linklist);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3833.0 Safari/537.36');
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$data = curl_exec($ch);
	curl_close($ch);

	$infomessage = json_decode($data);
	$message = array();

	foreach ($infomessage->messages->data as $value) {
		$var['from'] = $value->from->name;
		$var['message'] = $value->message;
		$created_time = explode('T', $value->created_time);
		$formatdate = explode('-', $created_time[0]);
		$time = explode('+', $created_time[1]);
		$formattime = explode(':', $time[0]);
		$var['created_time'] = ($formattime[0] - 5).':'.$formattime[1].':'.$formattime[2].'-'.$formatdate[2].'/'.$formatdate[1].'/'.$formatdate[0];;
		array_push($message, $var);
	}

	return $message;
}