<?php
// This is what I am using for the example, of course usually 
// this will be on a different server and do more.
$arg = json_decode(file_get_contents('php://input'), true);
foreach ($arg as $file) {
    $to = join(
        DIRECTORY_SEPARATOR, 
        array(
            dirname(__FILE__), 
            "uploads",
            $file['name']
        )
    );
    file_put_contents($to, base64_decode($file['data']));
}
?>
