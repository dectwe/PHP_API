<?php 
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include_once('../../../config/config.php');
include_once('../../../model/gameM.php');


$db = new db();
$conn = $db->connection();

$game = new gameM($conn);
$game->gameID = isset($_GET['id']) ? $_GET['id'] : die();

$data = new gameM($conn);
$data = json_decode(file_get_contents('php://input'));

$game->gameName = $data->gameName;
$game->gameLink = $data->gameLink;


if($game->Put($game->gameID)){
    echo json_encode(array('message'=>'Game update successed!!'));
}else{
    echo json_encode(array('message'=>'Game update Failed!!'));
}

?>