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

// Retrieve single post logic here


if (isset($_GET['id'])) {
    $data = $post->read_single_post($_GET['id']);

    if ($data->rowCount() > 0) {
        $posts = array();

        while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $post_item = array(
                'id' => $id,
                'categoryName' => $category,
                'description' => $description,
                'title' => $title,
                'created_at' => $created_at
            );

            $posts[] = $post_item;
        }

        echo json_encode($posts);
    } else {
        echo json_encode(array('message' => 'No posts found'));
    }
} else {
    echo json_encode(array('message' => 'No post ID specified'));
}
?>
