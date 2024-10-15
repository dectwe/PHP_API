<?php 
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include_once('../../../config/config.php');
include_once('../../../model/vourcherM.php');


$db = new db();
$conn = $db->connection();

$vourcher = new vourcherM($conn);
$vourcher->vourcherID = isset($_GET['id']) ? $_GET['id'] : die();

$data = new vourcherM($conn);
$data = json_decode(file_get_contents('php://input'));

$vourcher->vourcherName = $data->vourcherName;
$vourcher->vourcherValue = $data->vourcherValue;
$vourcher->eventID = $data->eventID;
$vourcher->expirationDate = $data->expirationDate;
$vourcher->vourcherStatus = $data->vourcherStatus;
$vourcher->ownerID = $data->ownerID;


if($vourcher->Put($vourcher->vourcherID)){
    echo json_encode(array('message'=>'vourcher update successed!!'));
}else{
    echo json_encode(array('message'=>'vourcher update Failed!!'));
}

?>