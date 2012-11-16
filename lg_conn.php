<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

$ch = curl_init("");
$fp = fopen("lg_conn_.xml", "w");
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_exec($ch);
curl_close($ch);
fclose($fp);

?>