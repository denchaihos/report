<?php
$HOST_NAME = "localhost";
$DB_NAME = "hi";
$CHAR_SET = "charset=utf8"; // เช็ตให้ใช้ภาษาไทยได
$USERNAME = "root";    // ตั้งค่าตามการใช้งานจริง
$PASSWORD = "123456";  // ตั้งค่าตามการใช้งานจริง
$db = new PDO('mysql:host=' . $HOST_NAME . ';dbname=' . $DB_NAME . ';' . $CHAR_SET, $USERNAME, $PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>