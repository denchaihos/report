<?php
include '../connect_pdo.php';
$data = array();
try {
    $query = "SELECT * FROM tsureport_department";
    $sql = $db->prepare($query);
    $sql->execute();
    while ($row = $sql->fetch()) {
        $row_array['dep_id'] = $row['dep_id'];
        $row_array['dep_name'] = $row['dep_name'];
        array_push($data, $row_array);
    }
    echo json_encode($data);
    exit;
} catch (PDOException $e) {
    echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : " . $e->getMessage();

}