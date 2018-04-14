<?php
$dblocal = "localhost";
$dbuser = "root";
$dbpasswd = "donky@16";
$dbname = "ouclabmanagement";
$connection = new mysqli($dblocal, $dbuser, $dbpasswd, $dbname);
$connection->query("set names 'utf8'"); //设置utf-8编码
if ($connection->connect_error) die($connection->conncet_error);
function queryMysql($query)
{
    global $connection;
    $result = $connection->query($query);
    if (!$result)
        die($connection->error);//may be modified according to the situation
    else
        return $result;
}
function sanitizeString($str)
{
    global $connection;
    $str = strip_tags($str);
    $str = htmlentities($str);
    $str = stripslashes($str);
    $str = $connection->real_escape_string($str);
    return $str;
}
function showEquDetails($equid)
{
    $statuses = array("available", "repair", "borrow", "scrap");
    $query = "SELECT e.id id,e.name name,input_time,status,e.info info,l.name labname"
        . " FROM equipment e,lab l "
        . " WHERE e.id = " . $equid . " AND l.id = e.labid";
    $result = queryMysql($query);
    if ($result->num_rows) {
        $row = $result->fetch_array();
        echo "Name:" . $row['name'] . "<br>" . "Input_time: " . $row['input_time'] . "<br>"
            . "Lab:" . $row['labname'] . "<br>" . "Status:" . $statuses[(int)$row['status']] . "<br>" . "Describe: " . $row['info'] . " <br><br > ";
    }
    if (file_exists("../img/equ_" . $equid . ".jpg"))
        echo "<img src='../img/equ_" . $equid . ".jpg' style='float:left'/><br><br>";
    else
        echo "Image: No image has been uploaded!";
}
function showLabDetails($labid)
{
    $query = "SELECT * FROM lab WHERE id = $labid";
    $result = queryMysql($query);
    if ($result->num_rows) {
        $row = $result->fetch_array();
        echo "Id:" . $row['id'] . "<br>" . "Name:" . $row['name'] . "<br>" .
            "Describe: " . $row['info'] . " <br><br > ";
    }
    if (file_exists("../img/lab_" . $labid . ".jpg"))
        echo "<img src='../img/lab_" . $labid . ".jpg' style='float:left'/><br><br>";
    else
        echo "Image: No image has been uploaded!";
}
function destroySession()
{
    $_SESSION = array();
    if (session_id() != "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time() - 2560000, '/');
    session_destroy();
}
function check($str)
{
    global $error;
    $var = $_POST[$str];
    if (empty($var)) {
        $var = "";
        $error = "$str is empty";
        $error = True;
    } else {
        $var = sanitizeString($var);
        $error = "";
    }
    return array($var, $error);
}
function imgUpload($id, $type)
{
    if ($type == "lab")
        $file_save_path = "../img/lab_$id.jpg";
    else if ($type == "equ")
        $file_save_path = "../img/equ_$id.jpg";
    if (isset($_FILES['image']['name']) && $id != "") {
        if (file_exists($file_save_path))
            unlink($file_save_path);
        move_uploaded_file($_FILES['image']['tmp_name'], $file_save_path);
    }
}