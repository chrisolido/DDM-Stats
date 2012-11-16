<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

$ch = curl_init("http://sky.tenhoknet.com/stats/stats.xml?api_key=AFFTWjAQiSrcqIjNXraW04XFygOOZP&group[]=Stat.date&group[]=Stat.source&start_date=2012-09-01&end_date=2012-11-07 ");
$fp = fopen("thnconn_stats.xml", "w");

curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_exec($ch);
curl_close($ch);
fclose($fp);

$ch = curl_init("http://sky.tenhoknet.com/offers/offers.xml?api_key=AFFTWjAQiSrcqIjNXraW04XFygOOZP&limit=0&page=500");
$fp = fopen("thnconn_offers.xml", "w");

curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_exec($ch);
curl_close($ch);
fclose($fp);


$filexml='thnconn_stats.xml';
if (file_exists($filexml)) {
    $xml = simplexml_load_file($filexml);
    $f = fopen('thnconn_stats_xml2csv.csv', 'w');

    foreach ($xml->stats->stat as $stat) {
      $data = get_object_vars($stat);
      array_shift($data);
      fputcsv($f, $data);
    }


fclose($f);
}

$filexml='thnconn_offers.xml';
if (file_exists($filexml)) {
    $xml = simplexml_load_file($filexml);
    $f = fopen('thnconn_offers_xml2csv.csv', 'w');

    foreach ($xml->offer as $offer) {
      $data = get_object_vars($offer);
      array_shift($data);
      fputcsv($f, $data);
    }


fclose($f);
}

$results = exec('zip thnconn_stats_xml2csv.csv.zip thnconn_stats_xml2csv.csv');
echo $results;

$results = exec('zip thnconn_offers_xml2csv.csv.zip thnconn_offers_xml2csv.csv');
echo $results;


?>