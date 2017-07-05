<form name="myform" id="myform" class="form-inline" role="form" action=""  method="get" >
    <input type='text' class="form-control" id='date_start'name="startDate" value="">
<?php
if (isset($_GET['startDate']) && $_GET['startDate']!='') {
    include 'connect_pdo.php';
    $myfile = fopen("query_txt/f3.txt", "r") or die("Unable to open file!");
    $my_query = fread($myfile,filesize("query_txt/z11.txt"));
    echo $my_query;
    /*try {
        $db1 = new PDO('mysql:host=' . $HOST_NAME . ';dbname=' . $DB_NAME . ';' . $CHAR_SET, $USERNAME, $PASSWORD);
        $sql_ex = $db1->prepare($my_query);
        $start_dateX = '2015-10-01';
        $end_dateX = '2016-09-30';
        $sql_ex->bindParam(':startdate', $start_dateX, PDO::PARAM_STR);
        $sql_ex->bindParam(':enddate', $end_dateX, PDO::PARAM_STR);
        $sql_ex->execute();
    } catch (PDOException $e) {

        echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : " . $e->getMessage();

    }*/

    fclose($myfile);
}
?>
    <input type="submit" name="show"  id="show_data" class="btn btn-success" value="Show"  >
    </form>