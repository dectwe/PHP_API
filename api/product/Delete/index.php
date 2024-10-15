<?php 
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include_once('../../../config/config.php');
include_once('../../../model/productM.php');


$db = new db();
$conn = $db->connection();

$product = new productM($conn);
$product->productID = isset($_GET['id']) ? $_GET['id'] : die();

if($product->Delete($product->productID)){
    echo json_encode(array('message'=>'Event delete successed!!'));
}else{
    echo json_encode(array('message'=>'Event delete Failed!!'));
}

?>