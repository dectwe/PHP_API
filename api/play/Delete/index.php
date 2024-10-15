<?php 
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include_once('../../../config/config.php');
include_once('../../../model/playM.php');


$db = new db();
$conn = $db->connection();

$play = new playM($conn);
$play->playID = isset($_GET['id']) ? $_GET['id'] : die();

if($play->Delete($play->playID)){
    echo json_encode(array('message'=>'play delete successed!!'));
}else{
    echo json_encode(array('message'=>'play delete Failed!!'));
}

?>