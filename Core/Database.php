<?php

namespace Core;
use PDO;

class Database {
    // Create a instance property connection for the database
    public $connection;
    // Create a instance property for the PDO statment
    public $statment;

    // Default constructor when we create a Database object
    public function __construct($config, $username = 'root', $password = '') {
        $dsn = "mysql:" . http_build_query($config, '', ';');

        $this->connection = new PDO($dsn, $username, $password, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    }


    public function query($query , $params = []) {
        // Assigning PDO statment to the Database object
        $this->statment = $this->connection->prepare($query);

        $this->statment->execute($params);
        
        // returning an instance of our Database class
        return $this;
    }
    
    public function find() {
        return $this->statment->fetch();
    }

    public function findAll() {
        return $this->statment->fetchAll();
    }

    public function findOrFail() {
        $result = $this->find();
        if(!$result) {
            abort(Response::NOT_FOUND);
        } else {
            return $result;
        }
    }

}
