<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 29/12/2559
 * Time: 20:37 น.
 */
$sum ='cost';
$t = "SELECT i.an,i.hn,CONCAT(p.fname,'  ',p.lname) as ptname,i.rgtdate,i.dchdate,sum(ict.rcptamt) as cost from ipt i JOIN incoth ict on ict.an=i.an JOIN pt p on p.hn=i.hn where i.dchdate BETWEEN '2016-01-01'  AND '2016-01-02'  GROUP BY i.an ";
$t = strtolower($t);
$replace_select = str_replace('select','',$t);
echo $replace_select;

  echo "<br>";

echo strstr($replace_select, 'from', true);
$column  = strstr($replace_select, 'from', true);
echo "<br>";
$result = end(explode('_delimiter_', 'bla-bla_delimiter_important_stuff'));
echo $result;
echo "<br>";
function GetBetween($var1="",$var2="",$pool){
    $temp1 = strpos($pool,$var1)+strlen($var1);
    $result = substr($pool,$temp1,strlen($pool));
    $dd=strpos($result,$var2);
    if($dd == 0){
        $dd = strlen($result);
    }

    return substr($result,0,$dd);
}

echo GetBetween(",","cost",$column); // returns: ell

echo "<hr>";


// get host name from URL
preg_match('@^(?:http://)?([^cost]+)@i',
    "http://www.php.net/index.html", $matches);
$host = $matches[1];
echo $host;
echo "<hr>";
// get last two segments of host name
preg_match('/[^.]+\.[^.]+$/', $host, $matches);
echo "domain name is: {$matches[0]}\n";

echo "<hr>";
$string = '1234';
echo chunk_split($string, 3, '-');
echo "<br>";
echo substr(chunk_split($string, 2, '-'), 0, -1);
// will return 12:34
echo "<hr>";
$email  = "i.an,i.hn,concat(p.fname,' ',p.lname) as ptname,i.rgtdate,i.dchdate,sum(ict.rcptamt) as cost ";
$domain = strstr($email, 'cost');
echo $domain; // prints @example.com
echo "<br>";
$user = strstr($email, 'cost', true); // As of PHP 5.3.0
echo $user; // prints name
echo "<hr>";

echo substr_count($email, ','); // 2
echo "<hr>";
$pos = strpos($email, ',');
echo $pos;

echo "<hr>";
$mystring = "i.an,i.hn,concat(p.fname,' ',p.lname) as ptname,i.rgtdate,i.dchdate,sum(ict.rcptamt) as cost";
$first = strtok($mystring, '/');
echo $first; // home
echo "<hr>";

echo substr($mystring, -8, strpos($mystring, 'cost'));

echo "<hr>";
$str =  'i.an,i.hn,concat(p.fname,,p.lname) as ptname,i.rgtdate,i.dchdate,sum(ict.rcptamt) as cost';
preg_match('/,(.*?)cost/', $str, $match);
echo $match[1];

echo "<hr>";
$example = array('An example','Another example','One Example','Last example');
$searchword = 'last';
$matches = array();
foreach($example as $k=>$v) {
    if(preg_match("/\b$searchword\b/i", $v)) {
        $matches[$k] = $v;
    }
}
print_r($matches);
echo "<hr>";
$dbLink = mysql_connect('localhost', 'root', '123456');
mysql_select_db('hi', $dbLink);


$query = "SELECT * FROM tableName";
$query_run = mysql_query($query);




$sql = "SELECT i.an,i.hn,CONCAT(p.fname,'  ',p.lname) as ptname,i.rgtdate,i.dchdate,sum(ict.rcptamt) as cost
from ipt i JOIN incoth ict on ict.an=i.an JOIN pt p on p.hn=i.hn where i.dchdate BETWEEN '2016-01-01' AND '2016-01-01'  GROUP BY i.an ";
$result = mysql_query($sql) or die(mysql_error());

// Print the column names as the headers of a table
echo "<table><tr>";
for($i = 0; $i < mysql_num_fields($result); $i++) {
    $field_info = mysql_fetch_field($result, $i);
    echo "<th>{$field_info->name}</th>";
}

// Print the data
while($row = mysql_fetch_row($result)) {
    echo "<tr>";
    foreach($row as $_column) {
        echo "<td>{$_column}</td>";
    }
    echo "</tr>";
}

echo "</table>";
echo "<hr>";

$qty= 0;
while ($num = mysql_fetch_assoc ($result)) {
    $qty += $num['an'];
}
echo $qty;