<?php
include 'readConfig.php';
/*$host = trim($config['host']);
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
*/
$HOST_NAME = trim($config['host']);
$DB_NAME = trim($config['db']);
$CHAR_SET = "charset=utf8"; // เช็ตให้ใช้ภาษาไทยได
$USERNAME = trim($config['username']);    // ตั้งค่าตามการใช้งานจริง
$PASSWORD = trim($config['password']);  // ตั้งค่าตามการใช้งานจริง
$db = new PDO('mysql:host=' . $HOST_NAME . ';dbname=' . $DB_NAME . ';' . $CHAR_SET, $USERNAME, $PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>