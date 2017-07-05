<?php
if(!isset($_FILES['file']['name']) ){
    include("db_connection.php");
    $id = $_POST['id'];
    $namereport = !empty($_POST['namereport']) ? "'".addslashes($_POST['namereport'])."'" : "NULL";
    $department = !empty($_POST['department']) ? "'".addslashes($_POST['department'])."'" : "NULL";
    $request_by = !empty($_POST['request_by']) ? "'".addslashes($_POST['request_by'])."'" : "NULL";
    $r_query = !empty($_POST['r_query']) ? "'".addslashes($_POST['r_query'])."'" : "NULL";
    $e_query = !empty($_POST['e_query']) ? "'".addslashes($_POST['e_query'])."'" : "NULL";
    $note = !empty($_POST['note']) ? "'".addslashes($_POST['note'])."'" : "NULL";



    $query = "UPDATE tsureport SET namereport = $namereport, dep = $department, request_by = $request_by,r_query = $r_query,e_query = $e_query, note = $note WHERE id = '$id'";
    if (!$result = mysql_query($query)) {
        exit(mysql_error());
    }else{
        echo "Inser Complate";
    }

}else{
    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
        if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){
            include("db_connection.php");
            $id = $_POST['id'];
            $namereport = !empty($_POST['namereport']) ? "'".addslashes($_POST['namereport'])."'" : "NULL";
            $department = !empty($_POST['department']) ? "'".addslashes($_POST['department'])."'" : "NULL";
            $request_by = !empty($_POST['request_by']) ? "'".addslashes($_POST['request_by'])."'" : "NULL";
            $r_query = !empty($_POST['r_query']) ? "'".addslashes($_POST['r_query'])."'" : "NULL";
            $e_query = !empty($_POST['e_query']) ? "'".addslashes($_POST['e_query'])."'" : "NULL";
            $note = !empty($_POST['note']) ? "'".addslashes($_POST['note'])."'" : "NULL";
            $file_ex = basename($_FILES['file']['name']);

            $query = "UPDATE tsureport SET namereport = $namereport, dep = $department, request_by = $request_by,r_query = $r_query,file_ex = '$file_ex', note = $note WHERE id = '$id'";

            if (!$result = mysql_query($query)) {
                exit(mysql_error());
            }else{
                move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $_FILES['file']['name']);
                echo "Inser Complate";
            }

        }
    }
}