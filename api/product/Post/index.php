<?php 
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include_once('../../../config/config.php');
include_once('../../../model/ProductM.php');


$db = new db();
$conn = $db->connection();

$product = new ProductM($conn);
$data = new productM($conn);
$data = json_decode(file_get_contents('php://input'));

$product->productName = $data->productName;
$product->productPrice = $data->productPrice;


if($product->Post()){
    echo json_encode(array('message'=>'product insert successed!!'));
}else{
    echo json_encode(array('message'=>'product insert Failed!!'));
}

?>