<?php

namespace Hikaru\MVC\Crowdfunding\Service;

use Hikaru\MVC\Crowdfunding\Config\Database;
use Hikaru\MVC\Crowdfunding\Entity\Sessions;
use Hikaru\MVC\Crowdfunding\Entity\User;
use Hikaru\MVC\Crowdfunding\Repository\SessionsRepository;
use Hikaru\MVC\Crowdfunding\Repository\SessionsRepositoryImpl;
use Hikaru\MVC\Crowdfunding\Repository\UserRepository;
use Hikaru\MVC\Crowdfunding\Repository\UserRepositoryImpl;
use PHPUnit\Framework\TestCase;

// handle header setCookie
function setCookie(string $name, string $value) {
    echo "cookie : $name => $value";
}

class SessionServiceImplTest extends TestCase
{
    private SessionService $sessionService;
    private SessionsRepository $sessionsRepository;
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        $conneection = Database::getConnection('test');
        $this->sessionsRepository = new SessionsRepositoryImpl($conneection);
        $this->userRepository = new UserRepositoryImpl($conneection);
        $this->sessionService = new SessionServiceImpl($this->sessionsRepository, $this->userRepository);

        $this->sessionsRepository->removeAll();
        $this->userRepository->removeAll();

        $user = new User(
            id_username: "rem",
            name: "rem chan",
            email: "chanrem@gmail.com",
            password: "wakaranai"
        );

        $this->userRepository->save($user);

    }

    function testCreate() {

        $sessionResult = $this->sessionService->create('rem');

        self::expectOutputRegex("[cookie : kizuna_crowdfunding_sessions => {$sessionResult->getIdSessios()}]");

    }

    function testDestroy() {

        $session = new Sessions(
           id_sessios: uniqid(),
           username_session_id: 'rem',
        );

        $this->sessionsRepository->save($session);

        $_COOKIE["kizuna_crowdfunding_sessions"] = $session->getIdSessios();
        $this->sessionService->destroy();

        $result = $this->sessionsRepository->findById($session->getIdSessios());

        self::expectOutputRegex("[cookie : kizuna_crowdfunding_sessions => わからない]");
        self::assertNull($result);


    }

    function testCurrent() {
        $session = new Sessions(
            id_sessios: uniqid(),
            username_session_id: 'rem',
        );

        $this->sessionsRepository->save($session);

        $_COOKIE["kizuna_crowdfunding_sessions"] = $session->getIdSessios();

        $user = $this->sessionService->current();

        self::assertEquals($session->getUsernameSessionId(), $user->getIdUsername());
    }
}
