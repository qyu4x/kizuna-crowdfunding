<?php

namespace Hikaru\MVC\Crowdfunding\Service;

use Hikaru\MVC\Crowdfunding\Config\Database;
use Hikaru\MVC\Crowdfunding\Entity\User;
use Hikaru\MVC\Crowdfunding\Model\UserLoginRequest;
use Hikaru\MVC\Crowdfunding\Model\UserLoginResponse;
use Hikaru\MVC\Crowdfunding\Model\UserRegisterRequest;
use Hikaru\MVC\Crowdfunding\Model\UserRegisterResponse;
use Hikaru\MVC\Crowdfunding\Repository\UserRepository;
use Hikaru\MVC\Crowdfunding\Validation\ValidateUserLoginRequest;
use Hikaru\MVC\Crowdfunding\Validation\ValidateUserRegisterRequest;
use \Hikaru\MVC\Crowdfunding\Exception\ValidationException;


class UserServiceImpl implements UserService {

    var UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    function register(UserRegisterRequest $userRegisterRequest): UserRegisterResponse {

        ValidateUserRegisterRequest::validateUserRegisterRequest($userRegisterRequest);


        try {
            Database::startTransaction();
            $userExist = $this->userRepository->findById($userRegisterRequest->getIdUsername());
            if (isset($userExist) || $userExist != null) {
                throw new ValidationException("Upps the username is already available");
            }

            $passwordHashing = hash('sha256', $userRegisterRequest->getPassword());

            $user = new User(
                id_username: $userRegisterRequest->getIdUsername(),
                name: $userRegisterRequest->getName(),
                email: $userRegisterRequest->getEmail(),
                password: $passwordHashing,
            );


//            $user = new User();
//            $user->setIdUsername($userRegisterRequest->getIdUsername());
//            $user->setName($userRegisterRequest->getName());
//            $user->setEmail($userRegisterRequest->getEmail());
//            $user->setPassword($passwordHashing);

            $this->userRepository->save($user);
            Database::commitTransaction();

            $responseUser = new UserRegisterResponse();
            $responseUser->user = $user;

            return $responseUser;
        }catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw new ValidationException("Error " . $exception->getMessage());
        }

    }

    function login(UserLoginRequest $userLoginRequest): UserLoginResponse {
        ValidateUserLoginRequest::validateUserLoginRequest($userLoginRequest);

        try {
            $user = $this->userRepository->findById($userLoginRequest->getIdUsername());

            if ($user != null) {
                $userLoginResponse = new UserLoginResponse();
                $userLoginResponse->user = $user;
            } else {
                throw new ValidationException("Username or password not found");
            }

        } catch (ValidationException $exception) {
            throw new ValidationException("Username or password not found");
        }

        $passwordUserRequest = hash('sha256', $userLoginRequest->getPassword());
        $passwordUserResponse = $userLoginResponse->user->getPassword();

        if ($passwordUserRequest != $passwordUserResponse) {
            throw new ValidationException("Invalid username or password");
        }

        return $userLoginResponse;

    }
}
