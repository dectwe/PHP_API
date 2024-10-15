<?php 
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include_once('../../../config/config.php');
include_once('../../../model/gameeventM.php');


$db = new db();
$conn = $db->connection();

$gameevent = new gameeventM($conn);
$data = new gameeventM($conn);
$data = json_decode(file_get_contents('php://input'));

$gameevent->gameID = $data->gameID;
$gameevent->eventID = $data->eventID;


if($gameevent->Post()){
    echo json_encode(array('message'=>'GameEvent insert successed!!'));
}else{
    echo json_encode(array('message'=>'GameEvent insert Failed!!'));
}

?>