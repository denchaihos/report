<?php

try {
    include "connect_pdo.php";
    $db = new PDO('mysql:host=' . $HOST_NAME . ';dbname=' . $DB_NAME . ';' . $CHAR_SET, $USERNAME, $PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'tis620'"));
    $reportId = $_GET['reportId'];
    $startDate = $_GET['startdate'];
    $endDate = $_GET['enddate'];
    // ดึงเอาคำสั่ง SQL  ออกมาก่อน
    $report_query = "SELECT * FROM tsureport WHERE id=$reportId";
    $sql = $db->prepare($report_query);
    $sql->execute();
    $sql = $sql->fetch();
    $reportName = $sql['namereport'];
    $sql_text = $sql['r_query'];
    //  column  head
    $ps = $db->prepare($sql_text);
    $start_date = $startDate;
    $end_date = $endDate;
    $ps->bindParam(1, $start_date, PDO::PARAM_STR);
    $ps->bindParam(2, $end_date, PDO::PARAM_STR);
    $ps->execute();
    $total_column = $ps->columnCount();

    $filelocation = 'export/';
    $files = glob('export/*'); // get all file names
    foreach($files as $file){ // iterate files
        if(is_file($file))
            unlink($file); // delete file
    }
    $filename     = 'export'.date('YmdHis').'.csv';
    $file_export  =  $filelocation . $filename;

    $data = fopen($file_export, 'w');
        //create  header  array
    $csv_fields = array();
    for ($counter = 0; $counter < $total_column; $counter++) {
        $meta = $ps->getColumnMeta($counter);
        $csv_fields[] = $meta['name'];
    }

    fputcsv($data, $csv_fields);

    while ($row = $ps->fetch(PDO::FETCH_ASSOC)) {
        fputcsv($data, $row);
    }
    header('Content-Disposition: attachment;filename="'.$filename.'";');
    echo $file_export;
    $db = null;
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}