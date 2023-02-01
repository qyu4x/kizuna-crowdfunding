<?php

namespace Hikaru\MVC\Crowdfunding\Middleware;

class AuthMiddleware implements Middleware {


    public function before(): void
    {
        session_start();
        if (!isset($_SESSION['username'])) {
            header('Location: /users/login');
            exit();
        }
    }
}
