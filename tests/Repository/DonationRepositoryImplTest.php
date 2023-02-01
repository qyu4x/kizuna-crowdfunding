<?php

namespace Hikaru\MVC\Crowdfunding\Repository;

use PHPUnit\Framework\TestCase;
use Hikaru\MVC\Crowdfunding\Config\Database;


class DonationRepositoryImplTest extends TestCase
{

    private DonationRepository $donationRepository;
    protected function setUp(): void
    {
        $connection = Database::getConnection('test');
        $this->donationRepository = new DonationRepositoryImpl($connection);

    }

    function testFindAll() {
        $result = $this->donationRepository->findAll();
        self::assertNotNull($result);

        $check = 0;
        foreach ($result as $row) {
            $check += 1;
            self::assertEquals($check, $row["id"]);
        }
    }

    function testFindById() {
        $result = $this->donationRepository->findById(1);
        self::assertNotNull($result);
        self::assertEquals(1, $result->getId());

    }

    function testFindByIdNotFound() {
        $result = $this->donationRepository->findById(10);
        self::assertNull($result);

    }

    function testFindHistoryById() {
        $result = $this->donationRepository->findHistoryById('rem');
        foreach ($result as $row) {

            self::assertNotNull($row['title']);
            self::assertNotNull($row['created_at']);
            self::assertNotNull($row['image_url']);
            self::assertNotNull($row['organizer']);

        }
    }


}
