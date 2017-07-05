<?php
$dbLink = mysql_connect('localhost', 'root', '123456');
mysql_select_db('hi', $dbLink);
$sql = "SELECT i.an,i.hn,CONCAT(p.fname,'  ',p.lname) as ptname,i.rgtdate,i.dchdate,sum(ict.rcptamt) as cost
from ipt i JOIN incoth ict on ict.an=i.an JOIN pt p on p.hn=i.hn where i.dchdate BETWEEN '2016-01-01' AND '2016-01-01'  GROUP BY i.an ";
$result = mysql_query($sql) or die(mysql_error());
$qty= 0;
while ($num = mysql_fetch_assoc ($result)) {
    $qty += $num['ptname'];
}
echo $qty;
echo "<hr>";




