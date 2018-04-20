<?php
$c = curl_init("http://localhost/www/background_file_upload/upload.php");                                                                      
curl_setopt($c, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($c, CURLOPT_POSTFIELDS, $argv[1]);                                                                      
curl_setopt($c, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($argv[1]))                                                                       
);
curl_exec($c);
$err = curl_error($c);
curl_close($c);
if ($err) {
    echo "cURL Error #:" . $err;
}
?>