<?php 
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include_once('../../../config/config.php');
include_once('../../../model/eventM.php');


$db = new db();
$conn = $db->connection();

$event = new eventM($conn);
$event->eventID = isset($_GET['id']) ? $_GET['id'] : die();

if($event->Delete($event->eventID)){
    echo json_encode(array('message'=>'Event delete successed!!'));
}else{
    echo json_encode(array('message'=>'Event delete Failed!!'));
}

?>