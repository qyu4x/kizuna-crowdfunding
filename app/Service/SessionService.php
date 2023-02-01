<?php

namespace Hikaru\MVC\Crowdfunding\Service;


use Hikaru\MVC\Crowdfunding\Entity\Sessions;
use Hikaru\MVC\Crowdfunding\Entity\User;

interface SessionService {
    function create(string $userId) : ?Sessions;
    function destroy() : void;
    function current() : ?User;

}
