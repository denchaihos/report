<?php
include 'connect_pdo.php';
try {
    $reportId = $_POST['reportId'];
    $column = $_POST['column'];
   $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    /*$reportId = 11;
    $column = "cost";*/
    //$startDate = '2016-01-01';
    //$endDate = '2016-01-01';

    // ดึงเอาคำสั่ง SQL  ออกมาก่อน
    $report_query = "SELECT * FROM tsureport WHERE id=$reportId";

    $sql = $db->prepare($report_query);
    $sql->execute();
    $sql = $sql->fetch();

    $sql_text = $sql['r_query'];

    $ps = $db->prepare($sql_text);

    $ps->bindParam(1, $startDate, PDO::PARAM_STR);
    $ps->bindParam(2, $endDate, PDO::PARAM_STR);
    $ps->execute();
    $sumColumn= 0;
    while ($row = $ps->fetch(PDO::FETCH_ASSOC)) {
        $sumColumn += $row[$column];

    }
    echo json_encode($sumColumn);

} catch (PDOException $e) {
    echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : " . $e->getMessage();

}