<?php

namespace Hikaru\MVC\Crowdfunding\Service;

use Hikaru\MVC\Crowdfunding\Config\Database;
use Hikaru\MVC\Crowdfunding\Model\GetDonationRequest;
use Hikaru\MVC\Crowdfunding\Repository\DonationRepositoryImpl;
use Hikaru\MVC\Crowdfunding\Service\DonationServiceImpl;
use PHPUnit\Framework\TestCase;

class DonationServiceImplTest extends TestCase
{
    private DonationService $donationService;

    private DonationRepositoryImpl $donationRepositoryImpl;

    protected function setUp(): void
    {
        $connection = Database::getConnection('test');
        $this->donationRepositoryImpl = new DonationRepositoryImpl($connection);
        $this->donationService = new DonationServiceImpl($this->donationRepositoryImpl);

    }

    function testFindAll() {
        $result = $this->donationService->findAll();

        $check = 0;
        foreach ($result as $row) {
            $check += 1;
            self::assertEquals($check, $row["id"]);
        }
    }

    function testFindById() {
        $donationRequest = new GetDonationRequest(
            id:1
        );

        $result = $this->donationService->findById($donationRequest);

        self::assertNotNull($result);
        self::assertEquals(1, $result->donation->getId());
    }

    function testFindByIdNotFound() {
        $donationRequest = new GetDonationRequest(
            id:10
        );

        $result = $this->donationService->findById($donationRequest);

        self::assertNull($result);

    }

    function testFindAllHistoryDonation() {
        $result = $this->donationService->findHistoryDonationById('rem');
        foreach ($result as $row) {

            self::assertNotNull($row['title']);
            self::assertNotNull($row['created_at']);
            self::assertNotNull($row['image_url']);
            self::assertNotNull($row['organizer']);

        }
    }
}
