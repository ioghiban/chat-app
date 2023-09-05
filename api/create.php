<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

//initialize api
include_once('../core/initialize.php');

//instantiate message
$message = new Message($db);

//get raw data
$data = json_decode(file_get_contents("php://input"));

$message->username = $data->username;
$message->groupid = $data->groupid;
$message->content = $data->content;

//create message
if($message->create()){
    echo json_encode(
        array('message' => 'Message sent.')
    );
}else{
    echo json_encode(
        array('message' => 'Message could not be sent.')
    );
}
