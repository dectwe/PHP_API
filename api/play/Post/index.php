<?php 
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include_once('../../../config/config.php');
include_once('../../../model/playM.php');


$db = new db();
$conn = $db->connection();

$play = new playM($conn);
$data = new playM($conn);
$data = json_decode(file_get_contents('php://input'));

$play->eventID = $data->eventID;
$play->gameID = $data->gameID;
$play->userID = $data->userID;
$play->vourcherID = $data->vourcherID;


if($play->Post()){
    echo json_encode(array('message'=>'play insert successed!!'));
}else{
    echo json_encode(array('message'=>'play insert Failed!!'));
}

?>