<?php
require_once("../header.php");
//if (!$islogin)
//    die("please log in first");

if (isset($_GET['id'])) {
    showLabDetails((int)$_GET['id']);
} else {
    $query = 'SELECT * from lab';
    $result = queryMysql($query);

    if ($result->num_rows) {
        for ($i = 0; $i < $result->num_rows; $i++) {
            $row = $result->fetch_array();
            $show_url = "showlab.php?id=" . (int)$row['id'];
            $modify_url = "modifylab.php?id=" . (int)$row['id'];
            echo "Id:" . $row['id'] . "<br>" . "Name:" . $row['name'] . "<br>"
                . "<a href=" . $show_url . ">查看</a>" . "<br>" . "<a href=" . $modify_url . ">修改</a>" . "<br>";
        }
    }
}