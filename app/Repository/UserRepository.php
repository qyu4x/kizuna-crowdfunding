<?php

namespace Hikaru\MVC\Crowdfunding\Repository;

use Hikaru\MVC\Crowdfunding\Entity\User;

interface UserRepository {
    function save(User $user) : User;
    function findById(string $id) : ?User;
    function removeAll() : void;


}