<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../../config/config.php');
    include_once('../../../model/userM.php');
    include_once('../../../model/userTypeM.php');
    include_once('../../../model/storeM.php');
    include_once('../../../model/storeproductM.php');
    
    $db = new db();
    $conn = $db->connection();

    $user = new userM($conn);
    $result = $user->GetAll();
    $arr["user"]= $result;
    echo json_encode($arr);
    
    mysqli_close($conn);
?>