<?php

namespace sky\models ;


class Post {
    // Post Properties
    public $id;
    public $category_id;
    public $title;
    public $description;
    public $created_at;

    // Database data.
    private $connection;
    private $table = 'posts';

    public function __construct($db)
    {
        $this->connection = $db;
    }
    

    public function readPosts()
    {
        // Query to get posts data.
        $query = 'SELECT    
            category.name as category,   
            posts.id,   
            posts.category_id,   
            posts.title,   
            posts.description,   
            posts.created_at   
            FROM ' . $this->table . ' posts  LEFT JOIN   
            category ON posts.category_id = category.id   
            ORDER BY   
            posts.created_at DESC';

        $post = $this->connection->prepare($query);
        $post->execute();

        return $post;
    }



    public function read_single_post($id)
    {
        $this->id = $id;

        // Query to get posts data.
        $query = 'SELECT    
            category.name as category,   
            posts.id,   
            posts.category_id,   
            posts.title,   
            posts.description,   
            posts.created_at   
            FROM ' . $this->table . ' posts  LEFT JOIN   
            category ON posts.category_id = category.id   
            WHERE posts.id=?   
            LIMIT 0,1';

        $post = $this->connection->prepare($query);
        $post->bindValue(1, $this->id, \PDO::PARAM_INT);
        $post->execute();

        return $post;
    }
   
    public function create_new_post($params)
    {
        try {
            $this->title = $params['title'];
            $this->description = $params['description'];

            $query = 'INSERT INTO posts SET title = :title, description = :description';

            $post = $this->connection->prepare($query);
            $post->bindValue(':title', $this->title);
            $post->bindValue(':description', $this->description);

            if ($post->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
 
    public function update($params)
    {
        try {
            $this->id = $params['id'];
            $this->title = $params['title'];
            $this->description = $params['description'];

            $query = 'UPDATE posts SET title = :title, description = :description WHERE id = :id';

            $post = $this->connection->prepare($query);
            $post->bindValue(':id', $this->id);
            $post->bindValue(':title', $this->title);
            $post->bindValue(':description', $this->description);

            if ($post->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function delete_post($id)
{
    try {
        $this->id = $id;

        // Query to delete post.
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = ?';

        $post = $this->connection->prepare($query);
        $post->bindValue(1, $this->id, \PDO::PARAM_INT);
        
        if ($post->execute()) {
            return true;
        } else {
            return false;
        }
    } catch (\PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

}
