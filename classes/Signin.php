<?php

namespace classes\Signin;

class Signin {
    private $name;
    private $password;
    private $conn;

    public function __construct($connection, $name, $password)
    {
        $this->conn = $connection;
        $this->name = $name;
        $this->password = md5($password);
    }

    public function signin() {
        $query = "SELECT id FROM bts_blanc WHERE name = '" .$this->name."'" . "AND password = '" . $this->password . "'";
        $result = $this->conn->query($query);
        if ($result->fetch_array() !== null) {
            return true;
        } else {
            return false;
        }
    }
}