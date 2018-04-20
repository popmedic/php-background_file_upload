<?php
$arg = json_decode($argv[1], true);
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
