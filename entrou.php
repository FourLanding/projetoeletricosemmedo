<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, "https://trackcmp.net/event");
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, array(
	"actid" => "610339326",
	"key" => "107925309c7e4118ec7890691c7c2521c7361933",
	"event" => $_GET['tag'],
	"eventdata" => $_GET['url'],
	"visit" => json_encode(array(
			// If you have an email address, assign it here.
			"email" => $_GET['email'],
		)),
	));

	$result = curl_exec($curl);
	if ($result !== false) {
		$result = json_decode($result);
		if ($result->success) {
    echo 'ok';
		} else {
			echo 'Error! ';
		}

		//echo $result->message;
	} else {
		echo 'cURL failed to run: ', curl_error($curl);
	}
