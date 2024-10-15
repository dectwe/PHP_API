<?php 
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include_once('../../../config/config.php');
include_once('../../../model/userM.php');


$db = new db();
$conn = $db->connection();

$user = new userM($conn);
$user->userID = isset($_GET['id']) ? $_GET['id'] : die();

if($user->Delete($user->userID)){
    echo json_encode(array('message'=>'user delete successed!!'));
}else{
    echo json_encode(array('message'=>'user delete Failed!!'));
}

?>