<?php
	require_once("header.php");
	if($islogin)
		echo"Hello $usr, this ouc lab management, now you can view the equipment";
	else
		echo"Hello $usr, You must log in or sign up to view the equipment";
?>

