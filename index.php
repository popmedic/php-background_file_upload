<?php
// Set the $php_path to where php lives on your server.
$php_path = escapeshellcmd("/usr/bin/php");
// Set the $log_path to where you want to print out from call_servive, 
//  or /dev/null if you don't want to have a log.
$log_path = escapeshellarg(join(DIRECTORY_SEPARATOR, array(dirname(__FILE__), "uploads", "log.txt")));
// Set the $call_servicepath to where the script to call the service lives.
$call_service_path = escapeshellarg(join(DIRECTORY_SEPARATOR, array(dirname(__FILE__), "call_service.php")));

// execbg will execute $cmd in the background redirecting output to $log.
function execbg($cmd, $log) {
    if (substr(php_uname(), 0, 7) == "Windows"){
        pclose(popen("start /B ". $cmd, "r")); 
    }
    else {
        exec($cmd . " >> {$log} &");  
    }
}
?>
<html>
    <head>
        <title>
            Poorman's Threadin'
        </title>
        <style>
            body{
                font-family: "Arial", sans-serif;
                color: #000000;
                background-color: #FFFFFF;
            }
            .error{
                color: #FF0000;
            }
        </style>
    </head>
    <body>
        <form enctype="multipart/form-data" action="index.php" method="post">
        <div>
            <input name="file1" type="file" />
        </div>
        <div>
            <input name="file2" type="file" />
        </div>
        <div>
            <input type="submit" />
        </div>
        </form>
        <div>
<?php 
// if we have files to upload
if (count($_FILES) > 0) {
    // make sure they filled out both
    if (!isset($_FILES['file1']['tmp_name']) || !isset($_FILES['file2']['tmp_name'])) {
        ?>
            <span class="error">Please select both files to upload</span>
        <?php
        return;
    }
    // pass them to the call_service.php script
    $arg = array(
        array(
            'name'=>$_FILES['file1']['name'],
            'data'=>base64_encode(file_get_contents($_FILES['file1']['tmp_name'])),
        ),
        array(
            'name'=>$_FILES['file2']['name'],
            'data'=>base64_encode(file_get_contents($_FILES['file2']['tmp_name'])),
        )
    );
    $cmd = "{$php_path} -f {$call_service_path} ".escapeshellarg(json_encode($arg));
    execbg($cmd, $log_path);
}
?>
        </div>
    </body>
</html>