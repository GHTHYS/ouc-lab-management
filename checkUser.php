<?php
	require_once("function.php");
	if(isset($_POST['user']))
	{
		$user = sanitizeString($_POST['user']);
		$query = "SELECT * FROM user WHERE username='$user'";
		$result = queryMysql($query);
		if($result->num_rows)
			echo "The username already exists";
		else
			echo "The username is available";
	}
?>
