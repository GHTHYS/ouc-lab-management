<?php
require_once("header.php");
echo "<div>Please enter details to signup</div>";
$error = $user = $pass = $name = "";
if (isset($_SESSION['user']))
    destroySession();
if (isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['name'])) {
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);
    $name = sanitizeString($_POST['name']);
    if ($user == '' || $pass == '' || $name == '') {
        $error = "Not All Fields Are Enter.";
    } else {
        $query = "SELECT * FROM user WHERE username = '$user'";
        $result = queryMysql($query);
        if ($result->num_rows)
            $error = "The username already exists";
        else
            queryMysql("INSERT INTO user VALUES(null, '$user', '$pass', '$name')");
        die("<br>Successful! Now you can log in<br><br>");
    }
}
echo <<<TEND
		<form method='post' action='signup.php'>$error
		<span class='fileduser'>USERNAME</span>
		<input type='text' onBlur='checkUser(this,"user","checkUser.php");' name='user' value='$user' maxlength='16'><div id='info'></div><br><br>
		<span class='filedpass'>PASSWORD</span>
		<input type='password' name='pass' value='$pass'>
		<span class='filedname'>NAME</span>
		<input type='text' name='name' value='$name'>
		<input type='submit' value='SIGN UP'>
		</form>
TEND;
?>
