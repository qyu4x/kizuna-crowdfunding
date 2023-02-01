<?php

namespace Hikaru\MVC\Crowdfunding\Controller;

use Hikaru\MVC\Crowdfunding\App\View;
use Hikaru\MVC\Crowdfunding\Config\Database;
use Hikaru\MVC\Crowdfunding\Exception\ValidationException;
use Hikaru\MVC\Crowdfunding\Model\UserLoginRequest;
use Hikaru\MVC\Crowdfunding\Model\UserRegisterRequest;
use Hikaru\MVC\Crowdfunding\Repository\SessionsRepositoryImpl;
use Hikaru\MVC\Crowdfunding\Repository\UserRepository;
use Hikaru\MVC\Crowdfunding\Repository\UserRepositoryImpl;
use Hikaru\MVC\Crowdfunding\Service\SessionService;
use Hikaru\MVC\Crowdfunding\Service\SessionServiceImpl;
use Hikaru\MVC\Crowdfunding\Service\UserService;
use Hikaru\MVC\Crowdfunding\Service\UserServiceImpl;


class UserController {

    // set up
    private UserService $userService;
    private SessionService $sessionService;

    public function __construct() {
        $connection = Database::getConnection('production');
        $userRepository = new UserRepositoryImpl($connection);
        $sesiionRepository = new SessionsRepositoryImpl($connection);

        $this->userService = new UserServiceImpl($userRepository);
        $this->sessionService = new SessionServiceImpl($sesiionRepository, $userRepository);
    }

    public function requestRegister() : void {

        $model = [
            'title' => 'Kizuna Register'
        ];
        View::renderLoginManagement('/User/register', $model);
    }


    public function postRequestRegister() : void {

        $model = new UserRegisterRequest(
            id_username: $_POST['id_username'],
            name: $_POST['name'],
            email: $_POST['email'],
            password: $_POST['password'],
        );

        try {
            $this->userService->register($model);
            View::redirectUrl('/users/login');
        } catch (ValidationException $exception) {
            $model = [
                'title' => 'Kizuna Crowdfunding Register',
                'error' => $exception->getMessage(),
            ];
            View::renderLoginManagement('/User/register', $model);
        }
    }

    // login
    public function requestLogin() {
        $model = [
            'title' => 'Kizuna Login'
        ];

        View::renderLoginManagement('/User/login', $model);
    }

    public function postRequestLogin() {

        $model = new UserLoginRequest();
        $model->setIdUsername($_POST['id_username']);
        $model->setPassword($_POST['password']);


        try {
            $user = $this->userService->login($model);
            $this->sessionService->create($user->user->getIdUsername());
            View::redirectUrl('/');
        } catch (ValidationException $exception) {
            $model = [
                'title' => 'Kizuna Crowdfunding Register',
                'error' => $exception->getMessage(),
            ];
            View::renderLoginManagement('/User/login', $model);
        }
    }

    public function postRequestLogout() {

        $user = $this->sessionService->current();
        if ($user != null) {
            $this->sessionService->destroy();
            View::redirectUrl('/');
        }
    }
}
