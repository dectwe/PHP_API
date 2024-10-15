<?php 
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include_once('../../../config/config.php');
include_once('../../../model/gameM.php');


$db = new db();
$conn = $db->connection();

$game = new gameM($conn);
$data = new gameM($conn);
$data = json_decode(file_get_contents('php://input'));

$game->gameName = $data->gameName;
$game->gameLink = $data->gameLink;


if($game->Post()){
    echo json_encode(array('message'=>'Game insert successed!!'));
}else{
    echo json_encode(array('message'=>'Game insert Failed!!'));
}

?>