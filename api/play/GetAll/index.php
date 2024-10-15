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
    $result = $play->GetAll();
    $arr["play"]= $result;
    echo json_encode($arr);
    
    mysqli_close($conn);
?>