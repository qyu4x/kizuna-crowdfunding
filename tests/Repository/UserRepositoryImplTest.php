<?php

namespace Hikaru\MVC\Crowdfunding\Repository;

use Hikaru\MVC\Crowdfunding\Config\Database;
use Hikaru\MVC\Crowdfunding\Entity\User;
use PHPUnit\Framework\TestCase;

class UserRepositoryImplTest extends TestCase
{

    private UserRepository $userRepository;
    protected function setUp(): void
    {
        $connection = Database::getConnection('test');
        $this->userRepository = new UserRepositoryImpl($connection);

        $this->userRepository->removeAll();
    }

    public function testSaveSuccess() {
        $user = new User(
            id_username: "rem",
            name: "Rem chan",
            email: "remchan@gmail.com",
            password: "onichandaisuki",
        );


        $this->userRepository->save($user);

        $result = $this->userRepository->findById($user->getIdUsername());

        self::assertEquals($result->getIdUsername(), $user->getIdUsername());
        self::assertEquals($result->getName(), $user->getName());
        self::assertEquals($result->getEmail(), $user->getEmail());
        self::assertEquals($result->getPassword(), $user->getPassword());
    }

    public function testNotFound() {
        $result = $this->userRepository->findById("wakaranai");

        self::assertNull($result);
    }
}
