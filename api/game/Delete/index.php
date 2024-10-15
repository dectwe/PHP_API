<?php 
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


include_once('../../../config/config.php');
include_once('../../../model/gameM.php');


$db = new db();
$conn = $db->connection();

$game = new gameM($conn);
$game->gameID = isset($_GET['id']) ? $_GET['id'] : die();

if($game->Delete($game->gameID)){
    echo json_encode(array('message'=>'Game delete successed!!'));
}else{
    echo json_encode(array('message'=>'Game delete Failed!!'));
}

?>