<?php
/*
$HOST_NAME = "localhost";
$DB_NAME = "hi";
$USERNAME = "root";
$PASSWORD = "123456";
*/
include 'connect_pdo.php';
$CHAR_SET = "charset=tis620"; // เช็ตให้ใช้ภาษาไทยไ
# MySQL with PDO_MYSQL
$id = !isset($_GET['reportId']) ? $_GET['reportId'] : $_GET['reportId'];
$reportName = isset($_GET['reportName']) ? $_GET['reportName'] : $_GET['reportName'];
//$startDate = !empty($_GET['startDate']) ? $_GET['startDate'] : "";
//$endDate = !empty($_GET['endDate']) ? $_GET['endDate'] : "";
$startdate = $_GET['startdate'];
$enddate = $_GET['enddate'];


try {

    $db = new PDO('mysql:host=' . $HOST_NAME . ';dbname=' . $DB_NAME . ';' . $CHAR_SET, $USERNAME, $PASSWORD);

    // ดึงเอาคำสั่ง SQL  ออกมาก่อน
    $report_query = "SELECT e_query FROM tsureport WHERE id=$id";

    $sql = $db->prepare($report_query);
    $sql->execute();

    $sql = $sql->fetch();
    $sql_text = $sql['e_query'];
    $ps = $db->prepare($sql_text);
    //$ps->bindParam(1, $start_date, PDO::PARAM_STR);
    //$ps->bindParam(2, $end_date, PDO::PARAM_STR);
    $ps->bindParam(':startdate', $startdate, PDO::PARAM_STR);
    $ps->bindParam(':enddate', $enddate, PDO::PARAM_STR);
    $ps->execute();
    echo "success";

} catch (PDOException $e) {

    echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : " . $e->getMessage();

}