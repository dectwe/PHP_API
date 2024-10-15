<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../../config/config.php');
    include_once('../../../model/userM.php');
    include_once('../../../model/storeM.php');
    include_once('../../../model/storeproductM.php');

    $db = new db();
    $conn = $db->connection();

    $store = new storeM($conn);
    $result = $store->GetAll();
    $arr["store"] = $result;
    echo json_encode($arr);

    mysqli_close($conn);
?>