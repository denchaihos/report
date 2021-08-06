<?php
    include 'connect_pdo.php';
    $file_ex = $_GET['file_ex'];
    //$file_ex = "nk1.txt";
    /*$startdate = "2017-11-01";
    $enddate = "2017-11-20";*/
    $startdate = $_GET['startdate'];
    $enddate = $_GET['enddate'];
    $myfile = fopen("query_txt/".$file_ex."", "r") or die("Unable to open file!");
    $my_query = fread($myfile,filesize("query_txt/".$file_ex.""));

    fclose($myfile);


$strReplace = str_replace("startdate",$startdate,$my_query);
$strReplace = str_replace("enddate",$enddate,$strReplace);
$array =  (explode(";",$strReplace));
//print_r($array);
//$i=1;
foreach ($array as $value) {

    try{
        $db1 = new PDO('mysql:host=' . $HOST_NAME . ';dbname=' . $DB_NAME . ';' . $CHAR_SET, $USERNAME, $PASSWORD);
        $ps = $db1->prepare($value);
        $ps->execute();

    }catch (PDOException $e) {
        echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : " . $e->getMessage();
    }
   // $i++;
    //echo $i."".$value ."<hr>";
}

?>
