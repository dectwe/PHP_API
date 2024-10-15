<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../../config/config.php');
    include_once('../../../model/userTypeM.php');

    $db = new db();
    $conn = $db->connection();

    $usertype = new userTypeM($conn);
    
    $usertype->typeID = isset($_GET['id']) ? $_GET['id'] : die();

    $result = $usertype->GetById($usertype->typeID);
    if($result){
        echo json_encode($result);
    }else{
        echo("Bad Request!!");
    }
    mysqli_close($conn);
?>