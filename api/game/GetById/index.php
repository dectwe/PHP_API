<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../../config/config.php');
    include_once('../../../model/gameM.php');

    $db = new db();
    $conn = $db->connection();

    $game = new gameM($conn);
    
    $game->gameID = isset($_GET['id']) ? $_GET['id'] : die();

    $result = $game->GetById($game->gameID);
    if($result){
        echo json_encode($result);
    }else{
        echo("Bad Request!!");
    }
    mysqli_close($conn);
?>