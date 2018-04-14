<?php
require_once("../header.php");
//if(!$isadmin) die();//*
$labid = $name = $info = "";
$iderr = $nameerr = $infoerr = "";
$error = False;
if (isset($_POST['name'])) {
    list($name, $nameerr) = check("name");
    list($info, $infoerr) = check("name");
    if (!$error) {
        $query2 = "INSERT INTO lab VALUES(NULL,'$name','$info')";
        $result2 = queryMysql($query2);
        $query = "select id from lab where name = '$name' and info = '$info'";
        $result = queryMysql($query);
        $row = $result->fetch_array();
        imgUpload($row['id'], "lab");
    }
}
echo <<<TEND
        <form method='post' action='lab.php' enctype="multipart/form-data">
        Name<input type='text' name='name' value='$name'><span id='error'>$nameerr</span><br>
        Describe:<textarea name='describe' cols='50' rows='6'>$info</textarea><span id='erroe'>$infoerr</span><br>
        Image:<input type='file' name='image' size=14><br>
        <input type='submit' value='save lab'>
        </form></body></html>
TEND;
?>

