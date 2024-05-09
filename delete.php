<?php

include_once('../../config/Database.php');
include_once('../../models/Post.php');

class Post {
    private $conn;
    private $table = 'posts';

    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // Delete post
    public function delete_post($id) {
        // Delete query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $id = htmlspecialchars(strip_tags($id));

        // Bind data
        $stmt->bindParam(':id', $id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}
?>
