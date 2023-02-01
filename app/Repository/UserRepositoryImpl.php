<?php

namespace Hikaru\MVC\Crowdfunding\Repository;

use Hikaru\MVC\Crowdfunding\Entity\User;

class UserRepositoryImpl implements UserRepository {

    var \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }


    function save(User $user): User
    {
        $sql = 'INSERT INTO users(id_username, name, email, password) VALUES (?, ? , ? , ?)';

        try {
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                $user->getIdUsername(),
                $user->getName(),
                $user->getEmail(),
                $user->getPassword(),
            ]);


        } catch (\PDOException $exception) {
            echo "Error " . $exception->getMessage();

        }

        return $user;
    }

    public function findById(string $id): ?User
    {
        $sql = 'SELECT id_username, name, email, password FROM users WHERE id_username = ?';
        $statement = $this->connection->prepare($sql);

        try {
            $statement->execute([$id]);

            if ($row = $statement->fetch()) {
                return new User(
                    id_username: $row['id_username'],
                    name: $row['name'],
                    email: $row['email'],
                    password: $row['password'],
                );

            } else {
                return null;
            }

        } catch (\PDOException $exception) {
            echo "Error " . $exception->getMessage();
        } finally {
            $statement->closeCursor();
        }

        return null;

    }


    // for remove all data after testing
    function removeAll(): void
    {

       $sql = 'DELETE FROM users';
       $this->connection->exec($sql);

    }
}
