<?php

class Database {
    // Database properties.
    private $host = 'localhost';
    private $db_name = 'test';
    private $username = 'root';
    private $password = '';
    private $connection ;
    
    // Database connection method.



    public function connect()
    {
        $this->connection = null;


        try
        {
            $this->connection = new PDO('mysql:host='.$this->host.';dbname='.$this->db_name, 
                $this->username, 
                $this->password,
            );
            
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }


        return $this->connection;
    }
}