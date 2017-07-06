<?php
include 'readConfig.php';
$host = trim($config['host']);
$uname = trim($config['username']);
$passwd = trim($config['password']);
$dbname = trim($config['db']);
$con = mysql_connect($host,$uname,$passwd);
//$con = mysql_connect('192.168.11.5', 'hiuser', '212224');
//$con = mysql_connect('localhost', 'root', '123456');
If (!$con) {
    echo "<h3> error  :  Can not conect databse</h3>";
    exit();
}else{
//echo "success";
    mysql_select_db($dbname);
    mysql_query("set character_set_results=utf8");
    mysql_query("set character_set_connection=utf8");
    mysql_query("set character_set_client=utf8");
}

//Connect to database
/*$host = "localhost";
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
/*
mysql_query("set character_set_results=tis620", $con);
mysql_query("set character_set_connection=tis620", $con);
mysql_query("set character_set_client=tis620", $con);
*/