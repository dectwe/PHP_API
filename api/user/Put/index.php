<?php 
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include_once('../../../config/config.php');
include_once('../../../model/userM.php');


$db = new db();
$conn = $db->connection();

$user = new userM($conn);
$user->userID = isset($_GET['id']) ? $_GET['id'] : die();

$data = new userM($conn);
$data = json_decode(file_get_contents('php://input'));

$user->userName = $data->userName;
$user->userPassword = $data->userPassword;
$user->typeID = $data->typeID;


if($user->Put($user->userID)){
    echo json_encode(array('message'=>'user update successed!!'));
}else{
    echo json_encode(array('message'=>'user update Failed!!'));
}

?>