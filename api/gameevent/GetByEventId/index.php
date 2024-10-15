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

    $db = new db();
    $conn = $db->connection();

    $gameevent = new gameeventM($conn);
    
    $gameevent->eventID = isset($_GET['id']) ? $_GET['id'] : die();

    $result = $gameevent->GetByEventId($gameevent->eventID);
    if($result){
        $arr["game"] = $result;
        echo json_encode($arr);
    }else{
        echo("Bad Request!!");
    }
    mysqli_close($conn);
?>