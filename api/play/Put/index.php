<?php 
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include_once('../../../config/config.php');
include_once('../../../model/playM.php');


$db = new db();
$conn = $db->connection();


$play = new playM($conn);
$play->playID = isset($_GET['id']) ? $_GET['id'] : die();
$data = new playM($conn);
$data = json_decode(file_get_contents('php://input'));

$play->eventID = $data->eventID;
$play->gameID = $data->gameID;
$play->userID = $data->userID;
$play->vourcherID = $data->vourcherID;


if($play->Put($play->playID )){
    echo json_encode(array('message'=>'Event update successed!!'));
}else{
    echo json_encode(array('message'=>'Event update Failed!!'));
}

?>