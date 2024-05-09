<?php
error_reporting(E_ALL);
ini_set('display_error', 1);

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

include_once('../../config/Database.php');
include_once('../../models/Post.php');



use sky\models\Post;

$database = new Database;
$db = $database->connect();

$post = new Post($db);
$data = json_decode(file_get_contents("php://input"));

// Insert logic here


if(count($_POST))
    {
 $params = [
    'title' => $_POST['title'],
    'description' => $_POST['description'],
   
 ];

 if($post->create_new_post($params))
 {
    echo json_encode(['message' => 'post add successfully']);

 }
}
else if  (isset($data)){
    $params = [
        'title' => $data->title,
        'description' => $data->description,
        
     ];
    
     if($post->create_new_post($params))
     {
        echo json_encode(['message' => 'post add successfully']);
    
     }
}

