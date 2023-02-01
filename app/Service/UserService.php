<?php

namespace Hikaru\MVC\Crowdfunding\Service;

use Hikaru\MVC\Crowdfunding\Model\UserLoginRequest;
use Hikaru\MVC\Crowdfunding\Model\UserLoginResponse;
use Hikaru\MVC\Crowdfunding\Model\UserRegisterRequest;
use Hikaru\MVC\Crowdfunding\Model\UserRegisterResponse;

interface UserService {
    function register(UserRegisterRequest $userRegisterRequest) : UserRegisterResponse;
    function login(UserLoginRequest $userLoginRequest) : UserLoginResponse;
}
