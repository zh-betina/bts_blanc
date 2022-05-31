<?php

namespace classes\Signup;

class Signup {
    private $name;
    private $surname;
    private $pwd;

    public function __construct($data)
    {
        $this->name = $data['prenom'];
        $this->surname = $data['nom'];
        $this->pwd = $data['mdp'];
        $this->hashPwd();
    }

    public function hashPwd() {
        $this->pwd = md5($this->pwd);
    }

    public function addToDB($connection) {
        $query = "INSERT INTO bts_blanc (name, surname, password) VALUES ('$this->name', '$this->surname', '$this->pwd')";
        if ($connection->query($query)) {
            return true;
        } else return false;
    }
}