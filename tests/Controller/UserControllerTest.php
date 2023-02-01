<?php

namespace Hikaru\MVC\Crowdfunding\Controller;

use Hikaru\MVC\Crowdfunding\Config\Database;
use Hikaru\MVC\Crowdfunding\Entity\Sessions;
use Hikaru\MVC\Crowdfunding\Entity\User;
use Hikaru\MVC\Crowdfunding\Repository\SessionsRepository;
use Hikaru\MVC\Crowdfunding\Repository\SessionsRepositoryImpl;
use Hikaru\MVC\Crowdfunding\Repository\UserRepository;
use Hikaru\MVC\Crowdfunding\Repository\UserRepositoryImpl;
use Hikaru\MVC\Crowdfunding\Service\SessionService;
use PHPUnit\Framework\TestCase;

class UserControllerTest extends TestCase
{
    private \PDO $connection;
    private UserController $userController;
    private UserRepository $userRepository;
    private SessionsRepository $sessionsRepository;


    protected function setUp(): void
    {

       $this->userController = new UserController();

       $this->connection = Database::getConnection('test');

       $this->sessionsRepository = new SessionsRepositoryImpl($this->connection);
       $this->sessionsRepository->removeAll();

       $this->userRepository = new UserRepositoryImpl($this->connection);
       $this->userRepository->removeAll();

    }

    function testRequestRegister() {

        $this->userController->requestRegister();

        self::expectOutputRegex('[Kizuna Register]');
        self::expectOutputRegex('[Username]');
        self::expectOutputRegex('[Email]');
        self::expectOutputRegex('[Password]');
        self::expectOutputRegex('[/users/register]');

    }

    function testpostRequestRegisterErrorEmptyValue() {

        $_POST['id_username'] = 'remchan';
        $_POST['name'] = '';
        $_POST['email'] = '';
        $_POST['password'] = '';

        $this->userController->postRequestRegister();

        self::expectOutputRegex('[Kizuna Register]');
        self::expectOutputRegex('[Username]');
        self::expectOutputRegex('[Email]');
        self::expectOutputRegex('[Password]');
        self::expectOutputRegex('[/users/register]');
        self::expectOutputRegex("[Upps username, name, email, and password can't be empty]");
    }

    function testpostRequestRegisterErrorDuplicate() {

        $user = new User(
            id_username: "rem",
            name: "Rem chan",
            email: "remchan@gmail.com",
            password: "onichandaisuki",
        );

        $this->userRepository->save($user);

        $_POST['id_username'] = 'rem';
        $_POST['name'] = 'Rem chan';
        $_POST['email'] = 'remchan@gmail.com';
        $_POST['password'] = 'onichandaisuki';

        $this->userController->postRequestRegister();

        self::expectOutputRegex('[Kizuna Register]');
        self::expectOutputRegex('[Username]');
        self::expectOutputRegex('[Email]');
        self::expectOutputRegex('[Password]');
        self::expectOutputRegex('[/users/register]');
        self::expectOutputRegex("[Upps the username is already available]");
    }

    function testpostRequestRegisterErrorPasswordLenght() {

        $_POST['id_username'] = 'rem';
        $_POST['name'] = 'Rem chan';
        $_POST['email'] = 'remchan@gmail.com';
        $_POST['password'] = 'baka';

        $this->userController->postRequestRegister();

        self::expectOutputRegex('[Kizuna Register]');
        self::expectOutputRegex('[Username]');
        self::expectOutputRegex('[Email]');
        self::expectOutputRegex('[Password]');
        self::expectOutputRegex('[/users/register]');
        self::expectOutputRegex("[Password must be more than 5 character]");
    }

    function testLoginRequest() {
        $this->userController->requestLogin();

        self::expectOutputRegex('Kizuna Login]');
        self::expectOutputRegex('[Username]');
        self::expectOutputRegex('[Password]');
        self::expectOutputRegex('[/users/login]');
    }

    function testLoginRequestErrorValidation() {


        $_POST['id_username'] = 'rem';
        $_POST['password'] = 'baka';

        $this->userController->postRequestLogin();


        self::expectOutputRegex('Kizuna Login]');
        self::expectOutputRegex('[Username]');
        self::expectOutputRegex('[Password]');
        self::expectOutputRegex('[/users/login]');
        self::expectOutputRegex('[Password must be more than 5 character]');


    }

    function testLoginRequestWrongPassword() {

        $user = new User(
            id_username: "kaguya",
            name: "kaguya chan",
            email: "chanchan@gmail.com",
            password: "onichandaisuki",
        );

        $this->userRepository->save($user);

        $_POST['id_username'] = 'kaguya';
        $_POST['password'] = 'kawaineko';

        $this->userController->postRequestLogin();

        self::expectOutputRegex('Kizuna Login]');
        self::expectOutputRegex('[Username]');
        self::expectOutputRegex('[Password]');
        self::expectOutputRegex('[/users/login]');
        self::expectOutputRegex('[Invalid username or password]');
    }

    function testLoginNotFound() {
        $user = new User(
            id_username: "kaguya",
            name: "kaguya chan",
            email: "chanchan@gmail.com",
            password: "onichandaisuki",
        );

        $this->userRepository->save($user);

        $_POST['id_username'] = 'hikaru';
        $_POST['password'] = 'onichandaisuki';

        $this->userController->postRequestLogin();

        self::expectOutputRegex('Kizuna Login]');
        self::expectOutputRegex('[Username]');
        self::expectOutputRegex('[Password]');
        self::expectOutputRegex('[/users/login]');
        self::expectOutputRegex('[Username or password not found]');

    }

    function testPostRequestLogoutSuccess() {
        $user = new User(
            id_username: "kaguya",
            name: "kaguya chan",
            email: "chanchan@gmail.com",
            password: "onichandaisuki",
        );

        $this->userRepository->save($user);

        $session = new Sessions(
            id_sessios: uniqid(),
            username_session_id: "kaguya chan"
        );

        $this->sessionsRepository->save($session);

        $this->userController->postRequestLogout();

        $sessionId = $this->sessionsRepository->findById($session->getIdSessios());

        self::assertNull($sessionId);

    }

}
