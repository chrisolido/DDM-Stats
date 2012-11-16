<?php                                                                                                                                 
ini_set('display_errors', 'On');                                                                                                      
error_reporting(E_ALL | E_STRICT);                                                                                                    
                                                                                                                                      
$ch =                                                                                                                                 
curl_init("https://www.performanceexchange.com/publisher/report/api/588d7fd847b14aae8cfbf39d87a3aec5/xml/report/stats?startDate=2012-09-01&endDate=2012-09-31");                                                                                                            
$fp = fopen("mtperformx_.xml", "w");                                                                                                  
curl_setopt($ch, CURLOPT_FILE, $fp);                                                                                                  
curl_setopt($ch, CURLOPT_HEADER, 0);                                                                                                  
                                                                                                                                      
curl_exec($ch);                                                                                                                       
curl_close($ch);                                                                                                                      
fclose($fp);                                                                                                                          



//open file and get data
$data = file_get_contents("mtperformx_.xml");

// do tag replacements or whatever you want
$data = str_replace("api:", "", $data);

//save it back:
file_put_contents("mtperformx.xml", $data);

$filexml='mtperformx.xml';
if (file_exists($filexml)) {
    $xml = simplexml_load_file($filexml);
    $f = fopen('mtperformx_xml2csv.csv', 'w');

    foreach ($xml->ReportData->Totals as $Row) {
      $data = get_object_vars($Row);
      $strdata=array_shift($data);
//    var_dump($data);

      fputcsv($f, $strdata);

    }
	
	foreach ($xml->ReportData->Rows->Row as $Row) {
      $data = get_object_vars($Row);
      $strdata=array_shift($data);
//    var_dump($data);

      fputcsv($f, $strdata);
	}
	
fclose($f);
}


$results = exec('zip mtperformx_xml2csv.csv.zip mtperformx_xml2csv.csv');
echo $results;


?>