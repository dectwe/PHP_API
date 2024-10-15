<?php 
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include_once('../../../config/config.php');
include_once('../../../model/storeproductM.php');


$db = new db();
$conn = $db->connection();

$storeproduct = new storeproductM($conn);
$sid = isset($_GET['sid']) ? $_GET['sid'] : die();
$pid = isset($_GET['pid']) ? $_GET['pid'] : die();

if($storeproduct->Delete($sid,$pid)){
    echo json_encode(array('message'=>'storeproduct delete successed!!'));
}else{
    echo json_encode(array('message'=>'storeproduct delete Failed!!'));
}

?>