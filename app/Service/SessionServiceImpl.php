<?php

namespace Hikaru\MVC\Crowdfunding\Service;

use Hikaru\MVC\Crowdfunding\Config\Database;
use Hikaru\MVC\Crowdfunding\Entity\Sessions;
use Hikaru\MVC\Crowdfunding\Repository\SessionsRepository;
use Hikaru\MVC\Crowdfunding\Repository\UserRepository;
use \Hikaru\MVC\Crowdfunding\Entity\User;

class SessionServiceImpl implements SessionService {

    private static string $COOKIE_NAME = 'kizuna_crowdfunding_sessions';

    private SessionsRepository $sessionsRepository;
    private UserRepository $userRepository;

    public function __construct(SessionsRepository $sessionsRepository, UserRepository $userRepository)
    {
        $this->sessionsRepository = $sessionsRepository;
        $this->userRepository = $userRepository;

    }

    // add session with cookie
    function create(string $userId): ?Sessions
    {
        Database::startTransaction();
        try {
            $session = new Sessions(
                id_sessios: uniqid(),
                username_session_id: $userId,
            );

            $sessionId = $this->sessionsRepository->save($session);

            if ($sessionId != null) {
                setcookie(self::$COOKIE_NAME, $sessionId->getIdSessios(), time() + (60 * 60 * 24 * 30 * 12), "/");
                Database::commitTransaction();
                return $session;
            } else {
                Database::rollbackTransaction();
                return null;
            }

        }catch (\Exception $exception) {
            Database::rollbackTransaction();
            echo "Error " . $exception->getMessage();
            return null;
        }

    }

    // delete cookie session
    function destroy(): void
    {
        Database::startTransaction();

        try {
            $sessionsCookieId = $_COOKIE[self::$COOKIE_NAME] ?? '';
            $this->sessionsRepository->removeById($sessionsCookieId);
            // make the cookie value empty ('わからない')
            setcookie(self::$COOKIE_NAME, 'わからない', 1, "/");
            Database::commitTransaction();
        } catch (\Exception $exception) {
            echo "Error" . $exception->getMessage();
            Database::rollbackTransaction();
        }
    }

    // get current user
    function current(): ?User
    {
        $sessionsCookieId = $_COOKIE[self::$COOKIE_NAME] ?? '';
        if ($sessionsCookieId != null || 'わからない' || '') {
            $session = $this->sessionsRepository->findById($sessionsCookieId);
            if ($session != null) {
                return $this->userRepository->findById($session->getUsernameSessionId());
            } else {
                return null;
            }


        } else {
            return null;
        }
    }
}
