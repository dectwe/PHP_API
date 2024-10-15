<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../../config/config.php');
    include_once('../../../model/gameM.php');
    
    $db = new db();
    $conn = $db->connection();

    $game = new gameM($conn);
    $result = $game->GetAll();
    $arr["game"] = $result;
    echo json_encode($arr);

    mysqli_close($conn);
?>