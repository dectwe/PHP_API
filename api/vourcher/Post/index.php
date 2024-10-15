<?php 
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include_once('../../../config/config.php');
include_once('../../../model/vourcherM.php');


$db = new db();
$conn = $db->connection();

$vourcher = new vourcherM($conn);
$data = new vourcherM($conn);
$data = json_decode(file_get_contents('php://input'));

$vourcher->vourcherName = $data->vourcherName;
$vourcher->vourcherValue = $data->vourcherValue;
$vourcher->eventID = $data->eventID;
$vourcher->expirationDate = $data->expirationDate;
$vourcher->vourcherStatus = $data->vourcherStatus;
$vourcher->ownerID = $data->ownerID;


if($vourcher->Post()){
    echo json_encode(array('message'=>'vourcher insert successed!!'));
}else{
    echo json_encode(array('message'=>'vourcher insert Failed!!'));
}

?>