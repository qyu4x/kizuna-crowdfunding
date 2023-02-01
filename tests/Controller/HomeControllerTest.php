<?php

namespace Hikaru\MVC\Crowdfunding\Controller;

use Hikaru\MVC\Crowdfunding\Config\Database;
use Hikaru\MVC\Crowdfunding\Entity\Sessions;
use Hikaru\MVC\Crowdfunding\Entity\User;
use Hikaru\MVC\Crowdfunding\Repository\SessionsRepository;
use Hikaru\MVC\Crowdfunding\Repository\SessionsRepositoryImpl;
use Hikaru\MVC\Crowdfunding\Repository\UserRepository;
use Hikaru\MVC\Crowdfunding\Repository\UserRepositoryImpl;
use PHPUnit\Framework\TestCase;

class HomeControllerTest extends TestCase
{

    private HomeController $homeController;
    private UserRepository $userRepository;
    private SessionsRepository $sessionsRepository;

    protected function setUp(): void
    {
       $connection = Database::getConnection('test');

       $this->userRepository = new UserRepositoryImpl($connection);
       $this->sessionsRepository = new SessionsRepositoryImpl($connection);
       $this->homeController = new HomeController();

       $this->sessionsRepository->removeAll();
       $this->userRepository->removeAll();
    }

    function testGuestLogin() {

        $this->homeController->index();

        self::expectOutputRegex('[Kizuna Home]');
    }

    function testLogin() {

        $user = new User(
            id_username: "rem",
            name: "rem chan",
            email: "chanrem@gmail.com",
            password: "wakaranai"
        );

        $this->userRepository->save($user);

        $session = new Sessions(
            id_sessios: uniqid(),
            username_session_id: 'rem',
        );

        $this->sessionsRepository->save($session);

        $_COOKIE["kizuna_crowdfunding_sessions"] = $session->getIdSessios();

        $this->homeController->index();

        self::expectOutputRegex('[Hello rem chan]');
    }

}
