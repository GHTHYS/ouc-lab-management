<?php
require_once("../header.php");

$name = $describe = "";
$labnew = $namenew = $desnew = "";
$laberr = $nameerr = $describeerr = "";
$error = False;
if (isset($_GET['id'])) {
    $labid = (int) $_GET['id'];
    if ($labid) {
        $query1 = "SELECT * FROM lab WHERE id = '$labid'";
        $result = queryMysql("$query1");
        if ($result->num_rows) {
            $rows = $result->fetch_array(MYSQLI_ASSOC);
            $name = $rows['name'];
            $describe = $rows['info'];
        }
    }
}
if (isset($_POST['labid']) && isset($_POST['name']))//*
{
    list($labid, $laberr) = check('labid');
    list($namenew, $nameerr) = check('name');
    list($desnew, $describeerr) = check('describe');
    if ($error == False) {
        $query = "UPDATE equipment SET name='$namenew',info='$desnew' WHERE id= '$labid'";
        queryMysql($query);
        imgUpload($labid, "lab");
    }
}

if ($labid != ""){
    $file_path = "./img/lab_$labid.jpg";
    if(file_exists($file_path)){
        echo "Image:<img src=$file_path><br><br>";
    }
    else{
        echo "Image: No image has been uploaded!";
    }
}

echo <<<TEND
        <form method='post' action='modifylab.php' enctype="multipart/form-data">
        <input type='hidden' name='labid' value='$labid'> 
        Name<input type='text' name='name' value='$name'><span id='error'>$nameerr</span><br>
        Describe:<textarea name='describe' cols='50' rows='6'>$describe</textarea><span id='erroe'>$describeerr</span><br>
        New Image:<input type='file' name='image' size=14><br>
        <input type='submit' value='save equipment'>
        </form></body></html>
TEND;

