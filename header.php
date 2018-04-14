<?php
header("content-type:text/html;charset=utf-8");
session_start();
require_once("function.php");
$appname = "ouclabmanagement";
$usr = "(Guest)";
$isadmin = FALSE;

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $usr = "($user)";
    $islogin = TRUE;
    if (isset($_SESSION['isadmin'])) {
        $isadmin = TRUE;
    }
} else
    $islogin = FALSE;

echo <<<TEND
	<html>
	<head><title>$appname</title>
	      <link rel="stylesheet" href="./css/style.css" type="text/css">
	      <script src="./js/javascript.js"></script>
	</head>
		
		
TEND;
if ($islogin == TRUE) {
    if ($isadmin == TRUE)
        echo <<< TEND
            <body>
                <div class="$appname">
					<ul><li><a href="index.php">HOME</a></li>
					    <li><a href="showequ.php">EQU SHOW</a></li>
					    <li><a href="showlab.php">LAB SHOW</a></li>
					    <li><a href="equipments.php">EQU INSERT</a></li>
					    <li><a href="lab.php">LAB INSERT</a></li>
					    <li><a href="user.php">USERS MANAGE</a></li>
					    <li><a href="../logout.php">LOGOUT</a></li>
					</ul>
				</div>
			</body>
TEND;
    else
        echo <<< TEND
		
			<body>
				<div class="$appname">
					<ul><li><a href="index.php">HOME</a></li>					    
					    <li><a href="showequ.php">EQUIPMENT</a></li>
					    <li><a href="../logout.php">LOGOUT</a></li>
					</ul>
				</div>
			</body></html>
TEND;
} else
    echo <<< TEND
			<body>
				<div class="$appname">
					<ul><li><a href="index.php">HOME</a></li>
					    <li><a href="login.php">LOGIN</a></li>
					    <li><a href="signup.php">SIGN UP</a></li>
				</div>
			</body></html>
TEND;

