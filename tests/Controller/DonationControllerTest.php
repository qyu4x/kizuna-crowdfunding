<?php

namespace Hikaru\MVC\Crowdfunding\Controller;

use Hikaru\MVC\Crowdfunding\Config\Database;
use Hikaru\MVC\Crowdfunding\Repository\DonationRepository;
use Hikaru\MVC\Crowdfunding\Repository\DonationRepositoryImpl;

use PHPUnit\Framework\TestCase;

class DonationControllerTest extends TestCase
{
    private \PDO $connection;
    private DonationController $donationController;
    private DonationRepository $donationRepository;
    protected function setUp(): void
    {
        $this->donationController = new DonationController();
        $this->connection = Database::getConnection('test');
        $this->donationRepository = new DonationRepositoryImpl($this->connection);

    }
    public function testRequestDonation()
    {
        $this->donationController->requestDonation();

        self::expectOutputRegex('[Kizuna Crowdfunding]');
    }
}
