<?php
if(!isset($_FILES['file']['name']) ){
    include("db_connection.php");

    $namereport = !empty($_POST['namereport']) ? "'".addslashes($_POST['namereport'])."'" : "NULL";
    $department = !empty($_POST['department']) ? "'".addslashes($_POST['department'])."'" : "NULL";
    $request_by = !empty($_POST['request_by']) ? "'".addslashes($_POST['request_by'])."'" : "NULL";
    $r_query = !empty($_POST['r_query']) ? "'".addslashes($_POST['r_query'])."'" : "NULL";
    $e_query = !empty($_POST['e_query']) ? "'".addslashes($_POST['e_query'])."'" : "NULL";
    $note = !empty($_POST['note']) ? "'".addslashes($_POST['note'])."'" : "NULL";


    $query = "INSERT INTO tsureport (namereport,r_query,e_query,request_by,dep,note)
            VALUES($namereport,$r_query,$e_query,$request_by,$department,$note)";

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
            $namereport = !empty($_POST['namereport']) ? "'".addslashes($_POST['namereport'])."'" : "NULL";
            $department = !empty($_POST['department']) ? "'".addslashes($_POST['department'])."'" : "NULL";
            $request_by = !empty($_POST['request_by']) ? "'".addslashes($_POST['request_by'])."'" : "NULL";
            $r_query = !empty($_POST['r_query']) ? "'".addslashes($_POST['r_query'])."'" : "NULL";
            $e_query = !empty($_POST['e_query']) ? "'".addslashes($_POST['e_query'])."'" : "NULL";
            $note = !empty($_POST['note']) ? "'".addslashes($_POST['note'])."'" : "NULL";
            $file_ex = basename($_FILES['file']['name']);

            $query = "INSERT INTO tsureport (namereport,r_query,e_query,request_by,file_ex,dep,note)
            VALUES($namereport,$r_query,$e_query,$request_by,'$file_ex',$department,$note)";

             if (!$result = mysql_query($query)) {
                 exit(mysql_error());
             }else{
                 move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $_FILES['file']['name']);
                 echo "Inser Complate";
             }

        }
    }
}
/*if ( 0 < $_FILES['file']['error'] ) {
    echo 'Error: ' . $_FILES['file']['error'] . '<br>';
}else {*/
/*if(is_uploaded_file($_FILES['file']['tmp_name'])){
     if(move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $_FILES['file']['name'])){
        include("db_connection.php");
        $namereport = $_POST['namereport'];
        $file_ex = basename($_FILES['file']['name']);
        $query = "INSERT INTO tsureport (namereport,file_ex) VALUES('$namereport','$file_ex')";
        mysql_query($query);
       /* if (!$result = mysql_query($query)) {
            exit(mysql_error());
        }*/

   /* }
}else{*/
/*
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    include("db_connection.php");
    $namereport = $_POST['namereport'];
    $r_query = $_POST['r_query'];
    $e_query = $_POST['e_query'];
    $department = $_POST['department'];
    $request_by = $_POST['request_by'];
    $note = $_POST['note'];
    //$file_ex = $_POST['file_ex'];
    $file_ex = basename($_FILES['file']['name']);
    echo $namereport;
   // $department = $_POST['department'];
    $query = "INSERT INTO tsureport (namereport,r_query,e_query,dep,request_by,note) VALUES('$namereport','$r_query','$e_query','$department','$request_by','$note')";
   // mysql_query($query);
}
//}


	//if(isset($_POST['namereport']) )
	//{
		// include Database connection file 
		//include("db_connection.php");

		// get values 
		//$namereport = $_POST['namereport'];
        //$file_ex = $_POST['file_ex'];
       // $file_ex = basename($_FILES['file']['name']);



		/*$request_by = $_POST['request_by'];
        $note = $_POST['note'];
        $r_query = addslashes($_POST['r_query']);*/

       /* $request_by = !empty($_POST['request_by']) ? "'".$_POST['request_by']."'" : 'null';

        $r_query = !empty($_POST['r_query']) ? "'".addslashes($_POST['r_query'])."'" : 'null';
        $note = !empty($_POST['note']) ? "'".$_POST['note']."'" : 'null';*/


    //    $query = "INSERT INTO tsureport (namereport, request_by, note,r_query) VALUES('$namereport', $request_by, $note,$r_query)";
       /* $query = "INSERT INTO tsureport (namereport,file_ex) VALUES('$namereport',$file_ex)";
		if (!$result = mysql_query($query)) {
	        exit(mysql_error());
	    }
	    echo "1 Record Added!";
	}*/
?>