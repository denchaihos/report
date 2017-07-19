<?php
function replace_string_in_file($filename, $string_to_replace, $replace_with){
    $content=file_get_contents($filename);
    $content_chunks=explode($string_to_replace, $content);
    $content=implode($replace_with, $content_chunks);
    file_put_contents($filename, $content);
}
?>




<?php
/*
$filename="query_txt/letter.txt";
$string_to_replace="date";
$replace_with="Yuan";
replace_string_in_file($filename, $string_to_replace, $replace_with);
*/

$fname = "query_txt/letter.txt";
$fhandle = fopen($fname,"r");
$content = fread($fhandle,filesize($fname));

$content = str_replace("hello", "newword", $content);
/*
$fhandle = fopen($fname,"w");
fwrite($fhandle,$content);
fclose($fhandle);*/
$con = mysql_connect('localhost','root','123456');
//$con = mysql_connect('192.168.11.5', 'hiuser', '212224');
//$con = mysql_connect('localhost', 'root', '123456');
If (!$con) {
    echo "<h3> error  :  Can not conect databse</h3>";
    exit();
}else{
//echo "success";
    mysql_select_db('hi');
    mysql_query("set character_set_results=utf8");
    mysql_query("set character_set_connection=utf8");
    mysql_query("set character_set_client=utf8");
}
$sql ="set @hn1=66144; set @hn2= 1; select hn from pt where hn=66144 union  all select hn from pt where hn=1 ";
//$sql = $content;
//echo $sql;
/*
$result = mysql_query($sql,$con);
while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
    echo $row['hn'];
    echo '<br>';
}
*/

$arr =  (explode(";",$sql));
$searchword = 'set';




$matches = array();
foreach($arr as $k=>$v) {
    if(preg_match("/\b$searchword\b/i", $v)) {
        $matches[$k] = $v;
    }
}

print_r($matches);
echo '<hr>';
$con=mysqli_connect("localhost","root","123456","hi");

// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$StartDate = '2016-01-01';
$EndDate = '2017-01-01';
$sql = "set @hn1=66144; set @hn2= 1; select hn from ovst where hn=@hn1 and date(vstdttm) between '$StartDate' and '$EndDate' union  all select hn from ovst where hn=@hn2 and date(vstdttm) between '$StartDate' and '$EndDate' ";


// Execute multi query
if (mysqli_multi_query($con,$sql))
{
    do
    {
        // Store first result set
        if ($result=mysqli_store_result($con)) {
            // Fetch one and one row
            while ($row=mysqli_fetch_row($result))
            {
                printf("%s\n",$row[0]);
            }
            // Free result set
            mysqli_free_result($result);
        }
    }
    while (mysqli_next_result($con));
}

mysqli_close($con);
?>

