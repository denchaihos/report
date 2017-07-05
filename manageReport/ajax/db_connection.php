<?php
/*
$HOST_NAME = "127.0.0.1";
$DB_NAME = "hi";
$CHAR_SET = "charset=utf8"; // เช็ตให้ใช้ภาษาไทยได
$USERNAME = "root";    // ตั้งค่าตามการใช้งานจริง
$PASSWORD = "123456";  // ตั้งค่าตามการใช้งา
*/
// Connection variables 
/*$host = "localhost"; // MySQL host name eg. localhost
$user = "root"; // MySQL user. eg. root ( if your on localserver)
$password = "123456"; // MySQL user password  (if password is not set for your root user then keep it empty )
$database = "hi"; // MySQL Database name

// Connect to MySQL Database 
$db = mysql_connect($host, $user, $password) or die("Could not connect to database");

// Select MySQL Database 
mysql_select_db($database, $db);
mysql_query("SET character_set_results=utf8");
mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_connection=utf8");
*/
$host = "localhost";
$uname = "root";
$passwd = "123456";
$dbname = "hi";
$con = mysql_connect($host,$uname,$passwd);
//$con = mysql_connect('192.168.11.5', 'hiuser', '212224');
$con = mysql_connect('localhost', 'root', '123456');
If (!$con) {
    echo "<h3> error  :  Can not coonect databse</h3>";
    exit();
}else{
//echo "success";
    mysql_select_db("hi");
    mysql_query("set character_set_results=utf8");
    mysql_query("set character_set_connection=utf8");
    mysql_query("set character_set_client=utf8");
}

?>