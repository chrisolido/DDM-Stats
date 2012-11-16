<?php

function xml2csv($xmlFile, $xPath) {

    // Load the XML file
    $xml = simplexml_load_file($xmlFile);

    // Jump to the specified xpath
    $path = $xml->xpath($xPath);

    // Loop through the specified xpath
    foreach($path as $item) {
    
	// Loop through the elements in this xpath
	foreach($item as $key => $value) {
	
	    $csvData .= '"' . trim($value) . '"' . ',';
	
	}
	
	// Trim off the extra comma
	$csvData = trim($csvData, ',');
	
	// Add an LF
	$csvData .= "\n";
    
    }
    
    // Return the CSV data
    return $csvData;
    
}

$csv_data = xml2csv( 'simplified.mtperformx.xml', 'ReportData/Rows/Row' );
echo $csv_data;
?>
