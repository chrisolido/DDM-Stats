<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

$ch = curl_init("https://api.publisher.adknowledge.com/performance.xml?token=e6b806bdda7700153956ec734157be25&product_id=3&product_guid=*&dimensions=report_date,offer,subid&measures=revenue,clicks,ppc,actions,ppa&start_date=2012-09-01&end_date=2012-09-30&all=1&limit=0&format=xml");
$fp = fopen("performance.xml", "w");

curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_exec($ch);
curl_close($ch);
fclose($fp);


$filexml='performance.xml';
if (file_exists($filexml)) {
    $xml = simplexml_load_file($filexml);
$f = fopen('performance_xml2csv.csv', 'w');
	foreach ($xml->data->record as $record) {
    fputcsv($f, get_object_vars($record),',','"');

}
fclose($f);
}

$results = exec('zip -c performance_xml2csv.csv.zip performance_xml2csv.csv');
echo $results;


?>	