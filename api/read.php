<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

//initialize api
include_once('../core/initialize.php');

//instantiate message
$message = new Message($db);

//message query
$result = $message->read();
//get row count
$num = $result->rowCount();

if($num > 0){
    $message_arr = array();
    $message_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $message_item = array(
            'id' => $id,
            'user_name' => $username,
            'group_id' =>$groupid,
            'content' => html_entity_decode($content)
        );
        array_push($message_arr['data'], $message_item);
    }
    //convert to JSON and output
    echo json_encode($message_arr);
} else {
    echo json_encode(array('message' => 'No messages found.'));
}