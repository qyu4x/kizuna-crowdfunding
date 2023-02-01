<?php

namespace Hikaru\MVC\Crowdfunding\Model;

class UserLoginRequest {

    private ?string $id_username;
    private ?string $password;


    public function getIdUsername(): string
    {
        return $this->id_username;
    }


    public function setIdUsername(string $id_username): void
    {
        $this->id_username = $id_username;
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