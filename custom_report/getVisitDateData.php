<?php

//if (isset($_GET['vn']) ) {
include "../connect_pdo.php";

 //$hn = 100;
 $hn = $_GET['hn'];

try {


    $sql_text = "select vn,vstdttm from ovst where hn= $hn order  by vstdttm desc"  ;
    //  column  head
    $ps = $db->prepare($sql_text);

    $ps->execute();

    $data ='';
    while ($row = $ps->fetch()) {
        $data .= "<p id='".$row['vn']."' onclick='tee(this.id)'>".$row['vstdttm']."<button type='button' class='btn btn-default' data-dismiss='modal'>Select</button></p>";

    }



    echo $data;




} catch (PDOException $e) {

    echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : " . $e->getMessage();

}

?>