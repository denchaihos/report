<?php
include("../../connect_pdo.php");

$namereport = !empty($_POST['namereport']) ? $_POST['namereport'] : "NULL";
$department = !empty($_POST['department']) ? $_POST['department'] : "NULL";
$request_by = !empty($_POST['request_by']) ? $_POST['request_by'] : "NULL";
$r_query = !empty($_POST['r_query']) ? $_POST['r_query'] : "NULL";
$e_query = !empty($_POST['e_query']) ? $_POST['e_query'] : "NULL";
$note = !empty($_POST['note']) ? addslashes($_POST['note']) : "NULL";


if(!isset($_FILES['file']['name']) ){

    try {
        $query = "INSERT INTO tsureport (namereport,r_query,e_query,request_by,dep,note)
                  VALUES(:namereport,
                       :r_query,
                       :e_query,
                       :request_by,
                       :department,
                       :note )";

        $stmt = $db->prepare($query);

        $stmt->bindParam(':namereport', $namereport, PDO::PARAM_STR);
        $stmt->bindParam(':r_query', $r_query, PDO::PARAM_STR);
        $stmt->bindParam(':e_query', $e_query, PDO::PARAM_STR);
        $stmt->bindParam(':request_by', $request_by, PDO::PARAM_STR);
        $stmt->bindParam(':department', $department, PDO::PARAM_STR);
        $stmt->bindParam(':note', $note, PDO::PARAM_STR);

        $stmt->execute();
        echo "Insert Complate";

    } catch (PDOException $e) {

        echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : " . $e->getMessage();

    }


}else{
    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
        if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){

            $file_ex = basename($_FILES['file']['name']);

            try {
                $query = "INSERT INTO tsureport (namereport,r_query,e_query,request_by,file_ex,dep,note)
                  VALUES(:namereport,
                       :r_query,
                       :e_query,
                       :request_by,
                       :file_ex,
                       :department,
                       :note )";

                $stmt = $db->prepare($query);

                $stmt->bindParam(':namereport', $namereport, PDO::PARAM_STR);
                $stmt->bindParam(':r_query', $r_query, PDO::PARAM_STR);
                $stmt->bindParam(':e_query', $e_query, PDO::PARAM_STR);
                $stmt->bindParam(':request_by', $request_by, PDO::PARAM_STR);
                $stmt->bindParam(':file_ex', $file_ex, PDO::PARAM_STR);
                $stmt->bindParam(':department', $department, PDO::PARAM_STR);
                $stmt->bindParam(':note', $note, PDO::PARAM_STR);

                $stmt->execute();
                move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $_FILES['file']['name']);
                echo "Inser Complate";

            } catch (PDOException $e) {

                echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : " . $e->getMessage();

            }

        }
    }
}

?>