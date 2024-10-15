<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../../config/config.php');
    include_once('../../../model/userM.php');
    include_once('../../../model/userTypeM.php');
    include_once('../../../model/eventM.php');
    include_once('../../../model/storeM.php');
    include_once('../../../model/storeproductM.php');
    include_once('../../../model/gameeventM.php');
    include_once('../../../model/playM.php');
    $db = new db();
    $conn = $db->connection();

    $play = new playM($conn);
    $play->userID = isset($_GET['id']) ? $_GET['id'] : die();
    $result = $play->GetByUser($play->userID);
    $arr["play"]= $result;
    echo json_encode($arr);
    
    mysqli_close($conn);
?>