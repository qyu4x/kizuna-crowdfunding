<?php

namespace Hikaru\MVC\Crowdfunding\Middleware;

use Hikaru\MVC\Crowdfunding\App\View;
use Hikaru\MVC\Crowdfunding\Config\Database;
use Hikaru\MVC\Crowdfunding\Repository\SessionsRepositoryImpl;
use Hikaru\MVC\Crowdfunding\Repository\UserRepositoryImpl;
use Hikaru\MVC\Crowdfunding\Service\SessionService;
use Hikaru\MVC\Crowdfunding\Service\SessionServiceImpl;


class MustLoginMiddleware implements Middleware {

    private SessionService $sessionService;
    public function __construct()
    {
        $connection = Database::getConnection('production');
        $sessionRepository = new SessionsRepositoryImpl($connection);
        $userRepository = new UserRepositoryImpl($connection);

        $this->sessionService = new SessionServiceImpl($sessionRepository, $userRepository);
    }

    public function before(): void
    {
        $user = $this->sessionService->current();
        if ($user == null) {
            View::redirectUrl('/users/login');
        }
    }
}
