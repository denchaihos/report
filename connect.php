<?php
//Connect to database
$host = "localhost";
$uname = "root";
$passwd = "123456";
$dbname = "hi";
$con = mysql_connect($host,$uname,$passwd);
If (!$con) {
    echo "<h3> error  :  can not connect database</h3>";
    exit();
}
mysql_select_db('hi');
mysql_query("SET NAMES TIS620");
/*
mysql_query("set character_set_results=utf8", $con);
mysql_query("set character_set_connection=utf8", $con);
mysql_query("set character_set_client=utf8", $con);
*/

mysql_query("set character_set_results=tis620", $con);
mysql_query("set character_set_connection=tis620", $con);
mysql_query("set character_set_client=tis620", $con);
