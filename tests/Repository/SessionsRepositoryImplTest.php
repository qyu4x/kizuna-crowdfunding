<?php

namespace Hikaru\MVC\Crowdfunding\Repository;

use Hikaru\MVC\Crowdfunding\Config\Database;
use Hikaru\MVC\Crowdfunding\Entity\Sessions;
use PHPUnit\Framework\TestCase;

class SessionsRepositoryImplTest extends TestCase
{
    private SessionsRepository $sessionsRepository;

    protected function setUp(): void
    {
        $connection = Database::getConnection('test');
        $this->sessionsRepository = new SessionsRepositoryImpl($connection);

        $this->sessionsRepository->removeAll();
    }

    function testSessionsSuccess() {
        $session = new Sessions(
            id_sessios: uniqid("hikaru"),
            username_session_id: "kaguya"
        );

        $this->sessionsRepository->save($session);

        $result = $this->sessionsRepository->findById($session->getIdSessios());

        self::assertEquals($session->getIdSessios(), $result->getIdSessios());
    }

    function testSessionsRemoveById() {
        $session = new Sessions(
            id_sessios: uniqid("hikaru"),
            username_session_id: "kaguya"
        );

        $this->sessionsRepository->save($session);

        $this->sessionsRepository->removeById($session->getIdSessios());

        $result = $this->sessionsRepository->findById($session->getIdSessios());

        self::assertNull($result);
    }

    function testSessionsNotfound() {
        $session = new Sessions(
            id_sessios: uniqid("hikaru"),
            username_session_id: "kaguya"
        );

        $this->sessionsRepository->save($session);


        $result = $this->sessionsRepository->findById("wakaranai");

        self::assertNull($result);
    }

}
