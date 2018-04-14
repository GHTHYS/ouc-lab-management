<?php
require_once("../header.php");
//if(!$isadmin) die(); //find way to distinguish admin
$name = $input_time = $status = $info = $lab = "";
$loopnum = 1;
$numerr = $iderr = $nameerr = $timeerr = $statuserr = $infoerr = $laberr = "";
$error = False;
$status = array("available", "repair", "borrow", "scrap");
if (isset($_POST['name'])) {
    list($name, $nameerr) = check("name");
    list($input_time, $timeerr) = check("input_time");
    list($status, $statuserr) = check("status");
    list($info, $infoerr) = check("info");
    list($lab, $laberr) = check("lab");
    list($loopnum, $numerr) = check("num");
    echo $error;

    if (!$error) {

        for ($i = 0; $i < (int)$loopnum; $i++) {
            $query2 = "INSERT INTO equipment VALUES(NULL,'$name','$input_time','$status','$info','$lab')";
            $result2 = queryMysql($query2);

        }
        $query = "select id from equipment where name = '$name' and info = '$info' and input_time = '$input_time'";
        $result = queryMysql($query);
        $row = $result->fetch_array();
        imgUpload($row['id'], "equ");
        $src_id = $row['id'];
        for ($i = 0; $i < $result->num_rows - 1; $i++) {
            $row = $result->fetch_array();
            copy("../img/equ_". $src_id. ".jpg", "../img/equ_". $row['id']. ".jpg");
        }

    }
}
echo <<<TEND
	<form method='post' action='equipments.php' enctype="multipart/form-data">
	Name<input type='text' name='name' value='$name'><span id='error'>$nameerr</span><br>
	Num<input type='text' name='num' value=$loopnum><span id='error'>$numerr</span><br>
	Input_time<input type='text' name='input_time' value='$input_time'><span id='error'>$timeerr</span><br>	
	Status: Available<input type='radio' name='status' value='1' checked='checked'>
		Repair<input type='radio' name='status' value='2'>
		Borrow<input type='radio' name='status' value='3'>
		scrap<input type='radio' name='status' value='4'><br>	
	Describe:<textarea name='info' cols='50' rows='6'>$info</textarea><span id='erroe'>$infoerr</span><br>
    Lab:<input type="text" name="lab" value='$lab'><span id='error'>$laberr</span></br>
	Image:<input type='file' name='image' size=14><br>
	<input type='submit' value='save equipment'>
	</form></body></html>
TEND;
?>	
	
	
