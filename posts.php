<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
$data = $post->readPosts();

// Retrieve posts logic here

if ($data->rowCount()) {
    $posts = array();

    while ($row = $data->fetch(PDO::FETCH_OBJ)) {
        $post_item = array(
            'id' => $row->id,
            'categoryName' => $row->category,
            'description' => $row->description, // Corrected property name
            'title' => $row->title,
            'created_at' => $row->created_at,
        );

        $posts[] = $post_item;
    }
    echo json_encode($posts);
} else {
    echo json_encode(['message' => 'No posts found']);
}
?>
