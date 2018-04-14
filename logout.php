<?php
	require('header.php');
	$islogin = 0;
	session_unset();
	session_destroy();
	header('location:index.php');
