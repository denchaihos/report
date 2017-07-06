<?php
// include Database connection file
include '../../readConfig.php';
include("../../connect_pdo.php");

// Design initial table header
$limit = $_GET['limit'];
$row_per_page = $_GET['row_per_page'];
$num = $_GET['num'];

$data = '<table class="table table-bordered table-striped">
						<tr>
							<th>No.</th>
							<th>Reportname</th>
							<th>Department</th>
							<th>Request By</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>';
try {
    $query = "SELECT r.*,td.dep_name FROM tsureport r left join tsureport_department td on td.dep_id=r.dep";
    $query .= ' limit ' . $limit . ',' . $row_per_page;
    $ps = $db->prepare($query);
    $ps->execute();
    $number = intval((($num -1 ) * $row_per_page))+1 ;
    while ($row = $ps->fetch()) {

        $data .= '<tr>
                <td>' . $number . '</td>
                        <td>' . $row['namereport'] . '</td>
                        <td>' . $row['dep_name'] . '</td>
                        <td>' . $row['request_by'] . '</td>
                        <td>
                            <button class="btn btn-warning btn-sm" id="getdetail"  onclick="GetReportDetails(' . $row['id'] . ')" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                        </td>
                        <td>
                            <button onclick="DeleteReport(' . $row['id'] . ')" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </td>
                    </tr>';
        $number++;
    }
    $data .= '</table>';

    ?>
    <div class="panel panel-primary">
        <!--<div class="panel-heading">Report All <span id="num_row" style="display: inline">  <?/* echo $rowCount */?></span>
            record
        </div>-->
        <div class="panel-body">
            <?php
            echo $data;
            ?>
        </div>
        <div class="panel-footer">

        </div>
    </div>
<?php

} catch (PDOException $e) {

    echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : " . $e->getMessage();

}
?>

