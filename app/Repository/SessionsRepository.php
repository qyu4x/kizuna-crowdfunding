<?php

namespace Hikaru\MVC\Crowdfunding\Repository;

use Hikaru\MVC\Crowdfunding\Entity\Sessions;

interface SessionsRepository {
    function save(Sessions $sessions) : Sessions;
    function findById(string $sessions) : ?Sessions;
    function removeById(string $id) : void;
    function removeAll() : void;

}
