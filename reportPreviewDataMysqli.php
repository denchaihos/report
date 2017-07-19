<?php
if (isset($_GET['startDate']) ) {
    include "connectMysqli.php";

    $reportId = $_GET['reportId'];
    $limit = $_GET['limit'];
    $row_per_page = $_GET['row_per_page'];
    $StartDate = $_GET['startDate'];
    $EndDate = $_GET['endDate'];

    $report_query = "SELECT * FROM tsureport WHERE id=42";
    $result = $mysqli->query($report_query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $reportName = $row['namereport'];
    $sql_text = $row['r_query'];

    echo '<br>';

   // $StartDate = "2016-10-01";
    //$EndDate = '2017-01-01';
    $report_query =  str_replace("StartDate",$StartDate,$sql_text);
    $report_query =  str_replace("EndDate",$EndDate,$report_query);
   // echo $report_query;
        echo "<hr>";
        foreach ($charset as $charset) {
            $mysqli->set_charset($charset);
            //$report_query = "set @hn1=66144; set @hn2= 1; select hn from ovst where hn=@hn1 and date(vstdttm) between '$StartDate' and '$EndDate' union all select hn from ovst where hn=@hn2 and date(vstdttm)  between '$StartDate' and '$EndDate' ";
            $report_query = $report_query;
            // loop show head table
            if (mysqli_multi_query($mysqli,$report_query)){
                do{
                    if ($result=mysqli_store_result($mysqli)) {
                        /* Get field information for all columns */
                       $finfo = $result->fetch_fields();
                        $data = "<table class='table table-strip table-hover' id='workweek'>
                                <thead>
                                    <tr>";
                        $num_column =0;
                        foreach ($finfo as $val) {
                            //printf("Name:      %s\n",   $val->name);
                            $data .= "<th>$val->name
                                    &nbsp;<input type='button' id='".$val->name."' value='&#931' onclick='sumTotalByColumn(this.id)'><br/><span id='".$val->name."'></span></th>";
                            $num_column++;
                        }
                        $data .= "</tr>
                                </thead>";
                        $result->free();
                    }
                }
                while (mysqli_next_result($mysqli));
            }
        }
        //loop show data
        if (mysqli_multi_query($mysqli,$report_query))
        {
            do
            {
                // Store first result set
                if ($result=mysqli_store_result($mysqli)) {
                    // Fetch one and one row
                    $data .= "<tbody>";
                    while ($row=mysqli_fetch_row($result))
                    {
                        $data .= "<tr>";

                        for ($x = 0; $x < $num_column; $x++) {
                            $data .= "<td>".
                                $row[$x]
                                ."</td>";
                        }
                        //$data .= "<td>$row[0]</td>";

                        $data .="</tr>";

                    }
                    $data .= "</tbody></table>";
                    // Free result set
                    mysqli_free_result($result);
                }
            }
            while (mysqli_next_result($mysqli));
        }
        $mysqli->close();
    echo $data;
    exit;
}