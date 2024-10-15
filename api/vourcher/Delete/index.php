<?php 
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include_once('../../../config/config.php');
include_once('../../../model/vourcherM.php');


$db = new db();
$conn = $db->connection();

$vourcher = new vourcherM($conn);
$vourcher->vourcherID = isset($_GET['id']) ? $_GET['id'] : die();

if($vourcher->Delete($vourcher->vourcherID)){
    echo json_encode(array('message'=>'Event delete successed!!'));
}else{
    echo json_encode(array('message'=>'Event delete Failed!!'));
}

?>