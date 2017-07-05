<?php
$HOST_NAME = "localhost";
$DB_NAME = "hi";
$USERNAME = "root";
$PASSWORD = "123456";
$CHAR_SET = "charset=tis620"; // เช็ตให้ใช้ภาษาไทยไ
# MySQL with PDO_MYSQL

$db = new PDO('mysql:host=' . $HOST_NAME . ';dbname=' . $DB_NAME . ';' . $CHAR_SET, $USERNAME, $PASSWORD);

$query = file_get_contents("query_txt/refer.sql");

$stmt = $db->prepare($query);

if ($stmt->execute())
echo "Success";
else
echo "Fail";