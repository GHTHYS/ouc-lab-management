<?php
require_once "../header.php";

$statuses = array("available", "repair", "borrow", "scrap");
$id = $name = $input_time = $status = $describe = $namenew = $timenew = $statusnew = $desnew = "";
$iderr = $nameerr = $timeerr = $statuserr = $describeerr = "";
$equid = $status_num = 0;
$error = False;

if (isset($_GET['id'])) {
    $equid = (int)$_GET['id'];
    $query1 = 'SELECT * FROM equipment WHERE id =' . $equid;
    $result = queryMysql("$query1");
    if ($result->num_rows) {
        $rows = $result->fetch_array();
        $name = $rows['name'];
        $input_time = $rows['input_time'];
        $status_num = (int)$rows['status'];
        $status = $statuses[(int)$rows['status']];
        $describe = $rows['info'];
    }
}

if (isset($_POST['equid']) && isset($_POST['name']))//*
{
    list($id, $iderr) = check('equid');
    list($namenew, $nameerr) = check('name');
    list($timenew, $timeerr) = check('input_time');
    list($statusnew, $statuserr) = check('status');
    list($desnew, $describeerr) = check('describe');
    if ($error == False) {
        $query = "UPDATE equipment SET name='$namenew',input_time='$timenew',status='$statusnew',info='$desnew' WHERE id='$id'";
        queryMysql($query);
        imgUpload($id);
    }
}
echo <<< TEND
<!DOCTYPE html>
<html>
<html>
<body>
<form method='post' action='modifyequ.php' enctype="multipart/form-data">
    <input type='hidden' name='equid' value=$equid>
    Name<input type='text' name='name' value=$name><span id='error'>$nameerr</span><br>
    Input_time<input type='text' name='input_time' value=$input_time><span id='error'>$timeerr</span><br>
    New Status:<br>
TEND;
for($i = 0; $i < 4; $i ++){
    if($i == $status_num){
        echo "$statuses[$i]<input type='radio' name='status' value='$status_num'  checked='checked'><br>";
    } else
        echo "$statuses[$i]<input type='radio' name='status' value='$status_num'><br>";
}
echo <<< TEND
    Describe:<textarea name='describe' cols='50' rows='6'>$describe</textarea><span id='erroe'>$describeerr</span><br>
    New Image:<input type='file' name='image' size=14><br>
    <input type='submit' value='save equipment'>
</form>
</body>
</html>
TEND;
