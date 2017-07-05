<?php
include 'connect_pdo.php';
$CHAR_SET = "charset=tis620"; // เช็ตให้ใช้ภาษาไทยไ
if (isset($_GET['report_name']) ) {
    $sql_query = addslashes($_GET['sql_query']);
    $note = addslashes($_GET['note']);
try {

    $db = new PDO('mysql:host=' . $HOST_NAME . ';dbname=' . $DB_NAME . ';' . $CHAR_SET, $USERNAME, $PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    // ดึงเอาคำสั่ง SQL  ออกมาก่อน
    $report_query = "INSERT INTO tsureport(namereport,r_query,dep,note,request_by)
    VALUES ('".$_GET['report_name']."','".$sql_query."','".$_GET['department']."','".$note."','".$_GET['requester']."')";

    $sql = $db->prepare($report_query);
    $sql->execute();
    echo "success";

} catch (PDOException $e) {

    echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : " . $e->getMessage();

}
}else{
    echo "not succuss";
}