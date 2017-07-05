<?php
// include Database connection file
include("../../connect_pdo.php");

// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // get User ID
    $id = $_POST['id'];

    // Get User Details
    try {
        $query = "SELECT * FROM tsureport WHERE id = '$id'";
        $ps = $db->prepare($query);
        $ps->execute();
        $response = array();
        while ($row = $ps->fetch()) {
            $response = $row;
        }
        echo json_encode($response);
    } catch (PDOException $e) {

        echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : " . $e->getMessage();

    }
}
else
{
    $response['status'] = 200;
    $response['message'] = "Invalid Request!";
}