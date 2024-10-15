<?php 
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include_once('../../../config/config.php');
include_once('../../../model/storeM.php');


$db = new db();
$conn = $db->connection();

$store = new storeM($conn);
$store->storeID = isset($_GET['id']) ? $_GET['id'] : die();

$data = new storeM($conn);
$data = json_decode(file_get_contents('php://input'));

$store->storeName = $data->storeName;
$store->storeAddress = $data->storeAddress;
$store->ownerID = $data->ownerID;


if($store->Put($store->storeID)){
    echo json_encode(array('message'=>'store update successed!!'));
}else{
    echo json_encode(array('message'=>'store update Failed!!'));
}

?>