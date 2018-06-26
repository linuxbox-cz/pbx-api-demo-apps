<?php
define('URL', 'https://custpbx.lbox.cz:8443/');
define('CERT', './custpbx-demo1.pem');

function api_call($action, $data) {

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, URL . $action);
	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_SSLCERT, CERT);

	$response = curl_exec($ch);
	if ($response === false) {
		echo 'Connection error: ' . curl_error($ch) . "\n";
		return null;
	}

	curl_close($ch);

	return $response;
}


$res = api_call('exten_dial', array(
	'exten' => '100',
	'number' => '123456789'
));
print_r($res);
echo "\n";
