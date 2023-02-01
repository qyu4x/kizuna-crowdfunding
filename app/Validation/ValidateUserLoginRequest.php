<?php

namespace Hikaru\MVC\Crowdfunding\Validation;


use Hikaru\MVC\Crowdfunding\Exception\ValidationException;
use Hikaru\MVC\Crowdfunding\Model\UserLoginRequest;

class ValidateUserLoginRequest {
    public static function validateUserLoginRequest(UserLoginRequest $userLoginRequest) {
        if ($userLoginRequest->getIdUsername() == null || $userLoginRequest->getPassword() == null
            || trim($userLoginRequest->getIdUsername() == "")
            || trim($userLoginRequest->getPassword() == "")) {

            // error
            throw new ValidationException("Upps username and password can't be empty");

        }

        if (strlen($userLoginRequest->getPassword()) < 5) {
            throw new ValidationException("Password must be more than 5 character");
        }
    }
}
