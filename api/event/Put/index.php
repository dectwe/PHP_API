<?php 
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include_once('../../../config/config.php');
include_once('../../../model/eventM.php');


$db = new db();
$conn = $db->connection();

$event = new eventM($conn);
$event->eventID = isset($_GET['id']) ? $_GET['id'] : die();

$data = new eventM($conn);
$data = json_decode(file_get_contents('php://input'));

$event->eventName = $data->eventName;
$event->releaseDate = $data->releaseDate;
$event->endDate = $data->endDate;
$event->userID = $data->userID;


if($event->Put($event->eventID)){
    echo json_encode(array('message'=>'Event update successed!!'));
}else{
    echo json_encode(array('message'=>'Event update Failed!!'));
}

?>