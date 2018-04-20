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
function execbg($cmd, $log) {
    if (substr(php_uname(), 0, 7) == "Windows"){
        pclose(popen("start /B ". $cmd, "r")); 
    }
    else {
        exec($cmd . " >> {$log} &");  
    }
} 

// if we have files to upload
if (count($_FILES) > 0) {
    // make sure they filled out both
    if (!isset($_FILES['file1']['tmp_name']) || !isset($_FILES['file2']['tmp_name'])) {
        ?>
            <span class="error">Please select both files to upload</span>
        <?php
        return;
    }
    // pass them to the upload.php script
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
    $cmd = escapeshellcmd("/usr/bin/php")." -f ".
        escapeshellarg(join(DIRECTORY_SEPARATOR, array(dirname(__FILE__), "upload.php")))." ".
        escapeshellarg(json_encode($arg));
    $log = escapeshellarg(join(DIRECTORY_SEPARATOR, array(dirname(__FILE__), "uploads", "log.txt")));
    execbg($cmd, $log);
}
?>
        </div>
    </body>
</html>