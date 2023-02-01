<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Hikaru\MVC\Crowdfunding\App\Router;
use Hikaru\MVC\Crowdfunding\Controller\HomeController;
use Hikaru\MVC\Crowdfunding\Controller\UserController;
use Hikaru\MVC\Crowdfunding\Controller\DonationController;
use Hikaru\MVC\Crowdfunding\Config\Database;
use Hikaru\MVC\Crowdfunding\Controller\PaymentController;
use Hikaru\MVC\Crowdfunding\Middleware\MustLoginMiddleware;
use Hikaru\MVC\Crowdfunding\Middleware\MustNotLoginMiddleware;


Database::getConnection('localhost');


// handle home
Router::add('GET', '/', HomeController::class, 'index', []);

// handle register
Router::add('GET', '/users/register',UserController::class, 'requestRegister', [MustNotLoginMiddleware::class]);
Router::add('POST', '/users/register',UserController::class, 'postRequestRegister', [MustNotLoginMiddleware::class]);

// handle login
Router::add('GET', '/users/login',UserController::class, 'requestLogin', [MustNotLoginMiddleware::class]);
Router::add('POST', '/users/login',UserController::class, 'postRequestLogin', [MustNotLoginMiddleware::class]);

// handle logout and clear cookie
Router::add('GET', '/users/logout',UserController::class, 'postRequestLogout', [MustLoginMiddleware::class]);

Router::add('GET', '/details/([0-9a-zA-Z]*)', DonationController::class, 'detailsDonation', []);

// handle transaction
Router::add('GET','/payment/([0-9a-zA-Z]*)', PaymentController::class,'requestPayment', [MustLoginMiddleware::class]);
Router::add('POST','/payment/([0-9a-zA-Z]*)', PaymentController::class,'postPayment', [MustLoginMiddleware::class]);

// handle guess
Router::add('GET', '/guest', HomeController::class, 'guest', [MustNotLoginMiddleware::class]);

// handle abour
Router::add('GET', '/about', HomeController::class, 'aboutKizuna', []);




Router::run();
