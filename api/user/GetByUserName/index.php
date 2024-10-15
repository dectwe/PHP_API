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
    
    $user->userName = isset($_GET['id']) ? $_GET['id'] : die();

    $result = $user->GetByUserName($user->userName);
    
    if($result){
        echo json_encode($result);
    }else{
        echo ("Bad Request!!");
    }
    mysqli_close($conn);
?>