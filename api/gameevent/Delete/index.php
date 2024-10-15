<?php 
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include_once('../../../config/config.php');
include_once('../../../model/gameeventM.php');


$db = new db();
$conn = $db->connection();

$gameevent = new gameeventM($conn);
$gameID = isset($_GET['gameID']) ? $_GET['gameID'] : die();

$eventID = isset($_GET['eventID']) ? $_GET['eventID'] : die();

if($gameevent->Delete($gameID, $eventID)){
    echo json_encode(array('message'=>'GameEvent delete successed!!'));
}else{
    echo json_encode(array('message'=>'GameEvent delete Failed!!'));
}

?>