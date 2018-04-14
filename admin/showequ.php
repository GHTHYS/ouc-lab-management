<?php
require_once("../header.php");
//if (!$islogin)
//    die("please log in first");

if (isset($_GET['id'])) {
    showEquDetails((int)$_GET['id']);
} else {
    $query = 'SELECT * from equipment';
    $result = queryMysql($query);

    if ($result->num_rows) {
        for ($i = 0; $i < $result->num_rows; $i++) {
            $row = $result->fetch_array();
            $show_url = "showequ.php?id=" . (int)$row['id'];
            $modify_url = "modifyequ.php?id=" . (int)$row['id'];
            echo "Id:" . $row['id'] . "<br>" . "Name:" . $row['name'] . "<br>" . "Input_time: " . $row['input_time'] . "<br>"
                . "<a href=" . $show_url . ">查看</a>" . "<br>" . "<a href=" . $modify_url . ">修改</a>" . "<br>";
        }
    }
}
