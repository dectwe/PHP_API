<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../../config/config.php');
    include_once('../../../model/storeM.php');
    include_once('../../../model/storeproductM.php');

    $db = new db();
    $conn = $db->connection();

    $store = new storeM($conn);
    
    $store->ownerID = isset($_GET['id']) ? $_GET['id'] : die();

    $result = $store->GetByOwner($store->ownerID);
    
    $arr["store"] = $result;
    echo json_encode($arr);
    
    mysqli_close($conn);
?>