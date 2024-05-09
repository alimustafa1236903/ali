<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

include_once('../../config/Database.php');
include_once('../../models/Post.php');

use sky\models\Post;

$database = new Database;
$db = $database->connect();

$post = new Post($db);
$data = json_decode(file_get_contents("php://input"));

// Delete logic here

if (isset($data->id)) { // Check if 'id' property is set in the decoded JSON data
    $params = ['id' => $data->id];

    if ($post->delete_post($params)) {
        echo json_encode(['message' => 'Post deleted successfully']);
    } else {
        echo json_encode(['message' => 'Failed to delete post']);
    }
} else {
    echo json_encode(['message' => 'No ID provided']);
}
