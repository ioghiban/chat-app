<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

//initialize api
include_once('../core/initialize.php');

//instantiate message
$message= new Message($db);

$message->id = ISSET($_GET['id']) ? $_GET['id'] : die();
$message->read_single();

$message_arr = array(
    'id' => $message->$id,
    'username' => $message->$username,
    'groupid' => $message->$groupid,
    'content' => $message->$content
);

print_r(json_encode($message_arr));
