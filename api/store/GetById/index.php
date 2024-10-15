<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../../config/config.php');
    include_once('../../../model/storeM.php');
    include_once('../../../model/storeproductM.php');
    $db = new db();
    $conn = $db->connection();

    $store = new storeM($conn);
    
    $store->storeID = isset($_GET['id']) ? $_GET['id'] : die();

    $result = $store->GetById($store->storeID);
    
    if($result){
        echo json_encode($result);
    }else{
        echo ("Bad Request!!");
    }
    mysqli_close($conn);
?>