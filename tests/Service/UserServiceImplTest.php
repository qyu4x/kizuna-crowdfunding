<?php

namespace Hikaru\MVC\Crowdfunding\Service;

use Hikaru\MVC\Crowdfunding\Config\Database;
use Hikaru\MVC\Crowdfunding\Exception\ValidationException;
use Hikaru\MVC\Crowdfunding\Model\UserLoginRequest;
use Hikaru\MVC\Crowdfunding\Model\UserRegisterRequest;
use Hikaru\MVC\Crowdfunding\Repository\UserRepositoryImpl;

use PHPUnit\Framework\TestCase;

class UserServiceImplTest extends TestCase
{
    private UserService $userService;
    private UserRepositoryImpl $userRepository;
    protected function setUp(): void
    {
        $connection = Database::getConnection('test');
        $this->userRepository = new UserRepositoryImpl($connection);
        $this->userService = new UserServiceImpl($this->userRepository);

        //$this->userRepository->removeAll();
    }

    public function testRegisterSuccess() {

        $request = new UserRegisterRequest(
            id_username: "kaguya",
            name: "Kaguya chan",
            email: "kaguyashinomiya@gmail.com",
            password: "onichandaisuki",
        );

        $response = $this->userService->register($request);

        self::assertEquals($request->getIdUsername(), $response->user->getIdUsername());
        self::assertEquals($request->getName(), $response->user->getName());
        self::assertEquals($request->getEmail(), $response->user->getEmail());
        self::assertNotEquals($request->getPassword(), $response->user->getPassword());

        self::assertEquals(hash('sha256', $request->getPassword()), $response->user->getPassword());

    }


    public function testRegisterFailed() {

        $this->expectException(ValidationException::class);

        $request = new UserRegisterRequest(
            id_username: "",
            name: "Kaguya chan",
            email: "kaguyashinomiya@gmail.com",
            password: "",
        );

        $this->userService->register($request);


    }


    public function testRegisterFailedValidationPassword() {

        $this->expectException(ValidationException::class);

        $request = new UserRegisterRequest(
            id_username: "kaguya",
            name: "Kaguya chan",
            email: "kaguyashinomiya@gmail.com",
            password: "uwu", // < 5 letters
        );

        $this->userService->register($request);

    }

    public function testRegisterDuplicate() {

        $request = new UserRegisterRequest(
            id_username: "kaguya",
            name: "Kaguya chan",
            email: "kaguyashinomiya@gmail.com",
            password: "wakaranai",
        );

        $this->userService->register($request);

        $this->expectException(ValidationException::class);

        $request = new UserRegisterRequest(
            id_username: "kaguya",
            name: "Kaguya chan",
            email: "kaguyashinomiya@gmail.com",
            password: "wakaranai",
        );

        $this->userService->register($request);

    }

    public function testLoginSuccess() {

        $request = new UserRegisterRequest(
            id_username: "kaguya",
            name: "Kaguya chan",
            email: "kaguyashinomiya@gmail.com",
            password: "wakaranai",
        );

        $this->userService->register($request);

        $loginRequest = new UserLoginRequest();
        $loginRequest->setIdUsername("kaguya");
        $loginRequest->setPassword("wakaranai");

        $responseLoginRequest = $this->userService->login($loginRequest);
        self::assertSame($loginRequest->getIdUsername(), $responseLoginRequest->user->getIdUsername());
        self::assertSame(hash('sha256', $loginRequest->getPassword()), $responseLoginRequest->user->getPassword());

    }

    public function testLoginError() {
        $request = new UserRegisterRequest(
            id_username: "kaguya",
            name: "Kaguya chan",
            email: "kaguyashinomiya@gmail.com",
            password: "wakaranai",
        );

        $this->userService->register($request);

        self::expectException(ValidationException::class);

        $loginRequest = new UserLoginRequest();
        $loginRequest->setIdUsername("nya");
        $loginRequest->setPassword("wakaranaidesu");

        $responseLoginRequest = $this->userService->login($loginRequest);
        self::assertNotEquals($loginRequest->getPassword(), $responseLoginRequest->user->getPassword());
    }
}
