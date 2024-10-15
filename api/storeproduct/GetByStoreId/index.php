<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../../config/config.php');
    include_once('../../../model/storeM.php');
    include_once('../../../model/productM.php');
    include_once('../../../model/storeproductM.php');

    $db = new db();
    $conn = $db->connection();

    $storeproduct = new storeproductM($conn);
    
    $storeproduct->storeID = isset($_GET['id']) ? $_GET['id'] : die();

    $result = $storeproduct->GetByStoreId($storeproduct->storeID);
    if($result){
        $arr["product"] = $result;
        echo json_encode($arr);
    }else{
        echo("Bad Request!!");
    }
    mysqli_close($conn);
?>