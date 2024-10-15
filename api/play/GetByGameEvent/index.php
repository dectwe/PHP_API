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

    $play->gameID = isset($_GET['gid']) ? $_GET['gid'] : die();
    $play->eventID = isset($_GET['eid']) ? $_GET['eid'] : die();
    $result = $play->GetByGameEvent($play->gameID,$play->eventID);
    $arr["play"]= $result;
    echo json_encode($arr);
    
    mysqli_close($conn);
?>