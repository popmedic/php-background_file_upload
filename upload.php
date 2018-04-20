<?php
print_r(file_get_contents('php://input'));
$arg = json_decode(file_get_contents('php://input'), true);
print_r($arg);
foreach ($arg['files'] as $file) {
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
