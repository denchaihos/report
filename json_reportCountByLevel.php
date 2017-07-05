<?
require("connect_pdo.php");
mysql_query("set character_set_results=utf8");
mysql_query("set character_set_connection=utf8");
mysql_query("set character_set_client=utf8");


//$hn = 26;
$data = array();

$start_date = (intval(substr($_GET['start_date'], 6, 4)) ) . "-" . substr($_GET['start_date'], 3, 2) . "-" . substr($_GET['start_date'], 0, 2);
$end_date = (intval(substr($_GET['end_date'], 6, 4)) ) . "-" . substr($_GET['end_date'], 3, 2) . "-" . substr($_GET['end_date'], 0, 2);

/*
$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];
*/
$sql = "SELECT  l.name,if(s.count is null,0,s.count) AS cc
                        FROM risk_level AS l
                        LEFT JOIN (
                          SELECT risk_level, COUNT(*) AS count
                          FROM risk_head
                        WHERE date_input between '$start_date' and  '$end_date'
                          GROUP BY risk_level
                        ) AS s
                        ON l.level =  s.risk_level
                        ORDER BY l.level ASC";
$result = mysql_query($sql);
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    $row_array['name'] = $row['name'];
    $row_array['count_total'] = $row['cc'];

    array_push($data, $row_array);
   // array_push($max_point, $row['cc']);
    //$total_risk = $total_risk + $row_array['count_total'];

}

echo json_encode($data);
//print_r($data);
mysql_close($con);
exit;
?>