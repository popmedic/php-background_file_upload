<?php
if(count($_FILES) > 0){
    print_r($_FILES);
} else {
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
        </style>
    </head>
    <body>
        <form enctype="multipart/form-data" action="index.php">
        <div>
            <input name="file1" type="file" /><br />
        </div>
        <div>
            <input name="file2" type="file" /><br />
        </div>
        <div>
            <input type="submit" />
        </div>
        </form>
    </body>
</html>
<?php
}
?>