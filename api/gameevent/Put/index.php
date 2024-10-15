<?php 
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
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

$gameID = isset($_GET['gameID']) ? $_GET['gameID'] : die();

$eventID = isset($_GET['eventID']) ? $_GET['eventID'] : die();


if($gameevent->Put($gameID, $eventID)){
    echo json_encode(array('message'=>'GameEvent update successed!!'));
}else{
    echo json_encode(array('message'=>'GameEvent update Failed!!'));
}

?>