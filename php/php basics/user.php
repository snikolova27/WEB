<?php

class User
{
    private $username;
    private $password;
    private $email;

    public function __construct($username, $password, $email)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setUsername($username){
        $this->username = $username;
    }

    public function info() {
        return "$this->username: $this->email";
    }
}

?>