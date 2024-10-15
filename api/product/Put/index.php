<?php 
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include_once('../../../config/config.php');
include_once('../../../model/ProductM.php');


$db = new db();
$conn = $db->connection();

$product = new ProductM($conn);
$product->productID = isset($_GET['id']) ? $_GET['id'] : die();

$data = new productM($conn);
$data = json_decode(file_get_contents('php://input'));

$product->productName = $data->productName;
$product->productPrice = $data->productPrice;


if($product->Put($product->productID)){
    echo json_encode(array('message'=>'product update successed!!'));
}else{
    echo json_encode(array('message'=>'product update Failed!!'));
}

?>