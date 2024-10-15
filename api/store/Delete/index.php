<?php 
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include_once('../../../config/config.php');
include_once('../../../model/storeM.php');


$db = new db();
$conn = $db->connection();

$store = new storeM($conn);
$store->storeID = isset($_GET['id']) ? $_GET['id'] : die();

if($store->Delete($store->storeID)){
    echo json_encode(array('message'=>'store delete successed!!'));
}else{
    echo json_encode(array('message'=>'store delete Failed!!'));
}

?>