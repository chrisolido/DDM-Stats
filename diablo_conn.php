<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

$ch = curl_init("http://pub.diablomedia.com/reports/campaign/start/2012-09-01/end/2012-10-31/?output=xml&key=94b860cd791a56a03a1faf7e878b2939");
$fp = fopen("diablo_xml.xml", "w");

curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_exec($ch);
curl_close($ch);
fclose($fp);


$filexml='diablo_xml.xml';
if (file_exists($filexml)) {
    $xml = simplexml_load_file($filexml);
$f = fopen('diablo_xml2csv.csv', 'w');
foreach ($xml->row as $row) {
    fputcsv($f, get_object_vars($row),',','"');
}
fclose($f);
}

$results = exec('zip -c diablo_xml2csv.csv.zip diablo_xml2csv.csv');
echo $results;

?>
