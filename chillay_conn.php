<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

$ch = curl_init("");
$fp = fopen("performance.xml", "w");

curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_exec($ch);
curl_close($ch);
fclose($fp);


$filexml='performance.xml';
if (file_exists($filexml)) {
    $xml = simplexml_load_file($filexml);
$f = fopen('adknow_xml2csv.csv', 'w');
	foreach ($xml->data->record as $record) {
    fputcsv($f, get_object_vars($record),',','"');

}
fclose($f);
}

$results = exec('zip -f adknow_xml2csv.csv.zip adknow_xml2csv.csv');
echo $results;

?>