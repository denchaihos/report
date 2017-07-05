<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27/12/2559
 * Time: 20:16 น.
 */
include("../connect_pdo.php");
$limit = $_GET['limit'];
$row_per_page = $_GET['row_per_page'];
try {
    $db = new PDO('mysql:host=' . $HOST_NAME . ';dbname=' . $DB_NAME . ';' . $CHAR_SET, $USERNAME, $PASSWORD);
    $query = "SELECT count(*) as cc FROM tsureport r left join tsureport_department td on td.dep_id=r.dep";
    $rows_count = $db->prepare($query);
    $rows_count->execute();
    $rowCount = $rows_count->fetch();
    $rowCount = $rowCount['cc'];

} catch (PDOException $e) {

    echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : " . $e->getMessage();

}

$data = 'All Record: <span id="num_row" style="display: inline">'.$rowCount.'</span>';
echo $data;


