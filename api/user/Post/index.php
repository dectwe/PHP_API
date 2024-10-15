<?php 
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include_once('../../../config/config.php');
include_once('../../../model/userM.php');


$db = new db();
$conn = $db->connection();

$user = new userM($conn);
$data = new userM($conn);
$data = json_decode(file_get_contents('php://input'));

$user->userName = $data->userName;
$user->userPassword = $data->userPassword;
$user->typeID = $data->typeID;


if($user->Post()){
    echo json_encode(array('message'=>'user insert successed!!'));
}else{
    echo json_encode(array('message'=>'user insert Failed!!'));
}

?>