<link rel="stylesheet" href="jquery/bootstrap-3.3.7-dist/css/bootstrap.min.css">
<?php

if (isset($_GET['reportId']) ) {
    include "connect_pdo.php";

    $reportId = $_GET['reportId'];
    $startDate = $_GET['startDate'];
    $endDate = $_GET['endDate'];



    try {
        // ดึงเอาคำสั่ง SQL  ออกมาก่อน

        $report_query = "SELECT * FROM tsureport WHERE id=$reportId";
        //$sql = "SELECT hn,fname,lname FROM pt WHERE hn = :hn";
        $sql = $db->prepare($report_query);
        $sql->execute();
        $sql = $sql->fetch();
        $reportName = $sql['namereport'];
        $sql_text = $sql['r_query'];
        //row count
        $numrows = $db->prepare($sql_text);
        $numrows->bindParam(1, $startDate, PDO::PARAM_STR);
        $numrows->bindParam(2, $endDate, PDO::PARAM_STR);
        $numrows->execute();
        $rowCount = $numrows->rowCount();

        //$sql_text .= " limit ".$limit.",".$row_per_page;
        //  column  head

        $ps = $db->prepare($sql_text);

        $start_date = $startDate;
        $end_date = $endDate;
        $ps->bindParam(1, $start_date, PDO::PARAM_STR);
        $ps->bindParam(2, $end_date, PDO::PARAM_STR);


        $ps->execute();

        $total_column = $ps->columnCount();

        for ($counter = 0; $counter < $total_column; $counter++) {
            $meta = $ps->getColumnMeta($counter);
            $column[] = $meta['name'];
        }

        $data = "<table class='table table-strip table-hover' id='workweek'>
                    <thead>
                        <tr><th> ลำดับ </th>";
        for ($x = 0; $x < $total_column; $x++) {
            $data .= "<th> $column[$x] </th>";
        }
        $data .= "</tr>
                    </thead>
                    <tbody>";
        $i=1;
        while ($row = $ps->fetch()) {
            $data .= "<tr><td>$i</td>";
            for ($x = 0; $x < $total_column; $x++) {
                $data .= "<td>".
                    $row[$column[$x]]
                    ."</td>";
            }
            $data .= "</tr>";
            $i++;

        }
        $data .= "<tr>";
        /*for ($x = 0; $x < $total_column; $x++) {
            if($x==0){
                //$data .= "<td>รวมจำนวน    ".$rowCount."  รายการ</td>";
                $data .= "<td><span id='num_row' style='display: inline'>".$rowCount."</span> record";
                $data .= "<input type='text' id=''></td>";
            }else{
                $data .= "<td></td>";
            }
        }*/
        $data .= "</tr>
                    </tbody>
                    </table>";


        echo $data;
        ?>
        <p>จำนวน <span id="num_row" style="display: inline"><? echo $rowCount ?></span> รายการ</p>
    <?

    } catch (PDOException $e) {

        echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : " . $e->getMessage();

    }
}
?>