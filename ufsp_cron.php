<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Get the data in Diablomedia</title>
</head>

<body>

<?php

function cURLcheckBasicFunctions()
{
  if( !function_exists("curl_init") &&
      !function_exists("curl_setopt") &&
      !function_exists("curl_exec") &&
      !function_exists("curl_close") ) return false;
  else return true;
}

/*
 * Returns string status information.
 * Can be changed to int or bool return types.
 */
function cURLdownload($url, $file)
{
  if( !cURLcheckBasicFunctions() ) return "UNAVAILABLE: cURL Basic Functions";
  $ch = curl_init();
  if($ch)
  {
    $fp = fopen($file, "w");
    if($fp)
    {
      if( !curl_setopt($ch, CURLOPT_URL, $url) )
      {
        fclose($fp); // to match fopen()
        curl_close($ch); // to match curl_init()
        return "FAIL: curl_setopt(CURLOPT_URL)";
      }
      if( !curl_setopt($ch, CURLOPT_FILE, $fp) ) return "FAIL: curl_setopt(CURLOPT_FILE)";
      if( !curl_setopt($ch, CURLOPT_HEADER, 0) ) return "FAIL: curl_setopt(CURLOPT_HEADER)";
      if( !curl_exec($ch) ) return "FAIL: curl_exec()";
      curl_close($ch);
      fclose($fp);
      return "SUCCESS: $file [$url]";
    }
    else return "FAIL: fopen()";
  }
  else return "FAIL: curl_init()";
}

// Download from 'example.com' to 'example.txt'
echo cURLdownload("http://www.example.com", "example.txt");

?>


</body>
</html>