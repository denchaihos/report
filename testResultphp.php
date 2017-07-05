<?php
// Connection variables
$host = "localhost"; // MySQL host name eg. localhost
$user = "root"; // MySQL user. eg. root ( if your on localserver)
$password = "123456"; // MySQL user password  (if password is not set for your root user then keep it empty )
$database = "hi"; // MySQL Database name

// Connect to MySQL Database
$db = mysql_connect($host, $user, $password) or die("Could not connect to database");

// Select MySQL Database
mysql_select_db($database, $db);
mysql_query("SET character_set_results=utf8");
mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_connection=utf8");

$query = "SELECT hn,vn,pttype   from ovst";
$result =mysql_query($query);
$row_count = mysql_num_rows($result);
echo $row_count;
$query .= ' limit 10';
    $result =mysql_query($query);



if (!$result = mysql_query($query)) {
    exit(mysql_error());
}
$data = '<table class="table table-bordered table-striped">
						<tr>
							<th>No.</th>
							<th>hn</th>
							<th>vn</th>
							<th>clinic By</th>
							<th>Update</th>
							<th>Delete</th>
						</tr>';

// if query results contains rows then featch those rows
if(mysql_num_rows($result) > 0)
{
    $number = 1;
    while($row = mysql_fetch_assoc($result))
    {
        $data .= '<tr>
				<td>'.$number.'</td>
				<td>'.$row['hn'].'</td>
				<td>'.$row['vn'].'</td>
				<td>'.$row['pttype'].'</td>
				<td>
					<button class="btn btn-warning btn-sm" id="getdetail"  onclick="GetReportDetails('.$row['hn'].')" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
				</td>
				<td>
					<button onclick="DeleteReport('.$row['hn'].')" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
				</td>
    		</tr>';
        $number++;
    }
}
else
{
    // records now found
    $data .= '<tr><td colspan="6">Records not found!</td></tr>';
}

$data .= '</table>';

echo $data;