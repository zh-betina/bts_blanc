<?php
namespace classes\DB;
use mysqli;

class DB {
    private $HOST = 'localhost';
    private $USER = 'betina';
    private $PASSWORD = 'betina';
    private $connection;
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function connect() {
        $conn = new mysqli(
            $this->HOST, $this->USER, $this->PASSWORD, $this->db
        );

        if ($conn->connect_errno) {
            return false;
        } else {
            $this->connection = $conn;
            return $this->connection;
        }
    }

    public function close() {
        $this->connection->close();
    }
}