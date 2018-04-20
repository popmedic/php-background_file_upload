<?php
// Set $service_path to the location you would like to call, 
// I am just caling a local PHP page to called "upload.php" for the example.
$service_path = "http://localhost/www/background_file_upload/upload.php";

$c = curl_init($service_path);                                                                      
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
    echo "CURL Error:" . $err;
}
?>