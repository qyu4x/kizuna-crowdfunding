<?php

namespace Hikaru\MVC\Crowdfunding\Entity;

class User {


    public function __construct(string $id_username, string $name, string $email, string $password)
    {
        $this->id_username = $id_username;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;

    }

    private string $id_username;
    private string $name;
    private string $email;
    private string $password;


    public function getIdUsername(): string
    {
        return $this->id_username;
    }


    public function setIdUsername(string $id_username): void
    {
        $this->id_username = $id_username;
    }


    public function getName(): string
    {
        return $this->name;
    }


    public function setName(string $name): void
    {
        $this->name = $name;
    }


    public function getEmail(): string
    {
        return $this->email;
    }


    public function setEmail(string $email): void
    {
        $this->email = $email;
    }


    public function getPassword(): string
    {
        return $this->password;
    }


    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
