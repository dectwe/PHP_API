<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../../config/config.php');
    include_once('../../../model/productM.php');
    include_once('../../../model/storeproductM.php');
    $db = new db();
    $conn = $db->connection();

    $product = new productM($conn);
    
    $product->productID = isset($_GET['id']) ? $_GET['id'] : die();

    $result = $product->GetById($product->productID);
    if($result){
        echo json_encode($result);
    }else{
        echo("Bad Request!!");
    }
    mysqli_close($conn);
?>