<?php
require_once("header.php");
$user = $pass = $error = "";
if (isset($_POST['user']) && isset($_POST['pass'])) {
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);
    if ($user == "" || $pass == "")
        $error = "Not all fields are enter";
    else if ($user == "admin" && $pass == "admin") {
        $_SESSION['isadmin'] = 1;
        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $pass;
        header("Location:./admin/index.php");
    } else {
        $query = "SELECT * FROM user WHERE username='$user' AND password='$pass'";
        $result = queryMysql($query);
        if ($result->num_rows) {
            $_SESSION['user'] = $user;
            $_SESSION['pass'] = $pass;
            header("Location:./user/index.php");
        } else {
            $error = "PASSWORD/USERNAME error";
        }
    }
}
echo <<<TEND
	<form method='post' action='login.php'>$error
	<span class='fielduser'>USERNAME</span>
	<input type='text' name='user' value='$user' maxlength=16>
	<span class='fieldpass'>PASSWORD</span>
	<input type='password' name='pass' value='$pass'>
	<input type='submit' value='LOG IN'>
	</form>
	</body></html>
TEND;
