<?php

namespace Hikaru\MVC\Crowdfunding\Repository;

use Hikaru\MVC\Crowdfunding\Entity\Sessions;


class SessionsRepositoryImpl implements SessionsRepository {

    var \PDO $connection;
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    function save(Sessions $sessions): Sessions
    {
        $sql = 'INSERT INTO sessions (id_sessions, username_sessions_id) VALUES (?, ?)';

        try {
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                $sessions->getIdSessios(),
                $sessions->getUsernameSessionId(),
            ]);
        }catch (\Exception $exception) {
            echo "Error " . $exception->getMessage();
        }

        return $sessions;
    }

    function findById(string $id): ?Sessions
    {
        $sql = 'SELECT id_sessions, username_sessions_id FROM sessions WHERE id_sessions = ?';

        try {
            $statement = $this->connection->prepare($sql);
            $statement->execute([
               $id,
            ]);

            if ($row = $statement->fetch()) {
                return new Sessions(
                    id_sessios: $row['id_sessions'],
                    username_session_id: $row['username_sessions_id']
                );
            } else {
                return null;
            }
        }catch (\Exception $exception) {
            echo "Error " . $exception->getMessage();
        } finally {
            $statement->closeCursor();
        }

        return null;
    }

    function removeById(string $id): void
    {
        $sql = 'DELETE FROM sessions WHERE id_sessions = ?';

        try {
            $statement = $this->connection->prepare($sql);
            $statement->execute([$id]);
        } catch (\Exception $exception) {
            echo "Error " . $exception->getMessage();
        }
    }

    // for remove all data after test
    function removeAll(): void
    {

        $sql = 'DELETE FROM sessions';
        $this->connection->exec($sql);

    }
}