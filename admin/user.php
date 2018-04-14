<?php
/**
 * Created by PhpStorm.
 * User: donky16
 * Date: 2018/3/22
 * Time: 15:08
 */
require "../header.php";

$query = 'SELECT * from user';
$result = queryMysql($query);

if ($result->num_rows) {
    for ($i = 0; $i < $result->num_rows; $i++) {
        $row = $result->fetch_array();
        echo "Id:" . $row['id'] . "<br>" . "Name:" . $row['name'] . "<br>"
            . "Username:" . $row['username'] . "<br>" . "Password:" . $row['password'] . "<br>"
            . "<br>" . "<a href='modifyuser.php?id=$id'>修改</a>" . "<br>";
    }
}