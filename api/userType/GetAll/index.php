<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../../config/config.php');
    include_once('../../../model/userTypeM.php');
    
    $db = new db();
    $conn = $db->connection();

    $usertype = new userTypeM($conn);
    $result = $usertype->GetAll();
    $arr["usertype"] = $result;
    echo json_encode($arr);

    mysqli_close($conn);
?>