<?php
$filexml='diablo_xml.xml';
if (file_exists($filexml)) {
    $xml = simplexml_load_file($filexml);
$f = fopen('diablo.csv', 'w');
foreach ($xml->diablo_xml as $diablo_xml) {
    fputcsv($f, get_object_vars($diablo_xml),',','"');
}
fclose($f);
}
?>
