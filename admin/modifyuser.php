<?php
/**
 * Created by PhpStorm.
 * User: donky16
 * Date: 2018/3/22
 * Time: 15:35
 */
require "../header.php";

$username = $password = $name = "";
$usernamenew = $namenew = $passwordnew = "";
$usernameerr = $nameerr = $passworderr = "";
$error = False;
if (isset($_GET['id'])) {
    $userid = (int)$_GET['id'];
    $query1 = "SELECT * FROM user WHERE id = '$userid'";
    $result = queryMysql("$query1");
    if ($result->num_rows) {
        $rows = $result->fetch_array(MYSQLI_ASSOC);
        $name = $rows['name'];
        $username = $rows['username'];
        $password = $rows['password'];
    }
}
if (isset($_POST['userid']) && isset($_POST['name']))//*
{
    list($userid, $usererr) = check('userid');
    list($namenew, $nameerr) = check('name');
    list($usernamenew, $usernameerr) = check('username');
    list($passwordnew, $passworderr) = check('password');
    if ($error == False) {
        $query = "UPDATE user SET name='$namenew', username='$username', password='$password' WHERE id= '$userid'";
        queryMysql($query);
    }
}

echo <<<TEND
<html>  
    <body>
        <form method='post' action='modifyuser.php' >
        <input type='hidden' name='userid' value='$userid'> 
        Username:<input type='text' name='username' value='$username'><span id='error'>$usernameerr</span><br>
        Password:<input name='password' cols='50' rows='6' value='$password'><span id='erroe'>$passworderr</span><br>
        Name:<input type='text' name='name' value='$name'> <span id='error'>$nameerr</span><br>
        <input type='submit' value='save equipment'>
        </form>
    </body>
</html>
TEND;
