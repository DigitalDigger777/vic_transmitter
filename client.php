<?php

$pathToLog = 'errors.log';

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, "http://levon.vic-transmitter/server.php");
$result = curl_exec($ch);
curl_close($ch);

$item = json_decode($result);

if (!property_exists($item, 'error')) {
	//print_r($item);
	
	//TODO: release insert to table pg_news
} else {
	$h = fopen($pathToLog, 'a+');
	fwrite($h, date('Y/m/d H:i:s') . ':' . $item->error->code . ':' . $item->error->message . "\n");
	fclose($h);
}

