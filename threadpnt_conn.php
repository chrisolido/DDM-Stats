<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

$ch = curl_init("reporting.mmgclicks.com/api.php?key=d70e233a517e04fe4c4fbdcdfd9aa1d92ca57960fb3afac9b559149638540c23&format=xml&type=test");
$fp = fopen("report.zip", "w");
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_exec($ch);
curl_close($ch);
fclose($fp);

?>