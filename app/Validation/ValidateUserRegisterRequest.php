<?php

namespace Hikaru\MVC\Crowdfunding\Validation;

use Hikaru\MVC\Crowdfunding\Exception\ValidationException;
use Hikaru\MVC\Crowdfunding\Model\UserRegisterRequest;

class ValidateUserRegisterRequest {
    public static function validateUserRegisterRequest(UserRegisterRequest $userRegisterRequest) {
        if ($userRegisterRequest->getIdUsername() == null || $userRegisterRequest->getName() == null
            || $userRegisterRequest->getEmail() == null || $userRegisterRequest->getPassword() == null
            || trim($userRegisterRequest->getIdUsername() == "")
            || trim($userRegisterRequest->getName() == "")
            || trim($userRegisterRequest->getEmail() == "")
            || trim($userRegisterRequest->getPassword() == "")) {

            // error
            throw new ValidationException("Upps username, name, email, and password can't be empty");

        }

        if (strlen($userRegisterRequest->getPassword()) < 5) {
            throw new ValidationException("Password must be more than 5 character");
        }

    }
}
