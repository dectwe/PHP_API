<?php 
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include_once('../../../config/config.php');
include_once('../../../model/storeproductM.php');


$db = new db();
$conn = $db->connection();

$storeproduct = new storeproductM($conn);
$data = new storeproductM($conn);
$data = json_decode(file_get_contents('php://input'));

$storeproduct->storeID = $data->storeID;
$storeproduct->productID = $data->productID;
$storeproduct->remaining = $data->remaining;

if($storeproduct->Post()){
    echo json_encode(array('message'=>'storeproduct insert successed!!'));
}else{
    echo json_encode(array('message'=>'storeproduct insert Failed!!'));
}

?>