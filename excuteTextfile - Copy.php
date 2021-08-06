<?php
    include 'connect_pdo.php';
    $file_ex = $_GET['file_ex'];
   // $file_ex = "F3.txt";
    $startdate = $_GET['startdate'];
    $enddate = $_GET['enddate'];
    $myfile = fopen("query_txt/".$file_ex."", "r") or die("Unable to open file!");
//    $my_query = fread($myfile,filesize("query_txt/".$file_ex.""));
    $my_query = fread($myfile,filesize("query_txt/".$file_ex.""));

    //$my_query =  iconv("UTF-8", "TIS-620", $my_query);
echo $my_query;
    //echo $my_query;
    try {

        $sql_ex = $db->prepare($my_query);
        //$start_dateX = '2015-10-01';
        //$end_dateX = '2016-09-30';
      //  $sql_ex->bindParam(':startdate', $startdate, PDO::PARAM_STR);
      //  $sql_ex->bindParam(':enddate', $enddate, PDO::PARAM_STR);
        $sql_ex->execute();
        echo "success";
    } catch (PDOException $e) {

        echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : " . $e->getMessage();

    }

    fclose($myfile);

?>
