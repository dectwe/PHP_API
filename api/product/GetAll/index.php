<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    include_once('../../../config/config.php');
    include_once('../../../model/productM.php');
    include_once('../../../model/storeproductM.php');
    $db = new db();
    $conn = $db->connection();
    mysqli_set_charset($conn, 'UTF8');

    $product = new productM($conn);
    $result = $product->GetAll();
    $arr["product"] = $result;
    echo json_encode($arr);
    
    mysqli_close($conn);
?>