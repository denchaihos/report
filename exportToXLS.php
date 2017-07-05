<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;Filename=exportFile.xls");
echo "<html>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
echo "<body>";
try {
    include "connect_pdo.php";
    $db = new PDO('mysql:host=' . $HOST_NAME . ';dbname=' . $DB_NAME . ';' . $CHAR_SET, $USERNAME, $PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
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
    $filename     = 'export'.date('YmdHis').'.csv';
    $filenameXLS     = 'export/xls/'.date('YmdHis').'.xls';
    $file_export  =  $filelocation . $filename;

for ($counter = 0; $counter < $total_column; $counter++) {
    $meta = $ps->getColumnMeta($counter);
    $column[] = $meta['name'];
}

echo "<table border=1>";

    echo "<tr>";

for ($x = 0; $x < $total_column; $x++) {
    echo "<th>".$column[$x]."</th>";
}

echo "</tr>";


    $STMrecords = $ps->fetchAll();
    // We use foreach loop here to echo records.
    foreach($STMrecords as $row){
        echo "<tr>";
        for ($x = 0; $x < $total_column; $x++) {
            echo "<td>".$row[$column[$x]]."</td>";
        }
        echo "</tr>";
    }
/*
while ($row = $ps->fetch()) {
    echo "<tr>";
    for ($x = 0; $x < $total_column; $x++) {
       echo "<td>".$row[$column[$x]]."</td>";
    }
   echo "</tr>";

}
*/

 echo "</table>";
    echo "</body>";
    echo "</html>";





} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}